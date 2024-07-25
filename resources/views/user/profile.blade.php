@extends('layouts.app')
@section('title', 'Edit Profile')
@section('content')

@include('errors.error')

<section id="page-profile-settings">
    <div class="row">
        <!-- left menu section -->
        <div class="col-md-3 mb-2 mb-md-0">
            <ul class="nav nav-pills flex-column nav-left" id="profile-tab">
                <!-- general -->
                <li class="nav-item">
                    <a class="nav-link active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" data-toggle="tab" aria-expanded="true">
                        <i data-feather="user" class="font-medium-3 mr-1"></i>
                        <span class="font-weight-bold">General</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="account-pill-change-profile" data-toggle="pill" href="#account-vertical-change-profile" data-toggle="tab" aria-expanded="false">
                        <i data-feather="user" class="font-medium-3 mr-1"></i>
                        <span class="font-weight-bold">Edit Profile</span>
                    </a>
                </li>
                <!-- change password -->
                <li class="nav-item">
                    <a class="nav-link" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" data-toggle="tab" aria-expanded="false">
                        <i data-feather="lock" class="font-medium-3 mr-1"></i>
                        <span class="font-weight-bold">Change Password</span>
                    </a>
                </li>
            </ul>
        </div>
        <!--/ left menu section -->

        <!-- right content section -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <!-- general tab -->
                        <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr>
                                                    <th style="width:180px;">Initial Store</th><td>: {{ getStore($user->initial_store) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Name</th><td>: {{ $user->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Email</th><td>: {{ $user->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Roles</th>
                                                    <td>: {{ getRoles($user->id) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Username</th><td>: {{ $user->username }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- general tab -->
                        <div role="tabpanel" class="tab-pane fade" id="account-vertical-change-profile" aria-labelledby="account-pill-change-profile" aria-expanded="false">
                            <!-- header media -->
                            <div class="media">
                                <a href="javascript:void(0);" class="mr-25">
                                    <img class="round" src="{{ asset('pictures/users/'.Auth::user()->file_name) }}" onerror="this.src='{{ asset('app-assets/images/avatars/default.png')}}';" id="accountUploadImg" class="rounded mr-50 img-thumnbnail rounded-circle" alt="profile image" height="80" width="80">
                                </a>
                                <form action="{{ route('file.upload.post') }}" method="POST" id="upload-image" enctype="multipart/form-data">
                                    @csrf
                                    <div class="media-body mt-75 ml-1">
                                        <label for="imageUpload" class="btn btn-sm btn-info mb-75 mr-75">Upload</label>
                                        <input type="file" name="imageUpload" id="imageUpload" hidden accept=".jpg,.png" />
                                        @error('image')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                        <button type="submit" class="btn btn-sm btn-outline-primary mb-75">{{ __('general.save') }}</button>
                                        <p>Allowed JPG or PNG. Maximum size 5Mb</p>
                                    </div>
                                </form>
                            </div>
                            <!-- form -->
                            <form id="updateProfile" class="validate-form mt-2">
                                @csrf
                                <input type="text" id="initial_store" name="initial_store" value="{{ $user->initial_store }}" hidden/>
                                <p class="text-danger" id="responMessageProfile"></p>
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{ old('username',$user->username) }}" disabled/>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input required type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name',$user->name) }}" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="account-e-mail">Email</label>
                                            <input required type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email',$user->email) }}" />
                                        </div>
                                    </div>
                                </div>
                                <button type="reset" class="btn btn-outline-info mt-1">{{ __('general.cancel') }}</button>
                                <button type="button" id="cmdSaveProfile" class="btn btn-primary mr-1 mt-1">{{ __('general.save') }}</button>
                            </form>
                            <!--/ form -->
                        </div>
                        <!--/ general tab -->
                        <!-- change password -->
                        <div class="tab-pane fade" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                            <!-- form -->
                            <form id="changPassword" enctype="multipart/form-data">
                                <p class="text-danger" id="responMessagePassword"></p>
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="oldPassword">Old Password</label>
                                            <div class="input-group form-password-toggle input-group-merge">
                                                <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Old Password" />
                                                <div class="input-group-append">
                                                    <div class="input-group-text cursor-pointer">
                                                        <i data-feather="eye"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="newPassword">New Password</label>
                                            <div class="input-group form-password-toggle input-group-merge">
                                                <input type="password" id="newPassword" name="newPassword" class="form-control" placeholder="New Password" />
                                                <div class="input-group-append">
                                                    <div class="input-group-text cursor-pointer">
                                                        <i data-feather="eye"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="retypePassword">Retype New Password</label>
                                            <div class="input-group form-password-toggle input-group-merge">
                                                <input type="password" class="form-control" id="retypeNewPassword" name="retypeNewPassword" placeholder="Retype New Password" />
                                                <div class="input-group-append">
                                                    <div class="input-group-text cursor-pointer"><i data-feather="eye"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="reset" class="btn btn-outline-info mt-1">{{ __('general.cancel') }}</button>
                                        <button type="button" id="cmdSavePassword" class="btn btn-primary mr-1 mt-1">{{ __('general.save') }}</button>
                                    </div>
                                </div>
                            </form>
                            <!--/ form -->
                        </div>
                        <!--/ change password -->
                    </div>
                </div>
            </div>
        </div>
        <!--/ right content section -->
    </div>
</section>
@endsection
@section('styles')
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function (e) {
        //view image after fiel is selected
        $('#imageUpload').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => { 
              $('#accountUploadImg').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 
        });
    });

    //save account pictures
    $('#upload-image').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData, 
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                let cau = window.location.origin;
                let imageName = data.image;
                let imagePath = cau + "/pictures/users/" + imageName;
                $('#avatar_picture').attr('src',imagePath);

                Swal.fire("Success!",data.message, "success");
            },
            error: function(err){
                if (err.status == 422) { // when status code is 422, it's a validation issue
                    let keterangan = '';
                    $.each(err.responseJSON.errors, function (i, error) {
                        keterangan += error[0] + '<br>';
                    });
                    Swal.fire("Error!",keterangan, "error");
                }else{
                    Swal.fire("Error!",err.message, "error");
                }
            }
        });
    }));

    $('#cmdSavePassword').click(function(e){
        oldPsw= $('#oldPassword').val();
        newPSw= $('#newPassword').val();
        retypeNewPSw= $('#retypeNewPassword').val();

        $.ajax({
            type: "post",
            url: "{{ route('change.password') }}",
            data: {
                oldPassword:oldPsw,
                newPassword:newPSw,
                retypeNewPassword:retypeNewPSw
            },
            dataType: 'json',
            success: function(data){
                if (data.status === 1) {
                    Swal.fire("Success!",data.message, "success");
                }else{
                    Swal.fire("Warning!",data.message, "warning");
                }
            },
            error: function (err) {
                if (err.status == 422) { // when status code is 422, it's a validation issue
                    let keterangan = '';
                    $.each(err.responseJSON.errors, function (i, error) {
                        keterangan += error[0] + '<br>';
                    });
                    Swal.fire("Warning!",keterangan, "warning");
                }else{
                    Swal.fire("Error!",err.message, "error");
                }
            }
        });
    });

    $('#cmdSaveProfile').click(function(e){
        username= $('#username').val();
        name= $('#name').val();
        email= $('#email').val();
        initial_store= $('#initial_store').val();

        $.ajax({
            type: "post",
            url: "{{ route('change.profile') }}",
            data: {
                username:username,
                name:name,
                email:email,
                initial_store:initial_store,
            },
            dataType: 'json',
            success: function(data){
                Swal.fire("Success!",data.message, "success");
            },
            error: function (err) {
                if (err.status == 422) { // when status code is 422, it's a validation issue
                    let keterangan = '';
                    $.each(err.responseJSON.errors, function (i, error) {
                        keterangan += error[0] + '<br>';
                    });
                    Swal.fire("Error!",keterangan, "error");
                }else{
                    Swal.fire("Error!",err.message, "error");
                }
            }
        });
    });

    $.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
</script>
@endsection