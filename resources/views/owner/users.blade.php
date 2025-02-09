@extends('owner.master')
@section('page-title', 'Users')
@section('active-users', 'active')

@section('content')
    <style>
        .customers-wrapper {
            padding: 20px;
        }

        .header-actions {
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .customer-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .customer-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .customer-meta {
            color: #666;
            font-size: 14px;
        }

        .customer-meta i {
            width: 20px;
            color: #555;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 13px;
            font-weight: 500;
        }

        .status-active {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .status-inactive {
            background: #ffebee;
            color: #c62828;
        }

        @media (max-width: 768px) {
            .customers-wrapper {
                padding: 10px;
            }

            .header-actions {
                padding: 15px;
            }
        }
    </style>

    <div class="customers-wrapper">
        <div class="header-actions d-flex align-items-center flex-wrap gap-3">
            <div class="flex-fill"></div>
            <div class="input-group" style="max-width: 300px;">
                <input type="text" class="form-control" placeholder="Search Users...">
                <span class="input-group-text">
                    <i class="fas fa-search" style="cursor: pointer"></i>
                </span>
            </div>

        </div>

        <div class="mt-4">

            @foreach ($users as $user)
                <a href="{{ route('owner.user.detail', $user->id) }}" style="text-decoration: none">
                    <div class="card customer-card mb-3">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <h5 class="mb-0">{{ $user->name }}
                                        <h5>
                                            <span class="customer-meta">
                                                <i class="fas fa-id-card"></i> ID: {{ $user->id }}
                                            </span>
                                </div>
                                <div class="col-md-3">
                                    <div class="customer-meta mb-2">
                                        <i class="fas fa-envelope"></i> {{ $user->email }}
                                    </div>
                                    <div class="customer-meta">
                                        <i class="fas fa-phone"></i> +1 234-567-8900
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="customer-meta mb-2">
                                        <i class="fas fa-shopping-bag"></i> Total Orders: 10
                                    </div>
                                    <div class="customer-meta">
                                        <i class="fas fa-dollar-sign"></i> Total Spent:
                                        $1,234.56
                                    </div>
                                </div>
                                <div class="col-md-3 text-md-end">
                                    <span class="status-badge status-active mb-2 d-inline-block">
                                        <i class="fas fa-check-circle me-1"></i>{{ $user->position }}
                                    </span>

                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div style="height: 100px">
            {{-- {{ $customers->links() }} --}}
        </div>
    </div>
@endsection
