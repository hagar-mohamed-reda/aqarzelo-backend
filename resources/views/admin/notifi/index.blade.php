@extends('admin.app')

@section('content')

   <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
       Notifactions

                </h2>
            </div>
           <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                 Notifactions
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" >
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Notifaction</th>
                                              <th>Description</th>
                                             <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                           <th>No.</th>
                                            <th>Notifaction</th>
                                             <th>Description</th>
                                             <th>Action</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                         @foreach($notifi as $notifi)
                                         <tr>
                                            <td>{{ $notifi->id }}</td>
                                            <td>{{ $notifi->title }}</td>
                                             <td>{{ $notifi->body }}</td>

                                            <td> <form action="{{ route('notifi.destroy',$notifi->id) }}" method="POST">

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



@endsection


