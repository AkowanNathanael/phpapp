<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Option;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Js;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view("admin.question.create_question");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Quiz $quiz)
    {
        //
        return view("admin.question.create_question",["quiz"=>$quiz]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return response()->json([
            "success" => true, // Add this key
            "message" => "Question added successfully!",
            "data" => [$request["quiz_id"], $request["question_text"]]
        ]);
    }

    /**
     * Add a question label to the database.
     */
    public function addQuestionLabel(Request $request)
    {
        $validated = $request->validate([
            'question_label' => 'required|string|max:255',
            'is_correct' => 'required|boolean',
            'quiz_id' => 'required|exists:quizzes,id',
        ]);

        // Save the question label to the database
        Option::create([
            'quiz_id' => $validated['quiz_id'],
            'label' => $validated['question_label'],
            'is_correct' => $validated['is_correct'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Question label added successfully!',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
    }
}
