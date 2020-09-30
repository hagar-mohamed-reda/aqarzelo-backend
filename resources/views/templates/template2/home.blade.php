

<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
 
     <!-- Site Metas -->
    <title>Aqar Zelo Tempolate</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
 
    <!-- Bootstrap CSS -->
   
    <link rel="stylesheet" href= "{{ asset('templates/template2/css/bootstrap.min.css') }}">
    <!-- Site CSS -->
    <link rel="stylesheet" href= "{{ asset('templates/template2/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href= "{{ asset('templates/template2/css/responsive.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href= "{{ asset('templates/template2/css/custom.css') }}">
	<script src= "{{ asset('templates/template2/js/modernizr.js') }}"></script> 

   

</head>
<body id="page-top" class="politics_version">

    <!-- LOADER -->
    <div id="preloader">
        <div id="main-ld">
			<div id="loader"></div>  
		</div>
    </div><!-- end loader -->
    <!-- END LOADER -->
	
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">
            <img src="{{ url('/images/logo2.png') }}" width="35px" style="padding: 6px" >Aqar Zelo
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
              <a class="nav-link js-scroll-trigger" href="#contact">Contect Us</a>
            </li>
          </ul>
        </div>
      </div>
    </nav> 
	<section id="home" class="main-banner parallaxie" style="background: url('{{ url('/') }}/templates/template2/uploads/two.jpg')">
		<div class="heading">
			<h1>{{$user->name}}</h1>
			<p>I'am one of family aqar zelo <br>I hope to help you to find what you need </p>
			<h3 class="cd-headline clip is-full-width">
				<span>We can help you to find </span>
				<span class="cd-words-wrapper">
					<b class="is-visible">House</b>
					<b>Appartment </b>
					<b>Office </b>
					<b>and more</b>
				</span>
			</h3>
		</div>
	</section>

	

    <div id="about" class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="message-box">                        
                        <h2>About </h2>

                      
                        <p>    {{$user->name}} </p>
						
                        <p>  {{$user->about}} </p>
						

                          </div><!-- end messagebox -->
                </div><!-- end col -->

                <div class="col-md-4">
                  
                    <img  width="400px" src="{{ asset('images/users') ."/". $user->photo }}" alt="" class="img-fluid img-rounded">
                 
                        
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->
	
	
	<div id="blog" class="section lb" style="padding-bottom:0px!important;">
		<div class="container">
			<div class="section-title text-left">
                <h3> My Posts</h3>
                <p> I hope to find what you need  </p>
            </div><!-- end title -->
			
			<div class="row">
            @foreach($posts as $post)
				<div class="col-md-4 col-sm-6 col-lg-4" onclick="window.location='{{ url("/map?post_id=") }}{{ $post->id }}'"  style="padding: 10px;cursor: pointer" >
					<div class="post-box" >
						<div class="post-thumb">
                        @if ($post->images()->first())
						<img style="height: 300px!important" src="{{ asset('images/posts') ."/". $post->images()->first()->photo }}" class="img-fluid" alt="Image">
                       @endif
							<div class="date">
								<span>{{$post->user->company->name}}</span>
							
							</div>
						</div>
						<div class="post-info">
							<h4 class="text-center">{{$post->title}}</h4>
                            </br>
                            <h5 class="text-center">Price per meter :${{$post->price_per_meter}}</h5>
                            <h5 class="text-center">Space:{{$post->space}} m</h5>
                            <h5 class="text-center">Bedroom No. :{{$post->bedroom_number}}</h5>
                            <h5 class="text-center">Bathroom No.:{{$post->bathroom_number}} </h5>
							
							
							<p class="text-center" >{{substr( $post->description,0, 255)}}...</p>
						</div>
					</div>
				</div>

                @endforeach
				
			
		</div>
	</div>
	 
    <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>


    <div id="contact" class="section db" style="padding-bottom:0px!important;">
        <center class="container">
            <center class="section-title text-center">
            <h3>Call me </h3>
                <p>{{$user->phone}}</p>
                <p>{{$user->email}}</p>
            </center><!-- end title -->

           
        </center><!-- end container -->
    </div><!-- end section -->

 
    <!-- ALL JS FILES -->
    <script src="{{ asset('templates/template2/js/all.js') }}"></script>
	<!-- Camera Slider -->
	<script src="{{ asset('templates/template2/js/jquery.mobile.customized.min.js') }}"></script>
	<script src="{{ asset('templates/template2/js/jquery.easing.1.3.js') }}"></script> 
	<script src="{{ asset('templates/template2/js/parallaxie.js') }}"></script>
	<script src="{{ asset('templates/template2/js/headline.js') }}"></script>
	<!-- Contact form JavaScript -->
    <script src="{{ asset('templates/template2/js/jqBootstrapValidation.js') }}"></script>
    <script src="{{ asset('templates/template2/js/contact_me.js') }}"></script>
    <!-- ALL PLUGINS -->
    <script src="{{ asset('templates/template2/js/custom.js') }}"></script>
    <script src="{{ asset('templates/template2/js/jquery.vide.js') }}"></script>

</body>
</html>
