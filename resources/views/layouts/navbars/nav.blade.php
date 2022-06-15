<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a href="{{route('home')}}" class="navbar-brand" role="button">Assessment</a>
      <a href="{{route('api-fetch')}}" class="navbar-brand" role="button">API</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
        <div class="navbar-nav gap-2 align-items-center">
            @auth
                <a role="button" class="text-white text-decoration-none"> Hello {{Auth::user()->name }}!</a>
                <form action="{{route("logout")}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-info text-white" aria-current="page" >Logout</button>
                </form>
            @else
                <a class="nav-link active" aria-current="page" href="{{route("register")}}">Register</a>
                <a class="nav-link" href="{{route("login")}}">Log In</a>
            @endauth
        </div>
      </div>
    </div>
</nav>