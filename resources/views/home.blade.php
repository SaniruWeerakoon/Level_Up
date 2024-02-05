<!DOCTYPE html>
<html lang="en-US">


{{-- updated the logo therofre need to changes app.blade and favicon  --}}


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/images/favicon/site.webmanifest">
    <link rel="mask-icon" href="/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/images/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="/images/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <title>LevelUp</title>


    @vite(['resources/css/home.css'])
</head>

<body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <nav class="navbar navbar-expand-lg navbar-light sticky-top" style="backdrop-filter: blur(5px);"
            data-navbar-on-scroll="data-navbar-on-scroll">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}"><img src="/images/new_logo.png" height="35"
                        alt="logo" />&nbsp;<span style="font-size: 28px; font-weight:500"> </span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon">
                    </span></button>
                <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" aria-current="page"
                                href="{{ route('courses.index') }}">Courses</a></li>
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="{{route('quiz.index')}}">Quizzes</a></li>
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="#">Tutorials</a></li>
                    </ul>
                    <div class="d-flex ms-lg-4">
                        @if (Route::has('login'))
                            <div>
                                @auth
                                    <a class="btn btn-warning ms-3" href="{{ url('/profile') }}">Profile&nbsp;&nbsp;<i
                                            class="fas fa-user"></i> </a>
                                @else
                                    <a class="btn btn-secondary-outline" href="{{ route('login') }}">Sign In</a>

                                    @if (Route::has('register'))
                                        <a class="btn btn-warning ms-3" href="{{ route('register') }}">Sign Up</a>

                                </div>
                            @endif
                        @endauth
                    </div>
                    @endif


                </div>
            </div>
        </nav>
        <section class="pt-7">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 text-md-start text-center py-6">
                        <p class="mb-4 fs-9 fw-bold" style="font-weight: 500;">Elevate Your Learning Journey</p>
                        <p class="mb-6 lead text-secondary">Courses, quizzes, tutorials, all<br
                                class="d-none d-xl-block" />in one place! The most intuitive way to learn.</p>
                        <div class="text-center text-md-start">
                            <a class="btn btn-warning me-3 btn-lg" href="{{ route('courses.index') }}"
                                role="button">Get started</a>

                        </div>
                    </div>
                    <div class="col-md-6 text-end"><img class="pt-7 pt-md-0 img-fluid" src="images/hero-img.png"
                            alt="" /></div>
                </div>
            </div>
        </section>


        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="pt-5 pt-md-9 mb-6" id="feature">

            <div class="bg-holder z-index--1 bottom-0 d-none d-lg-block"
                style="background-image:url(images/shape.png);opacity:.6;">
            </div>
            <!--/.bg-holder-->

            <div class="container">
                <h1 class="fs-9 fw-bold mb-4 text-center">Discover the Power of <br class="d-none d-xl-block" />LevelUp
                </h1>
                <div class="row">

                    <div class="col-lg-3 col-sm-6 mb-2">
                        <img class="mb-3 ms-n3" src="images/interactive.jfif" width="75" alt="Feature" />
                        <h4 class="mb-3">Interactive Learning Content</h4>
                        <p class="mb-0 fw-medium text-secondary">Dynamic content that goes beyond traditional lectures.
                        </p>
                    </div>
                    <div class="col-lg-3 col-sm-6 mb-2">
                        <img class="mb-3 ms-n3" src="images/books.png" width="75" alt="Feature" />
                        <h4 class="mb-3">Diverse Course <br />Catalog</h4>
                        <p class="mb-0 fw-medium text-secondary">Extensive selection of courses across various subjects
                        </p>
                    </div>
                    <div class="col-lg-3 col-sm-6 mb-2">
                        <img class="mb-3 ms-n3" src="images/personalized_icon.png" width="75" alt="Feature" />
                        <h4 class="mb-3">Personalized Learning Paths</h4>
                        <p class="mb-0 fw-medium text-secondary"> Tailor your educational experience
                        </p>
                    </div>

                    <div class="col-lg-3 col-sm-6 mb-2">
                        <img class="mb-3 ms-n3" src="images/hat.png" width="75" alt="Feature" />
                        <h4 class="mb-3">Certified Instructors and Vendors</h4>
                        <p class="mb-0 fw-medium text-secondary">Learn from the best with confidence.</p>
                    </div>
                </div>
                <div class="text-center"><a class="btn btn-warning" href="{{ route('register') }}"
                        role="button">SIGN UP NOW</a>
                </div>
            </div><!-- end of .container-->

        </section>
        <!-- <section> close ============================-->
        <!-- ============================================-->
        \<!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="pt-5" id="marketing">

            <div class="container">
                <h1 class="fw-bold fs-6 mb-3">Top Rated</h1>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card" style="width: 15rem;">
                            <img class="card-img-top" style="height: 150px; object-fit: cover;"
                                src="/images/course_img/algebra.png" alt="Card image cap" />
                            <div class="card-body ps-0">
                                <p class="text-secondary">By <a class="fw-bold text-decoration-none me-1"
                                        href="#">Prof. Derantha</a>|<span class="ms-1">03 November 2025</span>
                                </p>
                                <h4 class="fw-bold">Advanced Algebra</h4>
                                <p class="card-text">
                                    &bull; Difficulty : Intermediate<br />
                                    &bull; Ratings : 4.5 &#9733;/ 5<br />
                                    &bull; Video Lessons<br />
                                    &bull; Completed by : 70 Students<br />
                                </p>
                                <a href="#" class="btn btn-primary">Learn</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card" style="width: 15rem;max-width: 100%;height: 100%;border-radius: 10px;">
                            <img class="card-img-top" style="height: 150px; object-fit: cover;"
                                src="/images/course_img/chemistry.jfif" alt="Card image cap" />
                            <div class="card-body ps-0">
                                <p class="text-secondary">By <a class="fw-bold text-decoration-none me-1"
                                        href="#">Prof. Derantha</a>|<span class="ms-1">03 November 2025</span>
                                </p>
                                <h4 class="fw-bold">Organic Chemistry</h4>
                                <p class="card-text">
                                    &bull; Difficulty : Beginner<br />
                                    &bull; Ratings : 4.6 &#9733;/ 5<br />
                                    &bull; Text Lessons<br />
                                    &bull; Completed by : 50 Students<br />
                                </p>
                                <a href="#" class="btn btn-primary">Learn</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4" style="width: 15rem">
                        <div class="card"><img class="card-img-top" style="height: 150px; object-fit: cover;"
                                src="/images/course_img/thermodynamics.png" alt="Card image cap" />
                            <div class="card-body ps-0">
                                <p class="text-secondary">By <a class="fw-bold text-decoration-none me-1"
                                        href="#">Prof. Derantha</a>|<span class="ms-1">03 November 2025</span>
                                </p>
                                <h4 class="fw-bold">Thermodynamics</h4>
                                <p class="card-text">
                                    &bull; Difficulty : Intermediate<br />
                                    &bull; Ratings : 4.3 &#9733;/ 5<br />
                                    &bull; Video Lessons<br />
                                    &bull; Completed by : 90 Students<br />
                                </p>
                                <a href="#" class="btn btn-primary">Learn</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end of .container-->

        </section>
        <!-- <section> close ============================-->
        <!-- ============================================-->

        <footer>
            <!-- ============================================-->
            <!-- <section> begin ============================-->
            <section class="pb-2 pb-lg-5">
                <div class="container">
                    <div class="row border-top border-top-secondary pt-7">
                        <div class="col-lg-3 col-md-6 mb-4 mb-md-6 mb-lg-0 mb-sm-2 order-1 order-md-1 order-lg-1">
                            <img class="mb-4" src="/images/new_logo.png" width="200" alt="" />
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0 order-3 order-md-3 order-lg-2">
                            <p class="fs-2 mb-lg-4">Quick Links</p>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-1"><a class="link-900 text-secondary text-decoration-none"
                                        href="#!">About us</a></li>
                                <li class="mb-1"><a class="link-900 text-secondary text-decoration-none"
                                        href="#!">Blog</a></li>
                                <li class="mb-1"><a class="link-900 text-secondary text-decoration-none"
                                        href="#!">Contact</a></li>
                                <li class="mb-1"><a class="link-900 text-secondary text-decoration-none"
                                        href="#!">FAQ</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0 order-4 order-md-4 order-lg-3">
                            <p class="fs-2 mb-lg-4">Legal Information</p>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-1"><a class="link-900 text-secondary text-decoration-none"
                                        href="#!">Disclaimer</a></li>
                                <li class="mb-1"><a class="link-900 text-secondary text-decoration-none"
                                        href="#!">Financing</a></li>
                                <li class="mb-1"><a class="link-900 text-secondary text-decoration-none"
                                        href="#!">Privacy Policy</a></li>
                                <li class="mb-1"><a class="link-900 text-secondary text-decoration-none"
                                        href="#!">Terms of Service</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-md-6 col-6 mb-4 mb-lg-0 order-2 order-md-2 order-lg-4">
                            <p class="fs-2 mb-lg-4">Subscribe to our Monthly Newsletter</p>
                            <form class="mb-3">
                                <input class="form-control" type="email" placeholder="Enter your email"
                                    aria-label="Email" />
                            </form>
                            <button class="btn btn-warning fw-medium py-1">Sign up Now</button>
                        </div>

                    </div>
                </div><!-- end of .container-->

            </section>
            <!-- <section> close ============================-->
            <!-- ============================================-->


            <!-- ============================================-->
            <!-- <section> begin ============================-->
            <section class="text-center py-0">

                <div class="container">
                    <div class="container border-top py-3">
                        <div class="row justify-content-between">
                            <div class="col-12 col-md-auto mb-1 mb-md-0">
                                <p class="mb-0">&copy; 2023 LevelUp Inc </p>
                            </div>

                        </div>
                    </div>
                </div><!-- end of .container-->

            </section>
            <!-- <section> close ============================-->
            <!-- ============================================-->

        </footer>
</body>
