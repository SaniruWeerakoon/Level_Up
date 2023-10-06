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
                        {{ __('You are logged in as') }}
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <p><br />Name &nbsp: {{ Auth::user()->name }}
                            <br />
                            Username : {{ Auth::user()->username }}<br />
                            Email : {{ Auth::user()->email }}<br />
                            Updated at : {{ Auth::user()->updated_at }}
                            {{-- {{ dd(Auth::user()) }} --}}
                        </p>
                        <div class="row">
                            <div class="col-md-9 text-left">
                                <a href="{{ route('edit') }}" class="btn btn-primary">Edit</a>
                            </div>
                            <div class="col-md-2 mx-2 text-right">
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
    </div>
@endsection
