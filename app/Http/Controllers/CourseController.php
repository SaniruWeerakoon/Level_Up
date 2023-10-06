<?php

namespace App\Http\Controllers;

use App\Models\Course;

use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $this->authorize('accessCreateCourses');
        
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'difficulty' => 'required|string|max:255',
            'price' => 'required|numeric|max:10000',
        ]);
    
        Course::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'subject' => $validatedData['subject'],
            'difficulty' => $validatedData['difficulty'],
            'price' => $validatedData['price'],
        ]);

        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }
}
