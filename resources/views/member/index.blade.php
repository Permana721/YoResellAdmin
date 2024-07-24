@extends('layout.app')
@section('title', 'Member')

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
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Phone</th>
                    <th>YMC</th>
                    <th>CSO</th>
                    <th>ADMIN</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th id="statusColumn">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $x)
                    <tr class="align-middle">
                    <td>{{ $x->username }}</td>
                    <td>{{ $x->full_name }}</td>
                    <td>{{ $x->phone }}</td>
                    <td>{{ $x->ymc }}</td>
                    <td>{{ $x->cso }}</td>
                    <td>{{ $x->admin }}</td>
                    <td>{{ $x->created_at }}</td>
                    <td>{{ $x->updated_at }}</td>
                    <td>
                        <div class="dropdown">
                        <button class="btn transparent" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">menu</i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="">View</a>
                            <a class="dropdown-item" href="">Edit</a>
                            <form action="" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                        </div>
                    </td>
                    </tr>
                    @endforeach
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
        dom: dtdom,
        lengthMenu: [
            [10, 25, 50, 100],
            ['10', '25', '50', '100']
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
                window.location = "";
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
        responsive: true,
        lengthChange: true
        });

        $('div.head-label').html('<h6 class="mb-0">List Member</h6>');
    });

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    </script>
@endsection