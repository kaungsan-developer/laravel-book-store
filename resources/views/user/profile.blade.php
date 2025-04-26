@extends('user.master')
@section('content')
    <div class="container py-5">
        <div class="row">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <!-- Profile Section -->
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        @if (Auth::user()->profile && file_exists(public_path(Auth::user()->profile)))
                            <img src="{{ asset(Auth::user()->profile) }}" alt="Profile Image" class="rounded-circle"
                                style="width: 150px; height: 150px; object-fit: cover;">
                        @endif
                        <h4 class="card-title">{{ Auth::user()->name }}</h4>
                        <p class="text-muted">{{ Auth::user()->email }}</p>

                    </div>
                </div>

                <!-- Total Spent -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Account Summary</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Total Spent:</span>
                            <span class="h5 mb-0 text-primary">{{ Auth::user()->orders->sum('total_price') }} MMK</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">

                <div id="orders" class="tab-pane fade show active" style="height: 500px; overflow: scroll;">
                    @foreach ($user->orders as $order)
                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="mb-0">Order Id: {{ $order->id }}</h6>
                                    <span class="badge bg-success">{{ $order->status }}</span>
                                </div>
                                <div class="d-flex align-items-center">

                                    <div>
                                        <h6 class="text-muted small mb-0">Total: {{ $order->total_price }} MMK</h6>
                                        <p class="mb-1">{{ $order->created_at->format('d M Y') }}</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Wishlist Tab -->


                <!-- Cart Tab -->


            </div>


        </div>
        <!-- Settings Section -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Account Settings</h4>

                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Profile Image -->
                            <div class="mb-3">
                                <div class="text-center mb-3">
                                    @if (Auth::user()->profile)
                                        <img src="{{ asset(Auth::user()->profile) }}" alt="Profile Image"
                                            class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('default-avatar.png') }}" alt="Default Profile Image"
                                            class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                                    @endif
                                </div>
                                <label class="form-label">Profile Image</label>
                                <div class="input-group">
                                    <input type="file" class="form-control" name="profile_image">
                                    <button class="btn btn-outline-primary" type="submit">Upload</button>
                                </div>
                                <small class="text-muted">Recommended size: 150x150 pixels</small>
                            </div>
                        </form>
                        <!-- Name Change -->
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                                <button class="btn btn-outline-primary" type="submit">Update</button>
                            </div>
                        </div>

                        <!-- Email Change -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <input type="email" class="form-control" name="email"
                                    value="{{ Auth::user()->email }}">
                                <button class="btn btn-outline-primary" type="submit">Update</button>
                            </div>
                        </div>

                        <!-- Phone Number -->
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <div class="input-group">
                                <input type="tel" class="form-control" name="phone"
                                    value="{{ Auth::user()->phone ?? '' }}">
                                <button class="btn btn-outline-primary" type="submit">Update</button>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <div class="input-group">
                                <textarea class="form-control" name="address" rows="3">{{ Auth::user()->address ?? '' }}</textarea>
                                <button class="btn btn-outline-primary" type="submit">Update</button>
                            </div>
                        </div>

                        <!-- Password Change -->
                        <div class="mb-3">

                            <label class="form-label">Change Password</label>
                            <form action="{{ route('password.update') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <input type="password" class="form-control" name="current_password"
                                            placeholder="Current Password">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="password" class="form-control" name="new_password"
                                            placeholder="New Password">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="password" class="form-control" name="new_password_confirmation"
                                            placeholder="Confirm New Password">
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary float-end">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
