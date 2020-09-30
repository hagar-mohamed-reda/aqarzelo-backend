@extends('admin.app')

@section('content')

 <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>ADD Template</h2>
            </div>
   <div class="row clearfix ">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               ADD Template
                            </h2>

                            <ul class="header-dropdown m-r--5">
                            
                         
                            <a href= "{{ route('template.index') }}" style="color:white;" >
                            <button type="button" class="btn btn-info"> 
                              show all
                                  </button>
                               </a>
                              
                           </ul>

                        </div>
                        <div class="body">

                            <form action="{{ route('template.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                              <label for="name">Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter your Name">
                                    </div>
                                </div>
                                  <label for="price">Price</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="price" name="price" class="form-control" placeholder="Enter your Name">
                                    </div>
                                </div>

                                 <label for="url">Link</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="url" name="url" class="form-control" placeholder="Enter your Name">
                                    </div>
                                </div>



                                <label for="photo">Photo</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file"  name="photo" id="photo" class="form-control" placeholder="Enter your icon">
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
