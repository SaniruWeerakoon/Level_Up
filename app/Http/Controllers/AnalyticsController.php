<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Carbon\Carbon;

class AnalyticsController
{
    public function index()
    {
        $startDate = Carbon::now()->subMonth()->format('Y-m-d');
        $endDate = Carbon::now()->format('Y-m-d');
        $analytics = $this->analytic_data($startDate, $endDate);
        return view('admin.analytics', compact('analytics'));
    }

    public function show()
    {
        //validate request
        request()->validate([
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|before_or_equal:today',
        ]);
        $startDate = Carbon::parse(request('start_date', now()->subMonth()))->startOfDay()->format('Y-m-d H:i:s');
        $endDate = Carbon::parse(request('end_date', now()))->endOfDay()->format('Y-m-d H:i:s');

        $analytics = $this->analytic_data($startDate, $endDate);
        return view('admin.analytics', compact('analytics'));
    }

    public function analytic_data($startDate, $endDate)
    {
        $totalUsers = User::getTotalRegisteredUsers();
        $totalCourses = Course::getTotalCourses();
        $totalRevenue = $this->getTotalRevenueForPeriod($startDate, $endDate);
        $courseEnrollments = $this->getEnrollmentsForPeriod($startDate, $endDate);
        $activeUsers = $this->getActiveUsersForPeriod($startDate, $endDate);
        return (object)[
            'totalUsers' => $totalUsers,
            'totalCourses' => $totalCourses,
            'totalRevenue' => $totalRevenue,
            'courseEnrollments' => $courseEnrollments,
            'activeUsers' => $activeUsers,
        ];
    }

    public function getTotalRevenueForPeriod($startDate, $endDate)
    {
        $enrollments = Enrollment::whereBetween('created_at', [$startDate, $endDate])->get();
        $totalRevenue = 0;

        foreach ($enrollments as $enrollment) {
            $totalRevenue += $enrollment->course->price;
        }

        return $totalRevenue;
    }

    public function getEnrollmentsForPeriod($startDate, $endDate): int
    {
        $enrollments = Enrollment::whereBetween('created_at', [$startDate, $endDate])->get();
        return $enrollments->count();
    }

    public function getActiveUsersForPeriod($startDate, $endDate): int
    {
        $activeUsers = User::whereBetween('last_login', [$startDate, $endDate])->get();
        return $activeUsers->count();
    }
}
