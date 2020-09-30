@extends('company.app')

@section('content')

 <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>ADD User</h2>
            </div>
   <div class="row clearfix ">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               ADD User
                            </h2>
                            <ul class="header-dropdown m-r--5">
                             <a href= "{{ route('company.user.index') }}" style="color:white;" >
                            <button type="button" class="btn btn-info"> 
                            show all
                                  </button>
                               </a>
                              
                           </ul>

                        </div>
                        <div class="body">

                            <form action="{{ route('company.store.user') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-sm-6">
                              <label for="name">Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter your Name">
                                    </div>
                                </div>
                                 </div>

                               <div class="col-sm-6">
                                 <label for="email">Email Address</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="email" name="email" class="form-control" placeholder="Enter your email address">
                                    </div>
                                </div>
                                </div>
                                 <div class="col-sm-6">
                                <label for="password">Password</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" id="password"  name="password" class="form-control" placeholder="Enter your password">
                                    </div>
                                      </div>
                                </div>
                             <div class="col-sm-6">
                                <label for="phone">Phone</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="phone"  name="phone" class="form-control" placeholder="Enter your Phone">
                                    </div>
                                </div>
                                </div>
                                <div class="col-sm-6">
                                 <label for="address">Address</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="address"  name="address" class="form-control" placeholder="Enter your address">
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
                                                <input type="text" id="website_available_days" name="website_available_days" class="form-control date" placeholder="Ex: 2020/07/15">
                                            </div>
                                        </div>
                                    </div>





                                <div class="col-sm-4">
                                  <label for="city_id">Select City</label>
                                   <select  id="city_id" name="city_id" class="form-control">
                                   <option id="city_id" value="0" disabled="true" selected="true">=== Select City ===</option>
                               
                                    @foreach($city as $citys)
                                    
                                      <option value="{{ $citys->id }}">{{ $citys->name_en }}</option>
                                     @endforeach
                                   </select>



                                 </div>


                                 <div class="col-sm-4" >
                                   <label for="area_id">Select Area</label>
                                   <select  id="area_id" name="area_id" class="form-control">
                                       <option id="area_id" value="0" disabled="true" selected="true">=== Select Area ===</option>
                                   </select>
                                 </div>



                              <div class="col-sm-4">
                                  <label for="templete_id">Select template</label>
                                        <select   id="templete_id" name="templete_id"  class="form-control">
                                    @foreach($template as $templates)
                                      <option value="{{ $templates->id }}">{{ $templates->name }} </option>
                                     @endforeach
                                   </select>
                                  </div>





                                  <div class="col-sm-6">
                                  <label for="photo">Photo</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file"  name="photo" id="photo" class="form-control" placeholder="Enter your Photo">
                                    </div>
                                </div>
                                </div>

                                 <div class="col-sm-6">
                                  <label for="cover">Cover</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file"  name="cover" id="cover" class="form-control" placeholder="Enter your Cover">
                                    </div>
                                </div>
                                </div>

                                 <div class="col-sm-6">
                                  <label for="attached_file">Attached file</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file"  name="attached_file" id="attached_file" class="form-control" placeholder="Enter your Attached file">
                                    </div>
                                </div>
                                </div>

                                 <div class="col-sm-6">
                                 <label for="facebook"> Facebook Link</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"  name="facebook" id="facebook" class="form-control" placeholder="Enter your Facebook Link">
                                    </div>
                                </div>
                                </div>
                                 <div class="col-sm-6">
                                 <label for="youtube_link"> Youtube Link</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"  name="youtube_link" id="youtube_link" class="form-control" placeholder="Enter your Youtube Link">
                                    </div>
                                </div>
                                </div>

                                 <div class="col-sm-6">
                                 <label for="youtube_video"> Youtube Link Video</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"  name="youtube_video" id="youtube_video" class="form-control" placeholder="Enter your Youtube Link Video">
                                    </div>
                                </div>
                                </div>

                                 <div class="col-sm-6">
                                 <label for="whatsapp"> Wattsapp Link</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"  name="whatsapp" id="whatsapp" class="form-control" placeholder="Enter your Wattsapp Link">
                                    </div>
                                </div>
                                </div>

                                  <div class="col-sm-6">
                                 <label for="twitter"> Twitter Link</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"  name="twitter" id="twitter" class="form-control" placeholder="Enter your Twitter Link">
                                    </div>
                                </div>
                                </div>

                                 <div class="col-sm-6">
                                 <label for="linkedin"> linkedin Link</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"  name="linkedin" id="linkedin" class="form-control" placeholder="Enter your linkedin Link">
                                    </div>
                                </div>
                                </div>

                                 <div class="col-sm-6">
                                 <label for="website"> Website Link</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"  name="website" id="website" class="form-control" placeholder="Enter your Website Link">
                                    </div>
                                </div>
                                </div>

                                 <div class="row clearfix">
                                 <div class="md-form amber-textarea active-amber-textarea col-sm-6" >
                                   <label for="about">About</label>
                                    <textarea id="about"  name="about" class="md-textarea form-control" rows="14"></textarea>
                                      </div>


                                      <div class="form-group w3-display-container" >
                                      <label> Select Company Location  </label>
                                       <input type="hidden" id="lng" name="lng" >
                                       <input type="hidden" id="lat" name="lat" >
                                       <div id="map" class="w3-block w3-round shadow  col-sm-6"  style="height: 300px" ></div>
                                         <div class="w3-display-topright w3-padding" >
                                         <div class="w3-white w3-card w3-round lnglat" >

                                         </div>
                                         </div>
                                        </div>
                                           </div>







<br><br>

                                <br>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect  text-center">ADD</button>
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



