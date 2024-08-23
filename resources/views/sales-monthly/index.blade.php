@extends('layout.app')
@section('title', 'Detail Transaksi')

@section('content')

@include('errors.success')

<div class="card">
    <div class="card-body">
        <div class="row mb-2" style="position: relative; top: 5px;"> 
            <div class="col-md-3">
                <input type="month" id="fromDate" class="form-control" value="{{ date('Y-m', strtotime('first day of january this year')) }}">
            </div>
            <div class="col-md-3">
                <input type="month" id="toDate" class="form-control" value="{{ date('Y-m') }}">
            </div>
            <div class="col-md-3">
                <select id="store" class="form-control">
                    <option value="">Pilih Cabang</option>
                    @foreach($stores as $store)
                        <option value="{{ $store->store_code }}">{{ $store->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select id="typeCustomer" class="form-control">
                    <option value="ALL">Semua Tipe Pelanggan</option>
                    @foreach($typeCustomers as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 mt-2">
                <button id="filter" class="btn btn-primary">Tampilkan</button>
            </div>
        </div>

        <div>
            <canvas id="salesChart"></canvas>
        </div>

        <section id="table-roles">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card-datatable table-responsive pt-0">
                        <table id="detailedTable" class="datatables-basic table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Periode</th>
                                    <th>Cabang</th>
                                    <th>Tipe Pelanggan</th>
                                    <th>Jumlah Penjualan (Qty)</th>
                                    <th>Total Penjualan (Rupiah)</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#detailedTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('sales.getSalesMonthly') }}",
                data: function(d) {
                    d.fromDate = $('#fromDate').val();
                    d.toDate = $('#toDate').val();
                    d.store = $('#store').val();
                    d.type_customer = $('#typeCustomer').val(); 
                }
            },
            columns: [
                { data: 'no', name: 'no' },
                { data: 'periode', name: 'periode' },
                { data: 'cabang', name: 'cabang' },
                { data: 'salesQTY', name: 'salesQTY' },
                { data: 'salesRupiah', name: 'salesRupiah' }
            ]
        });

        $('#filter').on('click', function() {
            table.ajax.reload();
            updateChart();
        });

        function updateChart() {
            let fromDate = $('#fromDate').val();
            let toDate = $('#toDate').val();
            let store = $('#store').val();
            let typeCustomer = $('#typeCustomer').val();

            $.ajax({
                url: "{{ route('sales.getSalesMonthlyChart') }}",
                method: 'GET',
                data: { fromDate, toDate, store, type_customer: typeCustomer }, 
                success: function(data) {
                    myChart.data.labels = data.labels;
                    myChart.data.datasets[0].data = data.qty;
                    myChart.data.datasets[1].data = data.rupiah;
                    myChart.update();
                }
            });
        }
    });

    var ctx = document.getElementById('salesChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [
                {
                    label: 'Qty',
                    data: [],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Rupiah',
                    data: [],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: { beginAtZero: true },
                y: { beginAtZero: true }
            }
        }
    });
</script>

@endsection
