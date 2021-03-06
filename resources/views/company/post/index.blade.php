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
                        <div class="header">
                            <h2>
                                posts
                            </h2>
                            <ul class="header-dropdown m-r--5">


                                <a href="{{ route('company-post.create') }}" style="color:white;">
                                    <button type="button" class="btn btn-info">
                                        add
                                    </button>
                                </a>

                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable"
                                    id="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Title</th>
                                            <th>Phone</th>
                                            <th>Images</th>
                                            <th>Active</th>
                                            <th>Status</th>
                                            <th>Active Change</th>

                                            <th>Status Change</th>

                                            <th>Retrive Post</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($post as $post)

                                            <tr>
                                                <td>{{ $post->id }}</td>
                                                <td>{{ $post->title }}</td>
                                                <td>{{ $post->phone }}</td>
                                                <td>
                                                    @if ($post->images()->first())
                                                        <img class="img-responsive img-thumbnail"
                                                            src="{{ asset('images/posts') . '/' . $post->images()->first()->photo }}"
                                                            style="height: 70px; width: 70px" alt="">
                                                    @endif
                                                </td>
                                                <td>

                                                    @if ($post->active == 'active')
                                                        <span class="label bg-green">Active </span>

                                                    @else
                                                        <span class="label bg-red">Not Active</span>

                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($post->status == 'accepted')
                                                        <span class="label bg-green">Accepted </span>
                                                    @elseif($post->status == 'pending')
                                                        <span class="label bg-yellow">pending</span>
                                                    @elseif($post->status == 'refused')
                                                        <span class="label bg-red">Refuesed</span>
                                                    @else
                                                        <span class="label bg-red">Trash</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($post->active == 'active')
                                                        <a href="{{ route('company-post.not_active', ['post' => $post->id]) }}"
                                                            class="btn btn-xs btn-danger"> Make Not Active </a>
                                                    @else
                                                        <a href="{{ route('company-post.active', ['post' => $post->id]) }}"
                                                            class="btn btn-xs btn-success"> Make Active </a>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($post->status == 'accepted')
                                                        <a href="{{ route('company-post.panding', ['post' => $post->id]) }}"
                                                            class="btn btn-xs btn-info"> Panding Post </a>
                                                        <a href="{{ route('company-post.refused', ['post' => $post->id]) }}"
                                                            class="btn btn-xs btn-danger"> Refused Post </a>


                                                    @elseif($post->status == 'pending')
                                                        <a href="{{ route('company-post.accepted', ['post' => $post->id]) }}"
                                                            class="btn btn-xs btn-success"> Accepted Post </a>
                                                        <a href="{{ route('company-post.refused', ['post' => $post->id]) }}"
                                                            class="btn btn-xs btn-danger"> Refused Post </a>
                                                    @else

                                                        <a href="{{ route('company-post.panding', ['post' => $post->id]) }}"
                                                            class="btn btn-xs btn-info"> Panding Post </a>
                                                        <a href="{{ route('company-post.accepted', ['post' => $post->id]) }}"
                                                            class="btn btn-xs btn-success"> Accepted Post </a>
                                                    @endif

                                                </td>


                                                <td>
                                                    <a href="{{ route('company-post.retreve', ['post' => $post->id]) }}"
                                                        class="btn btn-xs btn-success"> Retrived Post </a>

                                                </td>





                                                <td>
                                                    <a class="btn btn-primary"
                                                        href="{{ route('company-post.edit', $post->id) }}">Edit</a>
                                                    <form action="{{ route('company-post.destroy', $post->id) }}"
                                                        onsubmit="return confirm('are you sure')" method="POST">



                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Title</th>
                                            <th>Phone</th>
                                            <th>Images</th>
                                            <th>Active</th>
                                            <th>Status</th>
                                            <th>Active Change</th>

                                            <th>Status Change</th>

                                            <th>Retrive Post</th>

                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
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
