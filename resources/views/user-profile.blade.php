@extends('layouts.main')
@section('title')
    <title>{{$user->first_name}} {{$user->last_name}}: Profile</title>
@endsection
@section('css')

@endsection
@section('content')
    <div class="row mt-4">
        <div class="col-md-3">
            @include('component.user-profile-menu')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Profile Details</h5>
                    <hr>
                    Name: <b>{{$user->first_name}} {{$user->last_name}}</b>
                    <br>
                    Gender: <b>{{$user->gender}}</b>
                    <br>
                    Date Of Birth: <b>{{$user->birthdate}}</b>
                    @auth()
                        @if($user->followings()->where(['follower_id' => auth()->user()->id])->count())
                            <div class="text-center p-4">
                                <a class="btn-sm btn btn-danger"
                                   href="{{route('unfollow.user', $user->id)}}">Unfollow {{$user->first_name}}</a>
                            </div>
                        @else
                            <div class="text-center p-4">
                                <a class="btn-sm btn btn-success"
                                   href="{{route('follow.user', $user->id)}}">Follow {{$user->first_name}}</a>
                            </div>
                        @endif

                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
