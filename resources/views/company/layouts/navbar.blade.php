 <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="">
                    <img src="{{ url('/images/logo2.png') }}" width="30px" style="padding: 2px" >
                </a>
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
            </div>
            <div class="navbar-header" style="padding: 20px" >
                <span class="label label-info w3-large w3-round" style="margin-left: 5px;margin-right: 5px" >
                    <i class="fa fa-user-circle" style="padding: 3px" ></i>
                    max users :
                    {{ optional(App\Company::auth())->users()->count() }} / {{ optional(optional(App\Company::auth())->service)->max_user }}
                </span>
                <span class="label label-primary w3-large w3-round" style="margin-left: 5px;margin-right: 5px" >
                    <i class="fa fa-rss" style="padding: 3px" ></i>
                    max posts :
                    {{ optional(App\Company::auth())->posts()->count() }} / {{ optional(optional(App\Company::auth())->service)->max_post }}
                </span>
                <span class="label label-warning w3-large w3-round" style="margin-left: 5px;margin-right: 5px" >
                    <i class="fa fa-image" style="padding: 3px" ></i>
                    max post images :
                    {{ optional(optional(App\Company::auth())->service)->max_post_image }}
                </span>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li>
                    </li>

                    <!-- #END# Tasks -->
                     <li>
                         <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="material-icons">logout</i>
                                    </a>

                                      <form id="logout-form" action="{{ route('company.logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>




                   </li>
                 </ul>
            </div>
        </div>
    </nav>
