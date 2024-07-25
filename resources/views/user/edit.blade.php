@extends('layouts.app')
@section('title', 'Edit User')

@section('content')

@include('errors.error')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">@yield('title')</h4>
    </div>
    {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', Hashids::encode($user->id)]]) !!}
        <div class="card-body">
            <div class="row">
                @include('users.form', ['formMode' => 'edit'])
            <hr />
                <div class="col-md-12">
                    <a class="btn btn-info" href="{{ route('users.index') }}"> {{ __('general.back') }}</a>
                    <button id="save" name="save" class="btn btn-primary" type="submit"><span>{{ __('general.save') }}</span></button>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
</div>
@endsection