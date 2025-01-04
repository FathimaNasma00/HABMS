<?php

namespace App\Http\Controllers;

use App\Models\appointment;
use App\Models\doctor;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function index()
    {
        if (!Auth::user() || Auth::user()?->role !== 'doctor') {
            return redirect(route('home'));
        }

        $appointments = appointment::where('doctor_id', Auth::user()->id)
            ->where('status', 'active')
            ->limit(10)
            ->orderBy('id', 'desc')->get();

        return view('doc', [
            'data' => $appointments
        ]);
    }
}
