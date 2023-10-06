@extends('layouts.app')
@section('content')
    <div class="container">
    <h1>My Enrolled Courses</h1>
    <div class="row">
        @forelse ($enrollments as $enrollment)
            @php
                $course = \App\Models\Course::find($enrollment->course_id);
            @endphp
            <div class="col-md-4 mb-3">
                <div class="card" style="width: 18rem;border-radius:10px;background-color:black;">
                    <div class="card-body" style="border-radius:10px;">
                        <h5 class="card-title">{{ $course->title }}</h5>
                        <p class="card-text">
                            &bull; Description: {{ $course->description }}<br />
                            &bull; Subject: {{ $course->subject }}<br />
                            &bull; Difficulty: {{ $course->difficulty }}<br />
                        </p>
                        <a href="#" class="btn btn-primary btn-md">View Course</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12">
                <p>You haven't enrolled in any courses yet.</p>
            </div>
        @endforelse
    </div>
</div>

@endsection
