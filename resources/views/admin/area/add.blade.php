@extends('admin.app')

@section('content')

 <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>ADD Area</h2>
            </div>
   <div class="row clearfix ">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               ADD Area
                            </h2>
                            
                            <ul class="header-dropdown m-r--5">
                            
                         
                            <a href= "{{ route('area.index') }}" style="color:white;" >
                            <button type="button" class="btn btn-info"> 
                                  Show all
                                  </button>
                               </a>
                              
                           </ul>

                        </div>
                        <div class="body">

                            <form action="{{ route('area.store') }}" method="POST">
                                @csrf
                              <label for="name_ar">Name in Arabic</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="name_ar" name="name_ar" class="form-control" placeholder="Enter your Name">
                                    </div>
                                </div>
                                <label for="name_en">Name in English</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="name_en" name="name_en" class="form-control" placeholder="Enter your Name">
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                  <label for="city_id">Select City</label>
                                   <select  id="city_id" name="city_id" class="form-control">
                                    @foreach($city as $citys)
                                      <option value="{{ $citys->id }}">{{ $citys->name_en }}</option>
                                     @endforeach
                                   </select>



                                 </div>















<br><br>

                                <br>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect text-right">ADD</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 </section>




            @endsection
