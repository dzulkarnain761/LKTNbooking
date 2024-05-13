<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\BookingVehicle;

class PDFController extends Controller
{
    
    public function generateQuotation(BookingVehicle $booking)
    {
        $pdf = PDF::loadView('quotation',['booking' => $booking]);
        return $pdf->stream('quotation.pdf');
        
    }
}
