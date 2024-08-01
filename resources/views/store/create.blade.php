@extends('layout.app')
@section('title', 'Add Store')

@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Add Store</h4>
    </div>
    <div class="card-body">
        <form method="post" action="{{ route('add.data.store') }}" id="frmSearch" class="invoice-repeater">
        @csrf
            <div class="row">
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="name"><strong>name:</strong></label>
                        <input type="text" name="name" id="name" placeholder="Name" class="form-control" autocomplete="off" required />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="store_code"><strong>Code:</strong></label>
                        <input type="text" name="store_code" id="store_code" placeholder="Code" class="form-control" autocomplete="off" />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="initial_store"><strong>Initial:</strong></label>
                        <input type="text" name="initial_store" id="initial_store" placeholder="Initial" class="form-control" autocomplete="off" required />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="address"><strong>Address:</strong></label>
                        <input type="text" name="address" id="address" placeholder="Address" class="form-control" autocomplete="off" required />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="city"><strong>City:</strong></label>
                        <input type="text" name="city" id="city" placeholder="City" class="form-control" autocomplete="off" required />
                    </div>
                </div>                
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="latitude"><strong>Latitude:</strong></label>
                        <input type="text" name="latitude" id="latitude" placeholder="Latitude" class="form-control" autocomplete="off" required />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="longtitude"><strong>Longitude:</strong></label>
                        <input type="text" name="longitude" id="longitude" placeholder="Longitude" class="form-control" autocomplete="off" required />
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