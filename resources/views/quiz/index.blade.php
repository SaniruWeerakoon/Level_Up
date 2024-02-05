@extends('layouts.app')

@section('content')
    @vite(['resources/css/home.css'])
    <div class="container">
        <h1 class="py-3">Quizzes</h1>

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

        @if($quizzes->isEmpty())
            <div class="alert alert-danger">
                No quizzes found.
            </div>
        @endif
        <div class="row">
            @foreach ($quizzes as $quiz)
                <div class="col-md-4 mb-4">
                    <div style="border-radius: 10px; background-color: #FFFFFF; color: #000000; border:1px solid #ccc "
                         class="card">
                        {{-- Check if quiz has an image --}}
                        @if ($quiz->quiz_image_path != null)
                            <img src="{{ asset('storage/' . $quiz->quiz_image_path) }}" alt="quiz image"
                                 class="card-img-top" style="height: 150px; object-fit: contain;">
                        @else
                            <img src="https://ui-avatars.com/api/?background=random&name={{ $quiz->title}}"
                                 alt="quiz image"
                                 class="card-img-top" style="height: 150px; object-fit: contain;">
                        @endif
                        <div class="card-body" style="border-radius: 10px;">
                            <p class="text-secondary">By <a class="fw-bold text-decoration-none me-1"
                                                            style="color: #FF9900;"
                                                            href="#">{{ $quiz->author->name }}</a>|<span
                                    class="ms-1">{{ Carbon\Carbon::parse($quiz->created_at)->format('d F Y') }}</span>
                            </p>
                            <h5 class="card-title">
                                <a href="{{ route('quiz.show', ['quiz' => $quiz->id]) }}">{{ $quiz->title }}</a>
                            </h5>
                            <p class="card-text">
                                &bull; Subject : {{ $quiz->subject }}<br/>
                                &bull; Difficulty : {{ $quiz->difficulty }}<br/>
                                &bull; Duration : {{ $quiz->duration }}<br/>
                                &bull; Total Questions : {{ $quiz->question_count }}<br/>
                            </p>
                            <a href="#" class="btn btn-primary"
                               style="background-color: #FF9900; border:none;">Start Quiz</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
