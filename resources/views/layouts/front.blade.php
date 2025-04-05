<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title', 'King Sri Lanka Tours')</title>
    <meta name="description" content="@yield('meta_description', 'Discover the best of Sri Lanka with King Sri Lanka Tours. Explore beaches, culture, and wildlife across the island.')">
    <meta name="keywords" content="@yield('meta_keywords', 'Sri Lanka Tours, Sri Lanka Tourism, Beach Tours, Wildlife Safaris, Cultural Tours')">
    <meta name="author" content="@yield('meta_author', 'King Sri Lanka Tours')">

    <!-- Open Graph Tags -->
    <meta property="og:title" content="@yield('meta_og_title', 'King Sri Lanka Tours - Explore the Beauty of Sri Lanka')">
    <meta property="og:description" content="@yield('meta_og_description', 'King Sri Lanka Tours offers unforgettable travel experiences in Sri Lanka.')">
    <meta property="og:image" content="@yield('meta_og_image', asset('assets/images/og-image.jpg'))">
    <meta property="og:url" content="@yield('meta_og_url', url()->current())">
    <meta property="og:type" content="website">

    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('meta_og_title', 'King Sri Lanka Tours - Explore the Beauty of Sri Lanka')">
    <meta name="twitter:description" content="@yield('meta_og_description', 'King Sri Lanka Tours offers unforgettable travel experiences in Sri Lanka.')">
    <meta name="twitter:image" content="@yield('meta_og_image', asset('assets/images/og-image.jpg'))">

    <!-- Canonical Tag -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="{{ asset('asset/front/lib/owlcarousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/front/lib/lightbox/css/lightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/front/lib/owlcarousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/front/lib/lightbox/css/lightbox.min.css') }}">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">



    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('asset/front/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('asset/front/css/style.css')}}" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('asset/front/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{ asset('asset/front/lib/owlcarousel/assets/owl.carousel.min.css/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{ asset('asset/front/lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">



    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('asset/front/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('asset/front/css/style.css')}}" rel="stylesheet">


    <style>
         .whatsapp-float {
      position: fixed;
      bottom: 100px;
      right: 20px;
      background-color: #25D366;
      color: white;
      width: 90px;
      height: 90px;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 60px;
      box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
      text-decoration: none;
      transition: background 0.3s;
  }

  .whatsapp-float:hover {
      background-color: #128C7E;
      text-decoration: none;
  }
    </style>

</head>

<body>


<!-- Navbar -->
@yield('navBar', view('component.navBar'))
<!-- /.navbar -->

@yield('content')

<!-- /.content-wrapper -->
@yield('footer', view('component.footer'))

<a href="https://wa.me/+94775192780" target="_blank" 
   class="whatsapp-float">
   <i class="fab fa-whatsapp fw-normal"></i>
</a>
<!-- Back to Top -->
<a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i class="fa fa-arrow-up"></i></a>





<script src="{{ asset('asset/front/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('asset/front/lib/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('asset/front/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('asset/front/lib/owlcarousel/assets/owl.carousel.css') }}"></script>
<script src="{{ asset('asset/front/lib/owlcarousel/assets/owl.carousel.css/owl.carousel.min.css') }}"></script>
<script src="{{ asset('asset/front/lib/lightbox/js/lightbox.min.js') }}"></script>
<script src="{{ asset('asset/front/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('asset/front/js/main.js') }}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- CSS Link -->
<link rel="stylesheet" href="{{ asset('asset/front/lib/owlcarousel/assets/owl.carousel.css') }}">

<!-- JS Link -->
<script src="{{ asset('asset/front/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('asset/front/lib/owlcarousel/owl.carousel.min.js') }}"></script>


<script>
    $(document).ready(function(){
        $(".testimonial-carousel").owlCarousel({
            items: 3,
            loop: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            nav: true,
            dots: true
        });
    });
</script>




</body>

</html>
