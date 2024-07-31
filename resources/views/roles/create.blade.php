@extends('layout.app')
@section('title', 'Add Role')

@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Add Role</h4>
    </div>
    <div class="card-body">
        <form method="post" action="{{ route('add.data.role') }}" id="frmSearch" class="invoice-repeater">
        @csrf
            <div class="row">
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="name"><strong>Name:</strong></label>
                        <input type="text" name="name" id="name" placeholder="name" class="form-control" autocomplete="off" required />
                    </div>
                </div>
            </div>
            <div>
                <a href="{{ route('role') }}" class="btn btn-info" id="backButton">Back</a>
                <button type="submit" class="btn btn-primary" id="saveButton">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection


