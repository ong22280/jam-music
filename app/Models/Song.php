<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Song extends Model
{
    use HasFactory, SoftDeletes;

    public function artist() :BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

    /**
     * Laravel 7 style
     * get[CamelCaseAttribute]Attribute()
    */

    public function getDurationToStringAttribute()
    {
        $minute = (int)($this->duration / 60);
        $second = $this->duration % 60;
        $second = Str::padLeft($second, 2, '0');
        return "{$minute}:{$second}";
    }

    /**
     * Laravel 9,10 style
     */
    // protected function duration_string()
    // {
    //     $minute = (int)($this->duration / 60);
    //     $second = $this->duration % 60;
    //     $second = Str::padLeft($second, 2, '0');
    //     return Attribute::make(
    //         get: "{$minute}:{$second}",
    //         set: fn($value) => $this->duration = (int)($value) * 60 + (int)($value)
    //     );
    // }
}
