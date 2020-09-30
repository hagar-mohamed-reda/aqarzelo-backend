@extends('company.app')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    posts

                </h2>
            </div>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header ">
                            <a role="button"
                            class="btn btn-info w3-right w3-margin"
                            href="{{ route('post.create') }}" style="color:white;">
                              add
                            </a>
                            <span class="w3-large" >
                                posts
                            </span>



                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable"
                                    id="table">
                                    <thead>
                                        <tr>
                                            <th>Number</th>
                                            <th>title</th>
                                            <th>Images</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Number</th>
                                            <th>title</th>
                                            <th>Images</th>
                                            <th>Phone</th>
                                            <th>Status</th>

                                            <th>Action</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($post as $post)

                                            <tr>
                                                <td>{{ $post->id }}</td>
                                                <td>{{ $post->title }}</td>
                                                <td>
                                                    @if ($post->images()->first())
                                                        <img class="img-responsive img-thumbnail"
                                                            src="{{ asset('images/posts') . '/' . $post->images()->first()->photo }}"
                                                            style="height: 70px; width: 70px" alt="">
                                                </td>
                                        @endif

                                        <td>{{ $post->phone }}</td>


                                        <td>
                                            @if ($post->status == 'accepted')
                                                <span class="label bg-green">Accepted </span>
                                            @elseif($post->status == 'pending')
                                                <span class="label bg-yellow">Panding</span>
                                            @elseif($post->status == 'refused')
                                                <span class="label bg-red">Refuesed</span>
                                            @else
                                                <span class="label bg-blue">Trash</span>
                                            @endif
                                        </td>

                                        <td>
                                            <form action="{{ route('company.post.destroy', $post->id) }}" method="POST">


                                                <a class="btn btn-primary"
                                                    href="{{ route('company.post.edit', $post->id) }}">Edit</a>

                                                @csrf
                                                @method('GET')

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
            });

        </script>

    @endpush


@endsection
