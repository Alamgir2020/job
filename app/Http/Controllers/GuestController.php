<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    //

    public function welcome()
    {

        $categories = Category::latest()
            ->withCount('posts')
            ->get();

        return view('welcome', compact('categories'));
    }

    public function categoryWisePostsList($slug)
    {

        $category = Category::where('slug', $slug)->firstOrFail();

        $posts = $category->posts()->where('active', 1)->get();

        return view('categoryWisePostsList', compact('category', 'posts'));
    }

    public function userWisePosts(User $user)
    {
        // return $user;

        $posts = $user->posts()
            ->where('active', 1)
            ->latest()
            ->get();

        // return $posts;

        return view('userWisePosts', compact('posts', 'user'));
    }

    public function allCategories()
    {

        $categories = Category::orderBy('name')
            ->withCount('posts')
            ->get();

        return view('searchACategory', compact('categories'));
    }

    public function allTablesOfContents()
    {

        $category = Category::where('name', 'TABLE OF CONTENTS')->first();

        if (!$category) {
            return redirect()->back()->withErrors('No table of contents available.');
        }

        $allTablesOfContents = $category->posts;

        return view('allTablesOfContents', compact('allTablesOfContents'));
    }

    public function allCourses()
    {

        $category = Category::where('name', 'OFFERED COURSE')->firstOrFail();

        $offeredCourses = $category->posts;

        return view('allCourses', compact('offeredCourses'));
    }

    public function allPosts()
    {

        // $posts = Post::all();

        $posts = Post::where('active', 1)->get();

        return view('allPosts', compact('posts'));
    }

    public function searchPostsWithKeywords()
    {

        return view('searchPostsWithKeywords');
    }

    public function search(Request $request)
    {

        if ($request->ajax()) {
            $output = "";
            $posts = Post::where('title', 'LIKE', '%' . $request->search . "%")
                ->orWhere('keywords', 'like', '%' . $request->search . '%')
                ->orWhere('body', 'like', '%' . $request->search . '%')
                ->get();
            if ($posts) {
                foreach ($posts as $key => $post) {


                    $output .= '<li class="list-group-item">' .

                        '<h3><a href="/post/' . $post->slug . '">' .
                        $post->title . '</a></h3></li>';
                }
                return Response($output);
            }
        }
    }
}
