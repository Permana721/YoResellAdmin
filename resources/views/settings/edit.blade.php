@extends('layouts.app')
@section('title', 'Edit Setting')

@section('content')

@include('errors.error')

<div class="card">
    <div class="card-body">
        {!! Form::model($setting, [
            'method' => 'PATCH',
            'url' => ['/settings', Hashids::encode($setting->id)],
            'class' => 'form-horizontal'
        ]) !!}
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <strong>Group *:</strong>
                    <select class="select-style form-control" id="groups" name="groups">
						@if (isset($setting))
							<option value="{{ $setting->groups }}">Selected {{ $setting->groups }}</option>
						@endif
						<option value="General">General</option>
						<option value="Image">Image</option>
						<option value="Config">Config</option>
					</select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <strong>Option *:</strong>
                    {!! Form::text('options', null, ['class' => $errors->has('options') ? 'form-control is-invalid' : 'form-control', 'required' => 'required', 'autocomplete' => 'off']) !!}
					<p><small class="text-muted">This is to identify the setting value.</small></p>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <strong>Value *:</strong>
                    @if(isset($setting))
						@if($setting->groups == 'Image')
							<div class="input-group">
								{!! Form::text('value', null, ['class' => 'form-control', 'id' => 'input-filemanager', 'required' => 'required']) !!}
								<span class="input-group-append">
									<a href="{{ url('content/filemanager/dialog.php?type=1&field_id=input-filemanager&relative_url=1&akey='.env('FM_KEY')) }}" id="filemanager" class="btn iframe-btn btn-primary mb-1 dz-clickable"><i class="fa fa-file"></i> Browse</a>
								</span>
							</div>
						@elseif($setting->options == 'maintenance' || $setting->options == 'member_registration' || $setting->options == 'password_expired')
							<div class="input-group">
								<select class="select-style form-control" id="value" name="value">
									@if (isset($setting))
									<option value="{{ $setting->value }}">Selected {{ $setting->value == 'Y' ? 'Yes' : 'No' }}</option>
									@endif
									<option value="Y">Yes</option>
									<option value="N">No</option>
								</select>
							</div>
						@else
							{!! Form::text('value', null, ['class' => $errors->has('value') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
						@endif
					@else
						{!! Form::text('value', null, ['class' => $errors->has('value') ? 'form-control is-invalid' : 'form-control', 'required' => 'required', 'autocomplete' => 'off']) !!}
					@endif
                </div>
            </div>
            <div class="col-12">
                <a class="btn btn-info" href="{{ route('settings.index') }}"> {{ __('general.back') }}</a>
                <button id="update" name="update" class="btn btn-primary" type="submit"><span>{{ __('general.update') }}</span></button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('styles')
<link href="{{ asset('content/filemanager/fancybox/jquery.fancybox.css') }}" rel="stylesheet">
@endsection
@section('scripts')
<script src="{{ asset('content/filemanager/fancybox/jquery.fancybox.js') }}"></script>
<script>
$('.iframe-btn').fancybox({	
	'width'		: 900,
	'height'	: 600,
	'type'		: 'iframe',
    'autoScale'    	: false
});
</script>
@endsection