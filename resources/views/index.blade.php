<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #eee;
        }
        .sidebar {
            background-color: #7EBEE0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .sidebar .nav-link {
            color: #fff;
        }
        .main-content {
            padding: 20px;
        }
        .card-custom {
            border-radius: 10px;
        }
        .table thead th {
            background-color: #007bff;
            color: #fff;
        }
        .badge-custom {
            border-radius: 10px;
            padding: 5px 10px;
        }
        .badge-selesai {
            background-color: #ffc107;
        }
        .badge-detail {
            background-color: #dc3545;
        }
        .profile-image {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block sidebar" style="background-color: #7EBEE0;">
            <div class="sidebar-sticky pt-3">
                <h3 class="text-white ps-3">Pick<span class="text-primary">UB</span></h3>
                <ul class="nav flex-column mt-5 p-1">
                    <li class="nav-item border rounded-3 m-1 bg-primary">
                        <a class="nav-link active text-white" href="{{route('dashboard')}}">
                            <i class="bi bi-grid-fill"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item border rounded-3 m-1 bg-light text-dark">
                        <a class="nav-link text-dark" href="{{route('laporan-masuk.index')}}">
                            <i class="bi bi-envelope-fill"></i> Laporan Masuk
                        </a>
                    </li>
                </ul>
                <div class="" style="margin-top:300px">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">
                                <i class="bi bi-gear-fill"></i> Settings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">
                                <i class="bi bi-question-circle-fill"></i> Help & Support
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 main-content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Hallo, Admin!</h1>
                <div class="input-group w-25">
                    <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
                </div>
                <div class="d-flex align-items-center">
                    <i class="bi bi-bell-fill fs-4 me-3"></i>
                    <div class="d-flex align-items-center">
                        <img src="{{asset('img/admin/default.png')}}" class="profile-image" alt="Profile">
                        <span class="ms-2">Meowww<br><small>Admin</small></span>
                    </div>
                </div>
            </div>
            @yield('content')

        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
