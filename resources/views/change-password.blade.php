@extends('layouts.main')
@section('title')
    <title>Change password</title>
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
                    <h5 class="card-title">Change password</h5>
                    <hr>
                    <form action="{{route('account.password.update')}}"
                          method="post">
                        @csrf
                        <div class="form-group">
                            <label for="current_password">Current password</label>
                            <input type="password"
                                   name="current_password"
                                   class="form-control @error('current_password') is-invalid @enderror"
                                   id="current_password"
                                   placeholder="********">
                            @error('current_password')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="new_password">New password</label>
                            <input type="password"
                                   name="new_password"
                                   class="form-control @error('new_password') is-invalid @enderror"
                                   id="new_password"
                                   placeholder="********">
                            @error('new_password')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm password</label>
                            <input type="password"
                                   name="confirm_password"
                                   class="form-control @error('confirm_password') is-invalid @enderror"
                                   id="confirm_password"
                                   placeholder="********">
                            @error('confirm_password')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        @include('component.messages')
                        <div class="text-center">
                            <button type="submit"
                                    class="btn btn-primary">
                                Update Password
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
