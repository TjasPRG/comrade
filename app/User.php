<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Laravel\Passport\HasApiTokens;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return Arr::only($this->toArray(), ['id', 'name']);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function votedPosts()
    {
        return $this->belongsToMany(Post::class, 'votes', 'user_id', 'post_id')
            ->withPivot('score');
    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id');
    }

    public function images() {
        return $this->hasMany(UserImage::class);
    }

    public function coverImage() {
        return $this->hasOne(UserImage::class)
            ->orderByDesc('id')
            ->where('location', 'cover')
            ->withDefault(function($userImage) {
                $userImage->path = 'default/cover.png';
            });
    }

    public function profileImage() {
        return $this->hasOne(UserImage::class)
            ->orderByDesc('id')
            ->where('location', 'profile')
            ->withDefault(function($userImage) {
                $userImage->path = 'default/profile.png';
            });
    }

}
