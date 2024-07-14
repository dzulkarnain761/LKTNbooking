<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // Define the table name if it's different from the default 'payments'
    protected $table = 'payments';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'booking_vehicle_id',
        'amount',
        'payment_date',
        'status',
        'refund_amount',
        'refund_date'
    ];


    // Define the relationship with the BookingVehicle model
    public function bookingVehicle()
    {
        return $this->belongsTo(BookingVehicle::class, 'booking_vehicle_id');
    }
}
