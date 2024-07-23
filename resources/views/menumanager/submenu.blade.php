@if(Auth::user()->menus == $menu->menus)
    @if((count($menu->children) > 0) && ($menu->parent == 0))
        <li class="nav-item">
            <a class="d-flex align-items-center" href="#" target="{{ $menu->target == 'none' ? '' : $menu->target }}">
            <i data-feather="circle"></i><span class="{{ count($menu->children) > 0 ? 'menu-item text-truncate' : 'menu-title text-truncate' }}" data-i18n="{!! $menu->title !!}">{!! $menu->title !!}</span></a>
    @else    
        <li class="{{ \Request::segment(1) == $menu->url && \Request::segment(2) == \Request::segment(2) ? 'active' : '' }} {{ \Request::segment(1) == $menu->url && in_array(\Request::segment(2), ['create','table',\Request::segment(2)]) ? 'active' : '' }} {{ \Request::segment(1) == $menu->url && \Request::segment(2) == '' ? 'active' : '' }} nav-item">
            <a class="d-flex align-items-center" href="{{ $menu->url == '#' ? '#' : url($menu->url) }}" target="{{ $menu->target == 'none' ? '' : $menu->target }}">
            <i data-feather="circle"></i><span class="{{ count($menu->children) > 0 ? 'menu-item text-truncate' : 'menu-title text-truncate' }}" data-i18n="{!! $menu->title !!}">{!! $menu->title !!}</span></a>
    @endif
    @if (count($menu->children) > 0)
        <ul class="menu-content">
            @foreach($menu->children as $menu)
                @include('menumanager.submenu', $menu)
            @endforeach
        </ul>
    @endif
        </li>
@endif 