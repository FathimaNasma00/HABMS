<?php

namespace App\Http\Controllers;

use App\Mail\contactUsMail;
use App\Models\specialty;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function login()
    {
        if (Auth::user()) {
            return redirect(route('home'));
        }

        return view('login');
    }

    public function register()
    {
        if (Auth::user()) {
            return redirect(route('home'));
        }

        return view('register');
    }

    public function findDoc(Request $request)
    {
        $list = null;

        if ($request->has('specialtie')  && $request->has('date')) {
            $date = Carbon::parse($request->input('date'));
            $list = User::where('role', User::ROLE_DOCTOR)
                ->where('specialtie_id', $request->input('specialtie'))
                ->whereHas('availability', function ($query) use ($date) {
                    $query->where('day', $date->dayOfWeek);
                })
                ->get()
                ->map(function ($doc) use ($date) {
                    return [
                        'label' => $doc->name,
                        'value' => $doc->name,
                        'id' => $doc->id,
                        'date' => $date->toDateString()
                    ];
                });
        }

        return view('find-doc', [
            'speciality' => specialty::all()->map(function ($spec) {
                return [
                    'label' => $spec->name,
                    'value' => $spec->name,
                    'id' => $spec->id
                ];
            }),
            'list' => $list
        ]);
    }

    public function aboutUs()
    {
        return view('about-us');
    }

    public function contactUs()
    {
        return view('contact-us');
    }

    public function contactUsSend(Request $request)
    {
        Mail::to(config('mail.from.address'))->send(
            new contactUsMail(
                $request->input('name'),
                $request->input('email'),
                $request->input('message')
            )
        );

        return redirect(route('contact-us'));
    }
}
