@extends('owner.master')

@section('profile_active')
    active
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-6 bg-danger">
                <div style="height: 100px"></div>
            </div>
            <div class="col col-6">
                <form action="">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" name="name" id="name" placeholder="New Name" class="form-control">
                        <label for="name">{{ Auth::user()->name }}</label>
                    </div>

                    <div class="form-floating">
                        <input type="emial" class="form-control" name="email" placeholder="email">
                        <label for="email">{{ Auth::user()->email }}</label>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
