<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\mOffer;
use App\Models\mRequest;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class ViewOffers extends Controller
{
    public function index()
    {
        $school_data = School::where('id_school', Auth::user()->id_school)->first();

        $request_tutorial_count = mRequest::where('id_school', Auth::user()->id_school)
            ->where('req_type', 'tutorial')
            ->leftjoin('tutorial_request', 'tutorial_request.id_tutorial_request','=','request.id_tutorial_request')
            ->count();

        $request_resource_count = mRequest::where('id_school', Auth::user()->id_school)
            ->where('req_type', 'resource')
            ->leftjoin('resource_request', 'resource_request.id_resource_request','=','request.id_resource_request')
            ->count();

        $request = mRequest::where('id_school', Auth::user()->id_school)
            ->where('req_request_status','new')
            ->get();

        $offer_count = mOffer::leftjoin('request', 'request.id_request','=','offer.id_request')
            ->where('request.id_school', Auth::user()->id_school)
            ->where('offer_status', 'pending')
            ->count();


        $data = [
            'school_data' => $school_data,
            'request_tutorial_count' => $request_tutorial_count,
            'request_resource_count' => $request_resource_count,
            'offer_count' => $offer_count,
            'request' => $request,
        ];

        return view('schoolAdmin/offers/offers', $data);
    }

    public function view_offers($id)
    {
        $id = Crypt::decrypt($id);
        $request = mRequest
            ::where('request.id_request', $id)
            ->leftjoin('school', 'school.id_school','=','request.id_school')
            ->leftjoin('tutorial_request', 'tutorial_request.id_tutorial_request','=','request.id_tutorial_request')
            ->leftjoin('resource_request', 'resource_request.id_resource_request','=','request.id_resource_request')
            ->first();

        $offer = mOffer::where('id_request', $id)
            ->where('offer_status', 'pending')
            ->leftjoin('volunteer', 'volunteer.id_volunteer', '=', 'offer.id_volunteer')
        ->get();

        $data = [
            'request' => $request,
            'offer' => $offer,
        ];

        return view('schoolAdmin/offers/viewOffers', $data);
    }

    public function accept_offer($id)
    {
        $id = Crypt::decrypt($id);
        $offer = mOffer
            ::where('offer.id_offer', $id)
            ->leftjoin('volunteer', 'volunteer.id_volunteer','=','offer.id_volunteer')
            ->first();

        $data_insert = [
            'offer_status' => 'accepted',
        ];

        $offer->update($data_insert);

        $email = $offer->vol_email;
        $data = [
            "subject"=>"School Help Notification",
            "body"=>"Thankyou for your support!"
        ];
        Mail::to($email)->send(new SendMail($data));

        return redirect()->back();
    }

    public function close_request($id)
    {
        $id = Crypt::decrypt($id);
        $request = mRequest
            ::where('request.id_request', $id)
            ->first();

        $data_insert = [
            'req_request_status' => 'closed',
        ];

        $request->update($data_insert);
        return redirect()->back();
    }
}
