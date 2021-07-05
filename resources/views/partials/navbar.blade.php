<nav class="navbar navbar-expand-md navbar-dark shadow-sm text-white" style="background-color:rgb(66, 25, 103);">

    <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset('images/default-monochrome-white.svg') }}" alt="">
    </a>


    <div id="mySidenav" class="sidenav " style="background-color:rgb(66, 25, 103);">
        <a href="{{ route('searchPostsWithKeywords') }}" class="text-white"><i class="fas fa-search mr-2"></i>Search
            Posts With
            Keywords</a>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="{{ route('allPosts') }}" class="text-white"><i class="fas fa-book mx-2"></i>Posts</a>

        <a href="{{ route('allTablesOfContents') }}" class="text-white"><i class="fas fa-table mx-2"></i>Tables of
            Contents</a>

        <a href="{{ route('allCategories') }}" class="text-white"><i class="fas fa-hashtag mx-2"></i>Categories /
            Keywords</a>
        <a href="{{ route('allCourses') }}" class="text-white"><i class="fas fa-user-graduate mx-2"></i>Courses</a>

    </div>
    <span style="font-size:20px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">

        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}"><i
                                class="fas fa-sign-in-alt mr-1"></i>{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fas fa-user m-2"></i>{{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                        <a href="{{ route('home') }}" class="dropdown-item "><i class="fa fa-home mx-2"
                                aria-hidden="true"></i>Home</a>

                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('manageUsers') }}" class="dropdown-item "><i
                                    class="fas fa-users-cog mx-2"></i>Manage Users</a>

                            <a href="{{ route('manageCategories') }}" class="dropdown-item "><i
                                    class="fas fa-hammer mx-2"></i>Manage Categories</a>

                        @endif

                        <a href="{{ route('favoritePosts') }}" class="dropdown-item "><i
                                class="fas fa-heart mx-2"></i>Favorite Posts</a>

                        <a href="{{ route('likedPosts') }}" class="dropdown-item "><i
                                class="fas fa-thumbs-up mx-2"></i>Liked Posts</a>


                        <a href="{{ route('draftPosts') }}" class="dropdown-item "><i
                                class="fas fa-drafting-compass mx-2"></i>Draft Posts</a>

                        <a href="{{ route('followings') }}" class="dropdown-item "><i
                                class="fas fa-star mx-2"></i>Followings</a>

                        <a href="{{ route('profile') }}" class="dropdown-item "><i
                                class="fas fa-address-card mx-2"></i>Profile</a>

                        <a href="{{ route('changePassword') }}" class="dropdown-item "><i
                                class="fas fa-key mx-2"></i>Change Password</a>


                        <a class="dropdown-item " href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                class="fas fa-sign-out-alt mx-2"></i>{{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>
