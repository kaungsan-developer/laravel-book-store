@extends('user.master')
@section('content')
    <div class="container">
        <h2 class="my-5">My Cart
            @if (count($user->cartBooks) > 0)
                <button class="btn btn-secondary float-end " data-bs-toggle="modal" data-bs-target="#cart-modal">Buy
                    All</button>
            @endif
        </h2>
        @if (count($user->cartBooks) <= 0)
            <div class="alert alert-info text-center">
                Your Cart Is Empty.
            </div>
        @endif


        <div class="row g-4 mx-auto">
            @if ($user->cartBooks)
                @foreach ($user->cartBooks as $book)
                    <div class="col-md-6 col-12 col-lg-3">

                        <div class="card book-card">
                            @if ($book->image)
                                <img src="{{ asset("books_img_folder/$book->image") }}" class="card-img-top book-img"
                                    alt="Book cover">
                            @endif
                            <a href="" style="text-decoration: none; color: black">
                                <div class="card-body">
                                    @if ($book->category)
                                        <span class="badge bg-secondary mb-2">{{ $book->category->name }}</span>
                                    @else
                                        <span class="badge bg-danger mb-2">No Category</span>
                                    @endif

                                    <h5 class="book-title">{{ $book->name }}</h5>
                                    <small class="book-author mb-2">{{ $book->aurthor }}</small>
                                    @if ($book->discounted_price)
                                        <div class="" style="text-decoration: line-through;color: red;">
                                            {{ $book->price }} MMK
                                        </div>
                                        <div class="book-price" data-value="{{ $book->discounted_price }}" id="price">
                                            {{ $book->discounted_price }} MMK
                                        </div>
                                    @else
                                        <div class="book-price" data-value="{{ $book->price }}" id="price">
                                            {{ $book->price }} MMK
                                        </div>
                                    @endif


                                </div>
                            </a>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between align-items-center">
                                    <a type="submit" class="btn btn-danger btn-sm"
                                        href="{{ route('cart.delete', $book->pivot->id) }}">Remove
                                    </a>
                                    <button class="btn btn-outline-warning btn-sm">Buy Now</button>
                                </div>

                            </div>
                        </div>





                    </div>
                @endforeach
            @endif

        </div>
    </div>

    <div style="height: 100px"></div>



    <div class="modal" id="cart-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Place Order
                    </h5>
                    <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close button"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.add.order') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ Auth::id() }}">
                        <label for="name">Name</label>
                        <input type="text " class="form-control mb-3" name="name" value="{{ Auth::user()->name }}">

                        <label for="phone_number">Phone No.</label>
                        <input type="text" class="form-control mb-3" name="phone" placeholder="Phone Number">

                        <label for="address">Address</label>
                        <input type="text" class="form-control mb-3" name="address">

                        <label for="note">Note(optional.)</label>
                        <textarea name="note" class="form-control mb-3" id="" rows="3"></textarea>

                        <p class="modal-title">
                            Order Info
                        </p>

                        <div class="mt-2 p-3" style="border: 1px solid rgba(0, 0, 0, 0.2)">

                            <input type="hidden" value="" name="total_price" id="total_price">

                            @foreach ($user->cartBooks as $index => $book)
                                <input type="hidden" name="book_id[]" value="{{ $book->id }}">
                                <input type="hidden" name="cartBookIds[]" value="{{ $book->pivot->id }}">

                                <div class="d-flex justify-content-between">
                                    <p>{{ $index + 1 }}.{{ $book->name }}


                                    </p>
                                    <input type="hidden" value="{{ $book->price }}" class="price-input">
                                    <input type="number" name="quantity[]" style="width: 40px; height: 25px" min="1"
                                        value="1" class="quantity-input">
                                    @if ($book->discounted_price)
                                        <p class="price" id="price">
                                            {{ $book->discounted_price }} MMK
                                        </p>
                                    @else
                                        <p class="price" id="price">
                                            {{ $book->price }} MMK
                                        </p>
                                    @endif


                                </div>
                            @endforeach

                            <hr>
                            <div class="d-flex justify-content-between">
                                <p>Sub Total</p>
                                <p id="total_price_text" class="total_price_text"></p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p>Delivery Fee</p>
                                <p>+3000 MMK</p>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <p>Total:</p>
                                <b id="final_total"> </b>
                            </div>



                        </div>
                        <button class="btn-primary btn float-end mt-3" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            console.log($('.tt').val())
            var total_price = 0;
            $('.price').each(function() {
                total_price += parseInt($(this).text().replace('MMK', ''))
            })
            $('#total_price_text').text(total_price + " MMK")
            $('#final_total').text(total_price + 3000 + " MMK")
            $('#total_price').val(total_price)


            $('.quantity-input').click(function() {
                var price = $(this).parent().find('.price-input').val()

                var multiPrice = price * $(this).val()

                $(this).parent().find('#price').text(multiPrice + ' MMK')


                var total_price = 0;
                $('.price').each(function() {
                    total_price += parseInt($(this).text().replace('MMK', ''))
                })
                $('#total_price_text').text(total_price + ' MMK')

                $('#final_total').text(total_price + 3000 + " MMK")

                $('#total_price').val(total_price)
            })
        });
    </script>
@endsection
