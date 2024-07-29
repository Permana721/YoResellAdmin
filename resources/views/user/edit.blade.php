@extends('layout.app')
@section('title', 'Edit user')

@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Edit User</h4>
    </div>
    <div class="card-body">
        <form method="post" action="{{ route('updateDataUser', $data->id) }}" id="frmSearch" class="invoice-repeater">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="username"><strong>Username:</strong></label>
                        <input type="text" name="username" id="username" placeholder="Username" class="form-control" value="{{ $data->username }}" autocomplete="off" required />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="full_name"><strong>Full Name:</strong></label>
                        <input type="text" name="full_name" id="full_name" placeholder="Full Name" class="form-control" value="{{ $data->full_name }}" autocomplete="off" />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="email"><strong>Email:</strong></label>
                        <input type="email" name="email" id="email" placeholder="Email" class="form-control" value="{{ $data->email }}" autocomplete="off" required />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="role"><strong>Role:</strong></label>
                        <select name="role" id="role" class="form-control select-data" placeholder="Select Role" required>
                            <option value="Administrator" {{ $data->role == 'Administrator' ? 'selected' : '' }}>Administrator</option>
                            <option value="CSO" {{ $data->role == 'CSO' ? 'selected' : '' }}>CSO</option>
                            <option value="User" {{ $data->role == 'User' ? 'selected' : '' }}>User</option>
                        </select>
                    </div>
                </div>                
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="phone"><strong>Phone:</strong></label>
                        <input type="phone" name="phone" id="phone" placeholder="Phone" class="form-control" value="{{ $data->phone }}" autocomplete="off" required />
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