<style>
    .list-group-item.active > a {
        color: #fff;
    }
</style>

<ul class="list-group">
    <li class="list-group-item {{request()->route()->getName() == "account.profile"?"active" : null}}">
        <a href="{{route('account.profile')}}">Profile</a>
    </li>
    <li class="list-group-item {{request()->route()->getName() == "account.password"?"active" : null}}">
        <a href="{{route('account.password')}}">Change Password</a>
    </li>
    <li class="list-group-item {{request()->route()->getName() == "account.posts"?"active" : null}}">
        <a href="{{route('account.posts')}}">Posts</a>
    </li>
    <li class="list-group-item {{request()->route()->getName() == "account.followers"?"active" : null}}">
        <a href="{{route('account.followers')}}">Followers</a>
    </li>
    <li class="list-group-item {{request()->route()->getName() == "account.followings"?"active" : null}}">
        <a href="{{route('account.followings')}}">Followings</a>
    </li>
    <li class="list-group-item">
        <a href="{{route('auth.logout')}}">Logout</a>
    </li>
</ul>
