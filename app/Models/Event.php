<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;
    protected $fillable=[
            "title",
            "description",
            "image",
            "url",
            "start",
            "end"
    ];
}
