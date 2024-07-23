@if ((count($option->children) > 0) && ($option->parent_id > 0))
	<li data-id="{{ $option->id }}" class="dd-item dd3-item">
		<div class="dd-handle dd3-handle"></div>
		<div class="dd3-content">
			<div class="d-flex justify-content-between">
				<div>{{ $option->title }} &nbsp;&nbsp;&nbsp; {{ $option->url }}</div>
				<div class="btn-group" role="group">
					<a href="javascript:void(0)" class="btn btn-icon waves-effect" title="{{ $option->active == 'Y' ? 'Aktif' : 'Tdk Aktif' }}" data-toggle="tooltip" data-placement="top">{{ $option->active }}</a>
					<a href="{{ url('menu-manager/'.Hashids::encode($option->id).'/edit') }}" class="btn btn-icon waves-effect" title="Edit" data-toggle="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>
					<a href="{{ url('menu-manager/'.Hashids::encode($option->id)) }}" class="btn btn-icon waves-effect" title="Delete" data-delete="" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i></a>
				</div>
			</div>
		</div>		
@else
	<li data-id="{{ $option->id }}" class="dd-item dd3-item">
		<div class="dd-handle dd3-handle"></div>
		<div class="dd3-content">
			<div class="d-flex justify-content-between">
				<div>{{ $option->title }} &nbsp;&nbsp;&nbsp; {{ $option->url }}</div>
				<div class="btn-group" role="group">
					<a href="javascript:void(0)" class="btn btn-icon waves-effect" title="{{ $option->active == 'Y' ? 'Aktif' : 'Tdk Aktif' }}" data-toggle="tooltip" data-placement="top">{{ $option->active }}</a>
					<a href="{{ url('menu-manager/'.Hashids::encode($option->id).'/edit') }}" class="btn btn-icon waves-effect" title="Edit" data-toggle="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>
					<a href="javascript:void(0)" onclick="validasidelete('{{ Hashids::encode($option->id) }}')" class="btn btn-icon waves-effect" title="Delete" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i></a>
				</div>
			</div>
		</div>	
@endif
	@if (count($option->children) > 0)
	<ol style="" class="dd-list">
		@foreach($option->children as $option)
			@include('menumanager.menu', $option)
		@endforeach
	</ol>
	@endif
	</li>