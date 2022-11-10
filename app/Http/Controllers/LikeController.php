<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index(Post $post)
    {
        $likes = $post->likes;

        // return view();
    }

    public function store(Request $request, Post $post)
    {                
        // Verificar si el usuario ya ha dado like antes


        // Almacenar el like en la DB
        $post->likes()->create([
            'user_id'=>auth()->user()->id
        ]);
        
        return back()->with('mensaje', 'Like realizado exitosamente');
    }

    public function destroy(Request $request, Post $post)
    {
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }        
}
