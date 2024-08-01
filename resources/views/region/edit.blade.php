@extends('layout.app')
@section('title', 'Edit Region')

@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Edit Region</h4>
    </div>
    <div class="card-body">
        <form method="post" action="{{ route('update.data.region', $data->id) }}" id="frmSearch" class="invoice-repeater">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="name"><strong>Name:</strong></label>
                        <input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{{ $data->name }}" autocomplete="off"/>
                    </div>
                </div>
            </div>
            <div>
                <a href="{{ route('region') }}" class="btn btn-info" id="backButton">Back</a>
                <button type="submit" class="btn btn-primary" id="saveButton">Save</button>
            </div>
        </form>        
    </div>
</div>
@endsection