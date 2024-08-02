@extends('layout.app')
@section('title', 'Catalog List')

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
                                    <th>Store</th>
                                    <th>Whatsapp</th>
                                    <th>Url Catalog</th>
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
            ajax: "{{ route('catalog.getCatalog') }}",
            columns: [
                { data: 'name', name: 'name' },
                { data: 'store_code', name: 'store_code' },
                {
                    data: 'whatsapp',
                    name: 'whatsapp',
                    render: function(data, type, row) {
                        let phoneNumber = data.replace(/\D/g, '');
                        return '<a href="https://wa.me/' + phoneNumber + '" target="_blank">' + data + '</a>';
                    }
                },
                {
                    data: 'url_catalog',
                    name: 'url_catalog',
                    render: function(data, type, row) {
                        return '<a href="' + data + '" target="_blank">' + data + '</a>';
                    }
                },
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
                        window.location = "{{route('create.catalog')}}";
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

        $('div.head-label').html('<h6 class="mb-0">Catalog list</h6>');
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@endsection
