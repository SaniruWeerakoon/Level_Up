@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        {{ __('You are logged in as') }}
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <p><br />Name &nbsp;&nbsp;&nbsp; : {{ Auth::user()->name }}
                            <br />
                            Username : {{ Auth::user()->username }}<br />
                            Email : {{ Auth::user()->email }}<br />
                            Updated at : {{ Auth::user()->updated_at }}
                            {{-- {{ dd(Auth::user()) }} --}}
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
