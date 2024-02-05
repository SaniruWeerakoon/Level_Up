@extends('layouts.dashboard')
@section('dashboard-content')

    <div class="container">
        <h1>Billings and Payments</h1>

        @if($enrollments->isEmpty())
            <p>No enrollments found.</p>
        @else
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Course</th>
                    <th>Price</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $totalPrice = 0;
                @endphp

                @foreach($enrollments as $enrollment)
                    <tr>
                        <td>{{ $enrollment->course->title }}</td>
                        <td>$ &nbsp;{{ $enrollment->course->price }}</td>
                        @php
                            $totalPrice += $enrollment->course->price;
                        @endphp
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td
                        class="d-flex justify-content-between align-items-center">
                        <strong>Total</strong>
                        <a href="#" class="btn btn-warning p-1 px-2" style="padding: revert;width: 100px;">Buy</a>
                    </td>
                    <td><strong>$ &nbsp;{{ $totalPrice }}</strong></td>
                </tr>

                </tfoot>
            </table>
        @endif
    </div>
@endsection
