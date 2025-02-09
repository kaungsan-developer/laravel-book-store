@extends('owner.master')
@section('css')
    <style>
        .book-card {
            border: none;
            transition: all 0.3s ease;

        }


        .card-body {
            border-radius: 5px;
        }


        .book-card:hover {
            transform: translateY(-5px);
        }

        .discount {
            font-size: 30px;
            font-weight: bolder;
        }
    </style>
@endsection
@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <button class="btn-close" data-bs-dismiss="alert"></button>
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <button class="btn-close" data-bs-dismiss="alert"></button>
            {{ session('error') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <button class="btn-close" data-bs-dismiss="alert"></button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif

    <!-- discount section -->

    <h3 class="mb-4 mt-5">Books To Discount

    </h3>
    @if (count($books) <= 0)
        <div class="alert alert-info text-center">
            No Books To Discount.
        </div>
    @endif

    @if (count($books) > 0)
        <div class="container mt-4">


            <form action="{{ route('owner.add.discount') }}" method="post">
                <div class="btn-group mb-3">
                    <button class="btn-secondary btn-sm btn" id="check-all-btn" type="button">Select All</button>
                    <button class="btn-secondary btn-sm btn" id="unCheck-all-btn" type="button">Unselect All</button>

                    <button class="btn btn-primary float-end btn-sm" data-bs-toggle="modal" data-bs-target="#discount-modal"
                        id="dis-all-btn" type="button">Discount</button>
                </div>
                @csrf
                <div class="row g-4 mx-auto">
                    @foreach ($books as $book)
                        <div class="col-12 col-lg-3 col-md-4 book-card">
                            <div class="card ">
                                <div class="card-body">
                                    <b class="card-title">{{ $book->name }}</b>
                                    <small class="card-text d-block">{{ $book->aurthor }}</small>
                                    <p class="card-text text-success">{{ $book->price }} MMK</p>
                                    <input type="checkbox" value="{{ $book->id }}" class="book-id float-end check-book"
                                        name="book_id[]">
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="modal" id="discount-modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title">Discount</div>
                                <button class="btn-close" data-bs-dismiss="modal" type="button"></button>

                            </div>
                            <div class="modal-body">
                                <small class="float-end text-success">Total Book:{{ count($books) }}</small>
                                <label for="discount_amount">Discount Amount</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="discount_amount">
                                    <select name="discount_type" class="input-group-text" id="test">
                                        <option value="%">%</option>
                                        <option value="MMK">MMK</option>
                                    </select>
                                </div>

                                <label for="startDate">Start Date</label>
                                <input type="datetime-local" class="form-control mb-3" name="start_date">

                                <label for="endDate">End Date</label>
                                <input type="datetime-local" class="form-control mb-3" name="end_date">

                                <button class="btn-primary btn btn-sm float-end" type="submit">Submit</button>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endif

    <div style="height: 40px"></div>
    {{-- remove discount section   --}}

    <h3>Discounted Books</h3>
    @if (count($discounted_books) <= 0)
        <div class="alert alert-info text-center">
            No Discounted Books.
        </div>
    @endif
    @if (count($discounted_books) > 0)
        <form action="{{ route('owner.remove.discount') }}" method="POST">
            @csrf

            <div class="btn-group float-end">
                <button class="btn-outline-secondary btn btn-sm" id="disc-select-all" type="button">Select
                    All</button>
                <button class="btn-secondary btn btn-sm" id="disc-unSelect-all" type="button">Unselect All</button>
                <button class="btn btn-primary btn-sm" type="submit"><small>Remove Discount</small></button>
            </div>

            <div style="height: 50px"></div>

            <div class="container">
                <div class="row g-3 mx-auto">
                    @foreach ($discounted_books as $book)
                        <div class="col-12 col-lg-3 col-md-4 book-card">
                            <div class="card">
                                <div class="card-body">
                                    <b class="card-title">{{ $book->name }}</b>
                                    <small class="card-text">{{ $book->aurthor }}</small>
                                    <p class="card-text text-danger" style="text-decoration: line-through">
                                        {{ $book->price }} MMK</p>
                                    <p class="card-text text-success">{{ $book->discounted_price }} MMK</p>
                                    <input type="checkbox" value="{{ $book->id }}"
                                        class="discounted-book-check float-end" name="discounted_book_ids[]">
                                </div>
                                <div class="card-footer">
                                    <small>{{ date('d M Y', strtotime($book->discount_start)) }} -</small>
                                    <small>{{ date('d M Y', strtotime($book->discount_end)) }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </form>
    @endif





    <div style="height: 300px"></div>



    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#unCheck-all-btn').hide();
            $('#disc-unSelect-all').hide();
            $('#check-all-btn').click(function() {
                $('.check-book').prop('checked', true);
                $(this).hide();
                $('#unCheck-all-btn').show();
            });
            $('#unCheck-all-btn').click(function() {
                console.log('uncheck all');
                $('.check-book').prop('checked', false);
                $(this).hide();
                $('#check-all-btn').show();
            });

            $('#disc-select-all').click(function() {
                $(this).hide();
                $('#disc-unSelect-all').show();
                $('.discounted-book-check').prop('checked', true)
            });
            $('#disc-unSelect-all').click(function() {
                $(this).hide();
                $('#disc-select-all').show();
                $('.discounted-book-check').prop('checked', false)
            })
        });
    </script>
@endsection
