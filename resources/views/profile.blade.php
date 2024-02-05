@extends('layouts.dashboard')

@section('dashboard-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card rounded-3 shadow">
                    <div class="card-header bg-light "><h3>{{ __('Dashboard') }}</h3></div>
                    <div class="card-body bg-light ">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                                <p><strong>Username:</strong> {{ Auth::user()->username }}</p>
                                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                                <p><strong>Mobile:</strong> {{ Auth::user()->mobile?:'Unspecified'}}</p>
                                <p><strong>Designation:</strong> {{ Auth::user()->designation?:'Unspecified'}}</p>
                                <p><strong>Skill Level:</strong> {{ Auth::user()->skill_level?:'Unspecified'}}</p>
                                <p><strong>Last Online at:</strong> {{ Auth::user()->last_login?:'Unspecified' }}</p>

                                @can('accessStudent')
                                    <p><strong>Skill Level:</strong> {{ Auth::user()->skill_level }}</p>
                                    <p><strong>Designation:</strong> {{ Auth::user()->designation }}</p>
                                @endcan
                            </div>
                            <div class="col-md-6 text-md-end">
                                <a href="{{ route('profile.edit') }}" class="btn btn-warning  p-2 px-3"
                                >Edit</a>
                            </div>
                        </div>

                        {{--                        <div class="text-center">--}}
                        {{--                            <form action="{{ route('profile.destroy', ['id' => Auth::user()->id]) }}" method="post">--}}
                        {{--                                @method('DELETE')--}}
                        {{--                                @csrf--}}
                        {{--                                <button class="btn btn-danger btn-sm" type="button"--}}
                        {{--                                    onclick="confirm('Are you sure?') ? this.form.submit() : ''">--}}
                        {{--                                    Delete--}}
                        {{--                                </button>--}}
                        {{--                            </form>--}}
                        {{--                        </div>--}}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
