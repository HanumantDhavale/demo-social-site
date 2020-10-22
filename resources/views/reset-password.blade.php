@extends('layouts.main')
@section('title')
    <title>Reset password</title>
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
                    <h5 class="card-title">Reset password</h5>
                    <hr>
                    <form action="{{route("auth.set.password")}}"
                          method="post">
                        @csrf
                        <input type="hidden"
                               name="a"
                               value="{{request('a')}}">
                        <input type="hidden"
                               name="t"
                               value="{{request('t')}}">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password"
                                   name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   id="password"
                                   placeholder="Password">
                            @error('password')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password"
                                   name="confirm_password"
                                   class="form-control @error('confirm_password') is-invalid @enderror"
                                   id="confirm_password"
                                   placeholder="Confirm Password">
                            @error('confirm_password')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <br>
                        @include('component.messages')
                        <div class="text-center">
                            <button type="submit"
                                    class="btn btn-primary">Reset
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
