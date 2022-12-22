@extends('volunteer.offers.mainOffers')

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
                    <h1><b>List of Offers</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Offers</li>
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
                <div class="small-box bg-info">
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
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$request_resource_count}}</h3>

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
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$offer_count}}</h3>

                        <p>Offers</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="card my-3 card-warning">
            <div class="card-header">
                <h3 class="card-title"><b>List of Offers made by you</b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="20">NO</th>
                        <th>Offer Date</th>
                        <th>Offer Remarks</th>
                        <th>Offer Amount</th>
                        <th>Request Description</th>
                        <th>Offer Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($i=0; $i<count($offer); $i++)
                        <tr>
                            <td>{{$i+1}}</td>
                            <td>{{date('j F Y', strtotime($offer[$i]->offer_date))}}</td>
                            <td>{{$offer[$i]->offer_remarks}}</td>
                            <td>{{$offer[$i]->offer_amount}}</td>
                            <td>{{$offer[$i]->req_description}}</td>
                            <td class="d-flex justify-content-center">
                                <span class="badge-pill badge-success">{{$offer[$i]->offer_status}}</span>
                            </td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>

    </section>
    <!-- /.content -->
@endsection
