@extends('masterAdmin.dashboard.mainDashboard')

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
                    <h1><b>School Help</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">SchoolHelp</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$school_count}}</h3>

                        <p>School</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$user_count}}</h3>

                        <p>Users</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title pt-2"><b>Edit School</b></h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-primary" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                        Edit School
                    </button>
                </div>
            </div>
            <div class="card-body" >
                <form method="POST" action="{{route('updateSchool', ['id' => \Illuminate\Support\Facades\Crypt::encrypt($school->id_school)])}}">
                    @csrf

                    <div class="row mb-3">
                        <label for="school_name" class="col-md-3 col-form-label text-md-end">School Name</label>

                        <div class="col-md-9">
                            <input id="school_name" type="text" class="form-control @error('school_name') is-invalid @enderror" name="school_name" value="" required autocomplete="school_name" autofocus>

                            @error('school_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="address" class="col-md-3 col-form-label text-md-end">School Address</label>
                        <div class="col-md-9">
                            <input id="address" type="text" class="form-control " name="school_address" value="" required autocomplete="address">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="city" class="col-md-3 col-form-label text-md-end">School City</label>
                        <div class="col-md-9">
                            <input id="city" type="text" class="form-control" name="school_city" required autocomplete="city">
                        </div>
                    </div>

                    <div class="row mb-0 mt-5">
                        <div class="col-md-12 ">
                            <button type="submit" class="btn btn-primary btn-block">
                                Update School
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
