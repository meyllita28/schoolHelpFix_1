@extends('schoolAdmin.mainDashboardSchool')

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
                <h1>Dashboard <b>{{$school_data->school_name}}</b></h1>
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
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$request_tutorial_count}}</h3>

                    <p>Tutorial Request</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$request_resource_count}}<sup style="font-size: 20px"></sup></h3>

                    <p>Resource Request</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$offer}}</h3>

                    <p>Offers</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title pt-2">
                        <i class="fa fa-book"></i>
                        <b>Request Tutorial</b></h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-primary" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                            Request Tutorial
                        </button>
                    </div>
                </div>
                <div class="card-body" >
                    <form method="POST" action="{{ route('submitRequestTutorial') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="description" class="col-md-3 col-form-label text-md-end">Description</label>

                            <div class="col-md-9">
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description" autofocus></textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="student_level" class="col-md-3 col-form-label text-md-end">Student Level</label>

                            <div class="col-md-9">
                                <input id="student_level" type="text" class="form-control @error('student_level') is-invalid @enderror" name="student_level" required autocomplete="student_level" autofocus>
                                @error('student_level')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="student_amount" class="col-md-3 col-form-label text-md-end">Student Amount</label>

                            <div class="col-md-9">
                                <input id="student_amount" type="number" min="1" class="form-control @error('student_amount') is-invalid @enderror" name="student_amount" required autocomplete="student_amount" autofocus>
                                @error('student_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0 mt-5">
                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Request Tutorial
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title pt-2">
                        <i class="fa fa-laptop"></i>
                        <b>Request Resource</b></h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-primary" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                            Request Resource
                        </button>
                    </div>
                </div>
                <div class="card-body" >
                    <form method="POST" action="{{ route('submitRequestResource') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="description" class="col-md-3 col-form-label text-md-end">Description</label>

                            <div class="col-md-9">
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description" autofocus></textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 form-group">
                            <label for="resource_type" class="col-md-3 col-form-label text-md-end">Resource Type</label>

                            <div class="col-md-9">
                                <select id="resource_type" class="form-control @error('resource_type') is-invalid @enderror" type="text"
                                        name="resource_type">
                                    <option value="" disabled selected></option>
                                    <option value="mobile_device">Mobile Device</option>
                                    <option value="personal_computer">Personal Computer</option>
                                    <option value="networking_equipment">Networking Equipment</option>
                                </select>

                                @error('resource_type')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="number_required" class="col-md-3 col-form-label text-md-end">Number Required</label>

                            <div class="col-md-9">
                                <input id="number_required" type="number" min="1" class="form-control @error('number_required') is-invalid @enderror" name="number_required" required autocomplete="number_required" autofocus>
                                @error('number_required')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0 mt-5">
                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Request Resource
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title"><b>Request Tutorial List</b></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th width="20">NO</th>
                            <th>Request Description</th>
                            <th>Student Level</th>
                            <th>Student Amount</th>
                            <th>Request Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for($i=0; $i<count($request_tutorial); $i++)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$request_tutorial[$i]->req_description}}</td>
                                <td>{{$request_tutorial[$i]->student_level}}</td>
                                <td>{{$request_tutorial[$i]->student_amount}}</td>
                                <td class="d-flex justify-content-center">
                                    @if($request_tutorial[$i]->req_request_status === 'new')
                                        <span class="badge-success badge-pill">{{$request_tutorial[$i]->req_request_status}}</span>
                                    @else
                                        <span class="badge-danger badge-pill">{{$request_tutorial[$i]->req_request_status}}</span>
                                    @endif
                                </td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-6">
            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title"><b>Request Resource List</b></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example3" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th width="20">NO</th>
                            <th>Request Description</th>
                            <th>Resource Type</th>
                            <th>Number Required</th>
                            <th>Request Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for($i=0; $i<count($request_resource); $i++)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$request_resource[$i]->req_description}}</td>
                                <td>{{$request_resource[$i]->res_resource_type}}</td>
                                <td>{{$request_resource[$i]->res_number_required}}</td>
                                <td class="d-flex justify-content-center">
                                    @if($request_resource[$i]->req_request_status === 'new')
                                        <span class="badge-success badge-pill">{{$request_resource[$i]->req_request_status}}</span>
                                    @else
                                        <span class="badge-danger badge-pill">{{$request_resource[$i]->req_request_status}}</span>
                                    @endif
                                </td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
@endsection
