@extends("website.component.app")
@php

if (session("locale"))
    App()->setLocale(session("locale")); 
else
    App()->setLocale("ar"); 

@endphp
 
@section("css") 
<style> 
    * {
        text-transform: capitalize!important;
    }
    .tab-content .w3-padding {
        padding: 5px!important;
    }
</style>
@endsection

@section("content") 


<div class="modal show login-background" style="z-index: -1;overflow: auto" id="root" >
    <br>
    <br> 
    <br> 
    <br> 
    <div class="w3-modal-content shadow w3-round w3-white w3-display-container" style="min-height: 400px;width: 90%;padding: 0px!important" >

        <!-- cover image -->
        <div class="w3-padding w3-display-container" >
            <div class="w3-display-bottomleft w3-padding" style="bottom: -60px;left: 20px" >
                <div class="media w3-padding">
                    <div class="media-left">
                        <a href="#" style="padding: 5px" >
                            <img src="{{ App\Profile::auth()->photo_url }}" onclick="viewImage(this)" class="profile-image w3-round shadow w3-white" style="padding: 3px" height="100px" width="100px" >
                        </a> 
                    </div>
                    <div class="media-body">
                        <br>
                        <br> 
                        <br> 
                        <h4 class="media-heading  w3-display-container">{{ App\Profile::auth()->name }}</h4>
                        {{ (App\Profile::auth()->company)? App\Profile::auth()->company->name : '' }}

                        <div class="w3-display-bottom{{ session('direction')=='ltr'? 'left': 'right' }} w3-padding" style="left: 80px;bottom: -20px" >
                            <button class="profile-image-icon btn light-theme-background w3-circle w3-margin shadow w3-text-white btn-sm" >
                                <i class="fa fa-camera"  ></i>
                            </button>
                            <form method="post" id="profile-image-form" class="form" action="{{ url('/profile/update/image') }}" enctype="multipart\form-data" > 
                                {{ csrf_field() }}
                                <input type="file" name="photo" class="hidden profile-image-input" onchange="loadImage(this, event, $('.profile-image')[0]);
                                        changeProfileImageToEditIcon()"  >
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <img src="{{ App\Profile::auth()->cover_url }}" onclick="viewImage(this)" height="200px" class="profile-cover w3-round w3-block shadow" >

            <div class="w3-display-bottom{{ session('direction')=='ltr'? 'right': 'left' }} w3-padding" >
                <button class="profile-cover-icon btn light-theme-background w3-circle w3-margin shadow w3-text-white btn-sm" >
                    <i class="fa fa-camera" ></i>
                </button>
                <form method="post" id="profile-cover-form" class="form" action="{{ url('/profile/update/cover') }}" enctype="multipart\form-data" > 
                    {{ csrf_field() }}
                    <input type="file" name="cover" class="hidden profile-cover-input" onchange="loadImage(this, event, $('.profile-cover')[0]);changeProfileCoverToEditIcon()"  >
                </form>
            </div>
        </div>

        <br> 
        <div class="row" >
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 w3-padding " style="height: 280px;margin-top: 50px">
                <div id="profileInfo" >
                    <br> 
                    <ul class="w3-ul w3-large w3-margin-left" > 
                        <li>
                            <span class="fa fa-user-circle dark-theme-color w3-margin-right" ></span>  
                            <span v-html="profile.name" ></span>
                        </li>
                        <li>
                            <span class="fa fa-phone-square dark-theme-color w3-margin-right" ></span>  
                            <span v-html="profile.phone" ></span>
                        </li>
                        <li>
                            <span class="fa fa-envelope dark-theme-color w3-margin-right" ></span>  
                            <span v-html="profile.email" ></span>
                        </li>
                        <li>
                            <span class="fa fa-globe dark-theme-color w3-margin-right" ></span>   
                            <span >
                                <a style="direction:ltr!important"  href="{{ App\Profile::auth()->templete_id? url('/personal/') . '/' . App\Profile::auth()->name : '' }}" target="_blank" >
                                {{ App\Profile::auth()->templete_id? url('/personal/') . '/' . App\Profile::auth()->name : '' }}
                            </a></span>
                        </li>
                        <li>
                            <span class="fa fa-map-marker dark-theme-color w3-margin-right" ></span>  
                            <span v-html="profile.address" ></span>
                        </li>
                        <li>
                            <button onclick="showEditForm()" class="w3-btn w3-padding w3-round-xxlarge w3-large  animated fadeInUp fa fa-pencil" style="width: 200px;background-image: linear-gradient(to right, #02A2A7 , #06D9B2);color:white"   ></button> 
                        </li>
                    </ul>
                </div>
                <div id="editForm" style="display: none" >
                    <br> 
                    <form method="post"   >
                        {{ csrf_field() }}
                        <ul class="w3-ul w3-large w3-margin-left" >  
                            <li>
                                <div class="input-group">
                                    <span class="input-group-addon transparent" id="basic-addon1">
                                        <i class="fa fa-user-circle dark-theme-color" ></i>
                                    </span>
                                    <input type="text" class="form-control" v-model='profile.name' name="name" value="{{ App\Profile::auth()->name }}" aria-describedby="basic-addon1">
                                </div> 
                            </li>
                            <li>
                                <div class="input-group">
                                    <span class="input-group-addon transparent" id="basic-addon1">
                                        <i class="fa fa-envelope dark-theme-color" ></i>
                                    </span>
                                    <input type="text" class="form-control" v-model='profile.email' name="email" value="{{ App\Profile::auth()->email }}" aria-describedby="basic-addon1">
                                </div> 
                            </li>
                            <li>
                                <div class="input-group">
                                    <span class="input-group-addon transparent" id="basic-addon1">
                                        <i class="fa fa-phone-square dark-theme-color" ></i>
                                    </span>
                                    <input type="text" class="form-control" v-model='profile.phone' name="phone" value="{{ App\Profile::auth()->phone }}" aria-describedby="basic-addon1">
                                </div> 
                            </li>
                            <li>
                                <div class="input-group">
                                    <span class="input-group-addon transparent" id="basic-addon1">
                                        <i class="fa fa-map-marker dark-theme-color" ></i>
                                    </span>
                                    <input type="text" class="form-control" v-model='profile.address' name="address" placeholder="{{ __('words.address') }}" value="{{ App\Profile::auth()->address }}" aria-describedby="basic-addon1">
                                </div> 
                            </li> 
                            <li>
                                <div class="input-group">
                                    <span class="input-group-addon transparent" id="basic-addon1">
                                        <i class="fa fa-lock dark-theme-color" ></i>
                                    </span>
                                    <input type="password" class="form-control" v-model='profile.password' name="password" placeholder="{{ __('words.password') }}" value="{{ App\Profile::auth()->address }}" aria-describedby="basic-addon1">
                                </div> 
                            </li> 
                            <li>
                            <center>
                                <button type="button" onclick="updateProfile()"  class="w3-btn w3-padding w3-round-xxlarge w3-large  animated fadeInUp" style="min-width: 100px;background-image: linear-gradient(to right, #02A2A7 , #06D9B2);color:white"   >
                                    {{ __("words.ok") }}
                                </button> 
                                <button type="button" onclick="closeEditForm()"  class="w3-btn w3-padding w3-round-xxlarge w3-large  animated fadeInUp" style="min-width: 100px;background-image: linear-gradient(to right, #02A2A7 , #06D9B2);color:white"   >
                                    {{ __("words.cancel") }}
                                </button> 
                            </center>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>


            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 w3-padding">
                <div>
                    {{ request()->state }}
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="{{ request()->state!='pending'? 'active' : '' }}"><a href="#posts" aria-controls="home" role="tab" data-toggle="tab">{{ __('words.my_posts') }}</a></li>
                        <li role="presentation" class="{{ request()->state=='pending'? 'active' : '' }}"><a href="#waiting_posts" aria-controls="profile" role="tab" data-toggle="tab">{{ __('words.waiting_posts') }}</a></li>
                        <li role="presentation"><a href="#refused_posts" aria-controls="messages" role="tab" data-toggle="tab">{{ __('words.refused_posts') }}</a></li> 
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content" style="height: 260px" >
                        <div role="tabpanel" class="tab-pane active" id="posts">
                            <ul class="w3-ul row" >
                                @foreach($profile->getPosts() as $post)
                                <li class="w3-col l3 m3 s3 w3-padding w3-display-container" >   
                                    <div class="w3-display-top{{ session('direction')=='ltr'? 'right' : 'left' }} w3-padding" style="top: 130px" >
                                        <div class="dropdown"> 
                                            <a href="#" class="w3-padding" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  >
                                                <span class="glyphicon glyphicon-option-vertical"></span> 
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel" id="my-post-{{ $post->id }}" >
                                                <li> 
                                                    <a href="{{ url('/') }}/map?post_id={{ $post->id }}" >
                                                        <span class="fa fa-desktop w3-margin-right" ></span>
                                                        {{ __("words.show") }}
                                                    </a>
                                                </li>
                                                <li> 
                                                    <a href="{{ url('/edit-post') }}?post_id={{ $post->id }}" >
                                                        <span class="fa fa-pencil w3-margin-right" ></span>
                                                        {{ __("words.edit") }}
                                                    </a>
                                                </li>
                                                <li> 
                                                    <a href="#" onclick="removePost('{{ $post->id }}')"  >
                                                        <span class="fa fa-trash w3-margin-right" ></span>
                                                        {{ __("words.remove") }}
                                                    </a> 
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="w3-display-topright w3-padding"  > 
                                        <span class="label label-primary" >{{ __('words.' . $post->status) }}</span>
                                    </div>
                                    <div class="shadow w3-round w3-white" onclick="$('#my-post-{{ $post->id }}').slideToggle(300)" >
                                        <img src="{{ sizeOf($post->images()->get()) > 0? $post->images->first()->image : url('/images/posts/post.jpg') }}" class="w3-block" height="120px" >
                                        <div class="w3-padding w3-text-gray" >
                                            <div class="w3-large" >{{ substr($post->title, 0, 20) }}..</div>
                                            <div class="w3-tiny" style="height: 20px;text-overflow: ellipsis" >
                                                {{ $post->space }} {{ __("words.meter") }}, {{ $post->price }}
                                            </div>
                                            <div class="w3-tiny" >
                                                @for($i = 0; $i < 5; $i ++)
                                                @if ($i < $post->rate)
                                                <span class="fa fa-star w3-text-orange" ></span>
                                                @else
                                                <span class="fa fa-star w3-text-gray" ></span>
                                                @endif
                                                @endfor
                                            </div>
                                        </div> 
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="waiting_posts">
                            <ul class="w3-ul row" >
                                @foreach(App\Profile::auth()->posts()->where('status', 'pending')->get() as $post)
                                <li class="w3-col l3 m3 s3 w3-padding w3-display-container" >   
                                    <div class="w3-display-top{{ session('direction')=='ltr'? 'right' : 'left' }} w3-padding" style="top: 130px" >
                                        <div class="dropdown"> 
                                            <a href="#" class="w3-padding" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  >
                                                <span class="glyphicon glyphicon-option-vertical"></span> 
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel" id="w-post-{{ $post->id }}" >
                                                <li> 
                                                    <a  href="{{ url('/') }}/map?post_id={{ $post->id }}"  >
                                                        <span class="fa fa-desktop w3-margin-right" ></span>
                                                        {{ __("words.show") }}
                                                    </a>
                                                </li>
                                                <li> 
                                                    <a href="{{ url('/edit-post') }}?post_id={{ $post->id }}" >
                                                        <span class="fa fa-pencil w3-margin-right" ></span>
                                                        {{ __("words.edit") }}
                                                    </a>
                                                </li>
                                                <li> 
                                                    <a href="#" onclick="removePost('{{ $post->id }}')"  >
                                                        <span class="fa fa-trash w3-margin-right" ></span>
                                                        {{ __("words.remove") }}
                                                    </a> 
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="shadow w3-round w3-white" onclick="$('#w-post-{{ $post->id }}').slideToggle(300)" >
                                        <img src="{{ sizeOf($post->images()->get()) > 0? $post->images->first()->image : url('/images/posts/post.jpg') }}" class="w3-block" height="120px" >
                                        <div class="w3-padding w3-text-gray" >
                                            <div class="w3-large" >{{ substr($post->title, 0, 20) }}..</div>
                                            <div class="w3-tiny" style="height: 20px;text-overflow: ellipsis" >
                                                {{ $post->space }} {{ __("words.meter") }}, {{ $post->price }}
                                            </div>
                                            <div class="w3-tiny">
                                                @for($i = 0; $i < 5; $i ++)
                                                @if ($i < $post->rate)
                                                <span class="fa fa-star w3-text-orange" ></span>
                                                @else
                                                <span class="fa fa-star w3-text-gray" ></span>
                                                @endif
                                                @endfor
                                            </div>
                                        </div> 
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="refused_posts">
                            <ul class="w3-ul row" >
                                @foreach(App\Profile::auth()->posts()->where('status', 'refused')->get() as $post)
                                <li class="w3-col l3 m3 s3 w3-padding w3-display-container" >   
                                    <div class="w3-display-top{{ session('direction')=='ltr'? 'right' : 'left' }} w3-padding" style="top: 130px" >
                                        <div class="dropdown"> 
                                            <a href="#" class="w3-padding" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  >
                                                <span class="glyphicon glyphicon-option-vertical"></span> 
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel" id="pn-post-{{ $post->id }}" >
                                                <li> 
                                                    <a  href="{{ url('/') }}/map?post_id={{ $post->id }}"  >
                                                        <span class="fa fa-desktop w3-margin-right" ></span>
                                                        {{ __("words.show") }}
                                                    </a>
                                                </li>
                                                <li> 
                                                    <a href="{{ url('/edit-post') }}?post_id={{ $post->id }}" >
                                                        <span class="fa fa-pencil w3-margin-right" ></span>
                                                        {{ __("words.edit") }}
                                                    </a>
                                                </li>
                                                <li> 
                                                    <a href="#" onclick="removePost('{{ $post->id }}')" >
                                                        <span class="fa fa-trash w3-margin-right" ></span>
                                                        {{ __("words.remove") }}
                                                    </a> 
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="shadow w3-round w3-white" onclick="$('#pn-post-{{ $post->id }}').slideToggle(300)" >
                                        <img src="{{ sizeOf($post->images()->get()) > 0? $post->images->first()->image : url('/images/posts/post.jpg') }}" class="w3-block" height="120px" >
                                        <div class="w3-padding w3-text-gray" >
                                            <div class="w3-large" >{{ substr($post->title, 0, 20) }}..</div>
                                            <div class="w3-tiny" style="height: 20px;text-overflow: ellipsis" >
                                                {{ $post->space }} {{ __("words.meter") }}, {{ $post->price }}
                                            </div>
                                            <div class="w3-tiny">
                                                @for($i = 0; $i < 5; $i ++)
                                                @if ($i < $post->rate)
                                                <span class="fa fa-star w3-text-orange" ></span>
                                                @else
                                                <span class="fa fa-star w3-text-gray" ></span>
                                                @endif
                                                @endfor
                                            </div>
                                        </div> 
                                    </div>
                                </li>
                                @endforeach
                            </ul>

                        </div> 
                    </div>

                </div>
            </div>
        </div>


    </div>



</div>


@endsection

@section("js")
<script src="{{ url('/website') }}/js/sweetalert.min.js"></script>
<script src="{{ url('/website') }}/js/profile.js"></script>
<script>
    function removePost(post) {
        var data = {
            api_token: '{{ App\Profile::auth()->api_token }}',
            post_id: post,
            status: 'user_trash',
        };
        swal({
            title: ARE_YOU_SURE,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then(function (willDelete) {
            if (willDelete) {
                $.post("{{ url('/api/post/update') }}", $.param(data), function(r){
                    if (r.status == 1) {
                        if (LANG == "en")
                        success(r.message_en);
                        else
                        success(r.message_ar);

                        window.location.reload();
                    }
                    else {
                        if (LANG == "en")
                        error(r.message_en);
                        else
                        error(r.message_ar);
                    }
                });
            } else {
            }
        });

       
    }
    
var app = new Vue({
    el: '#root',
    data: {
        profile: {
            name: '{{ App\Profile::auth()->name }}',
            phone: '{{ App\Profile::auth()->phone }}',
            email: '{{ App\Profile::auth()->email }}', 
            address: '{{ App\Profile::auth()->address }}',
        }
    },
    methods: {
        randColor: function () {
            return randColor();
        },
    },
});

</script>
@endsection


