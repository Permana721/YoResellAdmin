@extends('layout.app')
@section('title', 'Update Store')

@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Update Store</h4>
    </div>
    <div class="card-body">
        <form method="post" action="{{ route('update.data.store', $data->id) }}" id="frmSearch" class="invoice-repeater">
        @method('PUT')
        @csrf
            <div class="row">
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="name"><strong>name:</strong></label>
                        <input type="text" name="name" id="name" value="{{ $data->name }}" placeholder="Name" class="form-control" autocomplete="off" required />
                    </div>
                </div>
            </div>
            <div>
                <a href="{{ route('store') }}" class="btn btn-info" id="backButton">Back</a>
                <button type="submit" class="btn btn-primary" id="saveButton">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection