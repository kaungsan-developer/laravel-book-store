@extends('user.master')
@section('content')
    <div class="container py-5">
        <div class="row">
            <!-- Order Summary -->
            <div class="col-md-4 order-md-2 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-primary">Order Summary</span>
                            <span class="badge bg-primary rounded-pill">1</span>
                        </h4>
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0">Book Title</h6>
                                    <small class="text-muted">Brief description</small>
                                </div>
                                <span class="text-muted">$29.99</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total (USD)</span>
                                <strong>$29.99</strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Payment Form -->
            <div class="col-md-8 order-md-1">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3">Billing Information</h4>
                        <form>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label for="firstName" class="form-label">First name</label>
                                    <input type="text" class="form-control" id="firstName" required>
                                </div>

                                <div class="col-sm-6">
                                    <label for="lastName" class="form-label">Last name</label>
                                    <input type="text" class="form-control" id="lastName" required>
                                </div>

                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="you@example.com"
                                        required>
                                </div>

                                <div class="col-12">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="zip" class="form-label">Zip Code</label>
                                    <input type="text" class="form-control" id="zip" required>
                                </div>
                            </div>

                            <hr class="my-4">

                            <h4 class="mb-3">Payment Method</h4>

                            <div class="my-3">
                                <div class="form-check">
                                    <input id="credit" name="paymentMethod" type="radio" class="form-check-input"
                                        checked required>
                                    <label class="form-check-label" for="credit">Credit card</label>
                                </div>
                                <div class="form-check">
                                    <input id="debit" name="paymentMethod" type="radio" class="form-check-input"
                                        required>
                                    <label class="form-check-label" for="debit">Debit card</label>
                                </div>
                                <div class="form-check">
                                    <input id="paypal" name="paymentMethod" type="radio" class="form-check-input"
                                        required>
                                    <label class="form-check-label" for="paypal">PayPal</label>
                                </div>
                            </div>

                            <div class="row gy-3">
                                <div class="col-md-6">
                                    <label for="cc-name" class="form-label">Name on card</label>
                                    <input type="text" class="form-control" id="cc-name" required>
                                    <small class="text-muted">Full name as displayed on card</small>
                                </div>

                                <div class="col-md-6">
                                    <label for="cc-number" class="form-label">Card number</label>
                                    <input type="text" class="form-control" id="cc-number" required>
                                </div>

                                <div class="col-md-3">
                                    <label for="cc-expiration" class="form-label">Expiration</label>
                                    <input type="text" class="form-control" id="cc-expiration" required>
                                </div>

                                <div class="col-md-3">
                                    <label for="cc-cvv" class="form-label">CVV</label>
                                    <input type="text" class="form-control" id="cc-cvv" required>
                                </div>
                            </div>

                            <hr class="my-4">

                            <button class="w-100 btn btn-primary btn-lg" type="submit">Place Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

        })
    </script>
@endsection
