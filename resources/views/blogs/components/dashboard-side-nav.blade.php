<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-black" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src=" {{asset('img/blue.png')}}" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
          @if ($user->is_author)
            <li class="nav-item">
              <a class="nav-link" href="{{url('/author/home')}}">
                <i class="ni ni-planet "></i>
                <span class="nav-link-text">Home</span>
              </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{url('/author/posts/create')}}">
                <i class="ni ni-fat-add text-default" style="font-size: 22px;"></i>
                <span class="nav-link-text">Create blog</span>
            </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href=" {{url('/author/posts')}} ">
                <i class="ni ni-bullet-list-67 text-default"></i>
                <span class="nav-link-text">My blogs</span>
            </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{url('author/posts/view-trashed')}}  ">
                <i class="ni ni-briefcase-24 text-default"></i>
                <span class="nav-link-text">Trashed Blogs</span>
            </a>
            </li>
          @endif
            {{-- <li class="nav-item">
              <a class="nav-link" href="icons.html">
                <i class="ni ni-planet text-orange"></i>
                <span class="nav-link-text">Icons</span>
              </a>
            </li> --}}
            {{-- <li class="nav-item">
              <a class="nav-link" href="map.html">
                <i class="ni ni-pin-3 text-primary"></i>
                <span class="nav-link-text">Google</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profile.html">
                <i class="ni ni-single-02 text-yellow"></i>
                <span class="nav-link-text">Profile</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="tables.html">
                <i class="ni ni-bullet-list-67 text-default"></i>
                <span class="nav-link-text">Tables</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.html">
                <i class="ni ni-key-25 text-info"></i>
                <span class="nav-link-text">Login</span>
              </a>
            </li> --}}
          </ul>
        </div>
      </div>
    </div>
  </nav>