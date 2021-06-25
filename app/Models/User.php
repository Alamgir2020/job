<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function favorite_posts()
    {
        return $this->belongsToMany(Post::class, 'post_user_favorite')->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function can_post()
    {
        $role = $this->role;
        if ($role === 'author' || $role === 'admin') {
            return true;
        }
        return false;
    }

    public function is_admin()
    {
        $role = $this->role;
        if ($role === 'admin') {
            return true;
        }
        return false;
    }

    /**
     * The likedPosts that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function likedPosts()
    {
        return $this->belongsToMany(Post::class);
    }

    /**
     * The reportedPosts that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function reportedPosts()
    {
        return $this->belongsToMany(Post::class, 'post_user_report')->withTimestamps();
    }

    public function followers()
    {

        return $this->belongsToMany(User::class, 'followers', 'leader_id', 'follower_id')->withTimestamps();
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'leader_id')->withTimestamps();
    }
}
