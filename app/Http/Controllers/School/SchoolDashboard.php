<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\mOffer;
use App\Models\mRequest;
use App\Models\mResourceRequest;
use App\Models\mTutorialRequest;
use App\Models\School;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolDashboard extends Controller
{
    public function index()
    {
        $school_data = School::where('id_school', Auth::user()->id_school)->first();

        $school = \App\Models\School::all();
        $schoolCount = \App\Models\School::count();
        $user = \App\Models\User::all();
        $user_count = \App\Models\User::count();

        $request_tutorial = mRequest::where('id_school', Auth::user()->id_school)
            ->where('req_type', 'tutorial')
            ->leftjoin('tutorial_request', 'tutorial_request.id_tutorial_request','=','request.id_tutorial_request')
            ->get();
        $request_tutorial_count = mRequest::where('id_school', Auth::user()->id_school)
            ->where('req_type', 'tutorial')
            ->leftjoin('tutorial_request', 'tutorial_request.id_tutorial_request','=','request.id_tutorial_request')
            ->count();

        $request_resource = mRequest::where('id_school', Auth::user()->id_school)
            ->where('req_type', 'resource')
            ->leftjoin('resource_request', 'resource_request.id_resource_request','=','request.id_resource_request')
            ->get();
        $request_resource_count = mRequest::where('id_school', Auth::user()->id_school)
            ->where('req_type', 'resource')
            ->leftjoin('resource_request', 'resource_request.id_resource_request','=','request.id_resource_request')
            ->count();

        $offer = mOffer::leftjoin('request', 'request.id_request','=','offer.id_request')
            ->where('request.id_school', Auth::user()->id_school)
            ->where('offer_status', 'pending')
            ->count();

        $data = [
            'user' => $user,
            'user_count' => $user_count,
            'school' => $school,
            'school_count' => $schoolCount,
            'school_data' => $school_data,
            'request_tutorial' => $request_tutorial,
            'request_tutorial_count' => $request_tutorial_count,
            'request_resource' => $request_resource,
            'request_resource_count' => $request_resource_count,
            'offer' => $offer,
        ];

        return view('schoolAdmin/dashboardSchool', $data);
    }

    public function store_tutorial(Request $request)
    {
        $this->validate($request, [
            'description' => "required",
            'student_level' => "required",
            'student_amount' => "required",
        ]);

        $id_school = Auth::user()->id_school;
        $description = $request->input('description');
        $student_level = $request->input('student_level');
        $student_amount = $request->input('student_amount');

        $data_insert_tutorial = [
            'student_level' => $student_level,
            'student_amount' => $student_amount,
        ];

        $tutorial_request = mTutorialRequest::create($data_insert_tutorial);

        $data_insert = [
            'id_school' => $id_school,
            'id_tutorial_request' => $tutorial_request->id_tutorial_request,
            'req_description' => $description,
            'req_type' => 'tutorial',
            'req_request_date' => Carbon::now(),
            'req_request_status' => 'new',
        ];

        mRequest::create($data_insert);
        return redirect()->back();
    }

    public function store_resource(Request $request)
    {
        $this->validate($request, [
            'description' => "required",
            'resource_type' => "required",
            'number_required' => "required",
        ]);

        $id_school = Auth::user()->id_school;
        $description = $request->input('description');
        $resource_type = $request->input('resource_type');
        $number_required = $request->input('number_required');

        $data_insert_resource = [
            'res_resource_type' => $resource_type,
            'res_number_required' => $number_required,
        ];

        $resource_request = mResourceRequest::create($data_insert_resource);

        $data_insert = [
            'id_school' => $id_school,
            'id_resource_request' => $resource_request->id_resource_request,
            'req_description' => $description,
            'req_type' => 'resource',
            'req_request_date' => Carbon::now(),
            'req_request_status' => 'new',
        ];

        mRequest::create($data_insert);
        return redirect()->back();
    }
}
