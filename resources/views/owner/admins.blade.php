@extends('owner.master')

@section('active-admins', 'active')

@section('css')
    <style>
        .admin-card:hover {
            transform: translateY(-5px);


        }

        .admin-card {
            transition: transform 0.3s ease-in-out;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
        }
    </style>
@endsection

@section('content')
    @if (session('deleteSuccess'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('deleteSuccess') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('addSuccess'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('addSuccess') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card">
        <div class="card-header">Add New Admin</div>
        <form action="{{ route('owner.add.admin') }}" method="post">
            @csrf

            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <label for="name" class="mt-3">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small><br>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="email" class="mt-3">E-mail</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small><br>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <label for="password " class="mt-3">Password</label>
                        <input type="password" class="form-control" name="password">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small><br>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="confirm-password" class="mt-3">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm-password">
                        @error('confirm-password')
                            <small class="text-danger">{{ $message }}</small><br>
                        @enderror
                    </div>
                </div>

                <input type="hidden" name="position" value="admin">
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-secondary float-end mb-3">Submit</button>
            </div>

        </form>
    </div>

    <div class="container mt-5">
        <h3>Admins List</h3>
        @foreach ($admins as $admin)
            <div class="card admin-card">
                <div class="card-header">
                    <b>{{ $admin->name }}</b>
                    <div class="badge bg-primary float-end">{{ $admin->position }}</div>
                </div>

                <div class="card-body">
                    <p>{{ $admin->email }}</p>
                    <p>{{ $admin->created_at->format('d-M-Y') }}</p>
                </div>
                @if (Auth::user()->position == 'owner')
                    <div class="card-footer">
                        <a href="{{ route('owner.delete.admin', $admin->id) }}" class="btn btn-danger float-end">Delete</a>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
    <div style="height: 300px;"></div>
@endsection
