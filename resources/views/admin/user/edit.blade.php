@extends('admin.app')

@section('content')

 <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Edit user</h2>
            </div>
   <div class="row clearfix ">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                              Edit user
                            </h2>

                            <ul class="header-dropdown m-r--5">
                             <a href= "{{ route('user.index') }}" style="color:white;" >
                            <button type="button" class="btn btn-info"> 
                            show all
                                  </button>
                               </a>
                              
                           </ul>

                        </div>
                        <div class="body">

                            <form action="{{ route('user.update.1',$user->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                 
                            <div class="col-sm-6">
                              <label for="name">Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="name"  value="{{ $user->name }}" name="name" class="form-control" placeholder="Enter your Name">
                                    </div>
                                </div>
                                 </div>


                               <div class="col-sm-6">
                                 <label for="email">Email Address</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="email" readonly value="{{ $user->email }}" name="email" class="form-control" placeholder="Enter your email address">
                                    </div>
                                </div>
                                </div>


                                 <div class="col-sm-6">
                                <label for="password">Password</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" id="password"    name="password" class="form-control" placeholder="Enter your password">
                                    </div>
                                      </div>
                                </div>



                             <div class="col-sm-6">
                                <label for="phone">Phone</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="phone"  name="phone"  value="{{ $user->phone }}" class="form-control" placeholder="Enter your Phone">
                                    </div>
                                </div>
                                </div>


                                <div class="col-sm-6">
                                 <label for="address">Address</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="address"   value="{{ $user->address }}"  name="address" class="form-control" placeholder="Enter your address">
                                    </div>
                                </div>
                                 </div>
                                  <div class="col-sm-6">
                                 <label for="website_available_days"> Website Available Days</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">date_range</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" id="website_available_days"   value="{{ $user->website_available_days }}" name="website_available_days" class="form-control date" placeholder="Ex: 2020/07/15">
                                            </div>
                                        </div>
                                    </div>



                                <div class="col-sm-6">
                                  <label for="city_id">Select City</label>
                                   <select  id="city_id" name="city_id" class="form-control">
                                    @foreach($city as $citys)
                                      <option value="{{ $citys->id }}"
                                           @if($citys->id === $user->city_id)
                                          selected
                                          @endif>{{ $citys->name_en }}</option>
                                     @endforeach
                                   </select>



                                 </div>


                                   <div class="col-sm-6" >
                                   <label for="area_id">Select Area</label>
                                   <select  id="area_id" name="area_id" class="form-control">

                                         @foreach($area as $area)
                                      <option id="area_id"   value="{{ $area->id }}"
                                           @if($area->id === $user->area_id)
                                          selected
                                          @endif >{{ $area->name_en }}</option>


                                     @endforeach

                                       </select>
                                 </div>



                              <div class="col-sm-6">
                                  <label for="templete_id">Select template</label>
                                        <select   id="templete_id" name="templete_id"  class="form-control">
                                    @foreach($template as $templates)
                                      <option value="{{ $templates->id }}"
                                          @if($templates->id === $user->templete_id)
                                          selected
                                          @endif>{{ $templates->name }} </option>
                                     @endforeach
                                   </select>
                                  </div>

                                  <div class="col-sm-6">
                                 <label for="company_id">Select Company</label>
                                        <select id="company_id" name="company_id" class="form-control">
                                         @foreach($company as $company)
                                      <option value="{{ $company->id }}"

                                          @if($company->id === $user->company_id)
                                          selected
                                          @endif>{{ $company->name }} </option>
                                     @endforeach
                                   </select>
                                   </div>





                                  <div class="col-sm-6">
                                  <label for="photo">Photo</label>
                                    <div class="form-line">
                                <div class="form-group">
                                        <input type="file"   name="photo" id="photo" class="form-control" placeholder="Enter your user limit">
                                        <img class="img-responsive img-thumbnail" src="{{ asset('images/users/'.$user->photo) }}" style="height: 70px; width: 70px" alt="">
                                         <input type="hidden"   value="{{ $user->photo }}"  name="hidden_photo"  >

                                    </div>
                                </div>
                                </div>

                                 <div class="col-sm-6">
                                  <label for="cover">Cover</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file"    name="cover" id="cover" class="form-control" placeholder="Enter your user limit">
                                           <img class="img-responsive img-thumbnail" src="{{ asset('images/users/'.$user->cover) }}" style="height: 70px; width: 70px" alt="">
                                         <input type="hidden"   value="{{ $user->cover }}"  name="hidden_photo"  >


                                    </div>
                                </div>
                                </div>

                                 <div class="col-sm-6">
                                  <label for="attached_file">Attached file</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file"  value="{{ $user->attached_file }}" name="attached_file" id="attached_file" class="form-control" placeholder="Enter your user limit">
                                    </div>
                                </div>
                                </div>

                                 <div class="col-sm-6">
                                 <label for="facebook"> Facebook Link</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"    value="{{ $user->facebook }}" name="facebook" id="facebook" class="form-control" placeholder="Enter your user limit">
                                    </div>
                                </div>
                                </div>
                                 <div class="col-sm-6">
                                 <label for="youtube_link"> Youtube Link</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"    value="{{ $user->youtube_link }}" name="youtube_link" id="youtube_link" class="form-control" placeholder="Enter your user limit">
                                    </div>
                                </div>
                                </div>

                                 <div class="col-sm-6">
                                 <label for="youtube_video"> Youtube Link Video</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"   value="{{ $user->youtube_video }}"  name="youtube_video" id="youtube_video" class="form-control" placeholder="Enter your user limit">
                                    </div>
                                </div>
                                </div>

                                 <div class="col-sm-6">
                                 <label for="whatsapp"> Wattsapp Link</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"  name="whatsapp"   value="{{ $user->whatsapp }}" id="whatsapp" class="form-control" placeholder="Enter your user limit">
                                    </div>
                                </div>
                                </div>

                                  <div class="col-sm-6">
                                 <label for="twitter"> Twitter Link</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"   value="{{ $user->twitter }}"  name="twitter" id="twitter" class="form-control" placeholder="Enter your user limit">
                                    </div>
                                </div>
                                </div>

                                 <div class="col-sm-6">
                                 <label for="linkedin"> linkedin Link</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"    value="{{ $user->linkedin }}" name="linkedin" id="linkedin" class="form-control" placeholder="Enter your user limit">
                                    </div>
                                </div>
                                </div>

                                 <div class="col-sm-6">
                                 <label for="website"> Website Link</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"   value="{{ $user->website }}"  name="website" id="website" class="form-control" placeholder="Enter your user limit">
                                    </div>
                                </div>
                                </div>

                                 <div class="row clearfix">
                                 <div class="md-form amber-textarea active-amber-textarea col-sm-6" >
                                   <label for="about">About</label>
                                    <textarea id="about"    value="{{ $user->about }}" name="about" class="md-textarea form-control" rows="14">{{ $user->about }}</textarea>
                                      </div>

                                       <div class="form-group w3-display-container" >
                                      <label> Select user Location  </label>
                                       <input type="hidden"  value="{{ $user->lng }}" id="lng" name="lng" >
                                       <input type="hidden"  value="{{ $user->lat }}" id="lat" name="lat" >
                                       <div id="map" class="w3-block w3-round shadow  col-sm-6"  style="height: 300px" ></div>
                                         <div class="w3-display-topright w3-padding" >
                                         <div class="w3-white w3-card w3-round lnglat" >

                                         </div>
                                         </div>
                                        </div>
                                           </div>







<br><br>


                                <br>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect text-right">Edit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


 </section>

@push('custom-scripts')

<script>
    var map;
    function initMap() {
        var marker = null;
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 30.0455965, lng: 31.2387195},
            zoom: 8
        });

        google.maps.event.addListener(map, 'click', function (e) {
            placeMarker(e.latLng, map);
        });

        function placeMarker(position, map) {
            try {
                marker.setMap(null);
            } catch (e) {
            }
            marker = new google.maps.Marker({
                position: position,
                map: map
            });
            document.getElementById("lng").value = position.lng();
            document.getElementById("lat").value = position.lat();

            $(".lnglat").html(position.lat() + ", " + position.lng());
            map.panTo(position);
        }
        
      
        
         @if($user->lat &&  $user->lng )
         var pos = new google.maps.LatLng({{ $user->lat }}, {{ $user->lng }});
        placeMarker(pos, map);
        @endif

    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4ow5PXyqH-gJwe2rzihxG71prgt4NRFQ&libraries=places&callback=initMap"
async defer></script>






 <script type="text/javascript">
      $('#city_id').on('change', function(e){
        console.log(e);
        var city_id = e.target.value;
          $.get('{{ url('/json-area/company') }}?city_id=' + city_id,function(data) {
          console.log(data);
          $('#area_id').empty();
          $('#area_id').append('<option value="0" disable="true" selected="true">=== Select Area ===</option>');

          $.each(data, function(index, areaObj){
            $('#area_id').append('<option value="'+ areaObj.id +'">'+ areaObj.name_en +'</option>');
          })
        });
      });



    </script>





 @endpush



@endsection




