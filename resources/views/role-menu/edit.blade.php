@extends('layout.app')
@section('title', 'Edit Region')

@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Edit RoleMenu</h4>
    </div>
    <div class="card-body">
        <form method="post" action="{{ route('update.role.menu', $data->id) }}" id="frmSearch" class="invoice-repeater">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="role_id">Role</label>
                <select id="role_id" name="role_id" class="form-control" required>
                    <option value="">Select Role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ $roleMenu->role_id == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>
    
            <div class="form-group">
                <label for="menu_id">Menu</label>
                <select id="menu_id" name="menu_id" class="form-control" required>
                    <option value="">Select Menu</option>
                    @foreach($menus as $menu)
                        <option value="{{ $menu->id }}" {{ $roleMenu->menu_id == $menu->id ? 'selected' : '' }}>
                            {{ $menu->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <a href="{{ route('region') }}" class="btn btn-info" id="backButton">Back</a>
                <button type="submit" class="btn btn-primary" id="saveButton">Save</button>
            </div>
        </form>        
    </div>
</div>
@endsection