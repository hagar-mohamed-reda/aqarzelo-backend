@extends('admin.app')

@section('content')

   <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
      Ads

                </h2>

              
            </div>
           <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Ads
                            </h2>
                            <ul class="header-dropdown m-r--5">
                            
                         
                             <a href= "{{ route('advertise.create') }}" style="color:white;" >
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
                                            <th>Title</th>
                                            <th>Photo</th>
                                            <th>Stauts</th>
                                             <th>Stauts Change</th>
                                             <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                           <th>Number</th>
                                            <th>Title</th>
                                            <th>Photo</th>
                                            <th>Stauts</th>
                                             <th>Stauts Change</th>
                                             <th>Action</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                         @foreach($ads as $ads)

                                        <tr>
                                            <td>{{ $ads->id }}</td>
                                            <td>{{ $ads->title_en }}</td>
                                    <td><img class="img-responsive img-thumbnail" src="{{ asset('images/ads/'.$ads->photo) }}" style="height: 70px; width: 70px" alt=""></td>

                                  <td>

                                            @if($ads->active == 'active')
                                             <span class="label bg-green">Active </span>

                                             @else
                                            <span class="label bg-red">Not Active</span>

                                            @endif
                                            </td>
                                             <td>
                                            @if($ads->active == 'active')
                                             <a href="{{route('ads.not_active',['ads'=>$ads->id])}}" class="btn btn-xl btn-danger">  Make Not Active </a>
                                              @else
                                             <a href="{{route('ads.active',['ads'=>$ads->id])}}" class="btn btn-xl btn-success"> Make  Active </a>
                                             </td>
                                              @endif
                                              <td> <form action="{{ route('advertise.destroy',$ads->id) }}" method="POST">


                                               <a class="btn btn-primary" href="{{ route('advertise.edit',$ads->id) }}">Edit</a>

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


