@extends('layouts.main')
@section('title')
    <title>Login</title>
@endsection
@section('css')

@endsection
@section('content')
    <div class="row align-items-center" style="min-height: 80vh;">
        <div class="col-md"></div>
        <div class="col-md-5">
            <div class="card my-3">
                <div class="card-body">
                    <h5 class="card-title">Login</h5>
                    <hr>
                    <form action="{{route("auth.check")}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email"
                                   placeholder="Enter email" value="{{old('email')}}">
                            @error('email')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror" id="password"
                                   placeholder="Password" value="{{old('password')}}">
                            @error('password')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="remember_me" class="form-check-input" id="remember_me">
                            <label class="form-check-label" for="remember_me">Remember me</label>
                        </div>
                        <br>
                        @include('component.messages')
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                        <div class="pt-3">
                            I don't have an <a href="{{route('auth.register')}}">account</a>?
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md"></div>
    </div>
@endsection
@section('js')
@endsection
