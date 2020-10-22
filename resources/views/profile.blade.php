@extends('layouts.main')
@section('title')
    <title>Profile</title>
@endsection
@section('css')

@endsection
@section('content')
    <div class="row mt-4">
        <div class="col-md-3">
            @include('component.profile-menu')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Profile</h5>
                    <hr>
                    <form action="{{route('account.profile.update')}}"
                          method="post">
                        @csrf
                        <div class="form-group">
                            <label for="first_name">First name</label>
                            <input type="text"
                                   name="first_name"
                                   class="form-control @error('first_name') is-invalid @enderror"
                                   id="first_name"
                                   placeholder="First name"
                                   value="{{old('first_name') ?? auth()->user()->first_name}}">
                            @error('first_name')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last name</label>
                            <input type="text"
                                   name="last_name"
                                   class="form-control @error('last_name') is-invalid @enderror"
                                   id="last_name"
                                   placeholder="Last name"
                                   value="{{old('last_name') ?? auth()->user()->last_name}}">
                            @error('last_name')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="text"
                                   name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   id="email"
                                   placeholder="Enter email"
                                   value="{{old('email')  ?? auth()->user()->email}}">
                            @error('email')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        @include('component.messages')
                        <div class="text-center">
                            <button type="submit"
                                    class="btn btn-primary">
                                Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
