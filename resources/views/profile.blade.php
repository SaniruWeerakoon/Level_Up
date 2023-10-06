@extends('layouts.app')

@section('content')
<div class="container">
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

    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-0"><strong>Name:</strong> {{ Auth::user()->name }}</p>
                            <p class="mb-0"><strong>Username:</strong> {{ Auth::user()->username }}</p>
                            <p class="mb-0"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                            <p class="mb-0"><strong>Updated at:</strong> {{ Auth::user()->updated_at }}</p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <a href="{{ route('edit') }}" class="btn btn-primary">Edit</a>
                        </div>
                    </div>

                    <div class="text-center">
                        <form action="{{ route('profile.destroy', ['id' => Auth::user()->id]) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm" type="button"
                                onclick="confirm('Are you sure?') ? this.form.submit() : ''">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
