@extends('layout.app')
@section('title', 'Edit Region')

@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Edit RoleMenu</h4>
    </div>
    <div class="card-body">
        <form action="" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="roleName">Role Name</label>
                <input type="text" class="form-control" id="roleName" name="role_name" value="{{ $role->name }}" disabled>
            </div>
        
            <div class="form-group">
                <label for="menuList">Menu</label>
                <div id="menuList">
                    @foreach($availableMenus as $menu)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="menus[]" id="menu{{ $menu->id }}" value="{{ $menu->id }}"
                            @if($roleMenus->contains('menu_id', $menu->id)) checked @endif>
                            <label class="form-check-label" for="menu{{ $menu->id }}">
                                {{ $menu->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        
            <a href="{{route('role.menu')}}" class="btn btn-info">Back</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>               
    </div>
</div>
@endsection