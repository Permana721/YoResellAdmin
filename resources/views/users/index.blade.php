@extends('layouts.app')
@section('title', 'Users')

@section('content')

@include('errors.success')
  
<div class="card">
  <div class="card-body">
    <form id="frmSearch" class="invoice-repeater">
      <div data-repeater-list="invoice">
        <div data-repeater-item>
            <div class="row d-flex align-items-end">
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control select-data" id="role" name="role" required>
                          <option value="">-- Select Role --</option>
                          <option value="all">-- All --</option>
                          @foreach($roles as $key => $val)
                            <option value="{{$val}}">{{$val}}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label for="nama">Name</label>
                        <input type="text" class="form-control" id="nama" aria-describedby="name" autocomplete="off" />
                      </div>
                </div>
                    
                <div class="col-md-4 col-12">
                  <div class="form-group d-flex justify-content-center">
                    <label for="button"></label>
                      <button class="btn btn-primary mr-1" type="submit">
                          <i data-feather="search" class="mr-35"></i>
                          <span>{{ __('general.search') }}</span>
                      </button>
                      <button class="btn btn-info mr-0" type="button" onClick="resetPage(this)">
                        <i data-feather="refresh-cw" class="mr-35"></i>
                        <span>{{ __('general.reset') }}</span>
                    </button>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </form>
    <hr>
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
    showList('','all','');
  });

  $('#frmSearch').on('submit',(function(e) {
    e.preventDefault();
    var role = $('#role').val();
    var nama = $('#nama').val();
    showList('',role,nama);
  }));

  function showList(oIsiCari,role,nama){
    let dtdom = '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>';
    let arr_col_print =[0,1,2];
    var oTable = $("#detailedTable").DataTable({
      processing: true,
      serverSide: true,
      bDestroy: true, //pakai ini supaya bisa di load berulang2
      oSearch: {"sSearch":oIsiCari},
      scrollX: false,
      ajax:{
        dataType: 'json',
        url: "{{ route('users.list') }}",
        method:"POST",
        data:{
          role:role,
          nama:nama
        }
      },
      columns: [
          { data: 'action', name: 'action', title:'Actions', width: '5%', orderable: false, searchable: false},
            {
              data: 'file_name',
              name: 'users.file_name',
              title: 'Photo',
              className: "table-view-pf-actions",
              className: 'vertical-align-middle dt-head-center dt-body-center',
              orderable: false,
              searchable: false, 
              render: function (data, type, full, meta) {
                  return `<center><img class="text-center" src="{{ asset('pictures/users')}}/`+data+`" style='height:50px'></center>`;
              }
            },
          { data: 'name', name: 'users.name', title: 'Name'},
          { data: 'username', name: 'users.username', title: 'Username'},
          { data: 'initial_store', name: 'users.initial_store', title: 'Store'},
          { data: 'roles', name: 'roles', title: 'Roles'},
          { data: 'block', name: 'users.block', title: 'Status'},
          { data: 'updated_at', name: 'users.updated_at', title: 'Updated At'},
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
        lockUnlock();
      },
      order: [[7, 'desc']],
      dom:dtdom,
      displayLength: 10,
      lengthMenu: [
              [ 10, 25, 50, 100 ],
              [ '10', '25', '50', '100' ]
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
              window.location = "{{ route('users.create') }}";
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
    $('div.head-label').html('<h6 class="mb-0">List Users</h6>');
    // Order by the grouping

    oTable.on('draw.dt', function () {
      $('.my-tooltip').tooltip({
            trigger: "hover"
      });
    });
  }

  function lockUnlock(){
    $(".userLockUnlock").change(function(){
      let id = $(this).attr('id');
      let key = $(this).data('userid');
      let newStatus,oldStatus;
      let domId ="IDUserLockUnlock_"+ key;
      if (this.checked) {
        newStatus = 'N';
        oldsStatus = 'Y';
        updateStatus(key,oldStatus,newStatus,domId)
      } else {
        newStatus = 'Y';
        oldStatus = 'N';
        updateStatus(key,oldStatus,newStatus,domId)
      }
    });
  }

  function updateStatus(id,oldStatus,newStatus,domId){
      $.ajax({
        dataType: 'json',
        type:'POST',
        url: "{{ route('users.updatestatus') }}",
        data:{
          id:id,
          oldStatus:oldStatus,
          newStatus:newStatus
        },
        success: function(data) {
          if (data.block == 'N'){
            if (newStatus == 'N'){
               $("#"+domId).text("Active");
            }

            if (newStatus == 'Y'){
                $("#"+domId).text("Locked");
            }
            showList('','all','');
            Swal.fire("Success", data.message, "success");
          }else{
            showList('','all','');
             Swal.fire("Success", data.message, "success");
          }
        },
        error: function(data) {
           Swal.fire("Error","Error :" + data.message,"error");
        }
      });
  }

  function validasidelete(id,name){
    Swal.fire({
      title: "Are you sure?",
      text: "User ("+name+") will be delete",
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
              url: "{{ url('users') }}/" + id,
              data:{
                  id:id
              },
              success: function(data) {
                Swal.fire(
                    'Deleted!',
                    data.message,
                    'success'
                  )
                  showList('','all','');
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
  function resetPage(){
    $("#frmSearch")[0].reset();
    showList('','all','');
  }
</script>
@endsection