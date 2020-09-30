<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
 
     <!-- Site Metas -->
    <title>Aqar Zelo</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('templates/template5/css/bootstrap.min.css') }}">
    <!-- Site CSS -->
    <link rel="stylesheet" href="{{ asset('templates/template5/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('templates/template5/css/responsive.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('templates/template5/css/custom.css') }}">
	<script src="{{ asset('templates/template5/js/modernizr.js') }}"></script> <!-- Modernizr -->

   

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
        <a class="navbar-brand js-scroll-trigger" href="#page-top">
			<img class="img-fluid" src="{{ asset('templates/template5/images/logo.png') }}" hight="200px" width="200px" alt="" />
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
              <a class="nav-link js-scroll-trigger" href="#about">About Me</a>
            </li>
           
         
			<li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#blog">My Posts</a>
            </li>
			<li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact">Contect me</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
	
	<div id="home" class="ct-header ct-header--slider ct-slick-custom-dots">
		<div class="ct-slick-homepage" data-arrows="true" data-autoplay="false">
        
			<div class="ct-header tablex item" data-background="{{ asset('templates/template5/uploads/one.jpg') }}">
				<div class="ct-u-display-tablex">
					<div class="inner">
						<div class="container">
							<div class="row">
								<div class="col-md-8 col-lg-8 slider-inner">
									<h1 class="big animated">Hello I'm {{$user->name}}</h1>
									<p class="animated"> I' m one of Aqar Zelo family</p>
								
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="ct-header tablex item" data-background="{{ asset('templates/template5/uploads/two.jpg') }}">
				<div class="ct-u-display-tablex">
					<div class="inner">
						<div class="container">
							<div class="row">
								<div class="col-md-8 col-lg-8 slider-inner">
									<h1 class="big animated">Hello I'm {{$user->name}}</h1>
									<p class="animated"> I hope to help you and find what you looking for </p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="ct-header tablex item" data-background="{{ asset('templates/template5/uploads/three.jpg') }}">
				<div class="ct-u-display-tablex">
					<div class="inner">
						<div class="container">
							<div class="row">
								<div class="col-md-8 col-lg-8 slider-inner">
                                <h1 class="big animated">Hello I'm {{$user->name}}</h1>
									<p class="animated"> look & enjoy :) </p>
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
                <div class="col-md-8">
                    <div class="message-box">                        
                        <h2>About {{$user->name}}.</h2>
                        <p> {{$user->about}} </p>
						
						<ul>
							<li><b>Follow Me</b></li>
							<li><a href=" {{$user->facebook}}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							<li><a href="{{$user->twitter}}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							<li><a href="{{$user->linkedin}}"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
							<li><a href="{{$user->whatsapp}}"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
							<li><a href="{{$user->youtube_link}}"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
						</ul>

					
                    </div><!-- end messagebox -->
                </div><!-- end col -->

                <div class="col-md-4">
                    <div class="right-box-pro wow fadeIn">
                    <img  width="500px"  src="{{ asset('images/user') ."/". $user->photo }}" alt="" class="img-fluid img-rounded fat-ab">
                 
						
                    </div><!-- end media -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->
	
   
	
	
	
	
	<div id="blog" class="section lb">
		<div class="container">
			<div class="section-title text-center">
                <h3>My Posts </h3>
                <p>We are hope to find what you need here </p>
            </div><!-- end title -->
			
			<div class="row">
            @foreach($posts as $post)
				<div class="col-md-4 col-sm-6 col-lg-4">
					<figure class="snip1401">
                  
                    @if ($post->images()->first())
						<img src="{{ asset('images/posts') ."/". $post->images()->first()->photo }}" class="img-fluid" alt="Image">
                       @endif
						<figcaption>
                        <h3 class="text-center">{{$post->user->company->name}}</h3>
                            <h3 class="text-center">{{$post->title}}</h3>
                          
                            <p class="text-center">Price per meter :${{$post->price_per_meter}}</p>
                            <p class="text-center">Space:{{$post->space}} m</p>
							<p class="text-center">Bedroom No. :{{$post->bedroom_number}}</p>
                            <p class="text-center">Bathroom No.:{{$post->bathroom_number}} </p>
							
						</figcaption>
						<i class="ion-ios-home-outline"></i>
						<a href="#"></a>
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
               
                <p>{{$user->phone}}</p>
                <p>{{$user->email}}</p>   </div><!-- end title -->

          
        </div><!-- end container -->
    </div><!-- end section -->

   

    <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

    <!-- ALL JS FILES -->
   
    <script src="{{ asset('templates/template5/js/all.js') }}"></script>
    <!-- Camera Slider -->
   
	<script src="{{ asset('templates/template5/js/jquery.mobile.customized.min.js') }}"></script>
	<script src="{{ asset('templates/template5/js/jquery.easing.1.3.js') }}"></script> 
	<script src="{{ asset('templates/template5/js/parallaxie.js') }}"></script>
	<script src="{{ asset('templates/template5/js/slick.min.js') }}"></script>
	<script src="{{ asset('templates/template5/js/animated-slider.js') }}"></script>
	<!-- Contact form JavaScript -->
    <script src="{{ asset('templates/template5/js/jqBootstrapValidation.js') }}"></script>
    <script src="{{ asset('templates/template5/js/contact_me.js') }}"></script>
    <!-- ALL PLUGINS -->
    <script src="{{ asset('templates/template5/js/custom.js') }}"></script>
</body>
</html>