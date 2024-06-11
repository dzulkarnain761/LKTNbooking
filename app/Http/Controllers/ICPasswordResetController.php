<?php

// app/Http/Controllers/ICPasswordResetController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class ICPasswordResetController extends Controller
{
    public function showResetForm(Request $request)
    {
        $request->validate([
            'ic_number' => 'required|string|exists:users,ic_number',
        ]);

        return view('auth.reset_ic');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'ic_number' => 'required|string|exists:users,ic_number',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::where('ic_number', $request->ic_number)->firstOrFail();
        $user->password = Hash::make($request->password);
        $user->save();

        return Redirect::route('login')->with('status', 'Kata Laluan Sudah Berjaya Ditukar!');
    }
}

