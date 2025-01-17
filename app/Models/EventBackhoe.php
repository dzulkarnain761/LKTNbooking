<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventBackhoe extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'start_date'];
}
