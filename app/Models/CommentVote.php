<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\CommentVoteFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class CommentVote extends Model
{
    /** @use HasFactory<CommentVoteFactory> */
    use HasFactory;

    protected $fillable = [
        'comment_id',
        'user_id',
        'type',
    ];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
