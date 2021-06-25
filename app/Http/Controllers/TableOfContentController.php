<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class TableOfContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $category = Category::where('name', 'TABLE OF CONTENTS')->firstOrFail();

        $tableOfContents = $category->posts;

        return view('welcome', compact('tableOfContents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('tableOfContent.create');
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
        if ($request->user()->can_post()) {

            $request->validate(
                [
                    'title' => 'bail|required|unique:posts|max:255',
                    'categories' => 'bail|required',
                ]
            );

            $slug = Str::slug($request->title);

            $duplicate = Post::where('slug', $slug)->first();

            $post = new Post();
            $post->title = $request->title;
            $post->slug = Str::slug($request->title);

            $request->categories = $request->categories . ',TABLE OF CONTENTS';

            // return $request->categories;

            $post->keywords = trim(preg_replace('/\s+/', ' ', ($request->categories)));
            // $post->image = json_encode($data);
            $post->body = $request->body;

            $post->user_id = $request->user()->id;
            if ($request->has('save')) {
                $post->active = 0;
                $message = 'Post saved successfully';
            } else {
                $post->active = 1;
                $message = 'Post published successfully';
            }
            $post->save();

            if ($post) {
                $categoryNamesArray = explode(',', $request->categories);
                $trimmed_array = array_map('trim', $categoryNamesArray);
                $filtered_array = array_filter($trimmed_array);
                $categoryIds = [];
                foreach ($filtered_array as $categoryName) {

                    $sanitizedCategoryName = preg_replace("/ {2,}/", " ", strtoupper($categoryName));

                    $category = Category::firstOrCreate(
                        [
                            'name' => $sanitizedCategoryName,
                            'slug' => Str::slug($sanitizedCategoryName),
                        ]
                    );
                    if ($category) {
                        $categoryIds[] = $category->id;
                    }
                }
                $post->categories()->sync($categoryIds);
            }

            return redirect()->back()->withSuccess($message);
        } else {
            $message = 'You cannot create a post';
            return redirect()->back()->withErrors($message);
        }
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
    }
}
