<div class="col-xl-5 col-md-6 col-12">
    <div class="form-group">
        <strong>Name:</strong>
        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required')) !!}
    </div>
</div>
<div class="col-xl-4 col-md-6 col-12">
    <div class="form-group">
        <strong>Email:</strong>
        {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control', 'autocomplete' => 'off')) !!}
    </div>
</div>
<div class="col-xl-3 col-md-6 col-12">
    <div class="form-group">
        <strong>Username:</strong>
        {!! Form::text('username', null, array('placeholder' => 'Username','class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required', $formMode == 'create' ? '' : 'disabled')) !!}
    </div>
</div>
<div class="col-xl-6 col-md-6 col-12">
    <div class="form-group">
        <strong>Store:</strong>
        <select class="form-control" id="select-data-1" name="initial_store" required>
            <option value="">-- Select Store --</option>
            @foreach($stores as $store)
                @if($formMode == 'create')
                    <option value="{{ $store->initial }}">{{ $store->initial.' - '.$store->name }}</option>
                @else
                    <option value="{{ $store->initial }}" {{ $user->initial_store == $store->initial ? 'selected' : '' }}>{{ $store->initial.' - '.$store->name }}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>
<div class="col-xl-3 col-md-6 col-12">
    <div class="form-group">
        <strong>Password:</strong>
        @if($formMode == 'create')
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required')) !!}
        @else
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control', 'autocomplete' => 'off')) !!}
        @endif
    </div>
</div>
<div class="col-xl-3 col-md-6 col-12">
    <div class="form-group">
        <strong>Retype Password:</strong>
        @if($formMode == 'create')
            {!! Form::password('confirm-password', array('placeholder' => 'Retype Password','class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required')) !!}
        @else
            {!! Form::password('confirm-password', array('placeholder' => 'Retype Password','class' => 'form-control', 'autocomplete' => 'off')) !!}
        @endif
    </div>
</div>
<div class="col-xl-3 col-md-6 col-12">
    <div class="form-group">
        <strong>Role:</strong>
        {!! Form::select('roles', $roles, $formMode == 'create' ? null : $userRole, array('class' => 'form-control select-data', 'placeholder' => 'Select Role', 'required' => 'required')) !!}
    </div>
</div>
@if($formMode == 'edit' && Auth::user()->hasRole(['Superadmin','Admin']))
<div class="col-xl-6 col-md-6 col-12">
    <div class="form-group">
        <strong>Status:</strong>
        <select class="select-style form-control" id="block" name="block">
            @if (isset($user))
                <option value="{{ $user->block }}">Selected {{ $user->block == 'Y' ? 'Block' : 'Un Block' }}</option>
            @endif
            <option value="Y">Block</option>
            <option value="N">Un Block</option>
        </select>
    </div>
</div>
@endif