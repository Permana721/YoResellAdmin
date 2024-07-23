@extends('layouts.app')
@section('title', 'Edit Store')

@section('content')

@include('errors.error')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">@yield('title')</h4>
    </div>
    {!! Form::model($store, ['method' => 'PATCH','route' => ['stores.update', Hashids::encode($store->id)]]) !!}
        <div class="card-body">
            <div class="row">
                @include('store.form', ['formMode' => 'edit'])
                <div class="col-12">
                    <a class="btn btn-info" href="{{ route('stores.index') }}"> {{ __('general.back') }}</a>
                    <button id="save" name="save" class="btn btn-primary" type="submit"><span>{{ __('general.save') }}</span></button>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
</div>
@endsection