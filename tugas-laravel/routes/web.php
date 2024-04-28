<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RegisController;
use App\Http\Controllers\UserController;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Subject;
use Illuminate\Support\Facades\Route;

Route::get('/tanyain', function(){
    return view('tanyain');
});
Route::get('/about', function(){
    return view('about');
});

Route::get('/', function(){
    $questions = Question::latest()->with('user'); 
    
    if(request('search')){
        $questions->where(function ($query) {
            $query->where('body', 'like', '%' . request('search') . '%')
                ->orWhereHas('answers', function ($query) {
                    $query->where('body', 'like', '%' . request('search') . '%');
                })
                ->orWhereHas('user', function ($query) {
                    $query->where('username', 'like', '%' . request('search') . '%');
                });
        });
    }
    // $questions = $questions->paginate(4);
    return view('home', [
        'subjects' => Subject::all(),
        'questions' => $questions->get(),
    ]);
})->middleware('auth');


Route::get('/profile', function(){
    return view('profile', [
        'questions' => Question::where('user_id', auth()->user()->id)->get(),
        'answers' => Answer::where('user_id', auth()->user()->id)->get(),
        'user' => auth()->user()
    ]);
});

Route::get('/register', [RegisController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/subject/{subject:slug}', function($slug){
    $subject = Subject::where('slug', $slug)->firstOrFail();
    $questions = $subject->questions; 
    return view('subject', [
        'subject'=> $subject,
        'subjects' => Subject::all(),
        'questions' => $questions
    ]);
})->middleware('auth');


Route::get('/home/{question:slug}', function($slug){
    $question = Question::where('slug', $slug)->firstOrFail();
    $answers = $question->answers()->orderBy('created_at', 'asc')->get();
    return view('question', [
        'subjects' => Subject::all(),
        'question'=>$question,
        'answers' => $answers
    ]);
})->middleware('auth');

Route::get('/question/checkSlug', [QuestionController::class, 'checkSlug'])->middleware('auth');
Route::resource('/question', QuestionController::class)->middleware('auth');
Route::resource('/Answer', AnswerController::class)->middleware('auth');
Route::resource('/comment', CommentController::class)->middleware('auth');
Route::resource('/user', UserController::class)->middleware('auth');
Route::get('/Answer/create/{question:slug}', [AnswerController::class, 'create'])->middleware('auth');
Route::get('/comment/create/{answer:id}', [CommentController::class, 'create'])->middleware('auth');

