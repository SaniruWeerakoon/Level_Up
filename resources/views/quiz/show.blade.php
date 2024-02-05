@extends('layouts.app')
@section('content')

    <!-- Header start -->


    <div class="container-xxl py-5 overlay mb-2"
         style="background-image: url('{{ asset('images/course_img/study.webp') }}'); background-size: cover; background-position: center;">
        <div class="container my-5 pt-5 pb-4 " style="backdrop-filter: blur(7px);width: 500px;border-radius: 20px;">
            <h1 class="display-3  mb-3 animated slideInDown" style="color: black;font-weight: bold">Quiz Details</h1>
        </div>
    </div>

    <!-- Header End -->
    <!-- Quiz Detail Start -->
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
                        @if ($quiz->quiz_image_path)
                            <img class="flex-shrink-0 img-fluid border rounded"
                                 src="{{ asset('storage/' . $quiz->quiz_image_path) }}" alt="Quiz Image"
                                 style="width: 100px; height: 100px;">
                        @else
                            <img class="flex-shrink-0 img-fluid border rounded"
                                 src="https://ui-avatars.com/api/?background=random&name={{ $quiz->title }}"
                                 alt="Quiz Image"
                                 style="width: 100px; height: 100px;">
                        @endif
                        <div class="text-start ps-4">
                            <h1 class="mb-3">{{$quiz->title}}</h1>
                            <span class="text-truncate me-3"><i class="fas fa-graduation-cap  me-2"></i>{{ $quiz->subject ?: 'Not specified' }}</span>
                            <span class="text-truncate me-3"><i
                                    class="fas fa-star  me-2"></i>{{ $quiz->difficulty }}</span>
                        </div>
                    </div>

                    <div class="mb-5">
                        <h4 class="mb-3">Quiz Description</h4>
                        <p>{{ $quiz->description }}</p>
                        <div>
                            <a href="#" class="btn btn-primary"
                               style="background-color: #FF9900;border:none;">Start Quiz</a>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4">
                    <div id="color1" class=" rounded p-5 mb-4 wow slideInUp" data-wow-delay="0.1s">
                        <h4 class="mb-4">Quiz Summary</h4>
                        <p><i class="fas fa-angle-right  me-2"></i>Published
                            On: {{$quiz->created_at->format('Y-m-d')}}</p>
                        <p><i class="fas fa-angle-right  me-2"></i>Published By: {{$quiz->author->name}}</p>
                        <p><i class="fas fa-angle-right  me-2"></i>Subject: {{$quiz->subject}}</p>
                        <p><i class="fas fa-angle-right  me-2"></i>Difficulty: {{$quiz->difficulty}}</p>
                        <p><i class="fas fa-angle-right  me-2"></i>Duration: {{$quiz->duration}}</p>
                        <p><i class="fas fa-angle-right  me-2"></i>Completed by: {{$quiz->completed_by}}&nbsp;Students
                        </p>

                    </div>

                </div>
            </div>
        </div>
@endsection

