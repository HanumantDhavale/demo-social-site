<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="{{route('site.home')}}">Social</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{request()->route()->getName() == "site.home"?"active" : null}}">
                <a class="nav-link" href="{{route('site.home')}}">Home</a>
            </li>
            <li class="nav-item {{request()->route()->getName() == "site.home"?"active" : null}}">
                <a class="nav-link" href="#">Link</a>
            </li>
        </ul>
        <div class="form-inline my-2 my-lg-0">
            @auth()
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="text-white">
                            {{auth()->user()->first_name}}
                            {{auth()->user()->last_name}}
                        </span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="#">Change Password</a>
                        <a class="dropdown-item" href="{{route('auth.logout')}}">Logout</a>
                    </div>
                </div>
            @else
                <a href="{{route('auth.login')}}" class="btn btn-sm btn-primary">Login</a>
            @endauth
        </div>
    </div>
</nav>
