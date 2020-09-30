@extends('admin.app')

@section('content')

   <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
    Setting

                </h2>
            </div>
           <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Setting
                            </h2>
                           
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Number</th>
                                             <th>Name</th>
                                            <th>Value</th>
                                             <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                          <th>Number</th>
                                             <th>Name</th>
                                            <th>Value</th>
                                             <th>Action</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                         @foreach($setting as $setting)

                                        <tr>
                                            <td>{{ $setting->id }}</td>
                                            <td>{{ $setting->name }}</td>
                                             <td>{{ $setting->value }}</td>
                                             <td>
                    <a class="btn btn-primary" href="{{ route('setting.edit',$setting->id) }}">Edit</a>
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


