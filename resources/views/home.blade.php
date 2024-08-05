@extends('layout.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h4>Halo</h4>
    </div>
    <div class="card-body">
        Selamat datang, <b>{{ Auth::user()->full_name }}</b>.
    </div>
</div>
  <section>
    <div class="row kb-search-content-info match-height">
      <div class="col-md-3 col-sm-6 col-12 kb-search-content">
        <div class="card">
            <div class="card-body text-center home-font"><b>0</b></div>
            <div class="card-body text-center">
              <h5>A</h5>
            </div>
        </div>
      </div>
  
      <div class="col-md-3 col-sm-6 col-12 kb-search-content">
        <div class="card">
            <div class="card-body text-center home-font text-info"><b>0</b></div>
            <div class="card-body text-center">
              <h5>B</h5>
            </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 col-12 ">
        <div class="card">
            <div class="card-body text-center home-font text-danger"><b>0</b></div>
            <div class="card-body text-center">
              <h5>C</h5>
            </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-body text-center home-font text-warning"><b>0</b></div>
            <div class="card-body text-center">
              <h5>D</h5>
            </div>
        </div>
      </div>
    </div>
  </section>
@endsection