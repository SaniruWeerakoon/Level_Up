@extends('layouts.dashboard')

@section('dashboard-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card rounded-3 shadow">
                    <div class="card-header">{{ __('Add New Quiz') }}</div>

                    <div class="card-body bg-light">
                        <form method="POST" action="{{ route('quiz.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                                <div class="col-md-7">
                                    <input id="title" type="text"
                                           class="form-control @error('title') is-invalid @enderror"
                                           name="title" value="{{ old('title') }}" autocomplete="title" required
                                           autofocus>

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
                                    <textarea id="description"
                                              class="form-control @error('description') is-invalid @enderror"
                                              name="description" minlength="200" required
                                              maxlength="500">{{ old('description') }}</textarea>

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
                                           required value="{{ old('subject') }}">

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
                                    <select id="difficulty"
                                            class="form-select @error('difficulty') is-invalid @enderror"
                                            required name="difficulty">
                                        <option
                                            value="Beginner" {{ old('difficulty') == 'Beginner' ? 'selected' : '' }}>
                                            Beginner
                                        </option>
                                        <option value="Intermediate"
                                            {{ old('difficulty') == 'Intermediate' ? 'selected' : '' }}>
                                            Intermediate
                                        </option>
                                        <option
                                            value="Advanced" {{ old('difficulty') == 'Advanced' ? 'selected' : '' }}>
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
                                <label for="duration"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Estimated Length') }}</label>

                                <div class="col-md-7">
                                    <select id="duration"
                                            class="form-select @error('duration') is-invalid @enderror"
                                            name="duration">
                                        <option value="0-1 hours">0-1 hours</option>
                                        <option value="1-2 hours">1-2 hours</option>
                                        <option value="2-4 hours">2-4 hours</option>
                                        <option value="5+ hours">5+ hours</option>
                                    </select>

                                    @error('duration')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="question_count"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Question Count') }}</label>

                                <div class="col-md-7">
                                    <input id="question_count" type="number"
                                           class="form-control @error('question_count') is-invalid @enderror"
                                           name="question_count"
                                           required value="{{ old('question_count') }}">

                                    @error('question_count')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="image"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Image') }}</label>

                                <div class="col-md-7">
                                    <input id="image" type="file" required
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
                                        {{ __('Add Quiz') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
