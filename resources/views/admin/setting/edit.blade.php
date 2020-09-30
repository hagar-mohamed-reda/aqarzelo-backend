@extends('admin.app')

@section('content')

 <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Edit Setting</h2>
            </div>
   <div class="row clearfix ">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                              Edit Setting
                            </h2>
                            <ul class="header-dropdown m-r--5">
                            
                         
                            <a href= "{{ route('setting.index') }}" style="color:white;" >
                            <button type="button" class="btn btn-info"> 
                              show all
                                  </button>
                               </a>
                              
                           </ul>

                        </div>
                        <div class="body">

                            <form action="{{ route('setting.update',$setting->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                              <label for="name">Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" value="{{ $setting->name }}" id="name" name="name" class="form-control" placeholder="Enter your Name">
                                    </div>
                                </div>

                                 <label for="value">Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" value="{{ $setting->value }}" id="value" name="value" class="form-control" placeholder="Enter your Name">
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
