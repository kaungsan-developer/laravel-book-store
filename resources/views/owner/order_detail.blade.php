@extends('owner.master')

@section('active-orders', 'active')

@section('content')
    <style>
        .order-detail-wrapper {
            padding: 20px;
            background: #f8f9fa;
        }

        .order-header {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .order-meta {
            color: #666;
            font-size: 14px;
            margin-bottom: 8px;
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
            display: inline-block;
        }

        .status-pending {
            background: #fff3e0;
            color: #ef6c00;
        }


        .status-success {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .status-danger {
            background: #ffebee;
            color: #c62828;
        }

        .status-primary {
            background: #e3f2fd;
            color: #1976d2;
        }

        .order-items {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .item-row {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .item-row:last-child {
            border-bottom: none;
        }

        .customer-info {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .price-summary {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .summary-row:last-child {
            border-bottom: none;
            font-weight: bold;
        }
    </style>

    @if (session('accept'))
        <div class="alert alert-info fade alert-dismissible show" id="alert">
            {{ session('accept') }}
            <button class="btn-close" data-bs-dismiss="alert" aria-label="close button" id="alert"></button>
        </div>
    @elseif (session('reject'))
        <div class="alert alert-warning fade alert-dismissible show" id="alert">
            {{ session('reject') }}
            <button class="btn-close" data-bs-dismiss="alert" aria-label="close button" id="alert"></button>
        </div>
    @endif
    <div class="order-detail-wrapper">
        <div class="order-header">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">Order Id: {{ $order->id }}</h4>
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
            <div class="order-meta">
                <i class="fas fa-calendar"></i> Ordered on: {{ $order->created_at->format('d F Y') }}
            </div>
            <div class="order-meta">
                <i class="fas fa-truck"></i> Delivery Method: Standard Delivery
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="order-items mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0 pt-3 ps-3">Order Items</h5>
                    </div>
                    <div class="card-body p-0">
                        @foreach ($order->books as $book)
                            <div class="item-row">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">{{ $book->name }}</h6>
                                        <div class="order-meta mb-0">
                                            <i class="fas fa-book"></i>{{ $book->aurthor }}
                                        </div>
                                        <div class="order-meta mb-0">
                                            <i class="fas fa-tag"></i>{{ $book->category->name }}
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <div class="fw-bold">{{ $book->price }}MMK</div>
                                        <small class="text-muted">Qty:</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="customer-info">
                    <h5 class="mb-3">Customer Information</h5>
                    <div class="order-meta">
                        <i class="fas fa-user"></i> {{ $order->user->name }}
                    </div>
                    <div class="order-meta">
                        <i class="fas fa-envelope"></i> {{ $order->user->email }}
                    </div>
                    <div class="order-meta">
                        <i class="fas fa-phone"></i> {{ $order->phone }}
                    </div>
                    <div class="order-meta">
                        <i class="fas fa-map-marker-alt"></i> {{ $order->address }}
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="price-summary">
                    <h5 class="mb-3">Price Summary</h5>
                    <div class="summary-row">
                        <span>SubTotal</span>
                        <span>{{ $order->total_price }} MMK</span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping Fee</span>
                        <span>3000 MMK</span>
                    </div>
                    <div class="summary-row">
                        <span>Total</span>
                        <span>{{ $order->total_price + 3000 }} MMK</span>
                    </div>
                </div>
                @if ($order->status == 'Pending')
                    <div class="d-grid gap-2 mt-3">
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#accept">
                            <i class="fas fa-check me-1"></i> Accept Order
                        </a>
                        <a class="btn btn-outline-danger" data-bs-toggle='modal' data-bs-target="#reject">
                            <i class="fas fa-times me-1"></i> Reject Order
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="order-detail-wrapper mt-4">
        <div class="row">
            <div class="col-12">
                <div class="price-summary">
                    <h5 class="mb-3">Payment Information</h5>
                    <div class="summary-row">
                        <span><i class="fas fa-money-bill me-2"></i>Payment Method</span>
                        <span>Bank Transfer</span>
                    </div>
                    <div class="summary-row">
                        <span><i class="fas fa-calendar-alt me-2"></i>Payment Date</span>
                        <span>Not Paid Yet</span>
                    </div>
                    <div class="summary-row">
                        <span><i class="fas fa-receipt me-2"></i>Transaction ID</span>
                        <span>-</span>
                    </div>
                    <div class="summary-row">
                        <span><i class="fas fa-check-circle me-2"></i>Payment Status</span>
                        <span class="status-badge status-pending">Pending</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="height: 200px"></div>

    {{-- ask again to accept order  --}}
    <div class="modal" id="accept">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">
                        <h5>Order ID: {{ $order->id }}</h5>
                    </div>
                    <button class="btn btn-close" data-bs-dismiss="modal"></button>

                </div>
                <div class="modal-body text-center">
                    Are You Sure To <span class="text-primary">Accept</span>.You <span class="text-primary">Cannot</span>
                    Change It Later!

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('owner.order.accept', $order->id) }}">Accept</a>
                </div>
            </div>
        </div>
    </div>


    {{-- ask again to reject order  --}}
    <div class="modal" id="reject">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">
                        <h5>Order ID: {{ $order->id }}</h5>
                    </div>
                    <button class="btn btn-close" data-bs-dismiss="modal"></button>

                </div>
                <div class="modal-body text-center">
                    Are You Sure To <span class="text-danger">Reject</span> .You <span class="text-danger">Cannot</span>
                    Change It Later!

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="{{ route('owner.order.reject', $order->id) }}">Reject</a>
                </div>
            </div>
        </div>

    </div>




@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#alert').fadeOut(6000);
            });
        });
    </script>
@endsection
