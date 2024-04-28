<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Subject;
use App\Models\Answer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('profileQuestion', [
            'questions' => Question::where('user_id', auth()->user()->id)                    
            ->latest('updated_at')
            ->latest('created_at')
            ->get(),
            'answers' => Answer::where('user_id', auth()->user()->id)->get(),
            'user' => auth()->user()

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('createq', [
            'subjects' => Subject::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'subject_id' => 'required',
            'body'=> 'required',
            'photo'=> 'nullable|image|mimes:jpeg,png,jpg,gif|file|max:7168 ',
            'slug' => 'required|unique:questions'
        ]);

        if($request->file('photo')){
            $validatedData['photo'] = $request->file('photo')->store('question-photos');
        }
        $validatedData['user_id'] = auth()->user()->id;

        Question::create($validatedData);

        return redirect('/question')->with('success', 'Pertanyaan berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        $answers = $question->answers()->orderBy('created_at', 'asc')->get();
        $user = auth()->user();
        return  view('profileQA', [
            'question' => $question,
            'answers' => $answers,
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        return view('editq', [
            'question' => $question,
            'subjects' => Subject::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        $rules = [
            'subject_id' => 'required',
            'body'=> 'required',
            'photo'=> 'nullable|image|mimes:jpeg,png,jpg,gif|max:7168 ',
        ];

        if($request->slug != $question->slug){
            $rules['slug'] = 'required|unique:questions';
        }
        $validatedData = $request->validate($rules);
        if($request->file('photo')){
            $validatedData['photo'] = $request->file('photo')->store('question-photos');
        }
        $validatedData['user_id'] = auth()->user()->id;

        Question::where('id', $question->id)->update($validatedData);

        return redirect('/question')->with('success', 'Pertanyaan berhasil diedit!');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        foreach ($question->answers as $answer) {
        foreach ($answer->comments as $comment) {
            $comment->delete();
        }
        $answer->delete();
        }

        $question->delete();

        return redirect('/question')->with('success', 'Pertanyaan berhasil dihapus!');
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Question::class, 'slug', $request->body);
        return response()->json(['slug' => $slug]);
    }
}
