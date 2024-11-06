@extends('vendor.layouts.app')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-12 d-flex justify-content-between">
                    <a href="{{url()->previous()}}" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                    <h5>Pet Vaccines</h5>
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#AddVaccineModal">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Vaccine
                    </button>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Add vaccine model -->
    <div class="modal fade" id="AddVaccineModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{route('vendor.client.pets.vaccine.store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="pet_id" value="{{$pet->id}}">

                    <div class="modal-header">
                        <h6 class="modal-title">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Vaccine
                        </h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="VaccineName" class="form-label mb-1 fs-6">Vaccine Name</label>
                                <input type="text" class="form-control " name="vaccine_name" id="VaccineName" placeholder="Enter Vaccine Name">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="VaccineDate" class="form-label mb-1">Vaccine Date</label>
                                <input type="date" class="form-control" name="vaccine_date" id="VaccineDate">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="VaccineExpiry" class="form-label mb-1">Vaccine Expiry</label>
                                <input type="date" class="form-control" name="vaccine_expiry_date" id="VaccinExpiry">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="VeterniaryName" class="form-label mb-1">Veterniary Name</label>
                                <input type="text" class="form-control" name="veterinary_name" id="VeterniaryName" placeholder="Enter Veterniary Name">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="Detail" class="form-label mb-1">Vaccine Detail</label>
                                <textarea class="form-control" name="detail" id="Detail" placeholder="Detail"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Vaccine</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Add vaccine model -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- all pet list start -->
                    <div class="card">

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Vaccine Date</th>
                                    <th>Expiry</th>
                                    <th>Veterniary</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $vaccines as $item )
                                    <tr>
                                        <td>{{$item->vaccine_name}}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->vaccine_date)->format('F j, Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->vaccine_expiry_date)->format('F j, Y') }}</td>
                                        <td>{{$item->veterinary_name}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- all pet list end   -->

                </div>
            </div>
        </div>
    </section>

@endsection