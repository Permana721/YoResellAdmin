@extends('layouts.app')
@section('title', 'Add User')

@section('content')
@include('errors.success')
@include('errors.error')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">@yield('title')</h4>
    </div>
    {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
    <div class="card-body">
        <div class="row">
            @include('users.form', ['formMode' => 'create'])
            <hr>
            <div class="col-md-12">
                <a class="btn btn-info" href="{{ route('users.index') }}"> {{ __('general.back') }}</a>
                <button id="save" name="save" class="btn btn-primary" type="submit"><span>{{ __('general.save') }}</span></button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
@endsection