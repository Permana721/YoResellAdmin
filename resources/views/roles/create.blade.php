@extends('layouts.app')
@section('title', 'Add Role')
@section('content')

<section class="context-drag-drop-tree">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <form id="frmAdd" name="frmAdd" class="form form-vertical" autocomplete="off">
                        <div class="row">
                            <div class="col-6">
                              <label>Role Name</label>
                              <div class="form-group" required>
                                <input type="text" id="name" name="name" class="form-control" maxlength="30" autofocus >
                              </div>
                            </div>
                            <div class="col-6">
                                <label>Description</label>
                                <div class="form-group" required>
                                  <input type="text" id="display_name" name="display_name" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <h4 class="card-title">Roles</h4>
                        <div id="role-tree-checkbox"></div>
                        <br>
                        <div class="row">
                            <div class="col-12">
                                <a class="btn btn-info" href="{{ route('roles.index') }}"> {{ __('general.back') }}</a>
                                <button id="save" name="save" class="btn btn-primary" type="button" onclick="saving()"><span>{{ __('general.save') }}</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/jstree.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/ext-component-tree.css')}}">
@endsection

@section('scripts')
<script src="{{ asset('app-assets/vendors/js/extensions/jstree.min.js')}}"></script>
<script type="text/javascript">
    $(function () {
        $.ajax({
            type: "GET",
            url: "{{ route('permission.list.all') }}",
            dataType: "json",
            success: function (data) {
                let permission= data.permission;
                const result = Object.entries(permission.reduce((acc, { display_name, group_name,type,id }) => {
                    acc[group_name] = [...(acc[group_name] || []), { "text":display_name,type,id,"type": "css" }];
                    return acc;
                }, {})).map(([key, text]) => ({ text: key, children: text }));
                createJSTree(result);
            },

            error: function (xhr, ajaxOptions, thrownError) {
                Swal.fire(xhr.status);
                Swal.fire(thrownError);
            }
        });            
    });

    function createJSTree(jsondata) {    
        let checkboxTree = $('#role-tree-checkbox');   
        checkboxTree.jstree({
            core: {
                data: jsondata
            },
            plugins: ['types', 'checkbox', 'wholerow'],
            types: {
                default: {
                    icon: 'far fa-folder'
                },
                css: {
                    icon: 'far fa-folder'
                }
            }        
        });     
    }

    $("#save").click(function(){
        let flag = 1,pesan="";
        let role_name = $('#name').val();
        let role_description = $('#display_name').val();
        let checked_ids = []; 
        let selectedNodes = $('#role-tree-checkbox').jstree("get_bottom_checked", true);
        $.each(selectedNodes, function() {
            checked_ids.push(this.id);
        });

        if (checked_ids.length == 0 || role_name==''){
            flag=0
            pesan ="The given data was invalid";
        }

        if (flag==1) {
            $.ajax({
                dataType: 'json',
                type:'POST',
                url: "{{ route('roles.store') }}",
                data: { name:role_name,
                        display_name:role_description,
                        permission:checked_ids
                },
                success: function(data) {
                    Swal.fire({
                        title: 'Great job',
                        icon:"success",
                        text: data.message,
                        type: 'success',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK!'
                    }).then((result) => {
                        if(result){
                            location.href = '{{ route('roles.index') }}';
                        }else{
                            alert("Something went wrong!");
                        }
                    })
                },
                statusCode: {
                    500: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...1',
                            text: data.responseJSON.errors.name,
                        });
                        $('#name').focus();                        
                    },
                    422: function(data) {

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...2',
                            text: data.responseJSON.errors.name,
                        });
                        $('#name').focus();                        
                    }
                },
                // error: function(response) {
                //     Swal.fire('Error..',response.responseJSON.errors.name,'error');
                // }
            }); 
        }else{
            $('#name').focus();
            Swal.fire('Warning ... ', pesan ,'warning');    
        }
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#save').click(function() 
	{
		$('#beloader').hide();
	})
    function saving() {
		document.getElementById('loading').style.display = "block";
	}
</script>
@endsection