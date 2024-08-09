@extends('layout.app')
@section('title', 'Dashboard Transaction Detail')

@section('content')

@include('errors.success')

<div class="card">
    <div class="card-body">
        <div class="row">
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

    $('#detailedTable').DataTable({
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
        { data: 'gross', name: 'gross' },
        { data: 'disc', name: 'disc' },
        { data: 'qty', name: 'qty' },
        { data: 'price', name: 'price' },
        { data: 'pos', name: 'pos' },
        { data: 'trans', name: 'trans' },
        { data: 'Number', name: 'salesHeader.number' }
    ],
    scrollX: true, // Enable horizontal scroll
    dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'csv', 'pdf'
    ]
});


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@endsection