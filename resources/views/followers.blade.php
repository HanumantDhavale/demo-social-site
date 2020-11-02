@extends('layouts.main')
@section('title')
    <title>Followers</title>
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
                    <h5 class="card-title">My Followers</h5>
                    <hr>
                    <ul class="list-group">
                        @foreach(auth()->user()->followings as $following)
                            <li class="list-group-item">
                                <a href="{{route('user.profile', $following->id)}}">
                                    {{$following->first_name}} {{$following->last_name}}
                                </a>
                                @if($following->followings()->where(['follower_id' => auth()->user()->id])->count())
                                    <a class="btn btn-sm btn-danger float-right"
                                       href="{{route('unfollow.user', $following->id)}}">
                                        Unfollow
                                    </a>
                                @else
                                    <a class="btn btn-sm btn-success float-right"
                                       href="{{route('follow.user', $following->id)}}">
                                        Follow
                                    </a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
