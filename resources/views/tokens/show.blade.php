@extends('layouts.dashboard')

@section('dashboard-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>API Token Details</h2>
                    </div>
                    <div class="card-body bg-light">
                        <dl class="row">
                            <dt class="col-sm-3">ID:</dt>
                            <dd class="col-sm-9">{{ $token->id }}</dd>

                            <dt class="col-sm-3">Name:</dt>
                            <dd class="col-sm-9">{{ $token->name }}</dd>

                            <dt class="col-sm-3">Plain Text Token:</dt>
                            <dd class="col-sm-9">{{ $token->plainTextToken }}</dd>
                        </dl>

                        <div class="mt-4">
                            <a href="{{ route('api-token.index') }}" class="btn " style="background-color: #ff9900;color: #fff;">Back to Tokens</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
