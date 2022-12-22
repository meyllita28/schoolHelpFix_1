@extends('schoolAdmin.offers.mainOffers')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.data-table').DataTable();
        });
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><b>List of Offers for this request</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard School</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="d-flex justify-content-end">
            <a type="button" class="btn btn-primary" href="{{ url()->previous() }}">
                <i class="fas fa-backward"></i>
                Back
            </a>
        </div>

        <div class="row">
            <div class="col-4">
                <div class="card my-3 card-warning shadow">
                    <div class="card-header">
                        <h3 class="card-title pt-2">
                            <i class="fa fa-eye"></i>
                            <b>Detail Request</b></h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-primary" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                                Detail Request
                            </button>
                        </div>
                    </div>
                    <div class="card-body" >
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">School Name</label>
                            <label class="col-md-8 col-form-label text-md-end">: {{$request->req_type}}</label>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">School Name</label>
                            <label class="col-md-8 col-form-label text-md-end">: {{$request->school_name}}</label>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">School Address</label>
                            <label class="col-md-8 col-form-label text-md-end">: {{$request->school_address}}</label>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">School City</label>
                            <label class="col-md-8 col-form-label text-md-end">: {{$request->school_city}}</label>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Description</label>
                            <label class="col-md-8 col-form-label text-md-end">: {{$request->req_description}}</label>
                        </div>
                        @if($request->req_type === 'resource')
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">Resource Type</label>
                                <label class="col-md-8 col-form-label text-md-end">: {{$request->res_resource_type}}</label>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">Number Required</label>
                                <label class="col-md-8 col-form-label text-md-end">: {{$request->res_number_required}}</label>
                            </div>
                        @else
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">Student Level</label>
                                <label class="col-md-8 col-form-label text-md-end">: {{$request->student_level}}</label>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">Student Amount</label>
                                <label class="col-md-8 col-form-label text-md-end">: {{$request->student_amount}}</label>
                            </div>
                        @endif
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Request Date</label>
                            <label class="col-md-8 col-form-label text-md-end">: {{date('j F Y', strtotime($request->req_request_date))}}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card my-3">
                    <div class="card-header">
                        <h3 class="card-title pt-2">
                            <i class="fa fa-laptop"></i>
                            <b>List of Offers</b></h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-primary" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                                List of Offers
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th width="20">NO</th>
                                <th>Offer Date</th>
                                <th>Remarks</th>
                                <th>Amount</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Occupation</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i=0; $i<count($offer); $i++)
                                <tr>
                                    <td>{{$i+1}}</td>
                                    <td>{{date('j F Y', strtotime($offer[$i]->offer_date))}}</td>
                                    <td>{{$offer[$i]->offer_remarks}}</td>
                                    <td>{{$offer[$i]->offer_amount}}</td>
                                    <td>{{$offer[$i]->vol_name}}</td>
                                    <td>{{$offer[$i]->age }} Years Old</td>
                                    <td>{{$offer[$i]->vol_occupation}}</td>
                                    <td class="d-flex justify-content-center">
                                        <a type="button" class="btn btn-success text-center mx-3"
                                           href="{{route('acceptOffer', ['id' => \Illuminate\Support\Facades\Crypt::encrypt($offer[$i]->id_offer)])}}"
                                           title="View Offers">
                                            <i class="fa fa-eye text-white"></i>
                                            Accept Offer
                                        </a>
                                    </td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
@endsection
