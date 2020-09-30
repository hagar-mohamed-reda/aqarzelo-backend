@extends('admin.app')

@section('content')

 <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>ADD Service</h2>
            </div>
   <div class="row clearfix ">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               ADD Service
                            </h2>
                            <ul class="header-dropdown m-r--5">
                            
                         
                            <a href= "{{ route('service.index') }}" style="color:white;" >
                            <button type="button" class="btn btn-info"> 
                              show all
                                  </button>
                               </a>
                              
                           </ul>

                        </div>
                        <div class="body">


                            <form action="{{ route('service.store') }}" method="POST"  enctype="multipart/form-data">
                                @csrf
                              <label for="name">Name </label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter your Name">
                                    </div>
                                </div>
                                 <label for="max_user">Max User </label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="max_user" name="max_user" class="form-control" placeholder="Enter your Name">
                                    </div>
                                </div>
                                 <label for="price">Price </label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="price" name="price" class="form-control" placeholder="Enter your Name">
                                    </div>
                                </div>
                                  <label for="max_post">Max Post </label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="max_post" name="max_post" class="form-control" placeholder="Enter your Name">
                                    </div>
                                </div>
                                  <label for="max_post_image">Max Post Images </label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="max_post_image" name="max_post_image" class="form-control" placeholder="Enter your Name">
                                    </div>
                                </div>
                                <label for="icon">Icon </label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file" id="icon" name="icon" class="form-control" placeholder="Enter your Name">
                                    </div>
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
