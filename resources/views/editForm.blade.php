@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Edit Details
                    </div>
                    <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                        <form action="{{ route('update') }}" method="POST">
                            @csrf
                            @if (Auth::user()->id)
                                @method('PUT')
                            @endif
                        
                            <div class="row mb-3">
                                <label for="name" class="col-md-2 col-form-label">Name</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" />
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label for="username" class="col-md-2 col-form-label">Username</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="username" name="username"
                                        value="{{ old('username', Auth::user()->username) }}" />
                                    @error('username')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label for="email" class="col-md-2 col-form-label">Email</label>
                                <div class="col-md-8">
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email', Auth::user()->email) }}" placeholder="name@example.com">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label for="password" class="col-md-2 col-form-label">Password</label>
                                <div class="col-md-8">
                                    <input type="password" class="form-control" id="password" name="password" required />
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-2 col-form-label">{{ __('Confirm Password') }}</label>
                                <div class="col-md-8">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                                        autocomplete="new-password">
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
