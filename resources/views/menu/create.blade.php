@extends('layout.app')
@section('title', 'Add Menu')

@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Add Menu</h4>
    </div>
    <div class="card-body">
        <form method="post" action="{{ route('add.data.menu') }}" id="frmSearch" class="invoice-repeater">
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
                        <label for="group_name"><strong>Group Name:</strong></label>
                        <input type="text" name="group_name" id="group_name" placeholder="Group Name" class="form-control" autocomplete="off" required />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="url"><strong>URL:</strong></label>
                        <input type="text" name="url" id="url" placeholder="URL" class="form-control" autocomplete="off" required />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="icon">
                            <strong>Icon:
                                <a class="primary" href="https://materializecss.com/icons.html" target="_blank">List Icon KLIK</a>
                            </strong>
                        </label>
                        <input type="text" name="icon" id="icon" placeholder="Icon" class="form-control" autocomplete="off" required />
                    </div>
                </div>
            </div>
            <div>
                <a href="{{ route('menu') }}" class="btn btn-info" id="backButton">Back</a>
                <button type="submit" class="btn btn-primary" id="saveButton">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection