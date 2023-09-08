<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <!-- Bootstrap JavaScript -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="" />
    <title>LevelUp</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/site.webmanifest">
    <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="/favicon/browserconfig.xml">
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/styles.css'])

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="/images/logo_transparent.png" alt="logo" width="45px"
                    height="56px" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Quizzes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tutorials</a>
                    </li>
                    {{-- <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Dropdown
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li>
                  <a class="dropdown-item" href="#">Something else here</a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a
                class="nav-link disabled"
                href="#"
                tabindex="-1"
                aria-disabled="true"
                >Disabled</a
              >
            </li> --}}
                </ul>
                @if (Route::has('login'))
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                        @auth
                            <a href="{{ url('/profile') }}"
                                class="m-4 bg-primary text-white font-weight-bold rounded px-3 py-2 "
                                style="color:aliceblue">Profile</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="my-4 mx-2  bg-primary text-white font-weight-bold rounded px-3 py-2 "
                                style="color:aliceblue">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="m-2 bg-primary text-white font-weight-bold rounded px-3 py-2 "
                                    style="color:aliceblue">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>
    <div class="intro mt-3">
        <p>
            Welcome to LevelUp: Elevate Your Learning Journey <br />
            <i> Where Curiosity Meets Mastery </i>
        </p>
        <br />
        <div class="d-flex justify-content-center align-items-center">
            <form class="d-flex search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                <button class="btn btn-success" type="submit">Search</button>
            </form>
        </div>
        <br />
        <p>
            Unlock your full potential with LevelUp, the ultimate destination for
            online learning. Embark on a transformative educational journey that
            transcends boundaries and empowers you to reach new heights.
        </p>
    </div>
    <p style="font-size: 30px; margin-left: 50px"><b>Top Rated</b></p>
    <div class="course">
        <div class="card" style="width: 18rem">
            <img class="card-img-top" src="/images/algebra.png" alt="Card image cap" />
            <div class="card-body">
                <h5 class="card-title">Advanced Algebra</h5>
                <p class="card-text">
                    &bull; Difficulty : Intermediate<br />
                    &bull; Ratings : 4.5 &#9733/ 5<br />
                    &bull; Video Lessons<br />
                    &bull; Completed by : 70 Students<br />
                </p>
                <a href="#" class="btn btn-primary">Learn</a>
            </div>
        </div>
        <div class="card" style="width: 18rem">
            <img class="card-img-top" src="/images/chemistry.jfif" alt="Card image cap" />
            <div class="card-body">
                <h5 class="card-title">Organic Chemistry</h5>
                <p class="card-text">
                    &bull; Difficulty : Beginner<br />
                    &bull; Ratings : 4.6 &#9733/ 5<br />
                    &bull; Text Lessons<br />
                    &bull; Completed by : 50 Students<br />
                </p>
                <a href="#" class="btn btn-primary">Learn</a>
            </div>
        </div>
        <div class="card" style="width: 18rem">
            <img class="card-img-top" src="/images/thermodynamics.png" alt="Card image cap" />
            <div class="card-body">
                <h5 class="card-title">Thermodynamics</h5>
                <p class="card-text">
                    &bull; Difficulty : Intermediate<br />
                    &bull; Ratings : 4.3 &#9733/ 5<br />
                    &bull; Video Lessons<br />
                    &bull; Completed by : 90 Students<br />
                </p>
                <a href="#" class="btn btn-primary">Learn</a>
            </div>
        </div>
    </div>
    <p style="font-size: 30px; margin-left: 50px"><b>Top Quizzes</b></p>

    <div class="quiz">
        <div class="card" style="width: 18rem">
            <img class="card-img-top" src="/images/javascript.png" alt="Card image cap" />
            <div class="card-body">
                <h5 class="card-title">Javascript</h5>
                <p class="card-text">
                    &bull; Difficulty : Beginner<br />
                    &bull; Ratings : 4.8 &#9733/ 5<br />
                    &bull; MCQ<br />
                    &bull; Completed by : 120 Students<br />
                </p>
                <a href="#" class="btn btn-primary">Learn</a>
            </div>
        </div>
        <div class="card" style="width: 18rem">
            <img class="card-img-top" src="/images/emwaves.jfif" alt="Card image cap" />
            <div class="card-body">
                <h5 class="card-title">Electromagnetic Waves</h5>
                <p class="card-text">
                    &bull; Difficulty : Beginner<br />
                    &bull; Ratings : 4.9 &#9733/ 5<br />
                    &bull; MCQ<br />
                    &bull; Completed by : 130 Students<br />
                </p>
                <a href="#" class="btn btn-primary">Learn</a>
            </div>
        </div>
        <div class="card" style="width: 18rem">
            <img class="card-img-top" src="/images/matrices.jfif" alt="Card image cap" />
            <div class="card-body">
                <h5 class="card-title">3 x 3 Matrix</h5>
                <p class="card-text">
                    &bull; Difficulty : Intermediate<br />
                    &bull; Ratings : 4.0 &#9733/ 5<br />
                    &bull; MCQ<br />
                    &bull; Completed by : 180 Students<br />
                </p>
                <a href="#" class="btn btn-primary">Learn</a>
            </div>
        </div>
    </div>
    
    <footer class="d-flex bg-dark flex-wrap justify-content-between align-items-center py-3 mt-4 border-top">
        <p class="col-md-4 px-3 text-white mb-0 ">
            © 2023 LevelUp, Inc
        </p>

        <a href="{{url('/')}}"
            class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <img src="/images/logo_transparent.png" alt="logo"  />
        </a>

        <ul class="nav  col-md-4 justify-content-end">
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link px-2  ">Home</a>
            </li>3
            <li class="nav-item">
                <a href="#" class="nav-link px-2 ">Courses</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link px-2 ">Quizzes</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link px-2 ">About Us</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link px-2 ">FAQ</a>
            </li>
        </ul>
    </footer>

</body>

</html>
