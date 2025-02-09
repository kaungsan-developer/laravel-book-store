@extends('user.master')

@section('css')
    <style>
        .slider-img {
            width: 100%;
            background-position: center;
            background-size: cover;
            height: 380px;

        }

        .carousel {
            overflow: hidden;
        }

        .carousel-indicators li {
            list-style: none;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 600;
            margin: 3rem 0 2rem;
            color: #2c3e50;
        }

        .book-card {
            transition: all 0.3s ease;

            background: #fff;
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            animation: apppear linear;
            animation-timeline: view();
            animation-range: entry 0%;
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

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .book-img {
            /* height: 70%; */
            object-fit: cover;
            /* width: 100%; */
        }

        .book-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: #2c3e50;
            margin: 0.5rem 0;
        }

        .book-author {
            color: #666;
            font-size: 0.9rem;
        }

        .book-price {
            font-size: 1rem;
            font-weight: 600;
            color: #2ecc71;
        }



        .category-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            border: none;
            background: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .category-name {
            color: #2c3e50;
            margin: 10px 0 5px;
            font-size: 1.1rem;
        }

        .book-count {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .fa-2x {
            color: #3498db;
        }

        .line {
            width: 45%;
            height: 1px;
            background-color: black;
            opacity: 0.2;

        }

        .view-all-btn:hover {
            box-shadow: 12px 12px 12px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection
@section('content')
    <main>
        <div class="carousel slide" data-bs-ride="carousel" id="slide">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="slider-img"
                        style="background-image: url('{{ asset('books_img_folder/elin-melaas-hSehncagovE-unsplash.jpg') }}');">
                    </div>

                </div>
                <div class="carousel-item slider-img"
                    style="background-image: url('{{ asset('books_img_folder/baher-khairy-yjrRkqaa_h4-unsplash.jpg') }}')">

                </div>
                <div class="carousel-item slider-img"
                    style="background-image: url('{{ asset('books_img_folder/thought-catalog-EzGm2wtyiC4-unsplash.jpg') }}')">

                </div>
                <a href="#slide" class="carousel-control-prev" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a href="#slide" class="carousel-control-next" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
                <ul class="carousel-indicators">
                    <li class="active" data-bs-target="#slide" data-bs-slide-to="0"></li>
                    <li data-bs-target="#slide" data-bs-slide-to="1"></li>
                    <li data-bs-target="#slide" data-bs-slide-to="2"></li>
                </ul>

            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success m-3" id="alert" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="container p-0 w-100">

            {{-- categories  --}}
            <div class="categories">
                <h2 class="section-title">Categories</h2>


                <div class="row g-4">
                    @foreach ($categories as $category)
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="{{ route('searched_books', $category->id) }}" style="text-decoration: none">
                                <div class="card category-card">
                                    <div class="card-body text-center">
                                        <i class="fas fa-book-open fa-2x mb-2"></i>
                                        <h5 class="category-name">{{ $category->name }}</h5>
                                        <span class="book-count">{{ $category->books->count() }} Books</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach


                </div>
                <div class="mt-4">
                    <a href="{{ route('user.all.books') }}" class="btn btn-success float-end shadow">View All >></a>
                </div>
            </div>
            {{-- categories end  --}}
            <div style="height: 100px"></div>
            <!-- Featured Books Section -->

            <h2 class="section-title">Featured Books</h2>


            <div class="row g-4 mx-auto">
                @foreach ($books as $book)
                    <div class="col-md-4 col-6 col-lg-3">

                        <div class="card book-card">
                            @if ($book->image)
                                <img src="{{ asset("books_img_folder/$book->image") }}" class="card-img-top book-img"
                                    alt="Book cover">
                            @endif
                            <a href="{{ route('book.detail', $book->id) }}" style="text-decoration: none">
                                <div class="card-body">
                                    {{-- @if ($book->category)
                                        <span class="badge bg-secondary mb-2">{{ $book->category->name }}</span>
                                    @else
                                        <span class="badge bg-danger mb-2">No Category</span>
                                    @endif --}}
                                    <h5 class="book-title">{{ $book->name }}</h5>
                                    <p class="book-author mb-2">{{ $book->aurthor }}</p>
                                    @if ($book->discounted_price)
                                        <div class="book-price" style="text-decoration: line-through;color: red;">
                                            {{ $book->price }} MMK
                                        </div>
                                        <div class="book-price">
                                            {{ $book->discounted_price }}
                                            MMK
                                        </div>
                                    @else
                                        <div class="book-price">
                                            {{ $book->price }} MMK
                                        </div>
                                    @endif

                                </div>


                            </a>
                            {{-- <div class="card-footer">
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('book.detail', $book->id) }}"
                                        class="btn btn-outline-warning btn-sm">Buy Now</a>
                                    <form action="{{ route('add.cart', $book->id) }}" method="post">
                                        @csrf
                                        <input type="hidden" value="{{ $book->id }}" name="book_id">
                                        <button class="btn btn-outline-primary btn-sm" type="submit">Add to
                                            Cart</button>
                                    </form>
                                </div>
                            </div> --}}
                        </div>

                    </div>
                @endforeach



                <div>
                    <a href="{{ route('user.all.books') }}" class="btn btn-success float-end  view-all-btn">View All
                        >></a>
                </div>
            </div>

            {{-- section divider  --}}
            <div class="d-flex justify-content-between align-items-center mt-5">
                <div class="line "></div>
                <div class="text-danger" style="opacity: 0.8">
                    <i class="fa-solid fa-book"></i>
                    <i class="fa-solid fa-book"></i>

                </div>

                <div class="line shadow"></div>
            </div>


            <!-- New Arrivals Section -->
            <h2 class="section-title">New Arrivals</h2>
            <div class="row g-4 mx-auto">
                @foreach ($newArrivals as $newArrivalBook)
                    <div class="col-md-3 col-12 col-lg-3">

                        <div class="card book-card">
                            <a href="{{ route('book.detail', $newArrivalBook->id) }}" style="text-decoration: none">
                                @if ($newArrivalBook->image)
                                    <img src="{{ asset("books_img_folder/$newArrivalBook->image") }}"
                                        class=" book-img img-fluid" alt="Book cover">
                                @endif

                                <div class="card-body">


                                    {{-- @if ($newArrivalBook->category)
                                        <span
                                            class="badge bg-secondary mb-2 float-end"><small>{{ $newArrivalBook->category->name }}</small></span>
                                    @else
                                        <span class="badge bg-danger mb-2 float-end"><small>No
                                                Category</small></span>
                                    @endif --}}
                                    <span class="book-title">{{ $newArrivalBook->name }}</span>
                                    <p class="book-author mb-2">{{ $newArrivalBook->aurthor }}</p>

                                    <div class="book-price"
                                        @if ($newArrivalBook->discounted_price) style="text-decoration: line-through;color: red;" @endif>
                                        {{ $newArrivalBook->price }} MMK
                                    </div>
                                    @if ($newArrivalBook->discounted_price)
                                        <div class="book-price">
                                            {{ $newArrivalBook->discounted_price }}
                                            MMK
                                        </div>
                                    @endif

                                </div>
                            </a>
                            {{-- <div class="card-footer">
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('book.detail', $newArrivalBook->id) }}"
                                        class="btn btn-outline-warning btn-sm">Buy
                                        Now</a>
                                    <form action="{{ route('add.cart') }}" method="post">
                                        @csrf
                                        <input type="hidden" value="{{ $newArrivalBook->id }}" name="book_id">
                                        <button class="btn btn-outline-primary btn-sm" type="submit">Add
                                            to Cart</button>
                                    </form>
                                </div>
                            </div> --}}
                        </div>


                    </div>
                @endforeach

            </div>


            {{-- section divider  --}}
            <div class="d-flex justify-content-between align-items-center mt-5">
                <div class="line "></div>
                <div class="text-danger" style="opacity: 0.8">
                    <i class="fa-solid fa-book"></i>
                    <i class="fa-solid fa-book"></i>

                </div>

                <div class="line shadow"></div>
            </div>

            {{-- special offers section  --}}
            @if ($specialOffers->count() > 0)
                <h2 class="section-title">Special Offers</h2>
                <div class=" row g-4">

                    @foreach ($specialOffers as $special)
                        <div class="col-md-6 col-12 col-lg-3">
                            <a href="{{ route('book.detail', $special->id) }}" style="text-decoration: none">
                                <div class="card book-card">
                                    @if ($special->image)
                                        <img src="{{ asset("books_img_folder/$special->image") }}" class="book-img"
                                            alt="Book cover">
                                    @endif
                                    <div class="card-body">
                                        {{-- @if ($special->category)
                                            <span class="category-badge mb-2">{{ $special->category->name }}</span>
                                        @else
                                            <span class="category-badge mb-2">No Category</span>
                                        @endif --}}
                                        <h5 class="book-title">{{ $special->name }}</h5>
                                        <p class="book-author mb-2">{{ $special->aurthor }}</p>
                                        <p style="text-decoration: line-through" class="text-danger">
                                            {{ $special->price }}
                                            MMK</p>
                                        <div class="book-price">{{ $special->price * 0.8 }} MMK</div>
                                    </div>
                                    {{-- <div class="card-footer">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a class="btn btn-outline-warning btn-sm"
                                                href="{{ route('book.detail', $special->id) }}">Buy Now</a>
                                            <form action="{{ route('add.cart') }}" method="post">
                                                @csrf
                                                <input type="hidden" value="{{ $special->id }}" name="book_id">
                                                <button class="btn btn-outline-primary btn-sm" type="submit">Add to
                                                    Cart</button>
                                            </form>
                                        </div>
                                    </div> --}}
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        <div style="height: 100px"></div>
    </main>
@endsection
