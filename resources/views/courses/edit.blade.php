@extends('layouts.dashboard')

@section('dashboard-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3>{{ __('Edit Course') }}</h3></div>

                    <div class="card-body bg-light">

                        <form method="POST" action="{{ route('courses.update', ['id' => $course->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="title"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                                <div class="col-md-7">
                                    <input id="title" type="text"
                                        class="form-control @error('title') is-invalid @enderror" name="title"
                                        value="{{ old('title', $course->title) }}" autocomplete="title" autofocus>

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                                <div class="col-md-7">
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" minlength="200" maxlength="500">{{ old('description', $course->description) }}</textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="subject"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Subject') }}</label>

                                <div class="col-md-7">
                                    <input id="subject" type="text"
                                        class="form-control @error('subject') is-invalid @enderror" name="subject"
                                        value="{{ old('subject', $course->subject) }}">

                                    @error('subject')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="difficulty"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Difficulty') }}</label>

                                <div class="col-md-7">
                                    <select id="difficulty" class="form-select @error('difficulty') is-invalid @enderror"
                                        name="difficulty">
                                        <option value="Beginner"
                                            {{ old('difficulty', $course->difficulty) == 'Beginner' ? 'selected' : '' }}>
                                            Beginner
                                        </option>
                                        <option value="Intermediate"
                                            {{ old('difficulty', $course->difficulty) == 'Intermediate' ? 'selected' : '' }}>
                                            Intermediate
                                        </option>
                                        <option value="Advanced"
                                            {{ old('difficulty', $course->difficulty) == 'Advanced' ? 'selected' : '' }}>
                                            Advanced
                                        </option>
                                    </select>

                                    @error('difficulty')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="type"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Type') }}</label>

                                <div class="col-md-7">
                                    <select id="type" class="form-select @error('type') is-invalid @enderror"
                                        name="type">
                                        <option value="Video"
                                            {{ old('type', $course->type) == 'Video' ? 'selected' : '' }}>
                                            Video
                                        </option>
                                        <option value="Text"
                                            {{ old('type', $course->type) == 'Text' ? 'selected' : '' }}>
                                            Text
                                        </option>
                                        <option value="Other"
                                            {{ old('type', $course->type) == 'Other' ? 'selected' : '' }}>
                                            Other
                                        </option>
                                    </select>

                                    @error('type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="estimated_length"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Estimated Length') }}</label>

                                <div class="col-md-7">
                                    <select id="estimated_length"
                                        class="form-select @error('estimated_length') is-invalid @enderror"
                                        name="estimated_length">
                                        <option value="0-1 hours"
                                            {{ old('estimated_length', $course->estimated_length) == '0-1 hours' ? 'selected' : '' }}>
                                            0-1 hours
                                        </option>
                                        <option value="1-2 hours"
                                            {{ old('estimated_length', $course->estimated_length) == '1-2 hours' ? 'selected' : '' }}>
                                            1-2 hours
                                        </option>
                                        <option value="2-4 hours"
                                            {{ old('estimated_length', $course->estimated_length) == '2-4 hours' ? 'selected' : '' }}>
                                            2-4 hours
                                        </option>
                                        <option value="5+ hours"
                                            {{ old('estimated_length', $course->estimated_length) == '5+ hours' ? 'selected' : '' }}>
                                            5+ hours
                                        </option>
                                    </select>

                                    @error('estimated_length')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="content" class="col-md-4 col-form-label text-md-end">{{ __('Content') }}</label>

                                <div class="col-md-7">
                                    <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content" rows="4">{{ old('content', $course->content) }}</textarea>

                                    @error('content')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>

                                <div class="col-md-7">
                                    <input id="price" type="number" step="0.01"
                                           class="form-control @error('price') is-invalid @enderror" name="price"
                                           value="{{ old('price', $course->price) }}">

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Image') }}</label>

                                <div class="col-md-7">
                                    <input id="image" type="file"
                                           class="form-control @error('image') is-invalid @enderror" name="image">

                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-7 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Edit Course') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
