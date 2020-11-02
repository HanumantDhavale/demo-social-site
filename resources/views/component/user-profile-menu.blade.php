<style>
    .list-group-item.active > a {
        color: #fff;
    }
</style>

<ul class="list-group">
    <li class="list-group-item {{request()->route()->getName() == "user.profile"?"active" : null}}">
        <a href="{{route('user.profile', $user->id)}}">Profile</a>
    </li>
    <li class="list-group-item {{request()->route()->getName() == "user.posts"?"active" : null}}">
        <a href="{{route('user.profile', $user->id)}}">Posts</a>
    </li>
    <li class="list-group-item {{request()->route()->getName() == "user.followers"?"active" : null}}">
        <a href="{{route('user.followers', $user->id)}}">Followers</a>
    </li>
    <li class="list-group-item {{request()->route()->getName() == "user.followings"?"active" : null}}">
        <a href="{{route('user.followings', $user->id)}}">Followings</a>
    </li>
</ul>
