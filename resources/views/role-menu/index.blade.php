@extends('layout.app')
@section('title', 'RoleMenu list')

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
                                    <th>Role</th>
                                    <th>Menu</th>
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
    let dtdom = '<"card-header border-bottom mr-5"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>';

    $('#detailedTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('get.role.menu') }}",
        columns: [
            { data: 'role', name: 'role' },
            { data: 'menu', name: 'menu' },
            { 
                data: 'created_at', 
                name: 'created_at',
                render: function(data) {
                    return moment(data).isValid() ? moment(data).format('DD MMMM YYYY HH:mm') : 'Invalid Date';
                }
            },
            { 
                data: 'updated_at', 
                name: 'updated_at',
                render: function(data) {
                    return moment(data).isValid() ? moment(data).format('DD MMMM YYYY HH:mm') : 'Invalid Date';
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
                className: 'create-new btn btn-primary d-none',
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
    });

    $('div.head-label').html('<h6 class="mb-0">RoleMenu list</h6>');
});


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
@endsection
