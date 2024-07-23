<div class="col-xl-6 col-md-6 col-12">
    <div class="form-group">
        <strong>Name:</strong>
        {!! Form::text('name', old('name'), array('placeholder' => 'Store Name','class' => 'form-control', 'autocomplete' => 'off', 'onkeyup' => 'this.value = this.value.toUpperCase();')) !!}
    </div>
</div>
<div class="col-xl-2 col-md-3 col-12">
    <div class="form-group">
        <strong>Initial:</strong>
        {!! Form::text('initial', old('initial'), array('placeholder' => 'Initial','class' => 'form-control', 'autocomplete' => 'off', 'onkeyup' => 'this.value = this.value.toUpperCase();')) !!}
    </div>
</div>
<div class="col-xl-2 col-md-3 col-12">
    <div class="form-group">
        <strong>Store Code:</strong>
        {!! Form::text('store_code', old('store_code'), array('placeholder' => 'Store Code','class' => 'form-control numeric', 'autocomplete' => 'off')) !!}
        <span id="errmsg"></span>
    </div>
</div>
<div class="col-xl-3 col-md-6 col-12">
    <div class="form-group">
        <strong>Store Manager:</strong>
        {!! Form::text('store_manager', old('store_manager'), array('placeholder' => 'Store Manager','class' => 'form-control', 'autocomplete' => 'off', 'onkeyup' => 'this.value = this.value.toUpperCase();')) !!}
    </div>
</div>
<div class="col-xl-6 col-md-6 col-12">
    <div class="form-group">
        <strong>Address:</strong>
        {!! Form::text('address', old('address'), array('placeholder' => 'Address','class' => 'form-control', 'autocomplete' => 'off', 'onkeyup' => 'this.value = this.value.toUpperCase();')) !!}
    </div>
</div>
<div class="col-xl-3 col-md-6 col-12">
    <div class="form-group">
        <strong>City:</strong>
        {!! Form::text('city', old('city'), array('placeholder' => 'City','class' => 'form-control', 'autocomplete' => 'off', 'onkeyup' => 'this.value = this.value.toUpperCase();')) !!}
    </div>
</div>