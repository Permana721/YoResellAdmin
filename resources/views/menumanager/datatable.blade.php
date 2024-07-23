@extends('layouts.app')
@section('title', 'Menu Manager')

@section('content')

@include('errors.success')

<div class="card">
  <div class="card-body">
    <section id="table-menus">
      <div class="row">
          <div class="col-12">
              <div class="card-datatable table-responsive pt-0">
                  <table id="detailedTable" class="datatables-basic table">
                      <thead>
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

  $(document).ready(function(){    
    showList(); 
  });

  function showList(oIsiCari){
    let dtdom = '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>';
    let arr_col_print =[1,2,3,4];
    var oTable = $("#detailedTable").DataTable({
      processing: true,
      serverSide: true,
      bDestroy: true, //pakai ini supaya bisa di load berulang2
      oSearch: {"sSearch":oIsiCari},
      scrollX: true,
      ajax:{url: "{{ route('menu-manager.list') }}",method:"POST"},
      columns: [
        { data: 'action', name: 'action', title:'Actions', width: '5%', orderable: false, searchable: false},
        { data: 'parent', name: 'parent', title:'Parent'},
        { data: 'title', name: 'title', title:'Title'},
        { data: 'menus', name: 'menus', title:'Menu For Role'},
        { data: 'active', name: 'active', title:'Status'},
      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          responsivePriority: 2,
          targets: 0
        },
        {
          responsivePriority: 1,
          targets: 3
        }
      ],
      drawCallback: function (settings) {
          feather.replace({
              width: 14,
              height: 14
          });
      },
      order: [[2, 'asc']],
      dom:dtdom,
      displayLength: 10,
      lengthMenu: [
              [ 10, 25, 50, -1 ],
              [ '10', '25', '50', 'All' ]
      ],
      buttons: [
        {
          text: feather.icons['plus'].toSvg({ class: 'mr-50 font-small-4' }) + 'Add',
          className: 'create-new btn btn-primary',
          attr: {
            'data-toggle': 'modal',
            'data-target': '#modalAddrole'
          },
          action: function ( e, dt, button, config ) {
              window.location = "{{ route('menu-manager.index') }}";
          }
          
        }
      ],
      language: {
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      }
    });
    $('div.head-label').html('<h6 class="mb-0">List Menus</h6>');
    // Order by the grouping

    oTable.on('draw.dt', function () {
      $('.my-tooltip').tooltip({
            trigger: "hover"
      });
    });
  }

  function validasidelete(id){
    Swal.fire({
      title: "Are you sure?",
      text: "This menu will be delete!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete!'
      }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
              $.ajax({
              dataType: 'json',
              type:'DELETE',
              url: "{{ url('menu-manager') }}/"+ id,
              data:{
                  id:id
              },
              success: function(data) {
                Swal.fire(
                    'Deleted!',
                    data.message,
                    'success'
                  )
                  showList();
              },
                  error: function(data) {
                  alert(data.status);
              }
              });
          } 
      })
  }
    
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
</script>
@endsection