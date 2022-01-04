<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\Comment as CommentResource;

class CommentController extends Controller
{
    //
    public function index()
    {
        return response()->json( new CommentCollection(Comment::all()),200) ;
    }
    public function show(Product $product)
    {
        return response()->json(new CommentCollection($product->comments),200);
    }



    public function store (Request $request)
    {
        $comment = Comment::create($request->all());
        return  response()->json($comment, 204);
    }

    public function update(Request $request, Comment $comment)
    {
        $comment->update($request->all());

        return response()->json($comment, 200);
    }

    public function delete(Comment $comment)
    {
        $comment->delete();
        return response()->json(null,204);
    }
}
