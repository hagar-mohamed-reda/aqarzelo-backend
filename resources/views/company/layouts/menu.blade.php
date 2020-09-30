

 <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">

                    <img  src="{{ optional(App\Company::auth())->photo_url }}" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ optional(App\Company::auth())->name }}</div>
                    <div class="email"> {{ optional(App\Company::auth())->email }}</div>

                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">

                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="{{ route('company.dash') }}">
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
                               <a href= "{{ route('company.create.user') }}" >
                                    <span>Add User</span>
                                </a>

                        </li>
                            <li>
                                <a href= "{{ route('company.user.index') }}" >
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
                                <a href= "{{ route('company-post.index') }}" >
                                    <span>Show Posts</span>
                                </a>

                        </li>

                        </ul>
                    </li>



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
      </section>
