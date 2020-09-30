@extends('admin.app')

@section('content')

 <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Edit COMPANY</h2>
            </div>
   <div class="row clearfix ">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                              Edit COMPANY
                            </h2>
                            <ul class="header-dropdown m-r--5">


                            <a href= "{{ route('company.index') }}" style="color:white;" >
                            <button type="button" class="btn btn-info">
                                  Show all
                                  </button>
                               </a>

                           </ul>

                        </div>
                        <div class="body">

                            <form action="{{ route('company.update',$company->id) }}" method="POST"  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                            <div class="col-sm-6">
                              <label for="name">Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="name"  value="{{ $company->name }}" name="name" class="form-control" placeholder="Enter your Name">
                                    </div>
                                </div>
                                 </div>


                               <div class="col-sm-6">
                                 <label for="email">Email Address</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="email" readonly value="{{ $company->email }}" name="email" class="form-control" placeholder="Enter your email address">
                                    </div>
                                </div>
                                </div>


                                 <div class="col-sm-6">
                                <label for="password">Password</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" id="password"  value=""  name="password" class="form-control" placeholder="Enter your password">
                                    </div>
                                      </div>
                                </div>



                             <div class="col-sm-6">
                                <label for="phone">Phone</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="phone"  name="phone"  value="{{ $company->phone }}" class="form-control" placeholder="Enter your Phone">
                                    </div>
                                </div>
                                </div>


                                <div class="col-sm-6">
                                 <label for="address">Address</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="address"   value="{{ $company->address }}"  name="address" class="form-control" placeholder="Enter your address">
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
                                                <input type="text" id="website_available_days"   value="{{ $company->website_available_days }}" name="website_available_days" class="form-control date" placeholder="Ex: 2020/07/15">
                                            </div>
                                        </div>
                                    </div>



                                <div class="col-sm-6">
                                  <label for="city_id">Select City</label>
                                   <select  id="city_id" name="city_id" class="form-control">
                                    @foreach($city as $citys)
                                      <option value="{{ $citys->id }}"
                                           @if($citys->id === $company->city_id)
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
                                           @if($area->id === $company->area_id)
                                          selected
                                          @endif >{{ $area->name_en }}</option>


                                     @endforeach

                                       </select>
                                 </div>



                                 <!--
                              <div class="col-sm-6">
                                  <label for="template_id">Select template</label>
                                        <select   id="templete_id" name="templete_id"  class="form-control">
                                    @foreach($template as $templates)
                                      <option value="{{ $templates->id }}"
                                          @if($templates->id === $company->templete_id)
                                          selected
                                          @endif>{{ $templates->name }} </option>
                                     @endforeach
                                   </select>
                                  </div>
                                -->

                             <div class="col-sm-6">

                                  <label for="service_id">Select Service</label>
                                        <select   id="service_id" name="service_id" class="form-control">
                                    @foreach($service as $services)
                                      <option value="{{ $services->id }}"

                                          @if($services->id === $company->service_id)
                                          selected
                                          @endif>{{ $services->name }} </option>
                                     @endforeach
                                   </select>
                                    </div>

                                  <div class="col-sm-6">
                                  <label for="photo">Photo</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file" name="photo" id="photo" class="form-control" placeholder="Enter your Photo">
                                          <img class="img-responsive img-thumbnail" src="{{ asset('images/company/'.$company->photo) }}" style="height: 50px; width: 50px" alt="">
                                            <input type="hidden"  value="{{ $company->photo }}"  name="hidden_photo"  >

                                    </div>
                                </div>
                                </div>

                                 <div class="col-sm-6">
                                  <label for="cover">Cover</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file" name="cover" id="cover" class="form-control" placeholder="Enter your Cover">
                                      <img class="img-responsive img-thumbnail" src="{{ asset('images/company/'.$company->cover) }}" style="height: 50px; width: 50px" alt="">
                                        <input type="hidden"  value="{{ $company->cover }}"  name="hidden_photo"  >


                                    </div>
                                </div>
                                </div>

                                 <div class="col-sm-6">
                                  <label for="attached_file">Attached file</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file"  value="{{ $company->attached_file }}" name="attached_file" id="attached_file" class="form-control" placeholder="Enter your Attached File">
                                    </div>
                                </div>
                                </div>

                                 <div class="col-sm-6">
                                 <label for="facebook"> Facebook Link</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"    value="{{ $company->facebook }}" name="facebook" id="facebook" class="form-control" placeholder="Enter your Facebook link">
                                    </div>
                                </div>
                                </div>
                                 <div class="col-sm-6">
                                 <label for="youtube_link"> Youtube Link</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"    value="{{ $company->youtube_link }}" name="youtube_link" id="youtube_link" class="form-control" placeholder="Enter your Youtube Link">
                                    </div>
                                </div>
                                </div>

                                 <div class="col-sm-6">
                                 <label for="youtube_video"> Youtube Link Video</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"   value="{{ $company->youtube_video }}"  name="youtube_video" id="youtube_video" class="form-control" placeholder="Enter your Youtube Video Link ">
                                    </div>
                                </div>
                                </div>

                                 <div class="col-sm-6">
                                 <label for="whatsapp"> Wattsapp Link</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"  name="whatsapp"   value="{{ $company->whatsapp }}" id="whatsapp" class="form-control" placeholder="Enter your Wattsapp Link">
                                    </div>
                                </div>
                                </div>

                                  <div class="col-sm-6">
                                 <label for="twitter"> Twitter Link</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"   value="{{ $company->twitter }}"  name="twitter" id="twitter" class="form-control" placeholder="Enter your  Twitter Link">
                                    </div>
                                </div>
                                </div>

                                 <div class="col-sm-6">
                                 <label for="linkedin"> linkedin Link</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"    value="{{ $company->linkedin }}" name="linkedin" id="linkedin" class="form-control" placeholder="Enter your linkedin Link">
                                    </div>
                                </div>
                                </div>

                                 <div class="col-sm-6">
                                 <label for="website"> Website Link</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"   value="{{ $company->website }}"  name="website" id="website" class="form-control" placeholder="Enter your Website Link">
                                    </div>
                                </div>
                                </div>

                                 <div class="row clearfix">
                                 <div class="md-form amber-textarea active-amber-textarea col-sm-6" >
                                   <label for="about">About</label>
                                    <textarea id="about" value= "{{ $company->about }}"   name="about" class="md-textarea form-control" rows="14">{{ $company->about }}</textarea>
                                      </div>

                                       <div class=" col-sm-6 form-group " >
                                      <label> Select Company Location  </label>
                                       <input type="hidden"  value="{{ $company->lng }}" id="lng" name="lng" >
                                       <input type="hidden"  value="{{ $company->lat }}" id="lat" name="lat" >
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
        @if($company->lat &&  $company->lng )
        var pos = new google.maps.LatLng({{ $company->lat }}, {{ $company->lng }});
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



