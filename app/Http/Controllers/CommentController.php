<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;
use App\Comment;

use Auth;

class CommentController extends Controller
{
    //
    
    public function postOne(Request $request, $articleId)
    {
        $user = Auth::user();
        $article = Article::find($articleId);
        if ( is_null($article) ) {
            abort(404);
        }
        $comment = new Comment([
            'body' => $request->input('articleComment'),
        ]);
        $comment->user_id = $user->id;
        
        $article->comments()->save($comment);
        return redirect('/articles/'.$articleId);
    }
}