<?php

namespace App\Http\Controllers;

use App\Models\Course;

use App\Models\Notification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /////////////////////
    //display all the courses
    /////////////////////
    public function index()
    {
        $courses = Course::paginate(9);
        return view('courses.index', compact('courses'));
    }

    //search function
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $courses = Course::where(function ($query) use ($keyword) {
            $query->where('title', 'like', "%$keyword%")
                ->orWhere('subject', 'like', "%$keyword%");
        })
            ->paginate(9);

        return view('courses.index', compact('courses'));
    }

    /////////////////////
    //add courses for admins only
    /////////////////////
    public function create()
    {
        return view('courses.create');
    }

    /////////////////////
    /// display full course details
    /// /////////////////
    public function display($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.display', compact('course'));
    }

    /////////////////////
    //edit courses for admins only
    /////////////////////
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.edit', compact('course'));
    }
    /////////////////////
    //my courses for admins only
    /////////////////////
    public function show()
    {
        $user = Auth::user();
        $courses = Course::where('author_id', $user->id)->get();
        return view('courses.show', compact('courses'));
    }

    /////////////////////
    //store courses for admins only
    /////////////////////
    public function store(Request $request)
    {
        $this->authorize('accessCourses');
        $validatedData = $this->validateCourse($request);

        try {
            $imagePath = $this->storeImage($request);

            Course::create([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'subject' => $validatedData['subject'],
                'difficulty' => $validatedData['difficulty'],
                'price' => $validatedData['price'],
                'author_id' => auth()->user()->id,
                'type' => $validatedData['type'],
                'content' => $validatedData['content'],
                'estimated_length' => $validatedData['estimated_length'],
                'course_image_path' => $imagePath,
            ]);

            return redirect()->route('courses.show')->with('success', 'Course created successfully.');
        } catch (Exception) {
            return $this->handleStorageError($imagePath, 'Course creation failed.');
        }
    }

    public function update(Request $request, $id)
    {
        $this->authorize('accessCourses');

        $validatedData = $this->validateCourse($request, $id);

        try {
            $course = Course::findOrFail($id);
            $imagePath = $this->storeImage($request, $course->course_image_path);

            $course->update([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'subject' => $validatedData['subject'],
                'difficulty' => $validatedData['difficulty'],
                'price' => $validatedData['price'],
                'type' => $validatedData['type'],
                'content' => $validatedData['content'],
                'estimated_length' => $validatedData['estimated_length'],
                'course_image_path' => $imagePath,
            ]);


            //create notification
            $enrollments = $course->enrollments()->get();
            foreach ($enrollments as $enrollment) {
                Notification::createNotification('Course ' . $course->title . ' has been updated', $enrollment->user()->get());
            }

            return redirect()->route('courses.show', $course->id)->with('success', 'Course updated successfully.');
        } catch (Exception) {
            return $this->handleStorageError($imagePath, 'Course update failed.');
        }
    }



    /////////////////////
    //delete courses for admins only
    /////////////////////
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);
        if ($course->author_id !== auth()->user()->id) {
            return redirect()->back()->with('error', 'You cannot delete this course.');
        }

        //create notification
        $enrollments = $course->enrollments()->get();
        foreach ($enrollments as $enrollment) {
            Notification::createNotification('Course ' . $course->title . ' has been deleted', $enrollment->user()->get());
        }


        $course->delete();
        return redirect()->route('courses.show')->with('success', 'Course deleted successfully.');
    }


    // Validation logic for both store and update
    private function validateCourse(Request $request, $id = null)
    {
        return $request->validate([
            'title' => 'required|string|max:255|unique:courses,title,' . ($id ?: 'NULL') . ',id',
            'description' => 'required|string|min:200|max:500',
            'subject' => 'required|string|max:255',
            'difficulty' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'estimated_length' => 'required|string|max:255',
            'price' => 'required|numeric|max:10000',
            'content' => 'required|string|max:2048',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }

    // Image storage logic for both store and update
    private function storeImage(Request $request, $currentImagePath = null)
    {
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('course_img', 'public');

            // Delete the current image if updating
            if ($currentImagePath) {
                Storage::delete($currentImagePath);
            }

            return $imagePath;
        }

        return $currentImagePath;
    }

    // Handle storage errors
    private function handleStorageError($imagePath, $errorMessage)
    {
        Storage::delete($imagePath);
        return redirect()->route('courses.index')->with('error', $errorMessage);
    }
}

