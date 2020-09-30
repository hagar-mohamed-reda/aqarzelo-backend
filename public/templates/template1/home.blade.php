<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Site Metas -->
    <title>{{ $profile->name }}</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{ url('/') }}/templates/template1/images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="{{ url('/') }}/templates/template1/images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/templates/template1/css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/templates/template1/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/templates/template1/css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/templates/template1/css/custom.css">
    <script src="{{ url('/') }}/templates/template1/js/modernizr.js"></script> <!-- Modernizr -->

    <!--[if lt IE 9]>
      <script src="{{ url('/') }}/templates/template1/https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="{{ url('/') }}/templates/template1/https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body id="page-top" class="politics_version">

    <!-- LOADER -->
    <div id="preloader">
        <div class="loader">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div><!-- end loader -->
    <!-- END LOADER -->

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="{{ url('/') }}/templates/template1/#page-top">
                <img class="img-fluid" src="{{ $profile->photo }}" alt="" />
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ml-auto">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger active" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#portfolio">Portfolio</a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#blog">Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#contact">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="home" class="ct-header ct-header--slider ct-slick-custom-dots">
        <div class="ct-slick-homepage" data-arrows="true" data-autoplay="false">

            <div class="ct-header tablex item" data-background="{{ url('/') }}/templates/template1/uploads/banner-01.jpg">
                <div class="ct-u-display-tablex">
                    <div class="inner">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 col-lg-8 slider-inner">
                                    <h1 class="big animated">Hello I'm Web Designer</h1>
                                    <p class="animated">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse iaculis massa bibendum sodales rhoncus.</p>
                                    <a class="btn-new from-middle animated" href="{{ url('/') }}/templates/template1/#">Download cv</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ct-header tablex item" data-background="{{ url('/') }}/templates/template1/uploads/banner-01.jpg">
                <div class="ct-u-display-tablex">
                    <div class="inner">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 col-lg-8 slider-inner">
                                    <h1 class="big animated">Hello I'm Ux/Ui Designer</h1>
                                    <p class="animated">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse iaculis massa bibendum sodales rhoncus.</p>
                                    <a class="btn-new from-middle animated" href="{{ url('/') }}/templates/template1/#">Download cv</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ct-header tablex item" data-background="{{ url('/') }}/templates/template1/uploads/banner-01.jpg">
                <div class="ct-u-display-tablex">
                    <div class="inner">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 col-lg-8 slider-inner">
                                    <h1 class="big animated">Hello I'm Web Developer</h1>
                                    <p class="animated">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse iaculis massa bibendum sodales rhoncus.</p>
                                    <a class="btn-new from-middle animated" href="{{ url('/') }}/templates/template1/#">Download cv</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- .ct-slick-homepage -->
    </div><!-- .ct-header --> 

    <div id="about" class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="message-box">                        
                        <h2>About {{ $profile->name }}.</h2>
                         <p>{{ $profile->about }}.</p>

                        <ul>
                            <li><b>Follow Me</b></li>
                            <br>
                            <li><a href="{{ $profile->facebook }}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="{{ $profile->twitter }}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="{{ $profile->linkedin }}"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li> 
                            <li><a href="{{ $profile->whatsapp }}"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                            <li><a href="{{ $profile->youtube_link }}"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                            <li><a href="{{ $profile->youtube_video }}"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                        </ul>

                        <a class="btn-new from-middle animated" href="{{ $profile->attached_file }}">Download cv</a>
                    </div><!-- end messagebox -->
                </div><!-- end col -->

                <div class="col-md-6">
                    <div class="right-box-pro wow fadeIn">
                        <img src="{{ url('/') }}/templates/template1/images/about-1.png" alt="" class="img-fluid img-rounded fat-ab">
                    </div><!-- end media -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->

    <div id="services" class="section lb">
        <div class="container">
            <div class="section-title text-center">
                <h3>Services</h3>
                <p>we support three services with good quality.</p>
            </div><!-- end title -->

            <div class="row">
                <div class="col-md-4">
                    <div class="services-inner-box">
                        <div class="ser-icon">
                            <i class="flaticon-idea-1"></i>
                        </div>
                        <h2>buy home</h2>
                        <p>Find your place with an immersive photo experience and the most listings, including things you won’t find anywhere else. .</p>
                    </div>
                </div><!-- end col -->
                <div class="col-md-4">
                    <div class="services-inner-box">
                        <div class="ser-icon">
                            <i class="flaticon-discuss-issue"></i>
                        </div>
                        <h2>sell home</h2>
                        <p>Whether you sell with new Zillow Offers™ or take another approach, we’ll help you navigate the path to a successful sale..</p>
                    </div>
                </div><!-- end col -->
                <div class="col-md-4">
                    <div class="services-inner-box">
                        <div class="ser-icon">
                            <i class="flaticon-idea"></i>
                        </div>
                        <h2>rent home</h2>
                        <p>We’re creating a seamless online experience – from shopping on the largest rental network, to applying, to paying rent.</p>
                    </div>
                </div><!-- end col -->
                
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->

    <div id="portfolio" class="section lb">
        <div class="container">
            <div class="section-title text-center">
                <h3>Portfolio</h3>
                <p>look about out posts images.</p>
            </div><!-- end title -->

            <div class="gallery-menu text-center row">
                <div class="col-md-12">
                    <!--
                    <div class="button-group filter-button-group">
                        <button class="btn-new from-middle animated active" data-filter="*">All</button>
                        <button class="btn-new from-middle animated" data-filter=".gal_a">Web Development</button>
                        <button class="btn-new from-middle animated" data-filter=".gal_b">Creative Design</button>
                        <button class="btn-new from-middle animated" data-filter=".gal_c">Graphic Design</button>
                    </div>
                    -->
                </div>
            </div>

            <div class="gallery-list row">
                @foreach($profile->getPosts() as $post)
                <div class="col-md-4 col-sm-6 gallery-grid gal_a gal_b">
                    <div class="gallery-single spi-hr fix hover">
                        <img src="{{ $post->images()->get()[0]->photo }}" class="img-fluid" alt="Image">
                        <div class="text-hover">
                            <h3>{{ $post->title }}</h3>
                            <h4>{{ $post->description }}</h4>
                        </div>
                        <div class="img-overlay">
                            <a href="{{ $post->images()->get()[0]->photo }}" data-rel="prettyPhoto[gal]" class="hoverbutton global-radius"><i class="fa fa-picture-o"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach  
            </div>
        </div>
    </div>
</div>
 
<div id="blog" class="section lb">
    <div class="container">
        <div class="section-title text-center">
            <h3>posts</h3>
            <p>our posts.</p>
        </div><!-- end title -->

        <div class="row">
            
            @foreach($profile->getPosts() as $post)
            <div class="col-md-4 col-sm-6 col-lg-4">
                <figure class="snip1401">
                    <img src="{{ $post->images()->get()[0]->photo }}" alt="" />
                    <figcaption>
                        <h3>{{ $post->title }}</h3>
                        <p>{{ $post->description }}.</p>
                        <ul>
                            <li>by {{ $post->name }}</li>
                            <li>{{ $post->created_at }}</li>
                            <li>Comments</li>
                        </ul>
                    </figcaption>
                    <i class="ion-ios-home-outline"></i>
                    <a href="{{ url('/') }}/templates/template1/#"></a>
                </figure>
            </div>
            @endforeach
            
             
        </div>

    </div>
</div>

<div id="contact" class="section db">
    <div class="container">
        <div class="section-title text-center">
            <h3>Contact Me</h3>
            <p>Quisque eget nisl id nulla sagittis auctor quis id. Aliquam quis vehicula enim, non aliquam risus.</p>
        </div><!-- end title -->

        <div class="row">
            <div class="col-md-12">
                <div class="contact_form">
                    <div id="message"></div>
                    <form id="contactForm" name="sentMessage" novalidate="novalidate">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" id="name" type="text" placeholder="Your Name" required="required" data-validation-required-message="Please enter your name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="email" type="email" placeholder="Your Email" required="required" data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="phone" type="tel" placeholder="Your Phone" required="required" data-validation-required-message="Please enter your phone number.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" id="message" placeholder="Your Message" required="required" data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button id="sendMessageButton" class="sim-btn btn-new from-middle animated" data-text="Send Message" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end section -->

<div class="copyrights">
    <div class="container">
        <div class="footer-distributed">
            <div class="footer-left">
                <p class="footer-company-name">All Rights Reserved. &copy; 2018 <a href="{{ url('/') }}/templates/template1/#">Nickie</a> Design By : 
                    <a href="{{ url('/') }}/templates/template1/https://html.design/">html design</a></p>
            </div>
        </div>
    </div><!-- end container -->
</div><!-- end copyrights -->

<a href="{{ url('/') }}/templates/template1/#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

<!-- ALL JS FILES -->
<script src="{{ url('/') }}/templates/template1/js/all.js"></script>
<!-- Camera Slider -->
<script src="{{ url('/') }}/templates/template1/js/jquery.mobile.customized.min.js"></script>
<script src="{{ url('/') }}/templates/template1/js/jquery.easing.1.3.js"></script> 
<script src="{{ url('/') }}/templates/template1/js/parallaxie.js"></script>
<script src="{{ url('/') }}/templates/template1/js/slick.min.js"></script>
<script src="{{ url('/') }}/templates/template1/js/animated-slider.js"></script>
<!-- Contact form JavaScript -->
<script src="{{ url('/') }}/templates/template1/js/jqBootstrapValidation.js"></script>
<script src="{{ url('/') }}/templates/template1/js/contact_me.js"></script>
<!-- ALL PLUGINS -->
<script src="{{ url('/') }}/templates/template1/js/custom.js"></script>
</body>
</html>