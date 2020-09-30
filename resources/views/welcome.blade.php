@extends('admin.app')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix" >
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">Posts</div>
                                @if( Auth::user()->type =='user_company')
                              <div class="number count-to" data-from="0" data-to="{{ $user_post}}" data-speed="15" data-fresh-interval="20"></div>
                               @else
                               <div class="number count-to" data-from="0" data-to="{{ $count_post}}" data-speed="15" data-fresh-interval="20"></div>
                                @endif
                            </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">help</i>
                        </div>
                        <div class="content">
                             @if( Auth::user()->type =='user_company')
                            <div class="text">Views</div>
                            <div class="number count-to" data-from="0" data-to="{{3* $user_post}}" data-speed="1000" data-fresh-interval="20"></div>
                          @else

                          <div class="text">Companies</div>
                            <div class="number count-to" data-from="0" data-to="{{ $count_company}}" data-speed="1000" data-fresh-interval="20"></div>

  @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">

                             @if( Auth::user()->type =='user_company')
                               <div class="text">Favourites</div>
                            <div class="number count-to" data-from="0" data-to="{{2* $user_post}}" data-speed="1000" data-fresh-interval="20"></div>
                        @else
                            <div class="text">Ads</div>

                            <div class="number count-to" data-from="0" data-to="{{ $count_ads}}" data-speed="1000" data-fresh-interval="20"></div>

                         @endif </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">

                              @if( Auth::user()->type =='user_company')
                               <div class="text">Mails</div>
                            <div class="number count-to" data-from="0" data-to="{{ $mail_count }}" data-speed="1000" data-fresh-interval="20"></div>
                        @else
                            <div class="text">Users</div>
                            <div class="number count-to" data-from="0" data-to="{{ $count_users}}" data-speed="1000" data-fresh-interval="20"></div>
                       @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <!-- Visitors -->

                  <div class="card col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <div class="header">
                            <h2>Mail Box </h2>

                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Mail</th>
                                            <th>Message</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($mail as $mail)
                                        <tr>
                                            <td>{{ $mail->id }}</td>
                                            <td>{{ $mail->email }}</td>
                                            <td>{{ $mail->message }}
                                            </td>


                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <!-- Answered Tickets -->
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-teal">
                            <div class="font-bold m-b--35">Notifications</div>
                            <ul class="dashboard-stat-list">
                                     @foreach($notifi as $notifi)
                                <li>
                                   <h5 > {{ $notifi->title }}</h5>

                                </li>
                                  <hr>



                                @endforeach



                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Answered Tickets -->
            </div>




        </div>
    </section>

@endsection
