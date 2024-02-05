@extends('layouts.dashboard')
@section('dashboard-content')
    <div class="container">
        @vite(['resources/css/home.css'])
        <h1 class="py-3">Courses</h1>
        <div class="row">
            @if($enrollments->isEmpty())
                <p>Please enroll in our courses</p>
            @endif
            @foreach ($enrollments as $enrollment)
                <div class="col-md-4 mb-4">
                    <div style="border-radius: 10px; background-color: #FFFFFF; color: #000000; border:1px solid #ccc "
                         class="card">
                        {{-- Check if course has an image --}}
                        @if ($enrollment->course->course_image_path != null)
                            <img src="{{ asset('storage/' . $enrollment->course->course_image_path) }}"
                                 alt="course image"
                                 class="card-img-top" style="height: 150px; object-fit: contain;">

                        @endif
                        <div class="card-body" style="border-radius: 10px;">
                            <p class="text-secondary">By <a class="fw-bold text-decoration-none me-1"
                                                            style="color: #FF9900;"
                                                            href="#">{{ $enrollment->course->user->name }}</a>|<span
                                    class="ms-1">{{ Carbon\Carbon::parse($enrollment->course->created_at)->format('d F Y') }}</span>
                            </p>
                            <h5 class="card-title"><a
                                    href="{{route('courses.display',[$enrollment->course->id])}}">{{ $enrollment->course->title }}</a>
                            </h5>

                            <p class="card-text">
                                {{-- &bull; Description : {{ $enrollment->course->description }}<br /> --}}
                                &bull; Subject : {{ $enrollment->course->subject }}<br/>
                                &bull; Difficulty : {{ $enrollment->course->difficulty }}<br/>
                                &bull; Ratings
                                : {{ $enrollment->course->ratings == null ? 0 : $enrollment->course->ratings }} &#9733;/
                                5<br/>
                                &bull; Type : {{ $enrollment->course->type }} <br/>
                                &bull; Completed by
                                : {{ $enrollment->course->completed_by == null ? 0 : $enrollment->course->completed_by }}
                                Students<br/>
                            </p>
                            <a href="{{ route('courses.display', ['id' => $enrollment->course->id]) }}"
                               class="btn btn-primary"
                               style="background-color: #FF9900;border:none;">View</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
