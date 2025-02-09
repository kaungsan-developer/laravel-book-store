<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book Store</title>
    {{-- bootstrap link  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">

    {{-- fontawsome link  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

</head>
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f9f9f9;
    }

    .nav-bar {
        position: sticky;
        z-index: 100;
        top: 0px;
    }

    .navbar {
        padding: 15px 0;
        transition: all 0.3s ease;
    }

    .navbar-brand {
        font-size: 24px;
        font-weight: 600;
        color: #2c3e50;
    }

    .nav-link {
        font-weight: 500;
        color: #34495e !important;
        transition: color 0.3s ease;
    }

    .nav-link:hover,
    .quick-link li a:hover {
        color: #3498db !important;
    }

    .search .form-control {
        border-radius: 20px 0 0 20px;
        border: 1px solid #ddd;
        padding: 10px 20px;
    }

    .search .btn {
        border-radius: 0 20px 20px 0;
        padding: 10px 25px;
        background: #3498db;
        color: white;
        border: none;
    }

    .search .btn:hover {
        background: #2980b9;
    }

    .list-group-item {
        border: none;
        padding: 12px 20px;
        transition: all 0.3s ease;
    }

    .list-group-item a {
        text-decoration: none;
        color: #34495e;
        font-weight: 500;
    }

    .small-nav-container {
        border-radius: 15px;
        margin: 10px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .small-nav .list-group-item:hover {
        background-color: #f8f9fa;
        transform: translateX(5px);
    }

    .dropdown-menu {
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    .dropdown-item {
        padding: 8px 20px;
        transition: all 0.3s ease;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
        transform: translateX(5px);
    }

    .small-search {
        height: 60px;
        background-color: white;
        padding: 10px 20px !important;
    }

    .small-search .form-control {
        border-radius: 20px 0 0 20px;
        border: 1px solid #ddd;
    }

    .small-search .btn {
        border-radius: 0 20px 20px 0;
        background: #3498db;
        color: white;
        border: none;
    }

    .search {
        width: 70%;
    }



    .small-search-bar {
        width: 75%;
    }

    @media(max-width: 1200px) {
        .search {
            min-width: 80%;
        }
    }

    @media(min-width: 992px) {
        .bars {
            display: none;
        }
    }

    @media(max-width: 700px) {
        .search {
            display: none;
        }
    }

    @media(min-width: 700px) {
        .small-search {
            display: none;
        }
    }

    @media(max-width: 550px) {
        .small-search-bar {
            width: 100%;
        }
    }

    .footer {
        background-color: lightgray;
        border-radius: 10px;
    }
</style>
@yield('css')

<body>
    {{-- navbar master layout --}}


    <div class="container-fluid g-0">
        <div class="nav-bar">
            <nav class="navbar navbar-expand-lg bg-white shadow-sm">
                <div class="navbar-brand ms-4">📚 စာဥ</div>
                <div class="flex-fill justify-content-center d-flex">
                    <form action="{{ route('bookSearchByBar') }}" class="input-group  search" method="post">
                        @csrf
                        <input type="text" class="form-control form-control-sm"
                            style="border-radius: 20px 0px 0px 20px" placeholder="What are you looking for?"
                            name="searchKey">
                        <button class="btn btn-sm btn-outline-secondary" type="submit">Search</button>
                    </form>
                </div>

                <ul class="navbar-nav me-3">
                    @auth
                        @if (Auth::user()->position == 'owner')
                            <li class="nav-item d-none d-lg-inline ms-3"><a href="{{ route('owner.dashboard') }}"
                                    class="nav-link">Dashboard</a>
                            </li>
                        @endif
                    @endauth


                    <li class="nav-item d-none d-lg-inline ms-3">
                        <a href="{{ route('home') }}" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item d-none d-lg-inline ms-3">
                        <a href="{{ route('user.all.books') }}" class="nav-link">View All Books</a>
                    </li>
                    {{-- <li class="nav-item d-none d-lg-inline ms-3"><a href="" class="nav-link">About</a></li>
                    <li class="nav-item d-none d-lg-inline ms-3"><a href="" class="nav-link">Content Us</a></li> --}}
                    @auth


                        <li class="nav-item d-none d-lg-inline ms-3">
                            <a href="{{ route('cart', Auth::id()) }}" class="nav-link position-relative">Cart
                                @if (count(Auth::user()->cartBooks) > 0)
                                    <span
                                        class="badge bg-primary rounded-pill position-absolute top-10 start-100 translate-middle">{{ count(Auth::user()->cartBooks) }}
                                    </span>
                                @endif
                            </a>
                        </li>

                        <li class="nav-item dropdown d-none d-lg-inline ms-3">
                            <a href="#" class="dropdown-toggle nav-link user-name"
                                data-bs-toggle="dropdown">{{ Auth::user()->name }}</a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a href="{{ route('profile', Auth::id()) }}" class="dropdown-item">Profile</a></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button type="submit" class="text-danger dropdown-item">Logout</button>
                                    </form>
                                </li>

                            </ul>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item d-none d-lg-inline ms-3"><a href="{{ route('login') }}"
                                class="text-primary nav-link">Login</a>
                        </li>
                    @endguest


                    <li class="nav-item ms-3 fs-5 bars">
                        <a href="#item" class="nav-link" data-bs-toggle="collapse"><i
                                class="fa-solid fa-bars"></i></a>
                    </li>


                </ul>
            </nav>



            {{-- search bar for small screen  --}}
            <div class="small-search p-2 shadow">
                <form action="{{ route('bookSearchByBar') }}" class="input-group float-end small-search-bar"
                    method="post">
                    @csrf
                    <input type="text" class="form-control" placeholder="What are you looking for?" name="searchKey">
                    <button class="btn btn-sm btn-outline-secondary" type="submit">Search</button>
                </form>
            </div>
            {{-- search bar for small screen end  --}}



            {{-- nav buttons for small screen  --}}
            <div class="collapse" id="item" class="small-nav-container">
                <ul class="list-group small-nav shadow-sm">

                    <li class="list-group-item" style="list-style: none"><a
                            href="{{ route('owner.dashboard') }}">Dashooard</a></li>
                    <li class="list-group-item" style="list-style: none"><a href="">Home</a></li>
                    <li class="list-group-item" style="list-style: none"><a href="">About</a></li>
                    <li class="list-group-item" style="list-style: none"><a href="">Content Us</a></li>


                    @auth
                        <a href="#profile" style="text-decoration: none" data-bs-toggle="collapse">
                            <li class="list-group-item text-success dropdown-toggle">
                                {{ Auth::user()->name }}
                            </li>
                        </a>
                        <div id="profile" class="collapse">
                            <li class="list-group-item "><a href="" class="text-primary">Profile</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="text-danger dropdown-item">Logout</button>
                                </form>
                            </li>
                        @endauth
                        @guest
                            <li class="list-group-item"><a href="{{ route('login') }}"
                                    class="text-primary nav-link">Login</a>
                            </li>
                        @endguest
                    </div>

                </ul>
            </div>
            {{-- search bar for small screen end  --}}

        </div>
        {{-- navbar end  --}}



        {{-- main content --}}
        @yield('content')

        <div style="height: 200px"></div>
        <div class="footer">
            <div class="container">
                <div class="row pt-5">
                    <div class="col-md-4 mb-4">
                        <h5 class="mb-3">About Book Store</h5>
                        <p class="text-muted">
                            Your one-stop destination for all your reading needs. We offer a wide selection of books
                            across various genres at competitive prices.
                        </p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h5 class="mb-3 ">Quick Links</h5>
                        <ul class="list-unstyled quick-link">
                            <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Home</a>
                            </li>
                            <li class="mb-2"><a href="#" class="text-decoration-none text-muted">About Us</a>
                            </li>
                            <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Contact</a>
                            </li>
                            <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Terms &
                                    Conditions</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h5 class="mb-3">Contact Us</h5>
                        <ul class="list-unstyled text-muted">
                            <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i>123 Book Street, Reading City
                            </li>
                            <li class="mb-2"><i class="fas fa-phone me-2"></i>(123) 456-7890</li>
                            <li class="mb-2"><i class="fas fa-envelope me-2"></i>contact@bookstore.com</li>
                        </ul>
                        <div class="mt-3">
                            <a href="#" class="text-muted me-3"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="text-muted me-3"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-muted me-3"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="border-top py-1">
                    <div class="text-center text-muted">
                        <small>&copy; 2024 Book Store. All rights reserved.</small>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@yield('script')

<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('#alert').fadeOut(5000)
        });
    })
</script>

</html>
