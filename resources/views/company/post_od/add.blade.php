

           @extends('company.app')

@section('content')

 <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>ADD post</h2>
            </div>
   <div class="row clearfix ">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               ADD post
                            </h2>
                            
                          

                        </div>
                        <div class="body">

                            <form action="{{ route('post.store') }}" method="POST"  enctype="multipart/form-data">
                                @csrf
                                <div class="col-sm-6">
                              <label for="title">Title</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="title" name="title" class="form-control" placeholder="Enter your Name">
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
                                 <label for="build_date">Build Date</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">date_range</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" id="build_date" name="build_date" class="form-control date" placeholder="Ex: 30/07/2016">
                                            </div>
                                        </div>
                                    </div>

                                     <div class="col-sm-6">
                                      <label for="space">Space</label>
                                        <div class="form-group">
                                           <div class="form-line">
                                               <input type="text" id="space"  name="space" class="form-control" placeholder="Enter your Phone">
                                           </div>
                                         </div>
                                     </div>

                                      <div class="col-sm-6">
                                      <label for="price_per_meter">Price Per Meter</label>
                                        <div class="form-group">
                                           <div class="form-line">
                                               <input type="text" id="price_per_meter"  name="price_per_meter" class="form-control" placeholder="Enter your Phone">
                                           </div>
                                         </div>
                                     </div>


                                <div class="col-sm-3">
                                 <label for="bedroom_number">Bedroom No.</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="bedroom_number" name="bedroom_number" class="form-control" placeholder="Enter your email address">
                                    </div>
                                </div>
                                </div>
                                  <div class="col-sm-3">
                                <label for="bathroom_number">Bathroom No.</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="bathroom_number"  name="bathroom_number" class="form-control" placeholder="Enter your password">
                                    </div>
                                      </div>
                                </div>







                                <div class="col-sm-3">
                                 <label for="floor_number">Floor No.</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="floor_number" name="floor_number" class="form-control" placeholder="Enter your email address">
                                    </div>
                                </div>
                                </div>
                                 <div class="col-sm-3">
                                <label for="price"> Total price</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="price"  name="price" class="form-control" placeholder="Enter total price">
                                    </div>
                                      </div>
                                </div>

                                 <div class="col-sm-3">
                                <h5>Has Garden </h5>
                                      <input type="checkbox" id="yes1"  name="has_garden" value="yes" class="filled-in chk-col-red"  />
                                      <label for="yes1">Yes</label>
                                      <input type="checkbox" id="no1" name="has_garden"  value="no" class="filled-in chk-col-pink"  />
                                      <label for="no1">No</label>
                                 </div>

                                  <div class="col-sm-3">
                                    <h5>Has Parking </h5>
                                      <input type="checkbox" id="yes2"  name="has_parking" value="yes" class="filled-in chk-col-red"  />
                                      <label for="yes2">Yes</label>
                                      <input type="checkbox" id="no2" name="has_parking"  value="no" class="filled-in chk-col-pink"  />
                                      <label for="no2">No</label>
                                 </div>

                                  <div class="col-sm-3">
                                   <h5> For Sale Or Rent </h5>
                                      <input type="checkbox" id="sale"  name="type" value="sale" class="filled-in chk-col-red"  />
                                      <label for="sale">Sale</label>
                                      <input type="checkbox" id="rent" name="type"  value="rent" class="filled-in chk-col-pink"  />
                                      <label for="rent">Rent</label>
                                 </div>

                                  <div class="col-sm-3">
                                   <h5>Payment way </h5>
                                      <input type="checkbox" id="cash"  name="payment_method" value="cash" class="filled-in chk-col-red"  />
                                      <label for="cash">Cash</label>
                                      <input type="checkbox" id="installment" name="payment_method"  value="installment" class="filled-in chk-col-pink"  />
                                      <label for="installment">Installment</label>
                                 </div>

                                  <div class="col-sm-4">
                                   <h5> Posted By  </h5>
                                      <input type="checkbox" id="owner"  name="owner_type" value="owner" class="filled-in chk-col-red"  />
                                      <label for="owner">Owner</label>
                                      <input type="checkbox" id="developer" name="owner_type"  value="developer" class="filled-in chk-col-pink"  />
                                      <label for="developer">developer</label>
                                      <input type="checkbox" id="mediator" name="owner_type"  value="mediator" class="filled-in chk-col-pink"  />
                                      <label for="mediator">Broker</label>

                                 </div>



                                 <div class="col-sm-8">
                                  <h5>Finishing Type </h5>
                                      <input type="checkbox" id="extra_super_lux"  name="finishing_type" value="extra_super_lux" class="filled-in chk-col-red"  />
                                      <label for="extra_super_lux">Ex-S-Lux</label>

                                      <input type="checkbox" id="super_lux" name="finishing_type"  value="super_lux" class="filled-in chk-col-pink"  />
                                      <label for="super_lux">S-Lux</label>

                                      <input type="checkbox" id="lux"  name="finishing_type" value="lux" class="filled-in chk-col-red"  />
                                      <label for="lux">Lux</label>

                                      <input type="checkbox" id="semi_finished" name="finishing_type"  value="semi_finished" class="filled-in chk-col-pink"  />
                                      <label for="semi_finished">Semi Finished</label>

                                       <input type="checkbox" id="without_finished"  name="finishing_type" value="without_finished" class="filled-in chk-col-red"  />
                                      <label for="without_finished">Without Finished</label>

                                      <input type="checkbox" id="core&chel" name="finishing_type"  value="core&chel" class="filled-in chk-col-pink"  />
                                      <label for="core&chel">Core&Chel</label>

                                 </div>
                    </br>

                                <div class="col-sm-4">
                                 <label for="city_id">Select City</label>
                                 <div class="form-group">
                                    <div class="form-line">
                                         <select   id="city_id" name="city_id">
                                    <option value=""></option>
                                   </select>
                                   </div>
                                </div>
                                 </div>


                                 <div class="col-sm-4">
                                 <label for="area_id">Select Area</label>
                                 <div class="form-group">
                                    <div class="form-line">
                                         <select   id="area_id" name="area_id">
                                    <option value=""></option>
                                   </select>
                                   </div>
                                </div>
                                 </div>

                                   <div class="col-sm-4">
                                 <label for="template_id">Select Template</label>
                                 <div class="form-group">
                                    <div class="form-line">
                                         <select id="template_id" name="template_id">
                                    <option value=""></option>
                                   </select>
                                   </div>
                                </div>
                                 </div>

                                 <div class="row clearfix">
                                 <div class="md-form amber-textarea active-amber-textarea col-sm-6" >
                                   <label for="description">Description</label>
                                    <textarea id="description"  name="description" class="md-textarea form-control" rows="14"></textarea>
                                      </div>


                                      <div class="form-group w3-display-container" >
                              <label> Select post Location  </label>
                                <input type="hidden" id="lng" name="lng" >
                                <input type="hidden" id="lat" name="lat" >
                                <div id="map" class="w3-block w3-round shadow  col-sm-6"  style="height: 300px" ></div>
                                <div class="w3-display-topright w3-padding" >
                                <div class="w3-white w3-card w3-round lnglat" >

                                </div>
                                </div>
                            </div>
                        </div>




                            <div class="col-md-6">
                                <h4>Select Images</h4>
                                <input type="file" name="photo[]" id="photo" accept="image/*" multiple />
                            </div>


                             <div class="col-md-6">
                                <h4>Select Images in 360</h4>
                                <input type="file" name="360_photo[]" id="photo" accept="image/*" multiple />
                            </div>









<br><br>

                                <br>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect  text-center" name="upload" value="Upload">ADD</button>
                            </form>

                             <br />
                    <div class="progress">
                        <div class="progress-bar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                            0%
                        </div>
                    </div>
                    <br />
                    <div id="success" class="row">

                    </div>
                    <br />
                        </div>
                    </div>
                </div>
            </div>
        </div>
 </section>


@push('custom-scripts')



<script>
$(document).ready(function(){
    $('form').ajaxForm({
        beforeSend:function(){
            $('#success').empty();
            $('.progress-bar').text('0%');
            $('.progress-bar').css('width', '0%');
        },
        uploadProgress:function(event, position, total, percentComplete){
            $('.progress-bar').text(percentComplete + '0%');
            $('.progress-bar').css('width', percentComplete + '0%');
        },
        success:function(data)
        {
            if(data.success)
            {
                $('#success').html('<div class="text-success text-center"><b>'+data.success+'</b></div><br /><br />');
                $('#success').append(data.image);
                $('.progress-bar').text('Uploaded');
                $('.progress-bar').css('width', '100%');
            }
        }
    });
});
</script>


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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzl7l4tzN1dWBVu3dL_62EkHteripsaqc&libraries=places&callback=initMap"
async defer></script>




 @endpush



@endsection



