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
                    d.start_date = $('#fromDate').val();
                    d.end_date = $('#toDate').val();
                    d.store = $('#store').val();
                    d.type_customer = $('#typeCustomer').val(); 
                }
            },
            pageLength: 10,
            columns: [
                { data: 'no', name: 'no' },
                { data: 'periode', name: 'periode' },
                { data: 'cabang', name: 'cabang' },
                { data: 'tipe_customer', name: 'tipe_customer' },
                { data: 'sales_qty', name: 'sales_qty' },
                { data: 'total_penjualan', name: 'total_penjualan' }
            ],
            paging: true,
        });
    });

</script>

@endsection
