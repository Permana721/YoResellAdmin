@extends('layouts.app')
@section('title', 'View User')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th style="width:180px;">Name</th><td>: {{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th><td>: {{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Username</th><td>: {{ $user->username }}</td>
                            </tr>
                            <tr>
                                <th>Store</th><td>: {{ getStore($user->initial_store) }}</td>
                            </tr>
                            <tr>
                                <th>Roles</th>
                                <td>: {{ getRoles($user->id) }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>: {{ $user->block == 'N' ? 'Active' : 'Locked' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> {{ __('general.back') }}</a>
            </div>
        </div>  
    </div>
</div>
@endsection