<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use App\Models\mOffer;
use App\Models\mRequest;
use App\Models\mVolunteer;
use App\Models\School;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class VolunteerDashboard extends Controller
{
    public function index()
    {
        $volunteer_data = mVolunteer::where('id_volunteer', Auth::user()->id_volunteer)->first();

        $request_tutorial = mRequest::where('req_type', 'tutorial')
            ->where('req_request_status','new')
            ->leftjoin('school', 'school.id_school','=','request.id_school')
            ->leftjoin('tutorial_request', 'tutorial_request.id_tutorial_request','=','request.id_tutorial_request')
            ->get();
        $request_tutorial_count = mRequest::where('req_type', 'tutorial')
            ->where('req_request_status','new')
            ->leftjoin('school', 'school.id_school','=','request.id_school')
            ->leftjoin('tutorial_request', 'tutorial_request.id_tutorial_request','=','request.id_tutorial_request')
            ->count();

        $request_resource = mRequest::where('req_type', 'resource')
            ->where('req_request_status','new')
            ->leftjoin('school', 'school.id_school','=','request.id_school')
            ->leftjoin('resource_request', 'resource_request.id_resource_request','=','request.id_resource_request')
            ->get();
        $request_resource_count = mRequest::where('req_type', 'resource')
            ->where('req_request_status','new')
            ->leftjoin('school', 'school.id_school','=','request.id_school')
            ->leftjoin('resource_request', 'resource_request.id_resource_request','=','request.id_resource_request')
            ->count();

        $offer_count = mOffer::where('offer.id_volunteer', Auth::user()->id_volunteer)
            ->where('offer_status', 'pending')
            ->count();

        $data = [
            'offer_count' => $offer_count,
            'volunteer_data' => $volunteer_data,
            'request_tutorial' => $request_tutorial,
            'request_tutorial_count' => $request_tutorial_count,
            'request_resource' => $request_resource,
            'request_resource_count' => $request_resource_count,
        ];

        return view('volunteer/volunteerDashboard', $data);
    }

    public function view_detail_request_tutorial($id)
    {
        $id = Crypt::decrypt($id);
        $request = mRequest
            ::where('request.id_request', $id)
            ->leftjoin('school', 'school.id_school','=','request.id_school')
            ->leftjoin('tutorial_request', 'tutorial_request.id_tutorial_request','=','request.id_tutorial_request')
            ->first();

        $data = [
            'request' => $request,
        ];

        return view('volunteer/viewRequestTutorial', $data);
    }

    public function view_detail_request_resource($id)
    {
        $id = Crypt::decrypt($id);
        $request = mRequest
            ::where('request.id_request', $id)
            ->leftjoin('school', 'school.id_school','=','request.id_school')
            ->leftjoin('resource_request', 'resource_request.id_resource_request','=','request.id_resource_request')
            ->first();

        $data = [
            'request' => $request,
        ];

        return view('volunteer/viewRequestResource', $data);
    }

    public function make_offer(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $this->validate($request, [
            'remarks' => "required",
            'amount' => "required",
        ]);

        $remarks = $request->input('remarks');
        $amount = $request->input('amount');
        $data_insert = [
            'id_request' => $id,
            'id_volunteer' => Auth::user()->id_volunteer,
            'offer_remarks' => $remarks,
            'offer_amount' => $amount,
            'offer_date' => Carbon::now(),
            'offer_status' => 'pending',
        ];

        mOffer::create($data_insert);

        return redirect()->route('viewOffersVolunteer');
    }

    public function view_offers()
    {
        $volunteer_data = mVolunteer::where('id_volunteer', Auth::user()->id_volunteer)->first();

        $request_tutorial = mRequest::where('req_type', 'tutorial')
            ->where('req_request_status','new')
            ->leftjoin('school', 'school.id_school','=','request.id_school')
            ->leftjoin('tutorial_request', 'tutorial_request.id_tutorial_request','=','request.id_tutorial_request')
            ->get();
        $request_tutorial_count = mRequest::where('req_type', 'tutorial')
            ->where('req_request_status','new')
            ->leftjoin('school', 'school.id_school','=','request.id_school')
            ->leftjoin('tutorial_request', 'tutorial_request.id_tutorial_request','=','request.id_tutorial_request')
            ->count();

        $request_resource = mRequest::where('req_type', 'resource')
            ->where('req_request_status','new')
            ->leftjoin('school', 'school.id_school','=','request.id_school')
            ->leftjoin('resource_request', 'resource_request.id_resource_request','=','request.id_resource_request')
            ->get();
        $request_resource_count = mRequest::where('req_type', 'resource')
            ->where('req_request_status','new')
            ->leftjoin('school', 'school.id_school','=','request.id_school')
            ->leftjoin('resource_request', 'resource_request.id_resource_request','=','request.id_resource_request')
            ->count();

        $offer = mOffer::where('offer.id_volunteer', Auth::user()->id_volunteer)
            ->where('offer_status', 'pending')
            ->leftjoin('request', 'request.id_request','=','offer.id_request')
            ->get();
        $offer_count = mOffer::where('offer.id_volunteer', Auth::user()->id_volunteer)
            ->where('offer_status', 'pending')
            ->count();

        $data = [
            'offer' => $offer,
            'offer_count' => $offer_count,
            'volunteer_data' => $volunteer_data,
            'request_tutorial' => $request_tutorial,
            'request_tutorial_count' => $request_tutorial_count,
            'request_resource' => $request_resource,
            'request_resource_count' => $request_resource_count,
        ];

        return view('volunteer/offers/offers', $data);
    }
}
