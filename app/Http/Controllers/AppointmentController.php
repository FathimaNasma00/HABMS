<?php

namespace App\Http\Controllers;


use App\Mail\DoctorMail;
use App\Mail\PatientMail;
use App\Models\appointment;
use App\Models\Availability;
use App\Models\payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        return view('appointment', [
            'selectedDoc' => $request->input('doctor'),
            'doctors' => User::where('role', User::ROLE_DOCTOR)->orderBy('name')->get()->map(function ($doc) {
                return [
                    'label' => $doc->name,
                    'value' => $doc->name,
                    'id' => $doc->id
                ];
            }),
            'data' => appointment::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function get()
    {
        return appointment::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')
            ->with('doctor')
            ->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'doctor' => ['required', 'exists:users,id'],
            'date' => ['required'],
            'name' => ['nullable'],
            'age' => ['nullable'],
            'email' => ['nullable'],
            'is_other' => ['required'],
            'mobile' => ['nullable', 'regex:/^07\d{8}$/']
        ], [
            'mobile_number.regex' => 'The mobile number format is invalid.',
        ]);

        $doctor = User::where('id', $data['doctor'])->first();

        $avai = Availability::where('user_id', $doctor->id)
            ->where('day', Carbon::parse($data['date'])->dayOfWeek)
            ->exists();

       if (!$avai) {
           return response(
               'Doctor not available for selected date',
               400
           );
       }

        $serviceCharges = config('app.service_charges');
        $doctorCharges = $doctor->amount;
        $total = $serviceCharges+$doctorCharges;

        if ($request->input('is_other') === false) {
            $data['name'] = Auth::user()->name;
            $data['mobile'] = Auth::user()->mobile_number;
            $data['email'] = Auth::user()->email;
        }

        $appointment = appointment::create([
            'doctor_id' => $data['doctor'],
            'user_id' => Auth::user()->id,
            'name' => $data['name'],
            'age' => $data['age'],
            'mobile_number' => $data['mobile'],
            'date' => Carbon::parse($data['date'])->toDateString(),
            'time' => Carbon::now()->addHours(2)->toTimeString(),
            'is_other' => $data['is_other'],
            'amount' => $total,
            'email' => $data['email']
        ]);

        return response()->json([
            'doctorCharge' => number_format($doctorCharges, 2),
            'serviceCharge' => number_format($serviceCharges, 2),
            'total' => number_format($total, 2),
            'url' => route('payment', [
                'appointment' => $appointment
            ])
        ]);
    }

    public function payment(appointment $appointment, Request $request)
    {
        return view('payment', [
            'appointment' => $appointment
        ]);
    }

    public function paymentComplete(appointment $appointment, Request $request)
    {
        $creditCard = $request->input('card');
        $status = 'Success';
        $maskedCard = Str::mask($creditCard, '*', 4);

        if ($creditCard == '5123 4500 0000 0001') {
            $status = 'Failed';
        }

        $payment = payment::create([
           'appointment_id' => $appointment->id,
           'amount' => $appointment->amount,
           'currency' => 'LKR',
           'status' => $status,
           'method' => 'CARD',
           'card' => $maskedCard,
        ]);

        $appointment->status = $status === 'Success' ? 'active' : 'inactive';
        $appointment->save();

        if ($status === 'Success') {
            $doctor = User::where('id',$appointment->doctor_id)->first();
            Mail::to($appointment->email)->send(new PatientMail($appointment));
            Mail::to($doctor->email)->send(new DoctorMail($appointment));

            return redirect()
                ->route('my-appointment')
                ->with('success', 'Appointment created successfully!');
        }

        return redirect()
            ->route('my-appointment')
            ->with('error', 'Payment failed!');
    }
}
