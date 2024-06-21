<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <i class="bi bi-list toggle-sidebar-btn"></i>
        <a href="/" class="logo d-flex align-items-center"></a>
        <a id="nav-profile" class="nav-link nav-profile d-flex align-items-center ps-3 pe-0">
            <img src="" alt="" class="d-none rounded-circle image-header" id="profile-image">
            <span class="ps-2" id="profile-name">Select a conversation</span>
        </a>
    </div>
    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{asset($user->image_url)}}" alt="" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ $user->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ $user->name }}</h6>
                        <span>{{'@'.$user->username }}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="/new">
                            <i class="bi bi-people"></i>
                            <span>New Conversation</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" data-bs-toggle="modal"
                           data-bs-target="#editProfile">
                            <i class="bi bi-person"></i>
                            <span>Edit Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#" id="sign-out-btn">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
@include('layouts.update-profile')
