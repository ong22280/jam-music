<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status'];

    // Define task statuses
    const STATUS_TODO = 1;
    const STATUS_IN_PROGRESS = 2;
    const STATUS_DONE = 3;
}
