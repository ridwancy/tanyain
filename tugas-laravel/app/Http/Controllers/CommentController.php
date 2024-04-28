<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Answer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $answer = Answer::where('id', $id)->firstOrFail();
        return view('createc',[
            'answer' => $answer,
            'answer_id' => $answer->id,
            'slug' => $answer->question->slug
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'body' => 'required',
            'answer_id' => 'required'
        ]);

        $validatedData['user_id'] = auth()->user()->id;

        $comment = Comment::create($validatedData);
        $slug = $comment->answer->question->slug;
        return redirect('/home/'. $slug)->with('success', 'Komentar berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $answer = Answer::where('id', $id)->firstOrFail();
        $comment = Comment::where('answer_id', $answer->id)->where('user_id', auth()->user()->id)->firstOrFail();
        return view('editc', [
            'answer' => $answer,
            'answer_id' => $answer->id,
            'comment' => $comment,
            'slug' => $answer->question->slug
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $answer = Answer::where('id', $id)->firstOrFail();
        $comment = Comment::where('answer_id', $answer->id)->where('user_id', auth()->user()->id)->firstOrFail();
        $slug = $comment->answer->question->slug;
        $validatedData = $request->validate([
            'body' => 'required',
            'answer_id' => 'required'
        ]);

        $validatedData['user_id'] = auth()->user()->id;
        Comment::where('id', $comment->id)->update($validatedData);
        return redirect('/home/'. $slug)->with('success', 'Komentar berhasil diedit!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $answer = Answer::where('id', $id)->firstOrFail();
        $comment = Comment::where('answer_id', $answer->id)->where('user_id', auth()->user()->id)->firstOrFail();
        $slug = $comment->answer->question->slug;
        $comment->delete();
        return redirect('/home/'. $slug)->with('success', 'Komentar berhasil dihapus!');
    }
}
