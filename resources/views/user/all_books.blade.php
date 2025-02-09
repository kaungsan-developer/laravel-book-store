@extends('user.master')
@section('css')
    <style>
        .book-card {
            animation: apppear linear;
            animation-timeline: view();
            animation-range: entry 0% cover 20%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-body {
            padding: 5px;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }



        .book-price {
            font-size: 0.8rem;
            font-weight: 600;
            color: #2ecc71;
            float: right;
        }

        .book-title {
            font-size: 0.8rem;
            font-weight: 600;
            color: #2c3e50;
            margin: 0.5rem 0;

        }

        .book-author {
            color: #666;
            font-size: 0.7rem;
        }

        .line {
            width: 45%;
            height: 1px;
            background-color: black;
            opacity: 0.2;

        }

        @keyframes apppear {
            from {
                opacity: 0;
                scale: 0.5;
            }

            to {
                opacity: 1;
                scale: 1;
            }
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <h2 class="text-center mt-1">All <b>Books</b></h2>
        <div class="d-flex justify-content-between align-items-center mt-1 mb-3">
            <div class="line"></div>
            <div class="text-danger" style="opacity: 0.8">
                <i class="fa-solid fa-book"></i>
                <i class="fa-solid fa-book"></i>

            </div>

            <div class="line shadow"></div>
        </div>
        <div class="row g-4 mx-auto">
            @foreach ($books as $book)
                <div class="col-md-6 col-12 col-lg-2">
                    <a href="{{ route('book.detail', $book->id) }}" style="text-decoration: none">
                        <div class="card book-card book-card">
                            @if ($book->image)
                                <img src="{{ asset("books_img_folder/$book->image") }}" class="card-img-top book-img"
                                    alt="Book cover">
                            @endif
                            <div class="card-body">

                                <h5 class="book-title">{{ $book->name }}</h5>
                                <p class="book-author mb-2">{{ $book->aurthor }}</p>
                                @if ($book->discounted_price)
                                    <div class="float-start"
                                        style="text-decoration: line-through;color: red; font-size: 0.8rem;">
                                        {{ $book->price }} MMK
                                    </div>
                                    <div class="book-price">
                                        {{ $book->discounted_price }} MMK
                                    </div>
                                @else
                                    <div class="book-price">
                                        {{ $book->price }} MMK
                                    </div>
                                @endif
                                {{-- <div class="d-flex justify-content-between align-items-center">
                                    <button class="btn btn-outline-warning btn-sm">Buy Now</button>
                                    <button class="btn btn-outline-primary btn-sm">Add to Cart</button>
                                </div> --}}
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            <div class="d-flex justify-content-end">{{ $books->links() }}</div>
        </div>
    </div>
@endsection
