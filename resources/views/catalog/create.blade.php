@extends('layout.app')
@section('title', 'Add Catalog')

@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Add Catalog</h4>
    </div>
    <div class="card-body">
        <form method="post" action="{{ route('add.data.catalog') }}" id="frmSearch" class="invoice-repeater">
        @csrf
            <div class="row">
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="name"><strong>Name:</strong></label>
                        <input type="text" name="name" id="name" placeholder="name" class="form-control" autocomplete="off" required />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="whatsapp"><strong>Whatsapp (Gunakan awalan 62):</strong></label>
                        <input type="text" name="whatsapp" id="whatsapp" placeholder="WhatsApp" class="form-control" autocomplete="off" required />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="url_catalog"><strong>URL Catalog:</strong></label>
                        <input type="text" name="url_catalog" id="url_catalog" placeholder="Url Catalog" class="form-control" autocomplete="off" required />
                    </div>
                </div>
            </div>
            <div>
                <a href="{{ route('catalog') }}" class="btn btn-info" id="backButton">Back</a>
                <button type="submit" class="btn btn-primary" id="saveButton">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection