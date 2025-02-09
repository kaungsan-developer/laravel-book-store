@extends('user.master')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            <div class="btn-close" data-bs-dismiss="alert"></div>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <div class="container py-5">

        <div class="row">
            <!-- Book Image Section -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    @if ($book->image)
                        <img src='{{ asset('books_img_folder/' . $book->image) }}' class="card-img-top" alt="Book Cover">
                    @endif


                </div>
            </div>

            <!-- Book Details Section -->
            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title mb-3">{{ $book->name }}</h2>
                        <div class="d-flex align-items-center mb-3">
                            <div class="text-warning me-2">

                                @for ($i = 1; $i <= number_format($avg_rating); $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                                @for ($i = number_format($avg_rating); $i < 5; $i++)
                                    <i class="fa-regular fa-star"></i>
                                @endfor



                            </div>
                            <span class="text-muted">({{ count($book->reviews) }} Reviews)</span>
                        </div>

                        @if ($book->discounted_price)
                            <div class=""
                                style="text-decoration: line-through;color: red; font-size: 1rem; font-weight: 600;">
                                {{ $book->price }} MMK
                            </div>
                            <div class="book-price text-success" style="font-weight: 600; font-size: 1.5rem;"
                                data-value="{{ $book->discounted_price }}" id="price">
                                {{ $book->discounted_price }} MMK
                            </div>
                        @else
                            <div class="book-price text-success" style="font-weight: 600; font-size: 1.5rem;"
                                data-value="{{ $book->price }}" id="price">
                                {{ $book->price }} MMK
                            </div>
                        @endif




                        <div class="mb-4">
                            <h5>Description:</h5>
                            <p class="text-muted">A thrilling tale of adventure and discovery that follows our
                                protagonist
                                through mysterious lands and challenging encounters. This book will keep you on the edge
                                of
                                your seat from start to finish.</p>
                        </div>

                        <div class="d-flex gap-2 mb-4">
                            <div class="input-group" style="width: 150px;">
                                <button class="btn btn-outline-secondary" id="minus-btn" type="button">-</button>
                                <input type="number" class="form-control text-center" id="qty" value="1"
                                    min="1">
                                <button class="btn btn-outline-secondary" id="plus-btn" type="button">+</button>
                            </div>
                            <form action="{{ route('add.cart', $book->id) }}" method="post">
                                @csrf
                                <input type="hidden" value="{{ $book->id }}" name="book_id">
                                <button class="btn btn-primary">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                            </form>
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#orderModal">
                                <i class="fas fa-bolt"></i> Buy Now
                            </button>
                        </div>

                        <div class="border-top pt-4">
                            <h5>Book Details:</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Author:</strong> {{ $book->aurthor }}</p>
                                    <p><strong>Publisher:</strong> Penguin Books</p>
                                </div>
                                <div class="col-md-6">
                                    {{-- <p><strong>ISBN:</strong> 978-3-16-148410-0</p>
                                    <p><strong>Pages:</strong> 384</p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reviews Section -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body">
                        <h4 class="mb-4">Customer Reviews</h4>

                        <!-- Add Review Form -->
                        <form class="mb-4" action="{{ route('user.review') }}" method="post">
                            @csrf
                            <div class="mb-3">

                                <label class="form-label">Your Rating</label>
                                <div class="text-warning ">
                                    <div class="rating">
                                        @if ($rating)
                                            @for ($i = 0; $i < $rating->rating; $i++)
                                                <input type="radio" name="rating" class="d-none star"
                                                    value={{ $i + 1 }} id="star{{ $i + 1 }}">
                                                <label for="star{{ $i + 1 }}" class="fa-solid fa-star"></label>
                                            @endfor
                                            @for ($i = $rating->rating; $i < 5; $i++)
                                                <input type="radio" name="rating" class="d-none star"
                                                    value={{ $i + 1 }} id="star{{ $i + 1 }}">
                                                <label for="star{{ $i + 1 }}" class="fa-regular fa-star"></label>
                                            @endfor
                                        @else
                                            <input type="radio" name="rating" class="d-none star" value="1"
                                                id="star1">
                                            <label for="star1" class="fa-regular fa-star"></label>
                                            <input type="radio" name="rating" class="d-none star" value="2"
                                                id="star2">
                                            <label for="star2" class="fa-regular fa-star"></label>
                                            <input type="radio" name="rating" class="d-none star" value="3"
                                                id="star3">
                                            <label for="star3" class="fa-regular fa-star"></label>
                                            <input type="radio" name="rating" class="d-none star" value="4"
                                                id="star4">
                                            <label for="star4" class="fa-regular fa-star"></label>
                                            <input type="radio" name="rating" class="d-none star" value="5"
                                                id="star5">
                                            <label for="star5" class="fa-regular fa-star"></label>
                                        @endif



                                    </div>
                                </div>
                                @error('rating')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label class="form-label">Your Review</label>
                                @guest
                                    <small class="text-danger">(You need to login to write review.)</small>
                                @endguest
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <textarea class="form-control" name="review" rows="3" placeholder="Write your review here..."></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit Review</button>


                        </form>

                        <!-- Review List -->
                        <div class="review-list">
                            @foreach ($book->reviews as $review)
                                <div class="border-bottom  mb-3">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="mb-0 @if ($review->user->id == Auth::id()) text-success @endif">
                                                {{ $review->user->name }}</h6>
                                            <div class="">
                                                @for ($i = 0; $i < $review->rating; $i++)
                                                    <i class="fas fa-star text-warning"></i>
                                                @endfor
                                                @for ($i = $review->rating; $i < 5; $i++)
                                                    <i class="fa-regular fa-star text-warning"></i>
                                                @endfor
                                            </div>

                                        </div>

                                        <small class="text-muted">{{ $review->created_at->format('d M Y') }}</small>
                                    </div>
                                    <p class="mt-2 mb-0">{{ $review->review }}</p>
                                    @if ($review->user->id == Auth::id())
                                        <div class="w-100" style="height: 50px">
                                            <a href="{{ route('review.delete', $review->id) }}"
                                                class="btn btn-danger btn-sm float-end">Delete</a>
                                        </div>
                                    @endif

                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="orderModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Order Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('user.add.order') }}" method="POST">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <input type="hidden" name="quantity" id="modal-quantity">
                    <input type="hidden" name="total_price" id="modal-total">

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name', Auth::user()->name ?? '') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" name="address" rows="3">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Note (Optional)</label>
                            <textarea class="form-control" name="note" rows="2">{{ old('note') }}</textarea>
                        </div>

                        <div class="order-summary p-3 bg-light rounded">
                            <h6 class="mb-3">Order Summary</h6>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Price:</span>
                                <span id="modal-price"></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Quantity:</span>
                                <span id="modal-qty"></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>SubTotal:</span>
                                <span id="modal-subTotal"></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Delivery Fee:</span>
                                <span>3000 MMK</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between fw-bold">
                                <span>Total:</span>
                                <span id="modal-final-total"></span>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="place-order-btn">Place Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#minus-btn').click(function() {
                var input = $('#qty')
                var value = input.val() * 1
                if (value > 1) {
                    input.val(value - 1)
                }
                var price = $('#price').data('value')
                var total = price * input.val()
                $('#price').text('$' + total + '.00')
            })

            $('#plus-btn').click(function() {
                var input = $('#qty')
                var value = input.val() * 1
                input.val(value + 1)

                var price = $('#price').data('value')
                var total = price * input.val()
                $('#price').text(total + " MMK")
            })

            $('#orderModal').on('show.bs.modal', function() {
                var qty = $('#qty').val();
                var price = $('#price').data('value') * 1;
                var totalPrice = price * qty;
                var finalTotal = totalPrice + 3000;

                $('#modal-quantity').val(qty * 1);
                $('#modal-total').val(finalTotal);
                $('#modal-price').text(price + " MMK");
                $('#modal-subTotal').text(totalPrice + " MMK");
                $('#modal-qty').text(qty);
                $('#modal-final-total').text(finalTotal + " MMK");
            })

            $('.rating input').change(function() {
                var rating = $(this).val();
                console.log(rating);
            })
            $('.fa-star').click(function() {
                if ($(this).hasClass('fa-regular')) {
                    $(this).prevAll('.fa-star').addBack().removeClass('fa-regular').addClass('fa-solid');
                } else {
                    $(this).nextAll('.fa-star').removeClass('fa-solid').addClass('fa-regular');

                }
            })
        })
    </script>
@endsection
