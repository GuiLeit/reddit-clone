<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\PostVoteFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class PostVote extends Model
{
    /** @use HasFactory<PostVoteFactory> */
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'type',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
