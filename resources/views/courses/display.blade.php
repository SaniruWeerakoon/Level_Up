@extends('layouts.app')
@section('content')

    <style>
        .fas {
            color: #FF9900;
        }
    </style>
    <!-- Header start -->


    <div class="container-xxl py-5 overlay mb-2"
         style="background-image: url('{{ asset('images/course_img/study.webp') }}'); background-size: cover; background-position: center;">
        <div class="container my-5 pt-5 pb-4 " style="backdrop-filter: blur(7px);width: 500px;border-radius: 20px;">
            <h1 class="display-3  mb-3 animated slideInDown" style="color: black;font-weight: bold">Course Details</h1>
        </div>
    </div>

    <!-- Header End -->
    <!-- Job Detail Start -->
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
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row gy-5 gx-4">
                <div class="col-lg-8">
                    <div class="d-flex align-items-center mb-5">
                        @if ($course->course_image_path)
                            <img class="flex-shrink-0 img-fluid border rounded"
                                 src="{{ asset('storage/' . $course->course_image_path) }}" alt="Course Image"
                                 style="width: 100px; height: 100px;">
                        @else
                            <img class="flex-shrink-0 img-fluid border rounded"
                                 src="https://ui-avatars.com/api/?background=random&name={{ $course->title }}"
                                 alt="Job Image"
                                 style="width: 100px; height: 100px;">
                        @endif
                        <div class="text-start ps-4">
                            <h1 class="mb-3">{{$course->title}}</h1>
                            <span class="text-truncate me-3"><i class="fas fa-graduation-cap  me-2"></i>{{ $course->subject ?: 'Not specified' }}</span>
                            <span class="text-truncate me-3"><i class="fas fa-star  me-2"></i>{{ $course->difficulty }}</span>
                            <span class="text-truncate me-3"><i class="fas fa-file-alt  me-2"></i>{{ $course->type ?: 'Not specified' }}</span>
                            <span class="text-truncate me-0"><i class="fas fa-dollar-sign  me-2"></i>{{ $course->price ?: 'Not specified' }}</span>
                        </div>
                    </div>

                    <div class="mb-5">
                        <h4 class="mb-3">Course Description</h4>

                        <p>{{ $course->description }}</p>

                        <h4 class="mb-3">Course Content</h4>
                        <ul>
                            @foreach(explode("\n", $course->content) as $point)
                                <li>{{ $point }}</li>
                            @endforeach
                        </ul>
                        <div>
                            <a href="{{ route('enroll', ['course_id' => $course->id]) }}" class="btn btn-primary"
                               style="background-color: #FF9900;border:none;">Enroll</a>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4">
                    <div id="color1" class=" rounded p-5 mb-4 wow slideInUp" data-wow-delay="0.1s">
                        <h4 class="mb-4">Course Summary</h4>
                        <p><i class="fas fa-angle-right  me-2"></i>Published
                            On: {{$course->created_at->format('Y-m-d')}}</p>
                        <p><i class="fas fa-angle-right  me-2"></i>Published By: {{$course->user->name}}</p>
                        <p><i class="fas fa-angle-right  me-2"></i>Subject: {{$course->subject}}</p>
                        <p><i class="fas fa-angle-right  me-2"></i>Difficulty: {{$course->difficulty}}</p>
                        <p><i class="fas fa-angle-right  me-2"></i>Price: {{$course->price}}</p>
                        <p><i class="fas fa-angle-right  me-2"></i>Type: {{$course->type}}</p>
                        <p><i class="fas fa-angle-right  me-2"></i>Length: {{$course->estimated_length}}</p>
                        <p><i class="fas fa-angle-right  me-2"></i>Completed by: {{$course->completed_by?:'0'}}&nbsp;Students
                        </p>
                        {{--                        <p><i class="fa fa-angle-right text-primary me-2"></i>Job Nature: {{$course->employment_type}}</p>--}}
                        {{--                        <p><i class="fa fa-angle-right text-primary me-2"></i>Salary: {{ $course->salary_range ?: 'Not specified' }}</p>--}}
                        {{--                        <p><i class="fa fa-angle-right text-primary me-2"></i>Location: {{ $course->location ?: 'Not specified' }}</p>--}}
                        {{--                        <p class="m-0"><i class="fa fa-angle-right text-primary me-2"></i>Deadline: {{$course->application_deadline}}</p>--}}

                    </div>

                </div>
            </div>
        </div>
        <!-- Job Detail End -->

@endsection

