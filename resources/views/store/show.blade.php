@extends('layouts.app')
@section('title', 'Lihat Pengguna')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th style="width:180px;">Store Name</th><td>: {{ $store->name }}</td>
                            </tr>
                            <tr>
                                <th>Initial</th><td>: {{ $store->initial }}</td>
                            </tr>
                            <tr>
                                <th>Store Code</th><td>: {{ $store->store_code }}</td>
                            </tr>
                            <tr>
                                <th>Store Manager</th><td>: {{ $store->store_manager }}</td>
                            </tr>
                            <tr>
                                <th>Address</th><td>: {{ $store->address }}</td>
                            </tr>
                            <tr>
                                <th>City</th><td>: {{ $store->city }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <a class="btn btn-info" href="{{ route('stores.index') }}"> {{ __('general.back') }}</a>
            </div>
        </div>  
    </div>
</div>
@endsection