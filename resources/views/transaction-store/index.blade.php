@extends('layout.app')
@section('title', 'Dashboard Transaction Store')

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
                                    <th>Store</th>
                                    <th>Omset QTY</th>
                                    <th>Omset Rupiah</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<style>
    div.dataTables_wrapper div.dataTables_paginate {
        margin-top: -35px;
    }
</style>

@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
    var table = $('#detailedTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('store.getTransactionStore') }}",
            data: function(d) {
                d.fromDate = $('#fromDate').val();
                d.toDate = $('#toDate').val();
            }
        },
        columns: [
            { data: 'store', name: 'store' },
            { data: 'omset_qty', name: 'omset_qty' },
            { data: 'omset_rupiah', name: 'omset_rupiah' },
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
        table.ajax.reload();  // Reload table with new data filtered by date
    });
});



    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@endsection
