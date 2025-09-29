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
        'slug',
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

    protected static function boot(): void
    {
        parent::boot();

        self::creating(function ($community): void {
            if (blank($community->slug)) {
                $community->slug = Str::slug($community->name);
            }
        });

        self::updating(function ($community): void {
            if ($community->isDirty('name')) {
                $community->slug = Str::slug($community->name);
            }
        });
    }
}
