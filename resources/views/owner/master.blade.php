<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard - Book Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            overflow: hidden;
        }



        /* Sidebar Styles */
        .sidebar {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 250px;
            background: #2c3e50;
            color: #ecf0f1;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .sidebar.active {
            margin-left: -250px;
        }

        .sidebar-header {
            padding: 20px;
            background: #243342;
        }

        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: 600;
            color: #fff;
            text-decoration: none;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            color: #ecf0f1;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .menu-item:hover {
            background: #34495e;
            color: #3498db;
        }

        .menu-item.active {
            background: #34495e;
            border-left: 4px solid #3498db;
        }

        .menu-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Main Content Area */
        .main-content {
            margin-left: 250px;
            transition: all 0.3s ease;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-content.active {
            margin-left: 0px;
        }

        /* Top Navigation */
        .top-nav {
            position: sticky;
            top: 0;
            background: #fff;
            padding: 15px 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 25px;
            border-radius: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1;

        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .user-menu .dropdown-toggle {
            color: #2c3e50;
            text-decoration: none;
            font-weight: 500;
        }

        .user-menu .dropdown-menu {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);

        }

        /* Dashboard Cards */
        .dashboard-card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .sidebar {
                margin-left: -250px;
            }

            .sidebar.active {
                margin-left: 0;
                position: absolute;
                z-index: 100;
            }

            .main-content {
                margin-left: 0;

            }
        }

        /* Toggle Button */
        .sidebar-toggle {
            background: none;
            border: none;
            color: #2c3e50;
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* Content wrapper */
        .content-wrapper {
            padding: 20px;
            flex-grow: 1;
            height: 100vh;
            overflow: scroll;
        }
    </style>
    @yield('css')
</head>

<body>
    <!-- Sidebar -->
    <div class="h-100" style="position: relative">
        <div class="sidebar">
            <div class="sidebar-header">
                <a href="#" class="sidebar-brand">
                    <i class="fas fa-book-open"></i> BookStore
                </a>
            </div>
            <div class="sidebar-menu">
                <a href="{{ route('owner.dashboard') }}" class="menu-item @yield('active-dashboard')">
                    <i class="fas fa-dashboard"></i> Dashboard
                </a>
                <a href="{{ route('owner.add_book') }}" class="menu-item @yield('active-add-book') ">
                    <span class="text-success ms-3"><b>+Add New Book</b></span>
                </a>
                <a href="{{ route('owner.categories') }}" class="menu-item @yield('active-categories') ">
                    <i class="fa-solid fa-bookmark"></i>Categories
                </a>
                <a href="{{ route('owner.all.books') }}" class="menu-item @yield('active-all-books') ">
                    <i class="fa-solid fa-book"></i>All Books
                </a>
                <a href="{{ route('owner.users') }}" class="menu-item @yield('active-users') ">
                    <i class="fas fa-users"></i> Users
                </a>
                <a href="{{ route('owner.admins') }}" class="menu-item @yield('active-admins') ">
                    <i class="fas fa-users"></i> Admins
                </a>
                <a href="{{ route('owner.orders') }}" class="menu-item @yield('active-orders') ">
                    <i class="fas fa-shopping-cart"></i> Orders
                </a>
                <a href="{{ route('owner.discount') }}" class="menu-item">
                    <i class="fas fa-chart-bar"></i> Discount
                </a>
                <a href="{{ route('home') }}" class="menu-item">
                    <i class="fas fa-home"></i> Home
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="top-nav">
                <div class="d-flex align-items-center">

                    <h1 class="page-title d-none d-lg-inline d-md-inline">@yield('page-title', 'Dashboard')</h1>
                </div>
                <div class="user-menu">
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-2"></i>
                            {{ Auth::user()->name ?? 'Admin' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a>
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>

                    </div>
                    <button class="sidebar-toggle me-3">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>

            <div class="alert alert-info alert-dismissible fade show text-center d-none" id="noti">
                <b class=""> You have New Order.</b>
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>

            <div class="content-wrapper">
                @yield('content')
            </div>

        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        // Sidebar Toggle Functionality
        document.querySelector('.sidebar-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
            document.querySelector('.main-content').classList.toggle('active');
        });
    </script>
    @yield('scripts')

</body>

</html>
