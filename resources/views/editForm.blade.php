@extends('layouts.dashboard')

@section('dashboard-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-light">
                    <div class="card-header d-flex justify-content-between">
                        <span><h4>Edit Details</h4> </span>
                        <form action="{{ route('profile.destroy', ['id' => Auth::user()->id]) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm" type="button"
                                    onclick="confirm('Are you sure?') ? this.form.submit() : ''">
                                Delete
                            </button>
                        </form>
                    </div>

                    <div class="card-body bg-light">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (Auth::user()->id)
                                @method('PUT')
                            @endif

                            <div class="row mb-3">
                                <label for="name" class="col-md-2 col-form-label">Name</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ old('name', Auth::user()->name) }}"/>
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="username" class="col-md-2 col-form-label">Username</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="username" name="username"
                                           value="{{ old('username', Auth::user()->username) }}"/>
                                    @error('username')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-2 col-form-label">Email<span
                                        class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="email" class="form-control" id="email" name="email"
                                           value="{{ old('email', Auth::user()->email) }}" readonly>
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-2 col-form-label">Password</label>
                                <div class="col-md-8">
                                    <input type="password" class="form-control" id="password" name="password"/>
                                    @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                       class="col-md-2 col-form-label">{{ __('Confirm Password') }}</label>
                                <div class="col-md-8">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="profile_image" class="col-md-2 col-form-label">Profile Image</label>
                                <div class="col-md-8">
                                    <input type="file" class="form-control" id="profile_image" name="profile_image">
                                    @error('profile_image_path')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="mobile" class="col-md-2 col-form-label">Mobile</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="mobile" name="mobile"
                                           value="{{ old('mobile', Auth::user()->mobile) }}">
                                    @error('mobile')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="designation" class="col-md-2 col-form-label">Designation</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="designation" name="designation"
                                           value="{{ old('designation', Auth::user()->designation) }}">
                                    @error('designation')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Skill Level Dropdown -->
                            <div class="row mb-3">
                                <label for="skill_level" class="col-md-2 col-form-label">Skill Level</label>
                                <div class="col-md-8">
                                    <select class="form-control" id="skill_level" name="skill_level">
                                        <option value="Unspecified"
                                            {{ old('skill_level', Auth::user()->skill_level) === 'Unspecified' ? 'selected' : '' }}>
                                            Unspecified
                                        </option>
                                        <option value="Beginner"
                                            {{ old('skill_level', Auth::user()->skill_level) === 'Beginner' ? 'selected' : '' }}>
                                            Beginner
                                        </option>
                                        <option value="Intermediate"
                                            {{ old('skill_level', Auth::user()->skill_level) === 'Intermediate' ? 'selected' : '' }}>
                                            Intermediate
                                        </option>
                                        <option value="Advanced"
                                            {{ old('skill_level', Auth::user()->skill_level) === 'Advanced' ? 'selected' : '' }}>
                                            Advanced
                                        </option>
                                    </select>
                                    @error('skill_level')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Gender Dropdown -->
                            <div class="row mb-3">
                                <label for="gender" class="col-md-2 col-form-label">Gender</label>
                                <div class="col-md-8">
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="Unspecified"
                                            {{ old('gender', Auth::user()->gender) === 'Unspecified' ? 'selected' : '' }}>
                                            Unspecified
                                        </option>
                                        <option value="Male"
                                            {{ old('gender', Auth::user()->gender) === 'Male' ? 'selected' : '' }}>
                                            Male
                                        </option>
                                        <option value="Female"
                                            {{ old('gender', Auth::user()->gender) === 'Female' ? 'selected' : '' }}>
                                            Female
                                        </option>
                                        <option value="Other"
                                            {{ old('gender', Auth::user()->gender) === 'Other' ? 'selected' : '' }}>
                                            Other
                                        </option>
                                    </select>
                                    @error('gender')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="birthday" class="col-md-2 col-form-label">Birthday</label>
                                <div class="col-md-8">
                                    <input type="date" class="form-control" id="birthday" name="birthday"
                                           value="{{ old('birthday', Auth::user()->birthday) }}">
                                    @error('birthday')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-2">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
