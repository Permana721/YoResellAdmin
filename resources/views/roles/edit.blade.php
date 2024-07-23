@extends('layouts.app')
@section('title', 'Edit Role')
@section('content')

<section class="context-drag-drop-tree">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Role</div>
                <div class="card-body">
                    <div id="loading" style="display:none;text-align:center">   
                        <button class="btn waves-effect" type="button" disabled="">
                          <span class="spinner-border spinner-border-md" role="status" aria-hidden="true"></span>
                          <span class="ms-25 align-middle">Loading...</span>
                        </button>
                    </div>
                    <div id="beloader">
                        <form id="frmAdd" name="frmAdd" class="form form-vertical" autocomplete="off">
                            <div class="row">
                                <div class="col-6">
                                <label>Role Name</label>
                                <div class="form-group" required>
                                    <input type="text" id="name" name="name" class="form-control" maxlength="30" value="{{ $role->name }}" autofocus >
                                </div>
                                </div>
                                <div class="col-6">
                                    <label>Description</label>
                                    <div class="form-group" required>
                                    <input type="text" id="display_name" name="display_name" class="form-control" value="{{ $role->display_name }}" >
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
    let roleId = "{{ \Hashids::encode($role->id) }}";
    $(document).ready(function(){    
      showList(); 
    });
    
    function showList() {
        $.ajax({
            type: "GET",
            url: "{{ route('permission.list.all') }}",
            data:{
                roleId:roleId
            },
            dataType: "json",
            success: function (data) {
                let adaDiArray,diSelect;
                let rolePermission=data.rolePermissions;
                // console.log(rolePermission);
                const result = Object.entries(data.permission.reduce((acc, { display_name, group_name,type,id }) => {
                    adaDiArray = arrayExist(id,rolePermission);
                    adaDiArray == 1 ? diSelect = true:diSelect = false;
                    acc[group_name] = [...(acc[group_name] || []), { "text":display_name,type,id,"type": "css","state" :  {  "selected" : diSelect  }  }];
                    return acc;
                }, {})).map(([key, text]) => ({ text: key, children: text }));
                // console.log(result);
                createJSTree(result);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                Swal.fire(xhr.status);
                Swal.fire(thrownError);
            }
        });            
    };

    function createJSTree(jsondata) {    
        let checkboxTree = $('#role-tree-checkbox');   
        checkboxTree.jstree({
            core: {
                data: jsondata,
                worker: false
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
        let roleName = $('#name').val();
        let roleDescription = $('#display_name').val();
        let checkedIds = []; 
        let selectedNodes = $('#role-tree-checkbox').jstree("get_bottom_checked", true);
        $.each(selectedNodes, function() {
            checkedIds.push(this.id);
        });
        // console.log(checkedIds);
        if (checkedIds.length == 0 || roleName==''){
            flag=0
            pesan ="The given data was invalid";
        }

        if (flag==1) {
            $.ajax({
                dataType: 'json',
                type:'PUT',
                url: "{{ url('roles') }}/"+roleId,
                data: { 
                        id:roleId,
                        name:roleName,
                        display_name:roleDescription,
                        permission:checkedIds
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
                            title: 'Oops...',
                            text: data.responseJSON.errors.name,
                        });
                        $('#name').focus();                        
                    },
                    422: function(data) {

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
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

    function arrayExist(value,arr){
        let status = '0';
        // console.log(arr.length);
        for(let i=0; i<arr.length; i++){
            var name = arr[i];
            if(name == value){
                status = '1';
                break;
            }
        }
        return status;
    }

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