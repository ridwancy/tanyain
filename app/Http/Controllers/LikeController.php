<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Answer;
use Illuminate\Http\Request;


class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function like(Request $request, $id)
    {
        $answer = Answer::with('likes')->findOrFail($id);
        $like = Like::where('answer_id', $id)->where('user_id', auth()->user()->id)->first();
        if($like){
            $like->delete();
        }
        else {
            Like::create([
                'user_id' => auth()->user()->id,
                'answer_id' => $answer->id
            ]);
        }
        if (!$request->session()->has('isRefreshAfterLike')) {
            echo '<script>saveScrollPositionForLike(); sessionStorage.setItem("isRefreshAfterLike", "true");</script>';
        }
        return redirect()->back()->with('isRefreshedAfterLike', true);
    }
    
}
