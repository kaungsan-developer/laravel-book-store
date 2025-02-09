@extends('owner.master')

@section('page-title', 'All Books')
@section('active-all-books', 'active')
@section('css')
    <style>
        .books-wrapper {
            padding: 20px;
        }

        .header-actions {
            background: white;
            padding: 15px 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
        }

        .search-wrapper {
            position: relative;
            max-width: 350px;
        }

        .search-wrapper .form-control {
            padding-left: 40px;
            height: 42px;
        }



        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .book-card {
            transition: all 0.3s ease;

            height: 100%;
        }

        .book-card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background: #f8f9fa;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-weight: 600;
        }

        .book-price {
            font-size: 20px;
            font-weight: 600;
            color: #3498db;
        }

        .book-meta {
            font-size: 14px;
            color: #666;
        }

        .book-meta i {
            width: 20px;
            text-align: center;
            margin-right: 5px;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
        }

        .status-in-stock {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .status-low-stock {
            background: #fff3e0;
            color: #ef6c00;
        }

        .status-out-stock {
            background: #ffebee;
            color: #c62828;
        }

        @media (max-width: 768px) {
            .books-wrapper {
                padding: 10px;
            }

            .header-actions {
                padding: 15px;
            }

            .books-grid {
                gap: 15px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="books-wrapper">
        @if (session('success'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button class="btn-close btn" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if (session('info'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="header-actions float-end align-items-center ">
            <form action="" method="post">
                @csrf
                <div class=" input-group">

                    <input type="text" class="form-control" placeholder="Search books...">
                    <span class="input-group-text">
                        <button class="btn btn-sm" type="submit"> <i class="fas fa-search " style="cursor: pointer"></i>
                        </button>
                    </span>
                </div>
            </form>


        </div>
        <div class="" style="height: 100px"></div>
        <div class="books-grid mt-3">
            @foreach ($books as $book)
                <div class="card book-card mt-3">
                    <a href="{{ route('owner.book.detail', $book->id) }}" style="text-decoration: none; color: black">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>{{ $book->name }}</span>
                            <span class="book-price">{{ $book->price . ' MMK' }}</span>
                        </div>

                        <div class="card-body">
                            <div class="d-flex @if ($book->image) justify-content-around @endif">
                                @if ($book->image)
                                    <img src="{{ asset('books_img_folder/' . $book->image) }}" alt="{{ $book->name }}"
                                        class="img-fluid mb-2 "
                                        style="height: 150px; object-fit: cover; border-radius: 10px">
                                @endif


                                <div class="d-flex flex-column gap-2">
                                    <div class="book-meta">
                                        <i class="fas fa-user"></i>
                                        {{ $book->aurthor }}
                                    </div>
                                    <div class="book-meta">
                                        <i class="fas fa-bookmark"></i>
                                        @if ($book->category)
                                            {{ $book->category->name }}
                                        @else
                                            <span class="text-danger">No Category</span>
                                        @endif
                                    </div>
                                    <div class="mt-2">
                                        @if ($book->count > 10)
                                            <span class="status-badge status-in-stock">
                                                <i class="fas fa-check-circle me-1"></i>In Stock ({{ $book->count }})
                                            </span>
                                        @elseif($book->count <= 10 && $book->count > 0)
                                            <span class="status-badge status-low-stock">
                                                <i class="fas fa-exclamation-circle me-1"></i>Low Stock
                                                ({{ $book->count }})
                                            </span>
                                        @elseif($book->count == 0)
                                            <span class="status-badge status-out-stock">
                                                <i class="fas fa-times-circle me-1"></i>Out of Stock
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </a>
                    <div class="card-footer bg-white border-top-0">

                        <a class="btn btn-sm btn-danger float-end" title="Delete"
                            href="{{ route('owner.delete.book', $book->id) }}">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </div>
                </div>
            @endforeach
        </div>


    </div>
    <div style="height: 300px">
        {{-- {{ $books->links() }} --}}
    </div>
@endsection
