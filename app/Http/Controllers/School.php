<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class School extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $school = \App\Models\School::all();
        $schoolCount = \App\Models\School::count();
        $user = \App\Models\User::all();
        $user_count = \App\Models\User::count();

        $data = [
            'user' => $user,
            'user_count' => $user_count,
            'school' => $school,
            'school_count' => $schoolCount
        ];

        return view('masterAdmin/dashboard/dashboard', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'school_name' => "required|unique:school",
        ]);

        $school_name = $request->input('school_name');
        $school_address = $request->input('school_address');
        $school_city = $request->input('school_city');
        $data_insert = [
            'school_name' => $school_name,
            'school_address' => $school_address,
            'school_city' => $school_city,
        ];

        \App\Models\School::create($data_insert);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function createAccount($id)
    {
        $id = Crypt::decrypt($id);
        $schoolCount = \App\Models\School::count();
        $user_count = \App\Models\User::count();
        $school = \App\Models\School
            ::where('school.id_school', $id)
            ->first();

        $data = [
            'user_count' => $user_count,
            'school' => $school,
            'school_count' => $schoolCount
        ];

        return view('masterAdmin/dashboard/createSchoolAccount', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function storeAccount(Request $request, $id)
    {
        $id = Crypt::decrypt($id);

        $this->validate($request, [
            'email' => "required|unique:users",
            'username' => "required|unique:users",
        ]);

        $name = $request->input('name');
        $username = $request->input('username');
        $email = $request->input('email');
        $password = $request->input('password');
        $data_insert = [
            'id_school' => $id,
            'level_user' => 'school_admin',
            'username' => $username,
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ];

        User::create($data_insert);
        return redirect(route('manageUsers'));
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $schoolCount = \App\Models\School::count();
        $user_count = \App\Models\User::count();
        $school = \App\Models\School
            ::where('school.id_school', $id)
            ->first();

        $data = [
            'user_count' => $user_count,
            'school' => $school,
            'school_count' => $schoolCount
        ];

        return view('masterAdmin/dashboard/editSchool', $data);
    }

    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $school = \App\Models\School
            ::where('school.id_school', $id)
            ->first();

        $this->validate($request, [
            'school_name' => "required|unique:school",
            'username' => "required|unique:school",
        ]);

        $school_name = $request->input('school_name');
        $school_address = $request->input('school_address');
        $school_city = $request->input('school_city');
        $data_insert = [
            'school_name' => $school_name,
            'school_address' => $school_address,
            'school_city' => $school_city,
        ];

        $school->update($data_insert);
        return redirect(route('dashboardSchool'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        \App\Models\School::where('id_school', $id)->delete();
        User::where('id_school', $id)->delete();

        return redirect(route('dashboardSchool'));
    }
}
