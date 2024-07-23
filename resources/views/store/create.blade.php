@extends('layouts.app')
@section('title', 'Add Store')

@section('content')

@include('errors.error')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">@yield('title')</h4>
    </div>
    {!! Form::open(array('route' => 'stores.store','method'=>'POST')) !!}
    <div class="card-body">
        <div class="row">
            @include('store.form', ['formMode' => 'create'])
            
            <div class="col-12">
                <a class="btn btn-info" href="{{ route('stores.index') }}"> {{ __('general.back') }}</a>
                <button id="save" name="save" class="btn btn-primary" type="submit"><span>{{ __('general.save') }}</span></button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
@endsection