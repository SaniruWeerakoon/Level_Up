@extends('layouts.dashboard')

@section('dashboard-content')
    <div class="container">
        <div class="card pb-5">
            <div class="card-header">
                <h2>Analytics</h2>
            </div>
            <div class="card-body bg-light ">
                <form action="{{route('analytics.show')}}" method="POST" class="mb-4">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <label for="start_date">Start Date:</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" required
                                   value="{{ request('start_date', now()->subMonth()->format('Y-m-d')) }}">
                            @error('start_date')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="end_date">End Date:</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" required
                                   value="{{ request('end_date', now()->format('Y-m-d')) }}">
                            @error('end_date')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-sm  btn-warning mt-4 p-2" style="padding: revert">Apply
                                Filter
                            </button>
                        </div>
                    </div>
                </form>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Revenue</h5>
                                <p class="card-text">$ &nbsp;{{$analytics->totalRevenue  }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Courses</h5>
                                <p class="card-text">{{$analytics->totalCourses  }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Registered Users</h5>
                                <p class="card-text">{{$analytics->totalUsers }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Course Enrollments</h5>
                                <p class="card-text">{{ $analytics->courseEnrollments  }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Active Users</h5>
                                <p class="card-text">{{$analytics->activeUsers }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
