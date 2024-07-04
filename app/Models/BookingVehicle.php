<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingVehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vehicle_type',
        'task',
        'state',
        'district',
        'location',
        'land_size',
        'task_date',
        'estimated_time',
        'estimated_cost',
        'status',
        'actual_time',
        'actual_cost',
        'rejected_by',
        'rejected_reason',
        'updated_by_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
