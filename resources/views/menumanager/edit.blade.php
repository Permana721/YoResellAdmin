@extends('layouts.app')
@section('title', 'Edit Menu')

@section('content')

@include('errors.error')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">@yield('title')</h4>
    </div>
    {!! Form::model($menumanager, ['method' => 'PATCH','route' => ['menu-manager.update', Hashids::encode($menumanager->id)]]) !!}
        <div class="card-body">
            <div class="row">
                @include('menumanager.form', ['formMode' => 'edit'])
                <div class="col-12">
                    <a class="btn btn-info" href="{{ route('menu-manager.index') }}"> {{ __('general.back') }}</a>
                    <button id="save" name="save" class="btn btn-primary" type="submit"><span>{{ __('general.update') }}</span></button>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
</div>
@endsection