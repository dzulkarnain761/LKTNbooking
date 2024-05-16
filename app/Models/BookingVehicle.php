<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingVehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'negeri',
        'daerah',
        'kawasan',
        'keluasan',
        'servistype',
        'tugas',
        'task_date',
        'estimated_time',
        'estimated_cost',
        'status',
        'actual_time',
        'actual_cost',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
