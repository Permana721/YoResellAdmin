@extends('layout.app')
@section('title', 'Edit Region')

@section('content')

<div class="container">
    <div class="form-group">
        <label for="regionName">Region Name</label>
        <input type="text" class="form-control" id="regionName" name="region_name" value="{{ $region->name }}" disabled>
    </div>

    <form action="" method="POST">
        @csrf
        <div class="form-group">
            <label>Store:</label>
            @foreach ($stores as $store)
                <div class="form-check">
                    <input class="form-check-input " type="checkbox" name="store_codes[]" value="{{ $store->store_code }}"
                        {{ in_array($store->store_code, $selectedStores) ? 'checked' : '' }}>
                    <label class="form-check-label">
                        {{ $store->initial_store }}
                    </label>
                </div>
            @endforeach
        </div>

        <a href="{{route('region.store')}}" class="btn btn-info">Back</a>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection