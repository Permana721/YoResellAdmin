<div class="form-row">
	<div class="form-group col-sm-6">
		{!! Form::label('title', 'Title *', ['class' => 'control-label']) !!}
		{!! Form::text('title', null, ['class' => $errors->has('title') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Home', 'required' => 'required']) !!}
		{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
	</div>
	<div class="form-group col-sm-6">
		{!! Form::label('url', 'URL *', ['class' => 'control-label']) !!}
		{!! Form::text('url', null, ['class' => $errors->has('url') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Link Url', 'required' => 'required']) !!}
		{!! $errors->first('url', '<p class="help-block">:message</p>') !!}
	</div>
	<div class="form-group {{ $formMode == 'create' ? 'col-sm-6' : 'col-sm-4' }}">
		{!! Form::label('icon', 'Icon *', ['class' => 'control-label']) !!}
		{!! Form::text('icon', null, ['class' => $errors->has('icon') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'i-Bar-Chart', 'required' => 'required']) !!}
		{!! $errors->first('icon', '<p class="help-block">:message</p>') !!}
	</div>
	<div class="form-group {{ $formMode == 'create' ? 'col-sm-6' : 'col-sm-4' }}">
		{!! Form::label('class', 'Class', ['class' => 'control-label']) !!}
		{!! Form::text('class', null, ['class' => $errors->has('class') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'has-arrow']) !!}
		{!! $errors->first('class', '<p class="help-block">:message</p>') !!}
	</div>
	@if($formMode == 'edit')
	<div class="form-group col-sm-4">
		{!! Form::label('active', 'Active *', ['class' => 'control-label']) !!}
        <select class="select-style form-control" name="active">
            @if (isset($menumanager))
                <option value="{{ $menumanager->active }}">Selected {{ $menumanager->active == 'Y' ? 'Active' : 'InActive' }}</option>
            @endif
            <option value="Y">Active</option>
            <option value="N">InActive</option>
        </select>
	</div>
	@endif
	<div class="form-group col-sm-12">
		{!! Form::label('menus', 'Role *', ['class' => 'control-label']) !!}
			@if($formMode == 'create')
				<select class="select-data form-control" id="menus" name="menus[]" multiple>
			@else
				<select class="select-data form-control" id="menus" name="menus">
            <option value="{{ $menumanager->menus }}" selected>Selected {{ $menumanager->menus }}</option>
         @endif
            <option value="">Select Menu</option>
            {{ roleTreeOption($roles) }}
        </select>
	</div>
	<div class="form-group col-sm-12">
		{!! Form::label('target', 'Target *', ['class' => 'control-label']) !!}
		<select class="form-control select-style" id="target" name="target">
			@if($formMode == 'edit')
				<option value="{{ $menumanager->target }}">Selected {{ $menumanager->target }}</option>
			@endif
			<option value="none">none</option>
			<option value="_blank">_blank</option>
		</select>
	</div>
</div>