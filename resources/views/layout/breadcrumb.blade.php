<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-12">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h4 class="content-header-title float-left mb-0"><a class="home-title" href="{{ route('home') }}"><i class="fas fa-home"></i></a></h4>
                @if(\Request::segment(2) != "")
                    &nbsp| <a href="/{{\Request::segment(1)}}">{{ucwords(str_replace('-',' ',\Request::segment(1)))}}</a>
                    &nbsp| <a href="/{{\Request::segment(1)}}/{{\Request::segment(2)}}{{\Request::segment(3) == '' ? '' : '/edit'}}">@yield('title')</a>
                @else
                    &nbsp| <a href="/{{\Request::segment(1)}}">@yield('title')</a>
                @endif
            </div>
        </div>
    </div>
</div>