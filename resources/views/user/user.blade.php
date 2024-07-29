@extends('layout.app')
@section('title', 'User list')

@section('content')

@include('errors.success')

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
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
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
            ajax: "{{ route('users.getUsers') }}",
            columns: [
                { data: 'username', name: 'username' },
                { data: 'full_name', name: 'full_name' },
                { data: 'phone', name: 'phone' },
                { data: 'email', name: 'email' },
                { data: 'role', name: 'role' },
                { data: 'status', name: 'status', render: function(data, type, row) {
                    return '<span style="color: green;">' + data + '</span>';
                }},
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' },
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
                        window.location = "{{route('create.user')}}";
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

        $('div.head-label').html('<h6 class="mb-0">User list</h6>');
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@endsection
