@extends('owner.master')
@section('page-title', 'Users')
@section('active-users', 'active')

@section('content')
    <style>
        .user-detail-wrapper {
            padding: 20px;
        }

        .user-header {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .user-meta {
            color: #666;
            font-size: 14px;
            margin: 8px 0;
        }

        .user-meta i {
            width: 20px;
            color: #555;
            margin-right: 8px;
        }

        .status-badge {
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 13px;
            font-weight: 500;
        }

        .status-active {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .order-history {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .order-card {
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .order-card:hover {
            background: #f8f9fa;
        }
    </style>

    <div class="user-detail-wrapper">
        <div class="user-header">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">{{ $user->name }}</h4>
                <span class="status-badge status-active">
                    <i class="fas fa-check-circle"></i> {{ $user->position }}
                </span>
            </div>
            <div class="user-meta">
                <i class="fas fa-id-card"></i> User ID: {{ $user->id }}
            </div>
            <div class="user-meta">
                <i class="fas fa-envelope"></i> {{ $user->email }}
            </div>
            <div class="user-meta">
                <i class="fas fa-phone"></i>
                {{ $user->phone ? $user->phone : 'Unknown' }}
            </div>
            <div class="user-meta">
                <i class="fas fa-map-marker-alt"></i> {{ $user->address ? $user->address : 'Unknown' }}
            </div>
            <div class="user-meta">
                <i class="fas fa-calendar"></i> Member since: {{ $user->created_at->format('d F Y') }}
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="display-4 mb-0">{{ count($user->orders) }}</h3>
                        <p class="text-muted">Total Orders</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="display-4 mb-0">$2,450</h3>
                        <p class="text-muted">Total Spent</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="display-4 mb-0">4.8</h3>
                        <p class="text-muted">Average Rating</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="order-history">
            <h5 class="mb-4">User's Orders</h5>
            @foreach ($user->orders as $order)
                <a href="{{ route('owner.order.detail', $order->id) }}" style="text-decoration: none; color:black">
                    <div class="order-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">Order ID: {{ $order->id }}</h6>
                                <div class="user-meta mb-0">
                                    <i class="fas fa-calendar"></i> {{ $order->created_at }}
                                </div>
                                <div class="user-meta mb-0">
                                    <i class="fas fa-box"></i> {{ $order->qty }}
                                </div>
                            </div>
                            <div class="text-end">
                                <div class="fw-bold mb-2">{{ $order->total_price }} MMK</div>
                                @if ($order->status == 'Pending')
                                    <span class="badge bg-warning text-dark">{{ $order->status }}</span>
                                @elseif ($order->status == 'Delivered')
                                    <span class="badge bg-success">{{ $order->status }}</span>
                                @else
                                    <span class="badge bg-danger">{{ $order->status }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach





        </div>
    </div>
@endsection
