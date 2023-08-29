<?php

namespace App\Models;

use App\Models\Song;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Enums\PlaylistAccessibility;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Playlist extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'accessibility' => PlaylistAccessibility::class,
    ];

    public function songs()
    {
        return $this->belongsToMany(Song::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublicList($query)
    {
        return $this->where('accessibility', PlaylistAccessibility::PUBLIC);
    }

    public function scopePrivateList($query)
    {
        return $this->where('accessibility', PlaylistAccessibility::PRIVATE);
    }

    public function scopeOfUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
    public function scopeFilterByAccessibility($query, $accessibility)
    {
        return $query->where('accessibility', $accessibility);
    }

    public function isPrivate(): bool
    {
        return $this->accessibility === PlaylistAccessibility::PRIVATE;
    }

    public function scopeWithNameLike($query, $name)
    {
        return $query->where('name', 'like', "%{$name}%");
    }

    public function scopeSortedBy($query, $sortOption)
    {
        switch ($sortOption) {
            case 'oldest':
                return $query->orderBy('created_at', 'asc');
            case 'name_asc':
                return $query->orderBy('name', 'asc');
            case 'name_desc':
                return $query->orderBy('name', 'desc');
            case 'latest':
            default:
                return $query->orderBy('created_at', 'desc');
        }
    }
}
