@extends('admin.app')

@section('content')

   <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
     Service

                </h2>
            </div>
           <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Service
                            </h2>
                            <ul class="header-dropdown m-r--5">
                            
                         
                            <a href= "{{ route('service.create') }}" style="color:white;" >
                            <button type="button" class="btn btn-info"> 
                                +
                                  </button>
                               </a>
                              
                           </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" >
                                    <thead>
                                        <tr>
                                           <th>No.</th>
                                            <th>Name</th>
                                            <th>Icon</th>
                                             <th> Max Users</th>
                                            <th>Max Posts</th>
                                             <th>Max Posts Image</th>

                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Icon</th>
                                             <th> Max Users</th>
                                            <th>Max Posts</th>
                                             <th>Max Posts Images</th>

                                            <th>Action</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                         @foreach($service as $service)

                                        <tr>
                                            <td>{{ $service->id }}</td>
                                            <td>{{ $service->name }}</td>
<td><img class="img-responsive img-thumbnail" src="{{ asset('images/service/'.$service->icon) }}" style="height: 60px; width: 60px" alt=""></td>


                                             <td>{{ $service->max_user }}</td>
                                             <td>{{ $service->max_post }}</td>
                                             <td>{{ $service->max_post_image }}</td>


                                            <td> <form action="{{ route('service.destroy',$service->id) }}" method="POST">


                    <a class="btn btn-primary" href="{{ route('service.edit',$service->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form></td>

                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>


    </section>

@push('custom-scripts')
   <script>
  $(document).ready(function() {
    $('#table').DataTable({

         dom: 'Bfrtip',
        buttons: [
        'copyHtml5',
        'excelHtml5',
        'csvHtml5',
        'pdfHtml5'
    ]
    });
} );
 </script>

 @endpush


@endsection


