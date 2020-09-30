 <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="{{ Auth::user()->photo_url }}" width="60" height="60" alt="User" />
                </div>


               <div class="info-container">
                    <div class="name" style="font-size:16px; " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name}}</div>
                    <div class="email">{{ Auth::user()->email}}</div>

                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                      @if( Auth::user()->type =='admin')

                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="{{ route('dashboard') }}">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>

   <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                           <i class="material-icons">person_add</i>
                            <span>Users</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                               <a href= "{{ route('user.create') }}" >
                                    <span>Add User</span>
                                </a>

                        </li>
                            <li>
                                <a href= "{{ route('user.index') }}" >
                                    <span>Show Users</span>
                                </a>

                            </li>
                        </ul>
                    </li>

                  



                     <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                           <i class="material-icons">movie</i>
                            <span>Posts</span>
                        </a>
                        <ul class="ml-menu">
                             <li>
                                <a href= "{{ route('post.create') }}" >
                                    <span>Add Posts</span>
                                </a>

                        </li>
                            <li>
                                <a href= "{{ route('post.index') }}" >
                                    <span>Show Posts</span>
                                </a>

                        </li>

                        </ul>
                    </li>
                      <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                           <i class="material-icons">category</i>
                            <span>Categories</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                               <a href= "{{ route('category.create') }}" >
                                    <span>Add Category</span>
                                </a>

                        </li>
                            <li>
                                <a href= "{{ route('category.index') }}" >
                                    <span>Show Category</span>
                                </a>

                            </li>
                        </ul>
                    </li>


                     <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                           <i class="material-icons">business</i>
                            <span>Companies</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href= "{{ route('company.create') }}" >
                                    <span>Add Company</span>
                                </a>

                        </li>
                            <li>
                                <a href= "{{ route('company.index') }}" >
                                    <span>Show Companies</span>
                                </a>

                            </li>
                        </ul>
                    </li>


                     <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                           <i class="material-icons">room</i>
                            <span>City</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href= "{{ route('city.create') }}" >
                                    <span>Add City</span>
                                </a>

                        </li>
                            <li>
                                <a href= "{{ route('city.index') }}" >
                                    <span>Show City</span>
                                </a>

                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                           <i class="material-icons">room</i>
                            <span>Area</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href= "{{ route('area.create') }}" >
                                    <span>Add Area</span>
                                </a>

                        </li>
                            <li>
                                <a href= "{{ route('area.index') }}" >
                                    <span>Show Area</span>
                                </a>

                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                           <i class="material-icons">poll</i>
                            <span>Service</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href= "{{ route('service.create') }}" >
                                    <span>Add Service</span>
                                </a>

                        </li>
                            <li>
                                <a href= "{{ route('service.index') }}" >
                                    <span>Show Service</span>
                                </a>

                            </li>
                        </ul>
                    </li>
                     <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                           <i class="material-icons">add_a_photo</i>
                            <span>Ads</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href= "{{ route('advertise.create') }}" >
                                    <span>Add Ads</span>
                                </a>

                        </li>
                            <li>
                                <a href= "{{ route('advertise.index') }}" >
                                    <span>Show  Ads</span>
                                </a>

                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                           <i class="material-icons">create_new_folder</i>
                            <span>Template</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href= "{{ route('template.create') }}" >
                                    <span>Add Template</span>
                                </a>

                        </li>
                            <li>
                                <a href= "{{ route('template.index') }}" >
                                    <span>Show  Template</span>
                                </a>

                            </li>
                        </ul>
                    </li>



                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                           <i class="material-icons">settings</i>
                            <span>Settings</span>
                        </a>
                        <ul class="ml-menu">

                            <li>
                                <a href= "{{ route('setting.index') }}" >
                                    <span>Show Setting</span>
                                </a>

                            </li>
                        </ul>
                    </li>

                 

                      <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                           <i class="material-icons">markunread_mailbox</i>
                            <span>Mail Box</span>
                        </a>
                        <ul class="ml-menu">

                            <li>
                                <a href= "{{ route('mail.index') }}" >
                                    <span>Show Mails</span>
                                </a>

                        </li>

                        </ul>
                    </li>

                      <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                           <i class="material-icons">notifications</i>
                            <span>Notifications</span>
                        </a>
                        <ul class="ml-menu">

                            <li>
                                <a href= "{{ route('notifi.index') }}" >
                                    <span>Show Notifications</span>
                                </a>

                        </li>

                        </ul>
                    </li>




                    @endif


                      @if( Auth::user()->type =='user_company')


                       <li class="header">MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="{{ route('dashboard') }}">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>


                     <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                           <i class="material-icons">movie</i>
                            <span>Posts</span>
                        </a>
                        <ul class="ml-menu">
                             <li>
                                <a href= "{{ route('post.create') }}" >
                                    <span>Add Posts</span>
                                </a>

                        </li>
                            <li>
                                <a href= "{{ route('post.index') }}" >
                                    <span>Show Posts</span>
                                </a>

                        </li>

                        </ul>
                    </li>


                      <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                           <i class="material-icons">markunread_mailbox</i>
                            <span>Mail Box</span>
                        </a>
                        <ul class="ml-menu">

                            <li>
                                <a href= "{{ route('mail.index') }}" >
                                    <span>Show Mails</span>
                                </a>

                        </li>

                        </ul>
                    </li>

                      <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                           <i class="material-icons">notifications</i>
                            <span>Notifications</span>
                        </a>
                        <ul class="ml-menu">

                            <li>
                                <a href= "{{ route('notifi.index') }}" >
                                    <span>Show Notifications</span>
                                </a>

                        </li>

                        </ul>
                    </li>



                      @endif





                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2019 - 2020 <a href="javascript:void(0);">AQAR ZELO </a>.
                </div>

            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>
