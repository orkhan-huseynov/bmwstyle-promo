<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="/admin">BMW Club Azerbaijan Promo Discounts</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="/admin">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                <a class="nav-link" href="/admin/users">
                    <i class="fa fa-fw fa-table"></i>
                    <span class="nav-link-text">Users</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                <a class="nav-link" href="/admin/subscriptions">
                    <i class="fa fa-fw fa-book"></i>
                    <span class="nav-link-text">Subscriptions</span>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                @auth
                    <a class="nav-link" href="{{ url('/users/' . Auth::user()->id) }}">{{ Auth::user()->name }} {{ Auth::user()->surname }}</a>
                @endauth
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fa fa-fw fa-sign-out"></i>Logout
                </a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
            </li>
        </ul>
    </div>
</nav>