@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-4 col-lg-3 d-md-block  sidebar">
                <div class="position-sticky">
                    <!-- Sidebar content -->
                    <ul class="nav flex-column">
                        <li class="nav-item py-2">
                            {{-- profile image  --}}
                            @if (Auth::user()->profile_image_path)
                                <img src="{{asset('storage/' . Auth::user()->profile_image_path )}}" alt="Profile image"
                                     class="rounded-circle mx-auto d-block" width="100" height="100">
                            @else
                                <img class="rounded-circle mx-auto d-block"
                                     src="https://ui-avatars.com/api/?background=random&name={{ Auth::user()->name}}"
                                     alt="Profile Image"
                                     width="100" height="100">
                            @endif
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}"
                               href="{{ route('profile') }}">
                                <i class="fas fa-user"></i>&nbsp;&nbsp;{{ __('Profile') }}
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ request()->routeIs('enrollments.index') ? 'active' : '' }} "
                               href="{{ route('enrollments.index') }}">
                                <i class="fas fa-clipboard-list"></i>&nbsp;&nbsp;My Enrollments
                            </a>
                        </li>

                        @can('accessCourses')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('courses.create') ? 'active' : '' }}"
                                   href="{{ route('courses.create') }}">
                                    <i class="fas fa-plus-circle"></i>&nbsp;&nbsp;Create Course
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('quiz.create') ? 'active' : '' }}"
                                   href="{{ route('quiz.create') }}">
                                    <i class="fas fa-plus-circle"></i>&nbsp;&nbsp;Create Quiz
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('courses.show') ? 'active' : '' }}"
                                   href="{{ route('courses.show') }}">
                                    <i class="fas fa-list"></i>&nbsp;&nbsp;My Courses
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('api-token.index') ? 'active' : '' }}"
                                   href="{{ route('api-token.index') }}">
                                    <i class="fas fa-key"></i>&nbsp;&nbsp;My API Tokens
                                </a>
                            </li>
                        @endcan
                        @can('accessAdmin')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('analytics.index') ? 'active' : '' }}"
                                   href="{{ route('analytics.index') }}">
                                    <i class="fas fa-tachometer-alt"></i>&nbsp;&nbsp;Admin Analytics
                                </a>
                            </li>
                        @endcan
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('profile.payments') ? 'active' : '' }}"
                               href="{{route('profile.payments')}}">
                                <i class="fas fa-dollar-sign"></i>&nbsp;&nbsp;Billing and Payments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('notifications.index') ? 'active' : '' }}"
                               href="{{route('notifications.index')}}">
                                <i class="fas fa-bell"></i>&nbsp;&nbsp;Messages and Notifications
                            </a>
                        </li>
                        {{--<li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('#') ? 'active' : '' }}" href="#">
                                <i class="fas fa-chart-line"></i>&nbsp;&nbsp;Progress Report
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('#') ? 'active' : '' }}" href="#">
                                <i class="fas fa-question-circle"></i>&nbsp;&nbsp;Quizzes & Tutorial
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('#') ? 'active' : '' }}" href="#">
                                <i class="fas fa-life-ring"></i>&nbsp;&nbsp;Support and Help Center
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('#') ? 'active' : '' }}" href="#">
                                <i class="fas fa-lightbulb"></i>&nbsp;&nbsp;Recommendations
                            </a>
                        </li>--}}
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-8 ml-sm-auto col-lg-9 px-md-4 py-3">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @yield('dashboard-content')
            </main>
        </div>
    </div>
@endsection
