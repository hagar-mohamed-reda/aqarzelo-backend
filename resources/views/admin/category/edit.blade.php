@extends('admin.app')

@section('content')

 <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Edit category</h2>
            </div>
   <div class="row clearfix ">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                              Edit category
                            </h2>
                            <ul class="header-dropdown m-r--5">
                            
                         
                            <a href= "{{ route('category.index') }}" style="color:white;" >
                            <button type="button" class="btn btn-info"> 
                                  Show all
                                  </button>
                               </a>
                              
                           </ul>

                        </div>
                        <div class="body">

                            <form action="{{ route('category.update',$category->id) }}" method="POST"  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                              <label for="name_en">Name In English</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" value="{{ $category->name_en }}" id="name_en" name="name_en" class="form-control" placeholder="Enter your Name">
                                    </div>
                                </div>

                                 <label for="name_ar">Name In arabic </label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" value="{{ $category->name_ar }}" id="name_ar" name="name_ar" class="form-control" placeholder="Enter your Name">
                                    </div>
                                </div>

                                <label for="icon">ICON</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file"  name="icon" id="icon"  class="form-control" placeholder="Enter your category photo">
                                           <img class="img-responsive img-thumbnail" src="{{ asset('images/category/'.$category->icon) }}" style="height: 60px; width: 60px" alt="">
                                             <input type="hidden"  value="{{ $category->icon }}"  name="hidden_photo"  >


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




            @endsection
