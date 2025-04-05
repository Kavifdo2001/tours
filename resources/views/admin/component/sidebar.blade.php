<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
/*
 .logo-text {
    font-family: 'Calibri';
    text-align: center;
}

.logo-main {
    font-size: 40px;
    color: var(--primary-color);
    font-weight: bold;
    position: relative;
    display: inline-block;
    letter-spacing: 8px;
    line-height: 2px;
}

.me {
    font-size: 11px;
    position: absolute;
    top: 0;
    bottom: -29px;
    right: -30px;
    color: var(--primary-color);
    transform: rotate(270deg);
    transform-origin: left center;
    letter-spacing: 0.5px;
}

.slogan {
    display: block;
    font-size: 14px;
    color: var(--primary-color);
    letter-spacing: 0.2px;
    word-spacing: 2px;
}
.sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
    background-color: var(--primary-color);
} */
    </style>

</head>
<body>


    <aside class="main-sidebar sidebar-dark-primary elevation-4">




        <div class="sidebar">

          <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="info">
                <span class="logo-text">
                    {{-- <span class="logo-main">reelook<span class="me">.me</span></span><br>
                    <span class="slogan">where style meets expression</span> --}}
                </span>
            </div>
          </div>


          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

              <li class="nav-item menu-open">
                <a href="{{ route('admin.home') }}" class="nav-link @if(request()->routeIs('admin.home'))active @endif ">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard

                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.category') }}" class="nav-link @if(request()->routeIs('admin.category'))active @endif ">
                    <i class="nav-icon fas fa-list"></i>
                    <p>
                        Category
                    </p>
                </a>
            </li>


            <li class="nav-item">
                <a href="{{ route('admin.departures') }}" class="nav-link @if(request()->routeIs('admin.departures'))active @endif ">
                    <i class="nav-icon fas fa-plane-departure"></i>
                    <p>Departures</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.routes') }}" class="nav-link @if(request()->routeIs('admin.routes'))active @endif ">
                    <i class="nav-icon fas fa-route"></i>
                    <p>Routes</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.inclusions') }}" class="nav-link @if(request()->routeIs('admin.inclusions'))active @endif ">
                    <i class="nav-icon fas fa-check-square"></i>
                    <p>Inclusions</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.airtickets') }}" class="nav-link @if(request()->routeIs('admin.airtickets'))active @endif ">
                    <i class="nav-icon fas fa-ticket-alt"></i>
                    <p>Airtickets</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.default') }}" class="nav-link @if(request()->routeIs('admin.default'))active @endif ">
                    <i class="nav-icon fas fa-newspaper"></i>
                    <p>
                        Tour Packages
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.default_tour') }}" class="nav-link @if(request()->routeIs('admin.default_tour'))active @endif ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Default Tour Package</p>
                        </a>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{ route('admin.customize_tour') }}" class="nav-link @if(request()->routeIs('admin.customize_tour'))active @endif ">--}}
{{--                            <i class="far fa-circle nav-icon"></i>--}}
{{--                            <p>Customize Tour Package</p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
                </ul>
            </li>

                <li class="nav-item">
                    <a href="{{ route('customized.tours') }}" class="nav-link @if(request()->routeIs('customized.tours'))active @endif ">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>Customized Tours</p>
                    </a>
                </li>

            <li class="nav-item">
                <a href="{{ route('admin.gallery') }}" class="nav-link @if(request()->routeIs('admin.gallery'))active @endif ">
                    <i class="nav-icon far fa-images"></i>
                    <p>
                        Gallery
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.photos') }}" class="nav-link @if(request()->routeIs('admin.photos'))active @endif ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Photos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.videos') }}" class="nav-link @if(request()->routeIs('admin.videos'))active @endif ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Videos</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.booking') }}" class="nav-link @if(request()->routeIs('admin.booking'))active @endif ">
                    <i class="nav-icon fas fa-calendar-alt"></i>
                    <p>
                        Bookings
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.guide') }}" class="nav-link @if(request()->routeIs('admin.guide'))active @endif ">
                    <i class="nav-icon fas fa-video"></i>
                    <p>
                        Guides
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.transport') }}" class="nav-link @if(request()->routeIs('admin.transport'))active @endif ">
                    <i class="nav-icon fas fa-car"></i>
                    <p>
                        Transport
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('users') }}" class="nav-link @if(request()->routeIs('users'))active @endif ">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Users
                    </p>
                </a>
            </li>

             <li class="nav-item">
                <a href="{{ route('admin.index') }}" class="nav-link @if(request()->routeIs('color.edit'))active @endif ">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p>
                        Admin Setting
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link @if(request()->routeIs('logout'))active @endif "
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                 {{ __('Logout') }}
             </a>

             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                 @csrf
             </form>
            </li>
            </nav>
            </div>
      </aside>
</body>
</html>
