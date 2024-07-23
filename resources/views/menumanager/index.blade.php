@extends('layout.app')
@section('title', 'Menu Manager')

@section('content')

@include('errors.success')
@include('errors.error')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-8 tabbable">
                <div class="mg-b-10" id="success-indicator" style="display:none;">
                    <div class="alert alert-success" role="alert">
                        <strong>Information: </strong> Order menu has been saved.
                    </div>
                </div>
                <ul class="nav nav-tabs nav-justified" id="menumanagerTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="23" data-toggle="tab" href=#" role="tab" aria-controls="" aria-selected="true"><span class="cap"></span></a>
                    </li>
                </ul>
                <div class="tab-content bd bd-gray-300 bd-t-0 pd-20" id="menumanagerTabContent">
                    <div class="tab-pane active" id="" role="tabpanel" aria-labelledby="">
                        <div><input type="hidden" id="nestable-output" />
                            <div class="dd" id="nestable">
                                <ol class="dd-list">
                                    
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div><a href="{{ url('menu-manager/table') }}" class="btn-primary btn-block btn-sm pd-x-15 btn-uppercase mg-t-10">
                        <center><i class="fa fa-list wd-10 mg-r-5"></i> Table List</center>
                    </a></div>
                <div class="card">
                    <div class="card-header bg-gray-200 pd-t-10 pd-b-10">Info</div>
                    <div class="card-body">Drag the menu list to re-order and automatically to save the position.</div>
                </div>

                <div class="card mg-t-20">
                    <div class="card-header bg-gray-200 pd-t-10 pd-b-10">Add Menu</div>
                    <div class="card-body pd-b-0">
                        <ul class="alert alert-danger">
                            error
                        </ul>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-paper-plane wd-10 mg-r-5"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link href="{{ asset('app-assets/nestable/jquery.nestable.css') }}" rel="stylesheet">
@endsection

{{-- @section('scripts')
<script src="{{ asset('app-assets/nestable/jquery.nestable.js') }}"></script>
<script type="text/javascript">
    $(function() {
        var updateOutput = function(e) {
            var list = e.length ? e : $(e.target),
                output = list.data('output');
            if (window.JSON) {
                output.val(window.JSON.stringify(list.nestable('serialize')));
            } else {
                output.val('JSON browser support required for this.');
            }
        };
        @foreach($groups as $group)
        $('#nestable-{{ str_replace(' ','',$group->menus) }}').nestable().on('change', updateOutput);
        updateOutput($('#nestable-{{ str_replace(' ','',$group->menus) }}').data('output', $('#nestable-{{ str_replace(' ','',$group->menus) }}-output')));
        @endforeach

        $('.dd').on('change', function() {
        $("#success-indicator").hide();
          var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
          @foreach($groups as $group)
            var dataString{{ str_replace(' ','',$group->menus) }} = { 
              data : $("#nestable-{{ str_replace(' ','',$group->menus) }}-output").val(),
              _token : CSRF_TOKEN
            };
            $.ajax({
              type: 'POST',
              url: '{{ url("menu-manager/menusort") }}',
              data: dataString{{ str_replace(' ','',$group->menus) }},
              cache : false,
              success: function(data){
                $("#success-indicator").show();
              }
            });
          @endforeach
        });
    });

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
              url: "{{ url('menu-manager') }}/"+id,
              data:{
                  id:id
              },
              success: function(data) {
                Swal.fire(
                    'Deleted!',
                    data.message,
                    'success'
                  )
                  location.reload();
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
@endsection --}}