@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Courses</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error message -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
            @foreach ($courses as $course)
                <div class="col-md-4 mb-4" >
                    <div style="border-radius:10px;background-color:black;" class="card"  >
                        {{-- <img class="card-img-top" src="/images/algebra.png" alt="Card image cap" /> --}}
                        <div class="card-body" style="border-radius:10px;">
                            <h5 class="card-title">{{ $course->title }}</h5>
                            <p class="card-text">
                                &bull; Description : {{ $course->description }}<br />
                                &bull; Subject : {{ $course->subject }}<br />
                                &bull; Difficulty : {{ $course->difficulty }}<br />
                                {{-- &bull; Ratings : 4.5 &#9733/ 5<br />
                            &bull; Video Lessons<br />
                            &bull; Completed by : 70 Students<br /> --}}
                            </p>
                            <a href="{{ route('enroll', ['course_id' => $course->id]) }}"
                                class="btn btn-primary btn-md">Enroll</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
