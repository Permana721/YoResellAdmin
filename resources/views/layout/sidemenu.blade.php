<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="side navbar-brand mr-5" href="{{ route('home') }}">
                    <span class="brand-logo"><img src="{{ asset('content/uploads/logo.png') }}"></span><h2 class="mt-1">&nbsp;YoResellAdmin</h2></a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a>
            </li>
        </ul>
    </div>
    <br/>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <h6 class="ml-2 mt-1 breadcrumbs-title hide-on-small-and-down text-secondary"><strong>DASHBOARD</strong></h6>
            <li class="nav-item navMain {{ \Request::segment(1) == 'home' ? 'active':'' }}">
                <a class="d-flex align-items-center" href="{{ route('home') }}">
                    <i class="material-icons">home</i>
                    <span class="menu-title text-truncate" data-i18n="Home">Home</span>
                </a>
            </li>
            
            <h5 class="ml-2 mt-2 breadcrumbs-title hide-on-small-and-down">MEMBER</h5>
            <li class="nav-item navMain {{ \Request::segment(1) == 'member' ? 'active':'' }}">
                <a class="d-flex align-items-center" href="{{ route('member') }}">
                    <i class="material-icons">card_membership</i>
                    <span class="menu-title text-truncate" data-i18n="Home">Member</span>
                </a>
            </li>
            <li class="nav-item navMain {{ \Request::segment(1) == 'catalog' ? 'active':'' }}">
                <a class="d-flex align-items-center" href="{{ route('catalog') }}">
                    <i class="material-icons">book</i>
                    <span class="menu-title text-truncate" data-i18n="Home">Store Catalog</span>
                </a>
            </li>

            <h5 class="ml-2 mt-2 breadcrumbs-title hide-on-small-and-down">REPORT</h5>
            <li class="nav-item navMain {{ \Request::segment(1) == 'transaction-member' ? 'active':'' }}">
                <a class="d-flex align-items-center" href="{{ route('transaction-member') }}">
                    <i class="material-icons">people</i>
                    <span class="menu-title text-truncate" data-i18n="Home">Member Detail</span>
                </a>
            </li>
            <li class="nav-item navMain {{ \Request::segment(1) == 'sales-detail' ? 'active':'' }}">
                <a class="d-flex align-items-center" href="{{ route('sales-detail') }}">
                    <i class="material-icons">laptop_chromebook</i>
                    <span class="menu-title text-truncate" data-i18n="Home">Sales Detail</span>
                </a>
            </li>
            <li class="nav-item navMain {{ \Request::segment(1) == 'sales-monthly' ? 'active':'' }}">
                <a class="d-flex align-items-center" href="{{ route('sales-monthly') }}">
                    <i class="material-icons">assessment</i>
                    <span class="menu-title text-truncate" data-i18n="Home">Sales Monthly</span>
                </a>
            </li>
            <li class="nav-item navMain {{ \Request::segment(1) == 'transaction-member-summary' ? 'active':'' }}">
                <a class="d-flex align-items-center" href="{{ route('transaction-member-summary') }}">
                    <i class="material-icons">person_outline</i>
                    <span class="menu-title text-truncate" data-i18n="Home">Transaction Member</span>
                </a>
            </li>
            <li class="nav-item navMain {{ \Request::segment(1) == 'transaction-store' ? 'active':'' }}">
                <a class="d-flex align-items-center" href="{{ route('transaction-store') }}">
                    <i class="material-icons">business</i>
                    <span class="menu-title text-truncate" data-i18n="Home">Transaction Store</span>
                </a>
            </li>
        </ul>
    </div>
</div>