@extends('layout.app')
@section('title', 'Member Detail')

@section('content')

@include('errors.success')

<div class="card">
    <div class="card-body">
        <section id="table-roles">
        <div class="row">
            <div class="col-12">
            <div class="card-datatable table-responsive pt-0">
                <table id="detailedTable" class="datatables-basic table">
                <thead>
                    <tr>
                    <th>Store</th>
                    <th>Name</th>
                    <th>Member</th>
                    <th>Omset QTY</th>
                    <th>Omset Rupiah</th>
                    <th id="statusColumn">Status</th>
                    </tr>
                </thead>
                <tbody>
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
<script type="text/javascript">
    $(document).ready(function() {
        let dtdom = '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>';

        $('#detailedTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('transaction.gettransaction') }}",
            columns: [
                { data: 'store_code', name: 'store_code' },
                { data: 'name', name: 'name' },
                { data: 'member', name: 'member' },
                { data: 'omset_QTY', name: 'omset_QTY' },
                { data: 'omset_rupiah', name: 'omset_rupiah' },
            ],
            dom: dtdom,
            lengthMenu: [
                [10, 25, 50, 75, 100],
                ['10', '25', '50', '75', '100']
            ],
            buttons: [
                {
                    text: feather.icons['plus'].toSvg({ class: 'mr-50 font-small-4' }) + 'Add',
                    className: 'create-new btn btn-primary d-none',
                    attr: {
                        'data-toggle': 'modal',
                        'data-target': '#modalAddrole'
                    },
                    action: function(e, dt, button, config) {
                        window.location = "{{route('create.role')}}";
                    }
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

        $('div.head-label').html('<h6 class="mb-0">Transaction Member Detail</h6>');
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@endsection
