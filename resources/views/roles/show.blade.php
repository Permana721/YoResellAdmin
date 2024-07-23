@extends('layouts.app')
@section('title', 'Detail Role')
@section('content')
<section id="show-roles">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Name : {{ $role->name }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                        <p class="card-text mb-0">Permission:</p>
                        </div>
                        <div class="col-12">
                            <div class="demo-inline-spacing">
                                @if(!empty($rolePermissions))
                                    @foreach($rolePermissions as $v)
                                        <label class="badge badge-pill badge-success">{{ $v->display_name }}</label>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <a class="btn btn-info" href="{{ route('roles.index') }}"> {{ __('general.back') }}</a>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</section>
@endsection