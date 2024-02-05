@extends('layouts.dashboard')

@section('dashboard-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h1>API Tokens</h1>
                <p>
                    API tokens are used to authenticate with the API. You can create as many tokens as you like. You can
                    also delete tokens that you no longer need.
                </p>

                @if(isset($token))
                    <div class="alert alert-danger">
                        <strong>Warning!</strong> This is your new API token. You will not be able to see it again.
                    </div>
                    <div class="alert alert-info">
                        {{ $token->plainTextToken }}
                    </div>
                @endif


                <form action="{{ route('api-token.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>
                            <input type="text" name="name" class="form-control" placeholder="Name">
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Token</button>
                </form>


                <div class="card mt-3">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tokens as $token)
                            <tr>
                                <td>{{ $token->id }}</td>
                                <td>{{ $token->name }}</td>
                                <td>
                                    <a href="{{ route('api-token.show', $token->id) }}" class="btn  btn-sm"
                                       style="background-color: #ff9900;color: #fff;">Show</a>
                                    <form action="{{ route('api-token.destroy', $token->id) }}" method="POST"
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    @if($tokens->isEmpty())
                        <div class="d-flex justify-content-center mb-2">
                            <p class="card-text">You have not created any API tokens.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
