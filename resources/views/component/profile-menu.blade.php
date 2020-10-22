<style>
    .list-group-item.active > a {
        color: #fff;
    }
</style>

<ul class="list-group">
    <li class="list-group-item {{request()->route()->getName() == "account.profile"?"active" : null}}">
        <a href="{{route('account.profile')}}">Profile</a>
    </li>
    <li class="list-group-item {{request()->route()->getName() == "account.change.password"?"active" : null}}">
        <a href="{{route('account.password')}}">Change Password</a>
    </li>
    <li class="list-group-item">
        <a href="{{route('auth.logout')}}">Logout</a>
    </li>
</ul>
