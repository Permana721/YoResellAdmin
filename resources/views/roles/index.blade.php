@extends('layouts.app')
@section('title', 'Roles')
@section('content')

<div class="card">
  <div class="card-body">
      <section id="table-roles">
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
    let arr_col_print =[0,1,2];
    var oTable = $("#detailedTable").DataTable({
      processing: true,
      serverSide: true,
      bDestroy: true, //pakai ini supaya bisa di load berulang2
      oSearch: {"sSearch":oIsiCari},
      scrollX: false,
      ajax:{url: "{{ route('roles.list') }}",method:"POST"},
      columns: [
        { data: 'action', name: 'action', title:'Actions', width: '5%', orderable: false, searchable: false},
        { data: 'name', name: 'name', title:'Name'},
        { data: 'display_name', name: 'display_name', title:'Display Name'},
        { data: 'guard_name', name: 'guard_name', title:'Guard Name'},
        { data: 'updated_at', name: 'updated_at', title:'Updated At'},
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
      order: [[4, 'desc']],
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
              window.location = "{{ route('roles.create') }}";
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
    $('div.head-label').html('<h6 class="mb-0">List Roles</h6>');
    // Order by the grouping

    oTable.on('draw.dt', function () {
      $('.my-tooltip').tooltip({
            trigger: "hover"
      });
    });
  }

  function validasidelete(id,name){
    Swal.fire({
      title: "Are you sure?",
      text: "Role ("+name+") will be delete",
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
              url: "{{ route('roles.destroy',['role'=>"+id+"]) }}",
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
