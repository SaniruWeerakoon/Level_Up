<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Enrollment;

class EnrollmentController extends Controller
{

    public function my_courses(Request $request)
    {
        $user = auth()->user();
        $enrollments = Enrollment::where('user_id', $user->id)->get();

        return view('enrollments.index',  compact('enrollments'));
    }

    public function enroll(Request $request, $course_id)
    {

        $user = auth()->user();
        $course = Course::find($course_id);
        if ($course) {

            //check if user is already enrolled in the course
            $existingEnrollment = Enrollment::where('user_id', $user->id)
                ->where('course_id', $course->id)
                ->first();
            // dd($existingEnrollment);
            if ($existingEnrollment) {

                return redirect()->route('courses.index')->with('error', 'You are already enrolled in this course.');
            }


            Enrollment::create([
                'user_id' => auth()->user()->id,
                'course_id' => $course->id,
                'course_name' => $course->title,
                'complete' => false,
            ]);

            return redirect()->route('courses.index')->with('success', 'Enrolled in the course successfully.');
        } else {
            return redirect()->route('courses.index')->with('error', 'Course not found.');
        }
    }
}
