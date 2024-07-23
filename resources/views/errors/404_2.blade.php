@extends('layouts.app')
@section('title', '404')
@section('content')
<!-- Error page-->
<div class="misc-wrapper">
    <div class="misc-inner p-2 p-sm-1">
    <div class="w-100 text-center">
        <h2 class="mb-1">Page Not Found 🕵🏻‍♀️</h2>
        <p class="mb-2">Oops! 😖 The requested URL was not found here.</p>
        <a class="btn btn-primary mb-2 btn-sm-block" href="{{ route('home') }}">Back to dashboard</a><img width="450" class="img-fluid" src="{{ asset('app-assets/images/pages/error.svg') }}" alt="Error page" />
    </div>
    </div>
</div>
<!-- / Error page-->
@endsection 