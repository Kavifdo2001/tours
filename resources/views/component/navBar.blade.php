
<style>
    /* Style for the top bar */
    #topbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        background-color: #543495;
    }


    .navbar {
        position: fixed;
        top: 45px; /* Height of the top bar */
        left: 0;
        right: 0;
        z-index: 999; /* Lower than the top bar */
        background-color: #543495;
    }


    body {
        padding-top: 90px;
    }


    .social-media-icons {
        display: inline-flex;
    }

    @media (max-width: 992px) {
        #topbar, .navbar {
            position: fixed;
            top: auto;
        }

        body {
            padding-top: 0; /* Reset padding for mobile */
        }

        .social-media-icons {
            display: none; /* Hide on mobile devices */
        }

        .social-content{
            display: none;
        }

        .navbar{
            top: 40px;
        }
    }


</style>

    <!-- Topbar Start -->
    <div id="topbar" class="container-fluid bg-primary px-5" style="border-bottom: 1px white solid">
        <div class="row gx-0">
            <div class="col-12 col-lg-8 text-center text-lg-start mb-2 mb-lg-0 social-content">
                <div class="d-inline-flex align-items-center justify-content-center justify-content-lg-start" style="height: 45px;">
                    <div class="social-media-icons"> <!-- This section will be hidden on mobile -->
                        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href="https://www.facebook.com/share/1AScBnfmXE/" target="_blank"><i class="fab fa-facebook-f fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href="#"><i class="fab fa-instagram fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle" href="https://wa.me/94775192780" target="_blank">c</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    @guest
                        <a href="{{ route('register') }}" class="me-3 text-light"><small><i class="fa fa-user me-2"></i>Register</small></a>
                        <a href="{{ route('login') }}" class="me-3 text-light"><small><i class="fa fa-sign-in-alt me-2"></i>Login</small></a>
                    @else
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle text-light" data-bs-toggle="dropdown">
                                <small><i class="fas fa-user-circle me-2" style="font-size: 20px;"></i>{{ Auth::user()->name }}</small>
                            </a>
                            <div class="dropdown-menu rounded">
                                <a href="{{route('profile')}}" class="dropdown-item"><i class="fas fa-user-alt me-2"></i> My Profile</a>
                                <a href="{{ route('logout') }}" class="dropdown-item"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-power-off me-2"></i> Log Out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0" style="background-color: #347928">
            <a href="" class="navbar-brand p-0">
                <h1 class="m-0" style="font-size: 30px;">King Sri Lanka Tours</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0" >
                    <a href="{{route('home')}}" class="nav-item nav-link @if(request()->routeIs('home'))active @endif" style="font-weight: bold">Home</a>
                    <a href="{{route('about')}}" class="nav-item nav-link @if(request()->routeIs('about'))active @endif" style="font-weight: bold">About</a>
                    <a href="{{route('packages')}}" class="nav-item nav-link @if(request()->routeIs('packages'))active @endif" style="font-weight: bold">Tours</a>
                    <a href="{{route('gallery')}}" class="nav-item nav-link @if(request()->routeIs('gallery'))active @endif" style="font-weight: bold">Gallery</a>
                    <a href="{{route('transport')}}" class="nav-item nav-link @if(request()->routeIs('transport'))active @endif" style="font-weight: bold">Transport</a>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" style="font-weight: bold">Pages</a>
                        <div class="dropdown-menu m-0">
                            <a href="{{route('guide')}}" class="dropdown-item">Travel Guides</a>
                            <a href="{{route('testimonial')}}" class="dropdown-item">Testimonial</a>
                        </div>
                    </div>
                    <a href="{{route('contact')}}" class="nav-item nav-link @if(request()->routeIs('contact'))active @endif" style="font-weight: bold">Contact</a>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar & Hero End -->


<br>
<br>



<script>
    // Optional JavaScript for hiding top bar on scroll (for desktop)
    let lastScrollTop = 0;
    const topbar = document.getElementById('topbar');

    window.addEventListener('scroll', function() {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (window.innerWidth > 992) { // Only apply for desktop
            if (scrollTop > lastScrollTop) {
                // Scrolling down
                topbar.style.top = "0"; // Hide the top bar
            } else {
                // Scrolling up
                topbar.style.top = "0"; // Show the top bar
            }
            lastScrollTop = scrollTop;
        }
    });
</script>
