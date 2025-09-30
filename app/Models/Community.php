<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

final class Community extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'subforum',
        'description',
        'image',
        'creator_id',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'community_members', 'community_id', 'user_id')->withTimestamps();
    }

    // Helper method to check if user is a member
    public function hasMember($user)
    {
        if (!$user) return false;
        return $this->members->contains($user);
    }

    // Helper method to check if user is the owner
    public function isOwnedBy($user)
    {
        if (!$user) return false;
        return $this->creator_id === $user->id;
    }

    // Helper method to check if user belongs to community (member OR owner)
    public function userBelongs($user)
    {
        return $this->hasMember($user) || $this->isOwnedBy($user);
    }

    protected static function boot(): void
    {
        parent::boot();

        self::creating(function ($community): void {
            if (blank($community->subforum)) {
                $community->subforum = Str::studly($community->name);
            }
        });

        self::updating(function ($community): void {
            if ($community->isDirty('name')) {
                $community->subforum = Str::studly($community->name);
            }
        });
    }
}
