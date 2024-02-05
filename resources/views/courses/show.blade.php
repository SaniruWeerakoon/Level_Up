@extends('layouts.dashboard')

@section('dashboard-content')
    @vite(['resources/css/home.css'])
    <div class="container">
        <h1>My Courses</h1>
        <div class="row">
            @if($courses->isEmpty())
                <p>You have not created any courses yet.</p>
            @endif
            @foreach ($courses as $course)
                <div class="col-md-4 mb-4">
                    <div style="border-radius: 10px; background-color: #FFFFFF; color: #000000; border:1px solid #ccc "
                         class="card">
                        {{-- <a role="button" class="btn-close" style="position: absolute;right:2px;top:2px;"
                            href='{{ route('courses.show') }}'></a> --}}

                        <form action="{{ route('courses.destroy', ['id' => $course->id]) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn-close" type="button" style="position: absolute;right:2px;top:2px;"
                                    onclick="confirm('Are you sure?') ? this.form.submit() : ''">

                            </button>
                        </form>

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

                            <a href="{{ route('courses.edit', ['id' => $course->id]) }}"
                               class="btn btn-warning">Edit</a>{{-- style="background-color: #FF9900;border:none;" --}}

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection

