@extends('layout.app')
@section('title', 'Dashboard Transaction Detail')

@section('content')

@include('errors.success')

<div class="card">
    <div class="card-body">
        <div class="row mb-5" style="position: relative; top: 5px;"> 
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
                        <th>Store Code</th>
                        <th>Initial Store</th>
                        <th>Name</th>
                        <th>Jumlah Terdaftar</th>
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
    $('#filter').on('click', function() {
        $('#detailedTable').DataTable().ajax.reload();
    });

    $(document).ready(function() {
        var table = $('#detailedTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('registrasi.getRegistrasi') }}",
                data: function(d) {
                    d.fromDate = $('#fromDate').val();
                    d.toDate = $('#toDate').val();
                }
            },
            columns: [
                { data: 'store_code', name: 'store_code' },
                { data: 'initial_store', name: 'initial_store' },
                { data: 'name', name: 'name' },
                { data: 'jumlah_terdaftar', name: 'jumlah_terdaftar', searchable: false },
            ],
            dom: 'Bfrtip',
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

        // Reload table when "Show" button is clicked
        $('#filter').on('click', function() {
            table.ajax.reload();
        });

        $('div.head-label').html('<h6 class="mb-0">Registrasi</h6>');
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@endsection