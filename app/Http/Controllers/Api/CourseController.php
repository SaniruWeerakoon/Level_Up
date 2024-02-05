<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return response()->json($courses);
    }

    public function my_courses()
    {
        $user = Auth::user();
        $courses = Course::where('author_id', $user->id)->get();
        return response()->json($courses);
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        return response()->json($course);
    }

    public function create(Request $request)
    {
        $this->authorize('accessCourses');
//        dd($this->validateCourse($request));
//        return response()->json($validatedData);

        try {
            $validatedData = $this->validateCourse($request);
            // Image storage logic

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
                'course_image_path' => null,
            ]);

            return response()->json(['success' => 'Course created successfully.']);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 302);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }

    public function edit(Request $request, $id)
    {

        $this->authorize('accessCourses');
//        dd($request->all());
        try {
            $validatedData = $this->validateCourse($request, $id);
            $course = Course::findOrFail($id);

            $course->update([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'subject' => $validatedData['subject'],
                'difficulty' => $validatedData['difficulty'],
                'price' => $validatedData['price'],
                'type' => $validatedData['type'],
                'content' => $validatedData['content'],
                'estimated_length' => $validatedData['estimated_length'],
                'course_image_path' => null,
            ]);

            return response()->json(['success' => 'Course updated successfully.']);
        }catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 302);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $this->authorize('accessCourses');
        $course = Course::findOrFail($id);
        if ($course->author_id !== auth()->user()->id) {
            return response()->json(['error' => 'You cannot delete this course.'], 403);
        }
        $course->delete();
        return response()->json(['success' => 'Course deleted successfully.']);
    }



}
