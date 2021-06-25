<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function favorite_to_users()
    {
        return $this->belongsToMany(User::class, 'post_user_favorite')->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * The likingUsers that belong to the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function likingUsers()
    {
        return $this->belongsToMany(User::class);
    }


    /**
     * The reportingUsers that belong to the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function reportingUsers()
    {
        return $this->belongsToMany(User::class);
    }
}
