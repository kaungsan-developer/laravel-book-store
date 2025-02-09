@extends('owner.master')

@section('active-orders', 'active')

@section('css')
    <style>
        .orders-wrapper {
            padding: 20px;
            background: #f8f9fa;
        }

        .header-actions {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .order-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .order-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .order-meta {
            color: #666;
            font-size: 14px;
        }

        .order-meta i {
            width: 20px;
            color: #555;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 13px;
            font-weight: 500;
        }

        .status-pending {
            background: #fff3e0;
            color: #ef6c00;
        }


        .status-primary {
            background: #e3f2fd;
            color: #1976d2;
        }

        .status-success {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .status-danger {
            background: #ffebee;
            color: #c62828;
        }



        @media (max-width: 768px) {
            .orders-wrapper {
                padding: 10px;
            }

            .header-actions {
                padding: 15px;
            }
        }
    </style>
@endsection
@section('content')


    <div class="orders-wrapper">
        <div class="header-actions d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="input-group" style="max-width: 300px;">
                <input type="text" class="form-control" placeholder="Search orders...">
                <span class="input-group-text">
                    <i class="fas fa-search" style="cursor: pointer"></i>
                </span>
            </div>
            <div>
                <button class="btn btn-primary">
                    <i class="fas fa-filter me-1"></i> Filter
                </button>
            </div>
        </div>

        <div class="mt-4">
            @foreach ($orders as $order)
                <div class="card order-card mb-3">
                    <a href="{{ route('owner.order.detail', $order->id) }}" style="text-decoration: none">
                        <div class="card-body">
                            <div class="row align-items-center">

                                <div class="col-md-3">
                                    <h5 class="mb-0" style="color: black">Order Id: {{ $order->id }}</h5>
                                    <span class="order-meta">
                                        <i class="fas fa-calendar"></i> {{ $order->created_at->format('d M Y') }}
                                    </span>
                                </div>
                                <div class="col-md-3">
                                    <div class="order-meta mb-2">
                                        <i class="fas fa-user"></i> {{ $order->user->name }}
                                    </div>
                                    <div class="order-meta">
                                        <i class="fas fa-book"></i> {{ $order->qty }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="order-meta mb-2">
                                        <i class="fas fa-dollar-sign"></i> Total: {{ $order->total_price + 3000 }} MMK
                                    </div>
                                    <div class="order-meta">
                                        <i class="fas fa-truck"></i> Standard Delivery
                                    </div>
                                </div>

                                <div class="col-md-3 text-md-end">
                                    @switch($order->status)
                                        @case('Rejected')
                                            <span class="status-badge status-danger">
                                                <i class="fas fa-clock me-1"></i>Rejected
                                            </span>
                                        @break

                                        @case('Accepted')
                                            <span class="status-badge status-primary">
                                                <i class="fas fa-clock me-1"></i>Accepted
                                            </span>
                                        @break

                                        @case('Delivered')
                                            <span class="status-badge status-success">
                                                <i class="fas fa-clock me-1"></i>Delivered
                                            </span>
                                        @break

                                        @default
                                            <span class="status-badge status-pending">
                                                <i class="fas fa-clock me-1"></i>Pending
                                            </span>
                                    @endswitch

                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>





@endsection
