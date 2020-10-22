@extends('layouts.main')
@section('title')
    <title>Forgot password</title>
@endsection
@section('css')

@endsection
@section('content')
    <div class="row align-items-center"
         style="min-height: 80vh;">
        <div class="col-md"></div>
        <div class="col-md-5">
            <div class="card my-3">
                <div class="card-body">
                    <h5 class="card-title">Send reset link</h5>
                    <hr>
                    <form action="{{route("auth.reset.link")}}"
                          method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="text"
                                   name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   id="email"
                                   placeholder="Enter email"
                                   value="{{old('email')}}">
                            @error('email')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <br>
                        @include('component.messages')
                        <div class="text-center">
                            <button type="submit"
                                    class="btn btn-primary">Generate link
                            </button>
                        </div>
                        <div class="pt-3 text-center">
                            <a href="{{route('auth.login')}}">Login</a>
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
