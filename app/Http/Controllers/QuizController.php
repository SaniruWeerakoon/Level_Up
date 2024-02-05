<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();
        return view('quiz.index', compact('quizzes'));
    }

    public function create()
    {
        $this->authorize('accessCourses');
        return view('quiz.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateCourse($request);

        try {
            $imagePath = $this->storeImage($request);
            Quiz::create([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'subject' => $validatedData['subject'],
                'difficulty' => $validatedData['difficulty'],
                'author_id' => auth()->user()->id,
                'duration' => $validatedData['duration'],
                'question_count' => $validatedData['question_count'],
                'quiz_image_path' => $imagePath,
            ]);

            return redirect()->route('quiz.index')->with('success', 'Quiz created successfully.');
        } catch (Exception) {
            return $this->handleStorageError($imagePath, 'Quiz creation failed.');
        }
    }

    public function show($id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('quiz.show', compact('quiz'));
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }

    // Validation logic for both store and update
    private function validateCourse(Request $request, $id = null)
    {
        return $request->validate([
            'title' => 'required|string|max:255|unique:courses,title,' . ($id ?: 'NULL') . ',id',
            'description' => 'required|string|min:100|max:500',
            'subject' => 'required|string|max:255',
            'difficulty' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'question_count' => 'required|integer|min:1|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }

    // Image storage logic for both store and update
    private function storeImage(Request $request, $currentImagePath = null)
    {
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('quiz_img', 'public');

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
        return redirect()->route('quiz.index')->with('error', $errorMessage);
    }
}
