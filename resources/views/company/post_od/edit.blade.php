@extends('company.app')

@section('content')

 <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Edit post</h2>
            </div>
   <div class="row clearfix ">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                              Edit post
                            </h2>
                            <ul class="header-dropdown m-r--5">
                             <a href= "{{ route('company.show.posts') }}" style="color:white;" >
                            <button type="button" class="btn btn-info"> 
                            show all
                                  </button>
                               </a>
                              
                           </ul>

                        </div>
                        <div class="body">

                            <form action="{{ route('company.post.update',$post->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                               <div class="col-sm-6">
                              <label for="title">Title</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="title" value="{{ $post->title }}" name="title" class="form-control" placeholder="Enter your Name">
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-sm-6">
                                <label for="phone">Phone</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="phone"  value="{{ $post->phone }}"  name="phone" class="form-control" placeholder="Enter your Phone">
                                    </div>
                                </div>
                                </div>
                                <div class="col-sm-6">
                                 <label for="address">Address</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="address" value="{{ $post->address }}"  name="address" class="form-control" placeholder="Enter your address">
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
                                                <input type="text" id="build_date" value="{{ $post->build_date }}" name="build_date" class="form-control date" placeholder="Ex: 2020/07/15">
                                            </div>
                                        </div>
                                    </div>

                                     <div class="col-sm-6">
                                      <label for="space">Space</label>
                                        <div class="form-group">
                                           <div class="form-line">
                                               <input type="text" id="space" value="{{ $post->space }}"  name="space" class="form-control" placeholder="Enter your Phone">
                                           </div>
                                         </div>
                                     </div>

                                      <div class="col-sm-6">
                                      <label for="price_per_meter">Price Per Meter</label>
                                        <div class="form-group">
                                           <div class="form-line">
                                               <input type="text" id="price_per_meter" value="{{ $post->price_per_meter }}"  name="price_per_meter" class="form-control" placeholder="Enter your Phone">
                                           </div>
                                         </div>
                                     </div>


                                <div class="col-sm-3">
                                 <label for="bedroom_number">Bedroom No.</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="bedroom_number" value="{{ $post->bedroom_number }}" name="bedroom_number" class="form-control" placeholder="Enter your email address">
                                    </div>
                                </div>
                                </div>
                                  <div class="col-sm-3">
                                <label for="bathroom_number">Bathroom No.</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="bathroom_number"  value="{{ $post->bathroom_number }}"  name="bathroom_number" class="form-control" placeholder="Enter your password">
                                    </div>
                                      </div>
                                </div>







                                <div class="col-sm-3">
                                 <label for="floor_number">Floor No.</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="floor_number" value="{{ $post->floor_number }}" name="floor_number" class="form-control" placeholder="Enter your email address">
                                    </div>
                                </div>
                                </div>
                                 <div class="col-sm-3">
                                 <label for="price"> Total price</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="price" value="{{ $post->price }}"  name="price" class="form-control" placeholder="Enter Total price">
                                    </div>
                                      </div>
                                </div>



                                 
                                 <div class="col-sm-4">
                                  <label for="city_id">Select City</label>
                                   <select  id="city_id" name="city_id" class="form-control">
                                    @foreach($city as $citys)
                                      <option value="{{ $citys->id }}"
                                           @if($citys->id === $post->city_id)
                                          selected
                                          @endif>{{ $citys->name_en }}</option>
                                     @endforeach
                                   </select>
                                 </div>


                                 <div class="col-sm-4" >
                                   <label for="area_id">Select Area</label>
                                   <select  id="area_id" name="area_id" class="form-control">

                                         @foreach($area as $area)
                                      <option id="area_id"   value="{{ $area->id }}"
                                           @if($area->id === $post->area_id)
                                          selected
                                          @endif >{{ $area->name_en }}</option>


                                     @endforeach

                                       </select>
                                 </div>

                              <div class="col-sm-4 ">
                                  <label for="category_id">Select Category</label>


                                         <select   id="category_id" name="category_id" class="form-control" >
                                    @foreach($category as $categorys)
                                      <option value="{{ $categorys->id }}"
                                           @if($categorys->id === $post->category_id)
                                          selected
                                          @endif>{{ $categorys->name_ar }} : {{ $categorys->name_en }}</option>
                                     @endforeach
                                   </select>


                            </div>
  <div class="col-sm-4">
                                  <label for="owner_type">Posted By</label>
                                   <select  id="owner_type" name="owner_type" class="form-control">

                                      <option value="owner" {{ ($post->owner_type=="owner")? "selected" : "" }}>Owner</option>
                                       <option value="developer" {{ ($post->owner_type=="developer")? "selected" : "" }}>Developer</option>
                                       <option value="mediator" {{ ($post->owner_type=="mediator")? "selected" : "" }}>Broker</option>
                                     </select>
                                    </div>

                                      <div class="col-sm-8">
                                  <label for="finishing_type">Finishing Type</label>
                                   <select  id="finishing_type" name="finishing_type" class="form-control">

                                      <option value="extra_super_lux" {{ ($post->finishing_type=="extra_super_lux")? "selected" : "" }}>Extra Super Lux</option>
                                       <option value="super_lux" {{ ($post->finishing_type=="super_lux")? "selected" : "" }}>Super Lux</option>
                                       <option value="lux" {{ ($post->finishing_type=="lux")? "selected" : "" }}>Lux</option>
                                        <option value="semi_finished"{{ ($post->finishing_type=="semi_finished")? "selected" : "" }}>Semi Finished</option>
                                       <option value="without_finished"{{ ($post->finishing_type=="without_finished")? "selected" : "" }}>Without Finished</option>
                                       <option value="core&chel" {{ ($post->finishing_type=="core&chel")? "selected" : "" }}>Core and Chel</option>

                                     </select>
                                    </div>

 <div class="demo-radio-button col-sm-3">
                                   <h5>Has Garden </h5>
                                <input  type="radio" id="yes1" name="has_garden" value="yes" {{ ($post->has_garden=="1")? "checked" : "" }} class="radio-col-red"  />
                                        <label for="yes1">Yes</label>
                                <input  type="radio" id="no1" name="has_garden"  value="no"  {{ ($post->has_garden=="0")? "checked" : "" }} class="radio-col-pink" />
                                          <label for="no1">No</label>
                                     </div>

                                      <div class="demo-radio-button col-sm-3">
                                    <h5>Has Parking </h5>
                                <input  type="radio" id="yes2"  name="has_parking" value="yes" {{ ($post->has_parking=="1")? "checked" : "" }} class="radio-col-red"  />
                                         <label for="yes2">Yes</label>
                                <input  type="radio" id="no2" name="has_parking"  value="no" {{ ($post->has_parking=="0")? "checked" : "" }} class="radio-col-pink" />
                                          <label for="no2">No</label>
                                     </div>
                                          <div class="demo-radio-button col-sm-3">
                                    <h5> For Sale Or Rent </h5>
                                           <input  type="radio"  id="sale"  name="type" value="sale" {{ ($post->type=="sale")? "checked" : "" }} class="radio-col-red"  />
                                          <label for="sale">Sale</label>
                                            <input  type="radio" id="rent" name="type"  value="rent"  {{ ($post->type=="rent")? "checked" : "" }} class="radio-col-pink" />
                                          <label for="rent">Rent</label>
                                     </div>

                                      <div class="demo-radio-button col-sm-3">
                                     <h5>Payment way </h5>
                                           <input type="radio"  id="cash"  name="payment_method" value="cash" {{ ($post->payment_method=="cash")? "checked" : "" }} class="radio-col-red"  />
                                          <label for="cash">Cash</label>
                                            <input  type="radio" id="installment" name="payment_method"    value="installment"  {{ ($post->payment_method=="installment")? "checked" : "" }} class="radio-col-pink" />
                                           <label for="installment">Installment</label>
                                     </div>

                    </br>
                    </br>




                                 <div class="row clearfix">
                                 <div class="md-form amber-textarea active-amber-textarea col-sm-6" >
                                   <label for="description">Description</label>
                                    <textarea id="description"  name="description" value="{{ $post->description }}" class="md-textarea form-control" rows="14">{{ $post->description }}</textarea>
                                      </div>


                                   

                                      <div class="form-group w3-display-container" >
                                      <label> Select post Location  </label>
                                       <input type="hidden" id="lng"  name="lng" >
                                       <input type="hidden" id="lat" name="lat" >
                                       <div id="map" class="w3-block w3-round shadow  col-sm-6"  style="height: 300px" ></div>
                                         <div class="w3-display-topright w3-padding" >
                                         <div class="w3-white w3-card w3-round lnglat" >

                                         </div>
                                         </div>
                                        </div>
                                        
                                          
                           <div class="col-md-4">
                              <h4>Select  Master Image</h4>
                                <input type="file" name="mastr_photo[]" id="photo"     accept="image/*" multiple />
                                  @if ($post->images()->first())
                                                <img class="img-responsive img-thumbnail" src="{{ asset('images/posts') ."/". $post->images()->first()->photo }}" style="height: 50px; width: 70px" alt=""></td>
                                @endif
                               

                            </div>
                            
                             
                           <div class="col-md-4">
                              <h4>Select Images</h4>
                                <input type="file" name="photo[]" id="photo"     accept="image/*" multiple />
                                  @if ($post->images()->first())
                                                <img class="img-responsive img-thumbnail" src="{{ asset('images/posts') ."/". $post->images()->first()->photo }}" style="height: 50px; width: 70px" alt=""></td>
                                @endif
                               

                            </div>


                               <div class="col-md-4">
                              <h4>Select Images in 360</h4>
                                <input type="file" name="360_photo[]" id="photo"     accept="image/*" multiple />
                                  @if (  $post->images()->where('is_360', '1')->count() > 0 && $post->images()->where('is_360', '1')->first())
                                                <img class="img-responsive img-thumbnail" src="{{ asset('images/posts') ."/". $post->images()->where('is_360', '1')->first()->photo }}" style="height: 50px; width: 70px" alt=""></td>
                                  @endif
                              

                            </div>

                       






                       










<br><br>

                                <br>
                                <button type="submit" name="upload" value="Upload" class="btn btn-primary m-t-15 waves-effect text-right">Edit</button>
                            </form>
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
       @if($post->lat &&  $post->lng )
        var pos = new google.maps.LatLng({{ $post->lat }}, {{ $post->lng }});
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



