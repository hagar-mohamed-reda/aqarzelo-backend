<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Aqar Zelo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- styles -->
 
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700" rel="stylesheet">
  <link href="{{ asset('templates/template6/assets/css/bootstrap.css') }}" rel="stylesheet">
  <link href="{{ asset('templates/template6/assets/css/bootstrap-responsive.css') }}" rel="stylesheet">
  <link href="{{ asset('templates/template6/assets/css/docs.css') }}" rel="stylesheet">
  <link href="{{ asset('templates/template6/assets/css/prettyPhoto.css') }}" rel="stylesheet">
  <link href="{{ asset('templates/template6/assets/js/google-code-prettify/prettify.css') }}" rel="stylesheet">
  <link href="{{ asset('templates/template6/assets/css/flexslider.css') }}" rel="stylesheet">
  <link href="{{ asset('templates/template6/assets/css/sequence.css') }}" rel="stylesheet">
  <link href="{{ asset('templates/template6/assets/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('templates/template6/assets/color/default.css') }}" rel="stylesheet">

  

</head>

<body>
  <header>
    <!-- Navbar
    ================================================== -->
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <!-- logo -->
          <a class="brand logo" href="#"><img src="{{ asset('templates/template6/assets/img/logo.png') }}" hight="200px" width="200px" alt=""></a>
          <!-- end logo -->
          <!-- top menu -->
          <div class="navigation">
            <nav>
              <ul class="nav topnav">
                <li class="dropdown active">
                  <a href="#">Home</a>
                </li>
                 <li class="dropdown">
                  <a href="#about">About</a>
                 </li>
              
               
               
                <li class="dropdown">
                  <a href="#posts">My Posts</a>
                 </li>
                 
              
              
                <li>
                  <a href="#contact">Contact</a>
                </li>
              </ul>
            </nav>
          </div>
          <!-- end menu -->
        </div>
      </div>
    </div>
  </header>
  <section id="intro">
    <div class="jumbotron masthead">
      <div class="container">
        <!-- slider navigation -->
        <div class="sequence-nav">
          <div class="prev">
            <span></span>
          </div>
          <div class="next">
            <span></span>
          </div>
        </div>
        <!-- end slider navigation -->
        <div class="row">
          <div class="span12">
            <div id="slider_holder">
              <div id="sequence">
                <ul>
                  <!-- Layer 1 -->
                  <li>
                    <div class="info animate-in">
                      <h2>{{$user->name}}</h2>
                      <br>
                      <h3>{{$user->company->name}} Company </h3>
                     
                    
                    </div>
                    
                    <img class="slider_img animate-in" src="{{ asset('templates/template6/assets/img/slides/sequence/img-1.png') }}" alt="">
                  </li>
                  <li>
                    <div class="info animate-in">
                      <h2> Hello I'm{{$user->name}}</h2>
                      <br>
                      <h3>{{$user->company->name}} Company </h3>
                    
									<p> I' m one of Aqar Zelo family</p>
                    
                    
                    </div>
                    
                    <img class="slider_img animate-in" src="{{ asset('templates/template6/assets/img/slides/sequence/img-2.png') }}" alt="">
                  </li>
                  <li>
                    <div class="info animate-in">
                      <h2>{{$user->name}}</h2>
                      <br>
                      <h3>{{$user->company->name}} Company </h3>
                     
                    
                    </div>
                    
                    <img class="slider_img animate-in" src="{{ asset('templates/template6/assets/img/slides/sequence/img-3.png') }}" alt="">
                  </li>
                
                  

                </ul>
              </div>
            </div>
            <!-- Sequence Slider::END-->
          </div>
        </div>
      </div>
    </div>
  </section>
  
  
  <section id="subintro">
    <div class="jumbotron subhead" id="overview">
      <div class="container">
        <div class="row">
          <div class="span12">
            <div class="centered" id="about">
              <h3>About Me</h3>
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
 
  <section id="maincontent">
    <div class="container">
      <div class="row">
        <div class="span6">
          <aside>
            <div class="widget">
              <h4>About Me</h4>
             <p> {{$user->about}}</p>
            </div>
           
          </aside>
        </div>
        <div class="span2">
         
                   
           
           
 
         </div>

        <div class="span4">
         
        <img  width="400px"  src="{{ asset('images/users') ."/". $user->photo }}" alt="" class="img-fluid img-rounded fat-ab">
                 
          
          

        </div>
       
      </div>
    </div>
  </section>

 

  <section id="subintro">
    <div class="jumbotron subhead" id="overview">
      <div class="container">
        <div class="row">
          <div class="span12">
            <div class="centered">
              <h3>My Posts</h3>
             
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="maincontent">
    <div class="container">
     
      <div class="row" >
        <ul class="portfolio-area da-thumbs" id="posts">
        @foreach($posts as $post)
          <li class="portfolio-item2" data-id="id-0" data-type="web" >
            <div class="span4">
              <div class="thumbnail">
                <div class="image-wrapp" onclick="window.location='{{ url("/map?post_id=") }}{{ $post->id }}'"  style="padding: 10px;cursor: pointer">
                @if ($post->images()->first())
						<img src="{{ asset('images/posts') ."/". $post->images()->first()->photo }}" class="img-fluid" alt="Image">
                       @endif
                  <article class="da-animate da-slideFromRight" style="display: block;">
                  <h4>{{$user->company->name}} Company </h4>
                    <h4>{{$post->title}}</h4>
                  
                    <h6 class="text-center" style="color:white;">Price per meter :${{$post->price_per_meter}}</h6>
                    <h6 class="text-center" style="color:white;">Space:{{$post->space}} m</h6>
                    <h6 class="text-center" style="color:white;">Bedroom No. :{{$post->bedroom_number}}</h6>
                    <h6 class="text-center" style="color:white;">Bathroom No.:{{$post->bathroom_number}} </h6>
                  </article>
                </div>
              </div>
            </div>
          </li>
          @endforeach
        </ul>
      </div>
     
    </div>
  </section>

  <section id="subintro">
    <div class="jumbotron subhead" id="overview">
      <div class="container">
        <div class="row">
          <div class="span12">
            <div class="centered" id="contact">
              <h3>Contact Me</h3>
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
 
  <section id="maincontent">
    <div class="container">
      <div class="row">
        <div class="span12 text-center">
          <aside>
            <div class="widget">
              <h4>Get in touch with us</h4>
              <ul>
                <li><label><strong>Phone : </strong></label>
                  <p>
                   {{$user->phone}}
                  </p>
                </li>
                <li><label><strong>Email : </strong></label>
                  <p>
                  {{$user->email}}
                  </p>
                </li>
                <li><label><strong>Adress : </strong></label>
                  <p>
                  {{$user->address}}
                  </p>
                </li>
              </ul>
            </div>
            <div class="widget">
              <h4>Social network</h4>
              <ul class="social-links">
                <li><a href="{{$user->twitter}}" title="Twitter"><i class="icon-rounded icon-32 icon-twitter"></i></a></li>
                <li><a href=" {{$user->facebook}}" title="Facebook"><i class="icon-rounded icon-32 icon-facebook"></i></a></li>
                 <li><a href="{{$user->linkedin}}" title="Linkedin"><i class="icon-rounded icon-32 icon-linkedin"></i></a></li>
                </ul>
            </div>
          </aside>
        </div>
      

      
       
      </div>
    </div>
  </section>

  <!-- JavaScript Library Files -->
  <script src="{{ asset('templates/template6/assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('templates/template6/assets/js/jquery.easing.js') }}"></script>
  <script src="{{ asset('templates/template6/assets/js/google-code-prettify/prettify.js') }}"></script>
  <script src="{{ asset('templates/template6/assets/js/modernizr.js') }}"></script>
  <script src="{{ asset('templates/template6/assets/js/bootstrap.js') }}"></script>
  <script src="{{ asset('templates/template6/assets/js/jquery.elastislide.js') }}"></script>
  <script src="{{ asset('templates/template6/assets/js/sequence/sequence.jquery-min.js') }}"></script>
  <script src="{{ asset('templates/template6/assets/js/sequence/setting.js') }}"></script>
  <script src="{{ asset('templates/template6/assets/js/jquery.prettyPhoto.js') }}"></script>
  <script src="{{ asset('templates/template6/assets/js/application.js') }}"></script>
  <script src="{{ asset('templates/template6/assets/js/jquery.flexslider.js') }}"></script>
  <script src="{{ asset('templates/template6/assets/js/hover/jquery-hover-effect.js') }}"></script>
  <script src="{{ asset('templates/template6/assets/js/hover/setting.js') }}"></script>

  <!-- Template Custom JavaScript File -->
  <script src="{{ asset('templates/template6/assets/js/custom.js') }}"></script>

 

</body>
</html>
