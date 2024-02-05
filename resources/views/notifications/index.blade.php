@extends('layouts.dashboard')

@section('dashboard-content')
    @vite(['resources/css/home.css'])
    <div class="container">
        <h1>Notifications</h1>
        <div class="row d-flex justify-content-center">
            @if($notifications->isEmpty())
                <p>You do not have any notifications yet.</p>
            @endif
            @foreach($notifications as $notification)
                <div class="card mb-2 col-7"
                     style="border-radius: 10px; background-color: #FFFFFF; color: #000000; border:1px solid #ccc ">
                    <div class="card-body bg-white shadow d-flex justify-content-between align-items-center">
                        <p class="card-title">{{ $notification->message}}</p>
                        <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-close">
                            </button>
                        </form>
                    </div>
                </div>

            @endforeach
            <div class="col-7">
                {{ $notifications->links() }}
            </div>
        </div>
    </div>
@endsection
