<?php

namespace App\Http\Controllers;

use App\Models\mVolunteer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterVolunteer extends Controller
{
    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string'],
            'birth_date' => ['required', 'string'],
            'address' => ['required', 'string'],
        ]);

        $birth_date = \Carbon\Carbon::parse($request->input('birth_date'))->format('Y-m-d H:i:s');
        $volunteer = mVolunteer::create([
            'vol_name' => $request->input('name'),
            'vol_phone_no' => $request->input('phone'),
            'vol_birth_date' => $birth_date,
            'vol_address' => $request->input('address'),
            'vol_email' => $request->input('email'),
        ]);

        $user = User::create([
            'id_volunteer' => $volunteer->id_volunteer,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
        ]);

        Auth::login($user);

        return redirect()->route('dashboardSchool');
    }
}
