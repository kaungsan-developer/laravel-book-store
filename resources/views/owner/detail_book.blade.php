@extends('owner.master')

@section('all_books_active')
    active
@endsection

@section('content')
    <div style="height: 70px"></div>
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('owner.update_book', $book->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="text-center mb-3">
                        <div class="position-relative d-inline-block">
                            <div class="mb-3"
                                style="width: 200px; height: 250px; overflow: hidden; border-radius: 10px; border: 2px dashed #dee2e6; background: #f8f9fa; margin: auto; @error('book_image') border-color: red @endError">
                                <img src="{{ asset("books_img_folder/$book->image") }}" alt="Book Preview" id="output"
                                    class="img-fluid w-100 h-100" style="object-fit: contain;">
                            </div>
                            <div class="mt-3">
                                <label for="book_image" class="btn btn-outline-primary">
                                    <i class="fas fa-camera me-2"></i>Choose Image
                                </label>
                                <input type="file" id="book_image" name="book_image" class="d-none"
                                    onchange="loadFile(event)">

                            </div>
                            @error('book_image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="border p-2 mb-3">Created At : <span class="text-primary">
                            {{ $book->created_at->diffForHumans() }} </span></div>
                    <div class="border p-2 ">Updated At : <span
                            class="text-primary">{{ $book->updated_at->diffForHumans() }}
                        </span> </div>
                </div>


                <div class="col-12 col-lg-6">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Book's Name</label>
                            <input type="text" class="form-control @error('book_name') is-invalid @enderror"
                                name="book_name" placeholder="Enter book name" value="{{ old('book_name', $book->name) }}">
                            @error('book_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Author</label>
                            <input type="text" class="form-control @error('aurthor') is-invalid @enderror" name="aurthor"
                                placeholder="Enter aurthor name" value="{{ old('aurthor', $book->aurthor) }}">
                            @error('aurthor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="col-md-6">
                            <label class="form-label">Price</label>
                            <div class="input-group">

                                <input type="number" class="form-control @error('price') is-invalid @enderror"
                                    name="price" placeholder="0.00" value="{{ old('price', $book->price) }}">
                                <span class="input-group-text">MMK</span>
                            </div>
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">In Stock</label>
                            <input type="number" class="form-control @error('count') is-invalid @enderror" name="count"
                                placeholder="Enter quantity" value="{{ old('count', $book->count) }}">
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
                                    <option value=" {{ $category->id }}" name="category_id"
                                        {{ $book->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $index + 1 }}.
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="4"
                                placeholder="Enter book description">{{ old('description', $book->description) }}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                    </div>
                </div>

            </div>
            <div>
                <a href="{{ route('owner.delete.book', $book->id) }}" class="btn btn-outline-danger mt-3 mb-5">Delete</a>
                <button class="btn btn-outline-primary float-end  mt-3 mb-5" type="submit">Update</button>

            </div>

        </form>
        <div style="height: 300px"></div>
    </div>
@endsection
@section('scripts')
    <script>
        function loadFile(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('output');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
