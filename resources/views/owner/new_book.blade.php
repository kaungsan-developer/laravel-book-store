@extends('owner.master')

@section('page-title', 'Add New Book')
@section('active-add-book', 'active')
@section('content')
    <div class="container py-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        <div class="dashboard-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="text-primary m-0">
                    <i class="fas fa-plus-circle me-2"></i>Add New Book
                </h4>
            </div>

            <form action="{{ route('add_book') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">
                    <!-- Image Upload Section -->
                    <div class="col-12 col-lg-6">
                        <div class="text-center mb-3">
                            <div class="position-relative d-inline-block">
                                <div class="mb-3"
                                    style="width: 200px; height: 250px; overflow: hidden; border-radius: 10px; border: 2px dashed #dee2e6; background: #f8f9fa; margin: auto; @error('book_image') border-color: #ff0000; @enderror">

                                    <img src="" alt="Book Preview" id="output" class="img-fluid w-100 h-100"
                                        style="object-fit: contain;">

                                </div>
                                @error('book_image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                                <div class="mt-3">

                                    <label for="book_image" class="btn btn-outline-primary">
                                        <i class="fas fa-camera me-2"></i>Choose Image
                                    </label>
                                    <input type="file" id="book_image" name="book_image" class="d-none"
                                        onchange="loadFile(event)">
                                </div>

                                @error('book_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Book Details Section -->
                    <div class="col-12 col-lg-6">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Book's Name</label>
                                <input type="text" class="form-control @error('book_name') is-invalid @enderror"
                                    name="book_name" placeholder="Enter book name" value="{{ old('book_name') }}">
                                @error('book_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Author</label>
                                <input type="text" class="form-control @error('aurthor') is-invalid @enderror"
                                    name="aurthor" placeholder="Enter author name" value="{{ old('aurthor') }}">
                                @error('aurthor')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>



                            <div class="col-12 col-md-6 col-lg-6">
                                <label class="form-label">Price</label>
                                <div class="input-group">

                                    <input type="number" class="form-control @error('price') is-invalid @enderror"
                                        name="price" placeholder="0.00" value="{{ old('price') }}">
                                    <span class="input-group-text">MMK</span>
                                </div>
                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6 col-lg-6">
                                <label class="form-label">In Stock</label>
                                <input type="number" class="form-control @error('count') is-invalid @enderror"
                                    name="count" placeholder="Enter quantity" value="{{ old('count') }}">
                                @error('count')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Category</label>
                                <select class="form-select @error('category_id') is-invalid @enderror" size="5"
                                    aria-label="size 5 select example" name="category_id">
                                    <option>Select Category</option>
                                    @foreach ($categories as $index => $category)
                                        <option value=" {{ $category->id }}" name="category_id">{{ $index + 1 }}.
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Description(Optional)</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="4"
                                    placeholder="Enter book description" value="{{ old('description') }}"></textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12 text-end mt-4">
                                <button type="button" class="btn btn-light me-2">Cancel</button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus-circle me-2"></i>Add Book
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div style="height: 300px;"></div>


@endsection
@section('scripts')
    <script>
        const loadFile = function(event) {
            const output = document.getElementById('output');
            const file = event.target.files[0];
            if (file) {
                output.src = URL.createObjectURL(file);
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            }
        };
    </script>
@endsection
