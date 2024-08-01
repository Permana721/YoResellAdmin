@extends('layout.app')
@section('title', 'Edit Member')

@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Edit Member</h4>
    </div>
    <div class="card-body">
        <form method="post" action="{{ route('update.data.member', $data->id) }}" id="frmSearch" class="invoice-repeater">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for=""><strong>Yogya Member Card</strong></label>
                        <input type="text" name="" id="" placeholder="Yogya Member Card" class="form-control" value="" autocomplete="off"/>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="phone_1"><strong>Phone:</strong></label>
                        <input type="phone" name="phone_1" id="phone_1" placeholder="Phone" class="form-control" value="{{ $data->phone_1 }}" autocomplete="off" required />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="username"><strong>Username:</strong></label>
                        <input type="text" name="username" id="username" placeholder="Username" class="form-control" value="{{ $data->username }}" autocomplete="off" required />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="full_name"><strong>Full Name:</strong></label>
                        <input type="text" name="full_name" id="full_name" placeholder="Full Name" class="form-control" value="{{ $data->full_name }}" autocomplete="off" />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="email"><strong>Email:</strong></label>
                        <input type="email" name="email" id="email" placeholder="Email" class="form-control" value="{{ $data->email }}" autocomplete="off" required />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="nric"><strong>NRIC:</strong></label>
                        <input type="text" name="nric" id="nric" placeholder="NRIC" class="form-control" value="{{ $data->nric }}" autocomplete="off" required />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="keterangan"><strong>Keterangan:</strong></label>
                        <input type="text" name="keterangan" id="keterangan" placeholder="Keterangan" class="form-control" value="{{ $data->keterangan }}" autocomplete="off" required />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="address"><strong>Address:</strong></label>
                        <input type="text" name="address" id="address" placeholder="Address" class="form-control" value="{{ $data->address }}" autocomplete="off" required />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="tokopedia"><strong>MarketPlace - Tokopedia:</strong></label>
                        <input type="text" name="tokopedia" id="tokopedia" placeholder="MarketPlace - Tokopedia" class="form-control" value="{{ $data->tokopedia }}" autocomplete="off" required />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="shopee"><strong>MarketPlace - Shopee:</strong></label>
                        <input type="text" name="shopee" id="shopee" placeholder="MarketPlace - Shopee" class="form-control" value="{{ $data->shopee }}" autocomplete="off" required />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="bukalapak"><strong>MarketPlace - Bukalapak:</strong></label>
                        <input type="text" name="bukalapak" id="bukalapak" placeholder="MarketPlace - Bukalapak" class="form-control" value="{{ $data->bukalapak }}" autocomplete="off" required />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="lain_lain"><strong>MarketPlace - Lain-lain:</strong></label>
                        <input type="text" name="lain_lain" id="lain_lain" placeholder="MarketPlace - Lain-lain" class="form-control" value="{{ $data->lain_lain }}" autocomplete="off" required />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="type_customer"><strong>Tipe Customer:</strong></label>
                        <select name="type_customer" id="type_customer" class="form-control select-data" placeholder="Select Role" required>
                            <option value="SPG" {{ $data->type_customer == 'SPG' ? 'selected' : '' }}>SPG</option>
                            <option value="UMUM" {{ $data->type_customer == 'UMUM' ? 'selected' : '' }}>UMUM</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="form-group">
                        <label for="brand"><strong>Nama Brand(contoh LOGO):</strong></label>
                        <input type="text" name="brand" id="brand" placeholder="Nama brand" class="form-control" value="{{ $data->brand }}" autocomplete="off" required />
                    </div>
                </div>
            </div>
            <div>
                <a href="{{ route('member') }}" class="btn btn-info" id="backButton">Back</a>
                <button type="submit" class="btn btn-primary" id="saveButton">Save</button>
            </div>
        </form>        
    </div>
</div>
@endsection