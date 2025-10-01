<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Post extends Model
{
    /** @use HasFactory<PostFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'user_id',
        'community_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function community()
    {
        return $this->belongsTo(Community::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function votes()
    {
        return $this->hasMany(PostVote::class);
    }

    public function upvotes()
    {
        return $this->hasMany(PostVote::class)->where('type', 'upvote');
    }

    public function downvotes()
    {
        return $this->hasMany(PostVote::class)->where('type', 'downvote');
    }

    public function getUserVote($userId = null)
    {
        if (!$userId) {
            $userId = auth()->id();
        }
        
        if (!$userId) {
            return null;
        }

        $vote = $this->votes()->where('user_id', $userId)->first();
        return $vote ? $vote->type : null;
    }

    public function getScoreAttribute()
    {
        return $this->upvotes()->count() - $this->downvotes()->count();
    }

    public function getUpvoteCountAttribute()
    {
        return $this->upvotes()->count();
    }

    public function getDownvoteCountAttribute()
    {
        return $this->downvotes()->count();
    }

    public function upvote()
    {
        $existingVote = PostVote::where('post_id', $this->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingVote && $existingVote->type === 'upvote') {
            return;
        } 
        if ($existingVote && $existingVote->type === 'downvote') {
            $existingVote->update(['type' => 'upvote']);
            return;
        }
        $this->votes()->create(['user_id' => auth()->id(), 'type' => 'upvote']);
    }

    public function downvote()
    {
        $existingVote = PostVote::where('post_id', $this->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingVote && $existingVote->type === 'downvote') {
            return;
        } 
        if ($existingVote && $existingVote->type === 'upvote') {
            $existingVote->update(['type' => 'downvote']);
            return;
        }
        $this->votes()->create(['user_id' => auth()->id(), 'type' => 'downvote']);
    }
}
