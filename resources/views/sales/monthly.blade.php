@extends('layout.app')
@section('title', 'Sales Monthly')

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
                        <th>No</th>
                        <th>Periode</th>
                        <th>Cabang</th>
                        <th>Type Costumer</th>
                        <th>Sales QTY</th>
                        <th>Sales Rupiah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $x)
                        <tr class="align-middle">
                        <td>{{ $x->tanggal }}</td>
                        <td>{{ $x->code }}</td>
                        <td>{{ $x->store_name }}</td>
                        <td>{{ $x->subcat }}</td>
                        <td>{{ $x->tillcode }}</td>
                        <td>{{ $x->plu }}</td>
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

        $('div.head-label').html('<h6 class="mb-0">List Sales</h6>');
    });

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    </script>
@endsection