@extends('layout.app')
@section('title', 'Region List')

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
                                    <th>Name</th>
                                    <th>Initial Store</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Edit</th>
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
            ajax: "{{ route('region.getRegion.store') }}",
            columns: [
                { data: 'region', name: 'region' },
                { data: 'initial_stores', name: 'initial_stores' },
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
                    className: 'create-new btn btn-primary d-none',
                    attr: {
                        'data-toggle': 'modal',
                        'data-target': '#modalAddRole'
                    },
                    action: function(e, dt, button, config) {
                        window.location = "{{route('create.region')}}";
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

        $('div.head-label').html('<h6 class="mb-0">Region Store list</h6>');
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@endsection
