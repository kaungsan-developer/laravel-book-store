@extends('user.master')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Order Details -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Order Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <!-- Book Image -->
                            <div class="col-md-3">
                                <img src="{{ asset('books_img_folder/book_cover7.jpg') }}" class="img-fluid rounded"
                                    alt="Book Cover">
                            </div>
                            <!-- Book Info -->
                            <div class="col-md-9">
                                <h5 class="mb-2">The Great Adventure</h5>
                                <p class="text-muted mb-1">Author: John Smith</p>
                                <div class="d-flex align-items-center mb-2">
                                    <span class="text-primary h5 mb-0">$29.00</span>
                                    <div class="input-group input-group-sm w-25 ms-3">
                                        <button class="btn btn-outline-secondary" type="button">-</button>
                                        <input type="number" class="form-control text-center" value="1"
                                            min="1">
                                        <button class="btn btn-outline-secondary" type="button">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping Information -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Shipping Information</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Address</label>
                                    <textarea class="form-control" rows="3" required></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>$29.00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping</span>
                            <span>$5.00</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Total</strong>
                            <strong>$34.00</strong>
                        </div>
                        <button class="btn btn-primary w-100">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
