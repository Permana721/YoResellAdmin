@extends('layouts.app')
@section('title', '403')
@section('content')
<!-- Error page-->
<div class="misc-wrapper">
    <div class="misc-inner p-2 p-sm-3">
    <div class="w-100 text-center">
        <h2 class="mb-1">Forbidden 🔐</h2>
        <p class="mb-2">Oops! 😖 You Don't have permission to access.</p>
        <a class="btn btn-primary mb-2 btn-sm-block" href="{{ route('home') }}">Back to home</a><img class="img-fluid" src="../../../app-assets/images/pages/error.svg" alt="Error page" />
    </div>
    </div>
</div>
<!-- /\ Error page-->
@endsection