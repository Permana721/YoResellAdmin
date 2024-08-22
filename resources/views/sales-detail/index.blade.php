@extends('layout.app')
@section('title', 'Dashboard Transaction Detail')

@section('content')

@include('errors.success')

<div class="card">
    <div class="card-body">
        <div class="row mb-2" style="position: relative; top: 5px;"> 
            <div class="col-md-3">
                <input type="date" id="fromDate" class="form-control" placeholder="From">
            </div>
            <div class="col-md-3">
                <input type="date" id="toDate" class="form-control" placeholder="To">
            </div>
            <div class="col-md-2">
                <button id="filter" class="btn btn-primary">Show</button>
            </div>
        </div>
        <section id="table-roles">
        <div class="row">
            <div class="col-12">
            <div class="card-datatable table-responsive pt-0">
                <table id="detailedTable" class="datatables-basic table">
                    <thead>
                        <tr>
                        <th>Tanggal</th>
                        <th>Code</th>
                        <th>StoreName</th>
                        <th>SubCat</th>
                        <th>TillCode</th>
                        <th>PLU</th>
                        <th>SV</th>
                        <th>Type</th>
                        <th>Desc</th>
                        <th>Gros</th>
                        <th>Disc</th>
                        <th>QTY</th>
                        <th>Price</th>
                        <th>Pos</th>
                        <th>Trans</th>
                        <th>Number</th>
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
    $('#filter').on('click', function() {
        $('#detailedTable').DataTable().ajax.reload();
    });

    $(document).ready(function() {
        var table = $('#detailedTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('sales.getSalesDetail') }}",
                data: function(d) {
                    d.fromDate = $('#fromDate').val();
                    d.toDate = $('#toDate').val();
                }
            },
            columns: [
                { data: 'tanggal', name: 'tanggal' },
                { data: 'store_code', name: 'store_code' },
                { data: 'StoreName', name: 'store.name' },
                { data: 'SubCat', name: 'masterArticle.subcat' },
                { data: 'sku', name: 'sku' },
                { data: 'plu', name: 'plu' },
                { data: 'sv', name: 'sv' },
                { data: 'Type', name: 'masterArticle.art_type_system' },
                { data: 'description', name: 'description' },
                { 
                    data: 'gross', 
                    name: 'gross',
                    render: function(data, type, row) {
                        return data ? data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") : '0';
                    }
                },
                { data: 'disc', name: 'disc' },
                { data: 'qty', name: 'qty' },
                { 
                    data: 'price', 
                    name: 'price',
                    render: function(data, type, row) {
                        return data ? data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") : '0';
                    }
                },
                { data: 'pos', name: 'pos' },
                { data: 'trans', name: 'trans' },
                { data: 'Number', name: 'salesHeader.number' }
            ],
            dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-md-6"B><"col-md-6"f>>' + 
                't' +
                '<"row"<"col-md-6"i><"col-md-6"p>>',
            lengthMenu: [
                [10, 25, 50, 75, 100],
                ['10', '25', '50', '75', '100']
            ],
            buttons: [
                {
                    extend: 'copy',
                    text: 'Copy',
                    className: 'btn btn-primary'
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    className: 'btn btn-primary'
                },
                {
                    extend: 'csv',
                    text: 'CSV',
                    className: 'btn btn-primary'
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    className: 'btn btn-primary'
                }
            ],
            language: {
                paginate: {
                    previous: '&nbsp;',
                    next: '&nbsp;'
                },
                info: "Showing _START_ to _END_ of _TOTAL_ entries"
            },
            scrollX: true
        });
        
        $('#filter').on('click', function() {
            table.ajax.reload();
        });
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@endsection