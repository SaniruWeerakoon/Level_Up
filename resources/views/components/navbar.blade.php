<nav class="navbar navbar-expand-lg navbar-light sticky-top" style="backdrop-filter: blur(5px);"
     data-navbar-on-scroll="data-navbar-on-scroll">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}"><img src="/images/new_logo.png" height="35"
                                                           alt="logo"/>&nbsp;<span
                style="font-size: 28px; font-weight:500"> </span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon">
                    </span></button>
        <div class="collapse navbar-collapse  border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" aria-current="page" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item"><a class="nav-link" aria-current="page"
                                        href="{{ route('courses.index') }}">Courses</a></li>
                <li class="nav-item"><a class="nav-link" aria-current="page" href="{{route('quiz.index')}}">Quizzes</a>
                </li>
                <li class="nav-item"><a class="nav-link" aria-current="page" href="{{route('tutorial.index')}}">Tutorials</a></li>
            </ul>
            <div class="d-flex ms-lg-4">
                @guest
                    @if (Route::has('login'))
                        <a class="btn btn-secondary-outline" href="{{ route('login') }}">Sign In</a>
                    @endif

                    @if (Route::has('register'))
                        <a class="btn btn-warning ms-3" href="{{ route('register') }}">Sign Up</a>
                    @endif
                @else
                    <div class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                {{ __('Profile') }}
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
</nav>
