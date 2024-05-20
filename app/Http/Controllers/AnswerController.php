<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('profileAnswer', [
            'questions' => Question::where('user_id', auth()->user()->id)->get(),
            'answers' => Answer::with('comments')->where('user_id', auth()->user()->id)
            ->latest('updated_at')
            ->latest('created_at')
            ->get(),
            'user' => auth()->user()

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($slug)
    {
        $question = Question::where('slug', $slug)->firstOrFail();
        return view('createa', [
            'question' => $question,
            'question_id' => $question->id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'body' => 'required',
            'photo'=> 'nullable|image|mimes:jpeg,png,jpg,gif|max:7168 ',
            'question_id' => 'required'
        ]);
        if($request->file('photo')){
            $validatedData['photo'] = $request->file('photo')->store('answer-photos');
        }
        $validatedData['user_id'] = auth()->user()->id;

        Answer::create($validatedData);
        return redirect('/Answer')->with('success', 'Jawaban berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $question = Question::where('slug', $slug)->firstOrFail();
        $answer = Answer::where('question_id', $question->id)->where('user_id', auth()->user()->id)->firstOrFail();
        return view('edita', [
            'question' => $question,
            'question_id' => $question->id,
            'answer' => $answer
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $question = Question::where('slug', $slug)->firstOrFail();
        $answer = Answer::where('question_id', $question->id)->where('user_id', auth()->user()->id)->firstOrFail();
        $validatedData = $request->validate([
            'body' => 'required',
            'photo'=> 'nullable|image|mimes:jpeg,png,jpg,gif|max:7168 ',
            'question_id' => 'required'
        ]);
        if($request->file('photo')){
            $validatedData['photo'] = $request->file('photo')->store('answer-photos');
        }
        $validatedData['user_id'] = auth()->user()->id;

        Answer::where('id', $answer->id)->update($validatedData);

        return redirect('/Answer')->with('success', 'Jawaban berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {

        $question = Question::where('slug', $slug)->firstOrFail();
        $answer = Answer::where('question_id', $question->id)->where('user_id', auth()->user()->id)->firstOrFail();
        foreach ($answer->comments as $comment) {
            $comment->delete();
        }    
        $answer->delete();
    
        return redirect('/Answer')->with('success', 'Jawaban berhasil dihapus!');
    }




}
