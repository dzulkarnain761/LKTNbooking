<?php

namespace App\Http\Controllers;

use App\Models\BookingVehicle;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class BookingVehicleController extends Controller
{


    public function store(Request $request)
    {

        BookingVehicle::create([
            'user_id' => $request->input('user-id'),
            'negeri' => $request->input('negeri'),
            'daerah' => $request->input('daerah'),
            'kawasan' => $request->input('kawasan'),
            'keluasan' => $request->input('keluasan'),
            'servistype' => $request->input('servis-type'),
            'task_date' => $request->input('task-date'),
            'tugas' => $request->input('tugas'),
        ]);

        return redirect('loading');
    }

    public function jengkaut(Request $request)
    {
        $vehicleType = $request->input('vehicle-type');
        $negeriPilihan = $request->input('negeri-pilihan');
        $tarikhMasuk = $request->input('tarikh-sewa');
        $keluasanTanah = $request->input('keluasan-tanah');

        $formattedtarikhMasuk = date('d/m/Y', strtotime($tarikhMasuk));

        $tugasJengkaut = ['BC01-BERSIH KAWASAN', 'BC02-PERPARITAN'];

        $tugasTraktor = ['TR01-PIRING', 'TR02-ROTOR I', 'TR03-ROTOR II', 'TR04-BATAS'];

        $kelantan = ['Pasir Mas', 'Kota Bharu', 'Kubang Kerian'];

        $terengganu = ['Bachok', 'Kuala Terengganu', 'Chendering'];
        $negeri = [];


        if ($negeriPilihan == "Kelantan") {
            $negeri = $kelantan;
        } elseif ($negeriPilihan == "Terengganu") {
            $negeri = $terengganu;
        }

        if (auth()->check()) {

            
            if ($vehicleType == 'booking-jengkaut') {

                return view('LKTNbooking.bookingPage.jengkaut', [
                    'tarikhTempahan' => $formattedtarikhMasuk,
                    'keluasanTanah' => $keluasanTanah,
                    'negeriPilihan' => $negeriPilihan,
                    'tugasJengkaut' => $tugasJengkaut,
                    'negeri' => $negeri
    
                ]);
            } else {
    
                return view('LKTNbooking.bookingPage.traktor', [
                    'tarikhTempahan' => $formattedtarikhMasuk,
                    'keluasanTanah' => $keluasanTanah,
                    'negeriPilihan' => $negeriPilihan,
                    'tugasTraktor' => $tugasTraktor,
                    'negeri' => $negeri
                ]);
            }
            
        } else {
            // User is not logged in, redirect to the login page
            return redirect('login');
        }
        
    }


    public function confirmBookingVehicle(Request $request)
    {

        $jenisSewa = request('jenisSewa');

        $jenisServis = $request->input('jenis-servis');
        $tarikhTempahan = $request->input('tarikh-tempahan');
        $keluasanTanah = $request->input('keluasan-tanah');

        $lokasiTugas = $request->input('lokasi-tugas');
        $daerah = $request->input('pilih-daerah');
        $negeri = $request->input('negeri');
        $pilihanTugas = $request->input('pilihan-tugas');

        return view('LKTNbooking.payment_page_vehicles', [
            'pilihanTugas' => $pilihanTugas,
            'lokasiTugas' => $lokasiTugas,
            'daerah' => $daerah,
            'negeri' => $negeri,
            'tarikhTempahan' => $tarikhTempahan,
            'keluasanTanah' => $keluasanTanah,
            'jenisServis' => $jenisServis,
        ]);
    }

}
