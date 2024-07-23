@extends('layouts.app')
@section('title', 'Settings')

@section('content')
@include('errors.success')

<section id="nav-filled">
	<div class="row match-height">
		<!-- Filled Tabs starts -->
		<div class="col-xl-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">@yield('title')</h4>
					<div class="col-md-3 col-md-3 col-3">
						<div class="card-body">
							<a class="btn btn-primary btn-block" href="{{ route('settings.create') }}"><i data-feather="plus"></i> {{ __('general.add') }}</a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
						@foreach($groups as $group)
						<li class="nav-item">
							<a class="nav-link {{ $group->groups == 'General' ? 'active' : '' }}" id="{{ strtolower($group->groups) }}-tab-fill" data-toggle="tab" href="#{{ strtolower($group->groups) }}-fill" role="tab" aria-controls="{{ strtolower($group->groups) }}-fill" aria-selected="true">{{ $group->groups }}</a>
						</li>
						@endforeach
					</ul>

					<!-- Tab panes -->
					<div class="tab-content pt-1">
						@foreach($groups as $group)
							<div class="tab-pane {{ $group->groups == 'General' ? 'active' : '' }}" id="{{ strtolower($group->groups) }}-fill" role="tabpanel" aria-labelledby="{{ strtolower($group->groups) }}-tab-fill">
								<div class="table-responsive">
									<table class="table table-striped mg-b-0">
										<tbody>
											@foreach(getSettingGroup($group->groups) as $option)
												<tr>
													<th width="200">{{ $option->options }}</th>
													<td>{{ $option->value }}</td>
													<td width="160" class="text-center">
														<a href="{{ url('settings/'.Hashids::encode($option->id).'/edit') }}" class="btn btn-primary btn-xs btn-icon" title="{{ __('general.edit') }}" data-toggle="tooltip" data-placement="left"><i class="fa fa-edit"></i></a>
														<a href="javascript:;" onclick="validasidelete('{{ Hashids::encode($option->id) }}')"
															class="btn btn-danger btn-xs btn-icon" data-toggle="tooltip" data-placement="left" title="{{ __('general.delete') }}">
															<i class="feather-24-red" data-feather="trash-2"></i>
														</a>
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
		<!-- Filled Tabs ends -->
	</div>
</section>
@endsection

@section('scripts')
<script type="text/javascript">
	function validasidelete(id){
    Swal.fire({
      title: "Are you sure?",
      text: "This setting will be delete ",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, delete!'
      }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
              $.ajax({
              dataType: 'json',
              type:'DELETE',
              url: "{{ url('settings') }}/"+id,
              data:{
                  id:id
              },
              success: function(data) {
                Swal.fire(
                    'Deleted!',
                    data.message,
                    'success'
                  )
                  location.reload();
              },
                  error: function(data) {
                  alert(data.status);
              }
              });
          } 
      })
  }
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
</script>
@endsection