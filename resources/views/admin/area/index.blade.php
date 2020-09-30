@extends('admin.app')

@section('content')

   <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
     Area

                </h2>
            </div>
           <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                 Area
                            </h2>
                            <ul class="header-dropdown m-r--5">
                            
                         
                             <a href= "{{ route('area.create') }}" style="color:white;" >
                             <button type="button" class="btn btn-info"> 
                                   +
                                   </button>
                                </a>
                               
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="table">
                                    <thead>
                                        <tr>
                                            <th>Number</th>
                                            <th>Name in Arabic</th>
                                            <th>Name in English</th>
                                             <th>City in Arabic</th>
                                            <th>City in English</th>

                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                          <th>Number</th>
                                            <th>Name in Arabic</th>
                                            <th>Name in English</th>
                                             <th>City in Arabic</th>
                                            <th>City in English</th>

                                            <th>Action</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                         @foreach($area as $area)

                                        <tr>
                                            <td>{{ $area->id }}</td>
                                            <td>{{ $area->name_ar }}</td>
                                             <td>{{ $area->name_en }}</td>
                                             <td>{{ $area->city->name_ar }}</td>
                                             <td>{{ $area->city->name_en }}</td>


                                            <td> <form action="{{ route('area.destroy',$area->id) }}" method="POST">


                    <a class="btn btn-primary" href="{{ route('area.edit',$area->id) }}">Edit</a>

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


