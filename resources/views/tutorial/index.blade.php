<!-- resources/views/tutorial/index.blade.php -->
@extends('layouts.app')

@section('content')
    @vite('resources/css/home.css')
    <div class="container">
        <h1 class="py-3">All Tutorials</h1>

        <div class="row">
            @forelse ($tutorials as $tutorial)
                <div class="col-md-6 mb-4">
                    <div class="card "
                         style="border-radius: 10px; background-color: #FFFFFF; color: #000000; border:1px solid #ccc ">

                        <img src="https://ui-avatars.com/api/?background=random&name={{ $tutorial->title}}"
                             alt="quiz image"
                             class="card-img-top" style="height: 150px; object-fit: contain;">
                        <div class="card-body bg-light" style="border-radius: 10px;">
                            <h5 class="card-title">{{ $tutorial->title }}</h5>

                            <div class="card-text">
                                <p>Description: {{ $tutorial->description }}</p>
                                <p>Created by: <span class="fw-semi-bold"
                                                     style="color: #ff9900"> {{$tutorial->author->name}}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p>No tutorials available.</p>
            @endforelse
        </div>
    </div>
@endsection
