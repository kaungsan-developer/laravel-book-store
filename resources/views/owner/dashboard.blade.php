@extends('owner.master')

@section('page-title', 'Dashboard')

@section('active-dashboard', 'active')
@section('css')
    <style>
        .book-list-box::-webkit-scrollbar {
            display: none;
        }

        .book-list-box {
            cursor: move;
            cursor: n-resize;
            background-color: #F8F8F8;
            border-radius: 5px;
            max-height: 100px;
            overflow: scroll;
            padding: 5px 10px;
        }

        .book-list-box p {
            margin: 0;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <!-- Statistics Cards -->
        <div class="row g-4 mb-4">
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="dashboard-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Books</h6>
                            <h2 class="mb-0">1,234</h2>
                        </div>
                        <div class="fs-1 text-primary">
                            <i class="fas fa-book"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="dashboard-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Users</h6>
                            <h2 class="mb-0">567</h2>
                        </div>
                        <div class="fs-1 text-success">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="dashboard-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Orders</h6>
                            <h2 class="mb-0">892</h2>
                        </div>
                        <div class="fs-1 text-warning">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="dashboard-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Revenue</h6>
                            <h2 class="mb-0">$12,345</h2>
                        </div>
                        <div class="fs-1 text-info">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->



        <div style="height: 499px"></div>
    </div>
@endsection
