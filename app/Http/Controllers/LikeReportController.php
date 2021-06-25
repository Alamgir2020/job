<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LikeReportController extends Controller
{
    //

    public function likePost($id)
    {


        // Check if user already liked the post or not
        $user = Auth::user();

        $likedPost = $user->likedPosts()->where('post_id', $id)->count();
        if ($likedPost == 0) {
            $user->likedPosts()->attach($id);

            $post = Post::findOrFail($id);

            $postLikingUsers = $post->likingUsers->count();

            $stringUsers = strval($postLikingUsers);

            $stringUsers = $stringUsers . ' people liked this';

            return response()->json(['success' => '<i class="fas fa-thumbs-up mr-2"></i>Liked', 'users' => $stringUsers]);

            // return response()->json('Liked');
        } else {
            $user->likedPosts()->detach($id);

            $post = Post::findOrFail($id);

            $postLikingUsers = $post->likingUsers->count();

            $stringUsers = strval($postLikingUsers);

            $stringUsers = $stringUsers . ' people liked this';

            return response()->json(['success' => '<i class="far fa-thumbs-up mr-2"></i>Like This Post', 'users' => $stringUsers]);

            // return response()->json('Like This Post');

        }
        // return redirect()->back();

    }

    public function addToFavorite($id)
    {

        $user = Auth::user();

        $favoritePost = $user->favorite_posts()->where('post_id', $id)->count();

        if ($favoritePost == 0) {

            $user->favorite_posts()->attach($id);

            return response()->json('<i class="fas fa-heart mr-2"></i>Added To Favorite');
        } else {

            $user->favorite_posts()->detach($id);

            return response()->json('<i class="far fa-heart mr-2"></i>Add To Favorite');
        }
    }

    public function reportPost($id)
    {

        $user = Auth::user();

        $reportedPost = $user->reportedPosts()->where('post_id', $id)->count();

        if ($reportedPost == 0) {

            $user->reportedPosts()->attach($id);

            return redirect()->back()->with('success', 'Post reported successfully');
        } else {

            $user->reportedPosts()->detach($id);

            return redirect()->back()->with('success', 'Post unreported successfully');
        }
    }

    /**
     * Follow the user.
     *
     * @param $id
     *
     */
    public function followUser(int $id)
    {

        $user = Auth::user();

        $leaderFound = $user->followings()->where('leader_id', $id)->count();

        if ($leaderFound == 0) {


            $user->followings()->attach($id);


            return response()->json('<i class="fas fa-star mr-2"></i>Followed');
        } else {


            $user->followings()->detach($id);


            return response()->json('<i class="far fa-star mr-2"></i>Follow');
        }
    }
}
