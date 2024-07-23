@if ($message = Session::get('alert'))		
    <div class="alert {{ Session::get('alert') }} alert-dismissible" >
        <div class="alert-body">
            {{ Session::get('message') }}
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert" id="alert-message-error">
        <div class="alert-body">
            @foreach ($errors->all() as $error)
                    {{ $error }} <br>
            @endforeach
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif