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
}
