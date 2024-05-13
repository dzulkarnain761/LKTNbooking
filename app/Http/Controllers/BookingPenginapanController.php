<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingPenginapanController extends Controller
{
    public function penginapan(Request $request)
    {
        $sewaType = $request->input('sewa-type');
        $tarikhMasuk = $request->input('tarikh-sewa');
        $tempohSewa = $request->input('tempoh-sewa');

        $formattedtarikhMasuk = date('d/m/Y', strtotime($tarikhMasuk));

        $rooms = array(
            array(
                "name" => "Bilik Asrama",
                "image" => "images/bilik asrama.jpeg",
                "bedType" => "2 Single Bed",
                "capacity" => "2 Orang",
                "quantity" => 54,
                "price" => 70
            ),
            array(
                "name" => "Bilik VIP",
                "image" => "images/bilik vip.jpeg",
                "bedType" => "2 Single Bed",
                "capacity" => "2 Orang",
                "quantity" => 2,
                "price" => 45
            ),
            array(
                "name" => "Rumah Tumpangan",
                "image" => "images/rumah-tumpangan.jpg",
                "bedType" => "2 Double 2 Single Bed",
                "capacity" => "Keluarga",
                "quantity" => 2,
                "price" => 160
            )
        );

        // Calculate end date
        $tarikhKeluar = date('d/m/Y', strtotime("$tarikhMasuk + $tempohSewa days"));

        if ($sewaType == 'booking-penginapan') {
            return view('LKTNbooking.bookingPage.penginapan', [
                'tarikhMasuk' => $formattedtarikhMasuk,
                'tempohSewa' => $tempohSewa,
                'tarikhAkhir' => $tarikhKeluar,
                'rooms' => $rooms
            ]);
        } else {
            return view('LKTNbooking.bookingPage.dewan', [
                'tarikhMasuk' => $formattedtarikhMasuk,
                'tempohSewa' => $tempohSewa,
                'tarikhAkhir' => $tarikhKeluar,
                'rooms' => $rooms
            ]);
        }
    }

    public function paymentPagePenginapan(Request $request)
    {

        $rooms = $request->input('rooms');

       
        // dd($rooms);
        $checkin = $request->input('tarikh-checkin');
        $checkout = $request->input('tarikh-checkout');
        $tempoh = $request->input('tempoh');

    
        return view('LKTNbooking.payment_page_penginapan', [
            'checkin' => $checkin,
            'checkout' => $checkout,
            'tempoh' => $tempoh,
            'rooms' => $rooms,
        ]);
    }
}
