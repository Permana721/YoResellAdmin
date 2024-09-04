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

        <div class="row mb-5 ml-2" style="position: relative; justify-content: end; top: 40px;">
            <div class="d-flex align-items-center">
                <h6 class="mb-0 me-5 mr-1">Search :</h6> 
                <input type="text" id="searchInput" class="form-control" style="width: auto;">
            </div>
        </div>        

        <section id="table-roles">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card-datatable table-responsive pt-0">
                        <table id="detailedTable" class="display table" style="width:100%;">
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
                            <tbody id="tableBody">
                                <!-- Data akan dimuat di sini -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        let table = $('#detailedTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('sales.getSalesMonthly') }}",
                data: function (d) {
                    d.page = Math.ceil(d.start / d.length) + 1; // Update page number
                    d.per_page = d.length;
                    d.start_date = $('#fromDate').val();
                    d.end_date = $('#toDate').val();
                    d.store = $('#store').val();
                    d.type_customer = $('#typeCustomer').val();
                    d.search = $('#searchInput').val();
                }
            },
            columns: [
                { data: 'no', name: 'no' },
                { data: 'periode', name: 'periode' },
                { data: 'cabang', name: 'cabang' },
                { data: 'tipe_customer', name: 'tipe_customer' },
                { data: 'sales_qty', name: 'sales_qty' },
                { data: 'total_penjualan', name: 'total_penjualan' }
            ],
            dom: 'rtip', // Hide search box and entries
            language: {
                info: "Showing _START_ to _END_ of _TOTAL_ entries", // Customize the info text
                infoFiltered: "", // Hide the "filtered from" text
                infoEmpty: "Showing 0 to 0 of 0 entries"
            }
        });

        $('#filter').on('click', function() {
            table.draw(); // Reload data with selected filters
        });

        $('#searchInput').on('keyup', function() {
            table.search($(this).val()).draw(); // Reload data with search term
        });
    });
</script>
@endsection
