<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\CommentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

final class Comment extends Model
{
    /** @use HasFactory<CommentFactory> */
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'parent_id',
        'body',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function votes()
    {
        return $this->hasMany(CommentVote::class);
    }

    public function upvotes()
    {
        return $this->hasMany(CommentVote::class)->where('type', 'upvote');
    }

    public function downvotes()
    {
        return $this->hasMany(CommentVote::class)->where('type', 'downvote');
    }

    public function getUserVote($userId = null)
    {
        if (! $userId) {
            $userId = Auth::id();
        }

        if (! $userId) {
            return null;
        }

        $vote = $this->votes()->where('user_id', $userId)->first();

        return $vote ? $vote->type : null;
    }

    public function upvote(): void
    {
        $existingVote = CommentVote::query()->where('comment_id', $this->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingVote && $existingVote->type === 'upvote') {
            return;
        }

        if ($existingVote && $existingVote->type === 'downvote') {
            $existingVote->update(['type' => 'upvote']);

            return;
        }

        $this->votes()->create(['user_id' => Auth::id(), 'type' => 'upvote']);
    }

    public function downvote(): void
    {
        $existingVote = CommentVote::query()->where('comment_id', $this->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingVote && $existingVote->type === 'downvote') {
            return;
        }

        if ($existingVote && $existingVote->type === 'upvote') {
            $existingVote->update(['type' => 'downvote']);

            return;
        }

        $this->votes()->create(['user_id' => Auth::id(), 'type' => 'downvote']);
    }
}
