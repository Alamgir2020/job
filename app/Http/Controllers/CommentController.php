<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        // return $request;

        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->user_id = $request->user()->id;
        $comment->body = $request->body;

        $comment->save();

        return redirect()->back()->with('success', 'Comment published successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        // return $id;

        $comment = Comment::findOrFail($id);


        if ($comment->user_id === Auth::id() || Auth::user()->role === 'admin') {

            return view('comment.edit', compact('comment'));
        } else {

            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //


        $comment = Comment::findOrFail($id);


        if ($comment->user_id === Auth::id() || Auth::user()->role === 'admin') {

            $comment->body = $request->body;

            $comment->save();

            $post = Post::findOrFail($comment->post_id);

            return redirect()->route('post.show', $post->slug)->with('success', 'Comment updated successfully');
        } else {

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        // return $id;

        $comment = Comment::findOrFail($id);



        if ($comment->user_id === Auth::id() || Auth::user()->role === 'admin') {

            $comment->delete();

            return redirect()->back()->with('success', 'Comment deleted successfully');
        } else {
            return redirect()->back();
        }
    }
}
