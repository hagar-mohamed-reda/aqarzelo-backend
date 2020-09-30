@extends('admin.app')

@section('content')

   <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
       Companies

                </h2>
            </div>
           <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                 Companies
                            </h2>
                            <ul class="header-dropdown m-r--5">
                            
                         
                            <a href= "{{ route('company.create') }}" style="color:white;" >
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
                                            <th>Number</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Photo</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th> Change Status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Number</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Photo</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th> Change Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                         @foreach($company as $company)
                                         <tr>
                                            <td>{{ $company->id }}</td>
                                            <td>{{ $company->name }}</td>
                                            <td>{{ $company->email }}</td>
                                            <td>{{ $company->phone }}</td>
                                            <td>
                                                 <img class="img-responsive img-thumbnail" src="{{ asset('images/company/'.$company->photo) }}" style="height: 70px; width: 70px" alt="">
                                            </td>
                                               <td>{{ $company->address }}</td>
                                             <td>
                                            @if($company->active == 'active')
                                             <span class="label bg-green">Active </span>

                                             @else
                                            <span class="label bg-red">Not Active</span>

                                            @endif
                                            </td>

                                             <td>
                                            @if($company->active == 'active')
                                             <a href="{{route('company.not_active',['company'=>$company->id])}}" class="btn btn-xl btn-danger">  Make Not Active </a>
                                              @else
                                             <a href="{{route('company.active',['company'=>$company->id])}}" class="btn btn-xl btn-success"> Make  Active </a>
                                             </td>

                                            @endif



                                            <td> <form action="{{ route('company.destroy',$company->id) }}" method="POST">
                                               <a class="btn btn-primary" href="{{ route('company.edit',$company->id) }}">Edit</a>
                                                   @csrf
                                                   @method('DELETE')

                                                  <button type="submit" class="btn btn-danger">Delete</button>
                                                  </form>
                                            </td>
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


