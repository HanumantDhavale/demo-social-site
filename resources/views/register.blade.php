@extends('layouts.main')
@section('title')
    <title>Register</title>
@endsection
@section('css')

@endsection
@section('content')
    <div class="row align-items-center" style="min-height: 80vh;">
        <div class="col-md"></div>
        <div class="col-md-5">
            <div class="card my-3">
                <div class="card-body">
                    <h5 class="card-title">Register</h5>
                    <hr>
                    <form action="{{route('auth.register.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="first_name">First name</label>
                            <input type="text" name="first_name"
                                   class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                                   placeholder="First name" value="{{old('first_name')}}">
                            @error('first_name')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last name</label>
                            <input type="text" name="last_name"
                                   class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                                   placeholder="Last name" value="{{old('last_name')}}">
                            @error('last_name')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
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
                        @include('component.messages')
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                        <div class="pt-3">
                            I have an <a href="{{route('auth.login')}}">account</a>?
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
