@extends('admin.app')

@section('content')

 <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Edit Ads</h2>
            </div>
   <div class="row clearfix ">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                              Edit Ads
                            </h2>
                            <ul class="header-dropdown m-r--5">
                            
                         
                            <a href= "{{ route('advertise.index') }}" style="color:white;" >
                            <button type="button" class="btn btn-info"> 
                                  Show all
                                  </button>
                               </a>
                              
                           </ul>

                        </div>
                        <div class="body">

                            <form action="{{ route('advertise.update',$ads->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                               <label for="title_en">Title In English </label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="title_en" value="{{ $ads->title_en }}" name="title_en" class="form-control" placeholder="Enter your Name">
                                    </div>
                                </div>
                                 <label for="title_ar">Title In Arabic </label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="title_ar" value="{{ $ads->title_ar }}" name="title_ar" class="form-control" placeholder="Enter your Name">
                                    </div>
                                </div>

                                 <div class="row clearfix ">
                                   <div class="md-form col-sm-6 amber-textarea active-amber-textarea">
                                   <label for="description_en">Description In English</label>
                                 <textarea id="description_en" value="{{ $ads->description_en }}" name="description_en" class="md-textarea form-control" rows="3">{{ $ads->description_en }}</textarea>

                                 </div>

                                   <div class="md-form col-sm-6 amber-textarea active-amber-textarea">
                                   <label for="description_ar">Description In Arabic</label>
                                 <textarea id="description_ar" value="{{ $ads->description_ar }}" name="description_ar" class="md-textarea form-control" rows="3">{{ $ads->description_ar }}</textarea>

                                 </div>
                             </div>




                                <label for="url">Link For Ads  </label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="url" name="url" value="{{ $ads->url }}" class="form-control" placeholder="Enter your Name">
                                    </div>
                                </div>

                                  <label for="photo">Photo </label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file" id="photo"  name="photo" class="form-control" placeholder="Enter your Name">
                                          <img class="img-responsive img-thumbnail" src="{{ asset('images/ads/'.$ads->photo) }}" style="height: 70px; width: 70px" alt=""></td>
                                           <input type="hidden"   value="{{ $ads->photo }}"  name="hidden_photo"  >


                                    </div>
                                </div>
                                
                                 <label for="logo">Logo </label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file" id="logo" name="logo" class="form-control" placeholder="Enter your Name">
                                          <img class="img-responsive img-thumbnail" src="{{ asset('images/ads/'.$ads->logo) }}" style="height: 70px; width: 70px" alt=""></td>
                                           <input type="hidden"   value="{{ $ads->logo }}"  name="hidden_photo"  >

                                    </div>
                                </div>

                                <label for="expire_date"> Expire Date</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">date_range</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" id="expire_date" value="{{ $ads->expire_date }}" name="expire_date" class="form-control date" placeholder="Ex: 2020/07/15">
                                            </div>
                                        </div>





                                <br> <br> <br>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect text-right">Edit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 </section>




            @endsection
