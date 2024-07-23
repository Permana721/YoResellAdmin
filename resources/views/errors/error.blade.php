@if (count($errors) > 0)
    <div class="alert alert-danger">
        &nbsp;&nbsp;<strong>Oops!</strong> There is some problem with your Input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
