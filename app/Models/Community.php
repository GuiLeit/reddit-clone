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
        if (! $user) {
            return false;
        }

        return $this->members->contains($user);
    }

    // Helper method to check if user is the owner
    public function isOwnedBy($user)
    {
        if (! $user) {
            return false;
        }

        return $this->creator_id === $user->id;
    }

    // Helper method to check if user belongs to community (member OR owner)
    public function userBelongs($user): bool
    {
        if ($this->hasMember($user)) {
            return true;
        }

        return (bool) $this->isOwnedBy($user);
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

    // Query scope to filter communities where user belongs (member OR owner)
    protected function scopeWhereUserBelongs($query, $userId)
    {
        return $query->where(function ($q) use ($userId): void {
            $q->where('creator_id', $userId) // User is the creator/owner
                ->orWhereHas('members', function ($memberQuery) use ($userId): void {
                    $memberQuery->where('user_id', $userId); // User is a member
                });
        });
    }

    // Accessor for image URL
    protected function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }

        // If it's already a full URL, return as is
        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }

        // Otherwise, generate the public URL
        return asset('storage/'.$this->image);
    }
}
