<?php

namespace App\Http\Controllers;

use App\Models\appointment;
use App\Models\Availability;
use App\Models\payment;
use App\Models\specialty;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        if (!Auth::user() || Auth::user()?->role !== 'admin') {
            return redirect(route('home'));
        }

        return view('admin');
    }

    public function adminDashboard()
    {
        $doctorsCount = User::where('role', User::ROLE_DOCTOR)->count();
        $patients = User::where('role', User::ROLE_PATIENT)->count();
        $specialty = specialty::count();
        $appointments = appointment::count();
        $latestDoctors = User::where('role', User::ROLE_DOCTOR)->orderBy('id', 'desc')->limit(5)->get();
        $latestAppointments = appointment::limit(5)->orderBy('id', 'desc')->get();
        $latestTransactions = payment::limit(5)->orderBy('id', 'desc')->get();
        $totalTransaction = payment::where('status', 'Success')->sum('amount');

        return view('admin-dashboard', [
            'doctors' =>  $doctorsCount,
            'patients' =>  $patients,
            'speciality' => $specialty,
            'appointments' => $appointments,
            'latestDoctors' => $latestDoctors,
            'latestAppointments' => $latestAppointments,
            'latestTransactions' => $latestTransactions,
            'totalTransaction' => $totalTransaction
        ]);
    }

    public function speciality()
    {
        if (!Auth::user() || Auth::user()?->role !== 'admin') {
            return redirect(route('home'));
        }

        $speciality = specialty::orderBy('id','desc')->get();

        return view('add-spec', [
            'data' =>  $speciality
        ]);
    }

    public function getSpeciality()
    {
        if (!Auth::user() || Auth::user()?->role !== 'admin') {
            return redirect(route('home'));
        }

        return specialty::orderBy('id','desc')->get();
    }

    public function storeSpeciality(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'description' => ['required']
        ]);

        specialty::create([
           'name' => $data['name'],
           'description' => $data['description']
        ]);

        return redirect(route('admin.add-speciality'));
    }

    public function editSpeciality(specialty $specialty, Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'description' => ['required']
        ]);

        $specialty->update([
            'name' => $data['name'],
            'description' => $data['description']
        ]);

        return redirect(route('admin.add-speciality'));
    }

    public function deleteSpeciality(specialty $specialty)
    {
        $specialty->users()->update(['specialtie_id' => null]);

        $specialty->delete();

        return redirect(route('admin.add-speciality'));
    }

    public function addDoc()
    {
        $speciality = specialty::all()->map(function ($spec) {
            return [
                'label' => $spec->name,
                'value' => $spec->name,
                'id' =>  $spec->id
            ];
        });
        $doctors = User::where('role', User::ROLE_DOCTOR)->orderBy('id', 'desc')->get();

        return view('add-doc', [
            'data' =>  $doctors,
            'speciality' => $speciality
        ]);
    }

    public function getDoc()
    {
        return User::where('role', User::ROLE_DOCTOR)->orderBy('id', 'desc')->with(['specialty', 'availability'])->get();
    }

    public function storeDoc(Request $request)
    {
        $data = $request->validate([
            'specialtie' => ['required', 'exists:specialties,id'],
            'name' => ['required'],
            'email' => ['required', 'email'],
            'mobile_number' => ['required', 'regex:/^(\+?[1-9]\d{1,14})$/'],
            'amount' => ['required']
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => User::ROLE_DOCTOR,
            'password' => Hash::make('password'),
            'specialtie_id' => $data['specialtie'],
            'mobile_number' => $data['mobile_number'],
            'amount' => $data['amount']
        ]);

        $formattedAvailability = [];
        $availability = $request->input('availability');
        foreach ($availability as $day => $times) {
            $dayConstant = constant("App\Models\Availability::" . $day);

            if (!empty($times['start_hour']) && !empty($times['end_hour'])) {
                $start = $times['start_hour'] . ':' . $times['start_minute'];
                $end = $times['end_hour'] . ':' . $times['end_minute'];

                $formattedAvailability[] = [
                    'user_id' => $user->id,
                    'day' => $dayConstant,
                    'start_time' => $start,
                    'end_time' => $end,
                ];
            }
        }

        foreach ($formattedAvailability as $item) {
            Availability::updateOrInsert(
                [
                    'user_id' =>  $item['user_id'],
                    'day' => $item['day']
                ],
                [
                    'start_time' => $item['start_time'],
                    'end_time' => $item['end_time'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            );
        }

        return true;
    }

    public function editDoctor(User $doctor, Request $request)
    {
        $data = $request->validate([
            'specialtie' => ['required', 'exists:specialties,id'],
            'name' => ['required'],
            'email' => ['required', 'email'],
            'amount' => ['required']
        ]);

        $formattedAvailability = [];
        $availability = $request->input('availability');
        foreach ($availability as $day => $times) {
            $dayConstant = constant("App\Models\Availability::" . $day);

            if (!empty($times['start_hour']) && !empty($times['end_hour'])) {
                $start = $times['start_hour'] . ':' . $times['start_minute'];
                $end = $times['end_hour'] . ':' . $times['end_minute'];

                $formattedAvailability[] = [
                    'user_id' => $doctor->id,
                    'day' => $dayConstant,
                    'start_time' => $start,
                    'end_time' => $end,
                ];
            }
        }

        $doctor->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'specialtie_id' => $data['specialtie'],
            'amount' => $data['amount']
        ]);

        Availability::where('user_id', $doctor->id)
            ->forceDelete();

        foreach ($formattedAvailability as $item) {
           Availability::updateOrInsert(
                [
                    'user_id' =>  $item['user_id'],
                    'day' => $item['day']
                ],
                [
                    'start_time' => $item['start_time'],
                    'end_time' => $item['end_time'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            );
        }

        return redirect(route('admin.add-doctor'));
    }

    public function deleteDoctor(User $doctor)
    {
        $doctor->availability()->delete();
        $doctor->delete();

        return redirect(route('admin.add-doctor'));
    }

    public function viewDoc()
    {
        return view('view-doc');
    }

    public function viewAppointments()
    {
        return view('admin-view-appointments', [
            'data' => appointment::orderBy('id', 'desc')->get()
        ]);
    }

    public function getAppointments()
    {
        return view('admin-view-appointments', [
            'data' => appointment::orderBy('id', 'desc')->get()
        ]);
    }

    public function users()
    {
        return view('users');
    }

    public function getUsers()
    {
        return User::get();
    }

    public function resetPassword(User $user, Request $request)
    {
        $user->update([
            'password' => Hash::make($request->input('password')),
        ]);

        session()->flash('success', 'Password reset successfully');
        return redirect(route('admin.users'));
    }
}
