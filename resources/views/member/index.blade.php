@extends('layout.app')
@section('title', 'Member list')

@section('content')
<div class="card">
    <div class="card-body">
        <section id="table-roles">
            <div class="row">
                <div class="col-12">
                    <div class="card-datatable table-responsive pt-0">
                        <table id="detailedTable" class="datatables-basic table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Full Name</th>
                                    <th>Phone</th>
                                    <th>NRIC</th>
                                    <th>CSO</th>
                                    <th>Admin</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th>Action</th>
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
        let dtdom = '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>';

        $('#detailedTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('member.getMember') }}",
            columns: [
                { data: 'username', name: 'username' },
                { data: 'full_name', name: 'full_name' },
                { data: 'phone_1', name: 'phone_1' },
                { data: 'nric', name: 'nric' },
                { data: 'approve_cso', name: 'approve_cso' },
                { data: 'approve_admin', name: 'approve_admin' },
                { 
                    data: 'created_at', 
                    name: 'created_at',
                    render: function(data, type, row) {
                        return moment(data).format('DD MMMM YYYY HH:mm');
                    }
                },
                { 
                    data: 'updated_at', 
                    name: 'updated_at',
                    render: function(data, type, row) {
                        return moment(data).format('DD MMMM YYYY HH:mm');
                    }
                },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            dom: dtdom,
            lengthMenu: [
                [10, 25, 50, 75, 100],
                ['10', '25', '50', '75', '100']
            ],
            buttons: [
                {
                    text: feather.icons['plus'].toSvg({ class: 'mr-50 font-small-4' }) + 'Add',
                    className: 'create-new btn btn-primary',
                    attr: {
                        'data-toggle': 'modal',
                        'data-target': '#modalAddrole'
                    },
                    action: function(e, dt, button, config) {
                        window.location = "{{ route('create.member') }}";
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
            scrollX: true,
            createdRow: function(row, data, dataIndex) {
                if (data.approve_cso == 1) {
                    $('td:eq(4)', row).html('<span style="color: green;">Approve</span>');
                } else {
                    $('td:eq(4)', row).html('<span style="color: red;">Not Approve</span>');
                }
            }
        });

        $('div.head-label').html('<h6 class="mb-0">User list</h6>');
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@endsection
