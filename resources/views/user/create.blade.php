@extends('layout.app')
@section('title', 'Add User')

@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Add User</h4>
    </div>
    <div class="card-body">
        <form method="post" action="{{ route('regpros') }}" id="frmSearch" class="invoice-repeater">
        @csrf
            <div class="row">
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="username"><strong>Username:</strong></label>
                        <input type="text" name="username" id="username" placeholder="Username" class="form-control" autocomplete="off" required />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="full_name"><strong>Full Name:</strong></label>
                        <input type="text" name="full_name" id="full_name" placeholder="Full Name" class="form-control" autocomplete="off" />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="password"><strong>Password:</strong></label>
                        <input type="password" name="password" id="password" placeholder="Password" class="form-control" autocomplete="off" required />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="email"><strong>Email:</strong></label>
                        <input type="email" name="email" id="email" placeholder="Email" class="form-control" autocomplete="off" required />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="role_id"><strong>Role:</strong></label>
                        <select name="role_id" id="role_id" class="form-control select-data" placeholder="Select Role" required>
                            <option value="" hidden>Pilih Role</option>
                            <option value="1">Administrator</option>
                            <option value="2">User</option>
                            <option value="3">CSO</option>
                        </select>
                    </div>
                </div>                
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="phone"><strong>Phone:</strong></label>
                        <input type="phone" name="phone" id="phone" placeholder="Phone" class="form-control" autocomplete="off" required />
                    </div>
                </div>
            </div>
            <div>
                <a href="{{ route('user') }}" class="btn btn-info" id="backButton">Back</a>
                <button type="submit" class="btn btn-primary" id="saveButton">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection


