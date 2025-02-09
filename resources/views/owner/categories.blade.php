@extends('owner.master')
@section('active-categories', 'active')
@section('page-title', 'Categories')
@section('css')
    <style>
        .category-card {
            transition: all 0.3s ease;
        }

        .category-card .btn-close {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1000;
            font-size: 10px;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                @endforeach
            </div>
        @endif
        <div class="card w-75 mx-auto">
            <div class="card-body ">
                <form action="{{ route('owner.add.category') }}" method="post">
                    @csrf
                    <div class="w-75 mx-auto text-center">

                        <label for="name" class="mt-3">Category Name</label>
                        <input type="text" name="name" class="form-control mt-2" value="{{ old('name') }}">
                        <button class="btn-primary btn  mt-3" type="submit">Submit</button>
                    </div>

                </form>
            </div>
        </div>

        <div class="mt-5">
            <h3>Categories</h3>
            <div class="d-flex flex-wrap">
                @foreach ($categories as $category)
                    <div class="col-12 col-lg-3 col-md-4 p-3 ">
                        <div class="card text-center category-card">
                            <div class="card-body">
                                <a href="{{ route('owner.delete.category', $category->id) }}" class="btn btn-close"></a>
                                {{ $category->name }}
                                <p class="text-success m-0">Books: {{ $category->books->count() }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    <div style="height: 300px;"></div>
@endsection
