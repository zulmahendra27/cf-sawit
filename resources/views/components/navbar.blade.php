<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom" data-background-color="blue">
    <div class="container-fluid">

        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">

            <li class="nav-item topbar-user dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
                        <img src="{{ asset('img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle" />
                    </div>
                    <span class="profile-username">
                        <span class="op-7">Hi,</span>
                        <span class="fw-bold">{{ auth()->user()->name }}</span>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            <div class="user-box">
                                <div class="avatar-lg">
                                    <img src="{{ asset('img/profile.jpg') }}" alt="image profile"
                                        class="avatar-img rounded" />
                                </div>
                                <div class="u-text">
                                    <h4>{{ auth()->user()->name }}</h4>
                                    <p class="text-muted">{{ auth()->user()->level }}</p>
                                    <a href="{{ route('profile.index') }}" class="btn btn-xs btn-secondary btn-sm">View
                                        Profile</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                            <form id="logoutBtn" method="post" action="{{ route('auth.logout') }}">
                                @csrf
                                <button class="dropdown-item">Keluar</button>
                            </form>
                        </li>
                    </div>
                </ul>
            </li>
        </ul>
    </div>
</nav>
