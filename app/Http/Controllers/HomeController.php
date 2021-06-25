<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::id())->get();

        return view('home', compact('posts'));
    }

    public function myFavoritePosts()
    {
        $posts = Auth::user()->favorite_posts()->where('active', 1)->get();

        // return $posts;

        return view('myFavoritePosts', compact('posts'));
    }

    public function myLikedPosts()
    {
        $posts = Auth::user()->likedPosts()->where('active', 1)->get();

        // return $posts;

        return view('myLikedPosts', compact('posts'));
    }

    public function myFollowings()
    {
        $users = Auth::user()->followings()
            ->withCount('posts')
            ->get();
        // return $users;

        return view('myFollowings', compact('users'));
    }

    public function showProfile(User $user)
    {

        return view('profile.showProfile', compact('user'));
    }

    public function myProfile()
    {
        // return 'myProfile';

        $user = Auth::user();

        // return $user;

        return view('profile.myProfile', compact('user'));
    }

    public function editProfile()
    {

        $user = Auth::user();

        return view('profile.editProfile', compact('user'));
    }

    public function updateProfile(Request $request)
    {

        $request->validate(
            [

                'name' => 'bail|required|max:255',
            ]
        );
        // return $request;

        $user = Auth::user();

        // return $user;

        $user->name = $request->name;
        $user->body = $request->body;

        $user->save();

        $message = 'Profile published successfully';

        return redirect()->back()->withSuccess($message);
    }

    public function changePassword()
    {
        return view('profile.changePassword');
    }

    public function updatePassword(Request $request)
    {

        $this->validate($request, [

            'oldpassword' => 'required',
            'newpassword' => 'required',
            'password_confirmation' => 'same:newpassword',
        ]);

        // return $request;

        $hashedPassword = Auth::user()->password;

        if (\Hash::check($request->oldpassword, $hashedPassword)) {

            if (!\Hash::check($request->newpassword, $hashedPassword)) {

                $users = User::find(Auth::user()->id);
                $users->password = bcrypt($request->newpassword);
                User::where('id', Auth::user()->id)->update(array('password' => $users->password));

                // session()->flash('message', 'password updated successfully');

                $message = 'password changed successfully';

                return redirect()->back()->withSuccess($message);
            } else {

                $message = 'new password can not be the old password!';

                return redirect()->back()->withSuccess($message);
            }
        } else {

            $message = 'old password doesn\'t matched';

            return redirect()->back()->withSuccess($message);
        }

        // }
    }

    public function manageUsers()
    {
        // return 'manageUsers';

        if (Auth::user()->role === 'admin') {

            $users = User::orderBy('name')
                ->withCount('posts')
                ->get();


            // return $users;

            return view('manageUsers', compact('users'));
        } else {
            // return redirect()->back();
            return redirect('home')->with('error', 'You are not authorized');
        }
    }

    public function manageCategories()
    {
        // return 'manageUsers';

        if (Auth::user()->role === 'admin') {

            $categories = Category::withCount('posts')->get();

            return view('manageCategories', compact('categories'));
        } else {
            // return redirect()->back();
            return redirect('home')->with('error', 'You are not authorized');
        }
    }

    public function deleteUser($id)
    {

        if (Auth::user()->role === 'admin') {

            // return $id;

            $user = User::find($id);

            // return $user;

            if ($user->role === 'admin') {
                // return $user->role;
                return redirect()->route('manageUsers')->with('error', 'You cannot delete admin');
            } else {
                // return $user->role;

                $user->favorite_posts()->detach();
                $user->likedPosts()->detach();
                $user->reportedPosts()->detach();
                $user->followers()->detach();
                $user->followings()->detach();

                $user->delete();

                return redirect()->back()->with('success', 'User deleted successfully');
            }
        } else {
            return redirect('home')->with('error', 'You are not authorized');
        }
    }

    public function deleteCategory($id)
    {
        // return $id;
        if (Auth::user()->role === 'admin') {

            // return $id;

            $category = Category::find($id);

            // return $category;


            $category->posts()->detach();

            $category->delete();

            return redirect()->back()->with('success', 'category deleted successfully');
        } else {
            return redirect('home')->with('error', 'You are not authorized');
        }
    }
}
