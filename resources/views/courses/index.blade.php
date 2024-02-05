@extends('layouts.app')

@section('content')
    @vite(['resources/css/home.css'])
    <div class="container">
        <h1 class="py-3">Courses</h1>

        <div class="container">
            <form action="{{ route('courses.search') }}" method="GET" class="row justify-content-center">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search jobs" name="keyword"
                               value="{{ request('keyword') }}">
                        <button class="btn btn-warning" type="submit">Search</button>
                    </div>
                </div>
            </form>
            {{--            Search form end--}}
        </div>

        <div class="row">
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
            @foreach ($courses as $course)
                <div class="col-md-4 mb-4">
                    <div style="border-radius: 10px; background-color: #FFFFFF; color: #000000; border:1px solid #ccc "
                         class="card">
                        {{-- Check if course has an image --}}
                        @if ($course->course_image_path != null)
                            <img src="{{ asset('storage/' . $course->course_image_path) }}" alt="course image"
                                 class="card-img-top" style="height: 150px; object-fit: contain;">

                        @endif
                        <div class="card-body" style="border-radius: 10px;">
                            <p class="text-secondary">By <a class="fw-bold text-decoration-none me-1"
                                                            style="color: #FF9900;"
                                                            href="#">{{ $course->user->name }}</a>|<span
                                    class="ms-1">{{ Carbon\Carbon::parse($course->created_at)->format('d F Y') }}</span>
                            </p>
                            <h5 class="card-title"><a
                                    href="{{route('courses.display',[$course->id])}}">{{ $course->title }}</a></h5>

                            <p class="card-text">
                                {{-- &bull; Description : {{ $course->description }}<br /> --}}
                                &bull; Subject : {{ $course->subject }}<br/>
                                &bull; Difficulty : {{ $course->difficulty }}<br/>
                                &bull; Ratings : {{ $course->ratings == null ? 0 : $course->ratings }} &#9733;/ 5<br/>
                                &bull; Type : {{ $course->type }} <br/>
                                &bull; Completed by : {{ $course->completed_by == null ? 0 : $course->completed_by }}
                                Students<br/>
                            </p>

                            <a href="{{ route('enroll', ['course_id' => $course->id]) }}" class="btn btn-primary"
                               style="background-color: #FF9900;border:none;">Enroll</a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-md-12 d-flex justify-content-center mt-4">
                {{ $courses->links() }}
            </div>

        </div>

    </div>
@endsection
