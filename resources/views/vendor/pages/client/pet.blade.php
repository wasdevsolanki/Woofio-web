@extends('vendor.layouts.app')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-7 d-flex justify-content-between">
                    <a href="{{route('vendor.client')}}" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                    <h5>{{$user->name}}'s Pet List</h5>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
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
                                    <th>Profile</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Breed</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $pets as $pet )
                                    <tr>
                                        <td>
                                            <img src="/system/public/uploaded_files/pet/{{$pet->profile}}" class="img-fluid" width="50">
                                        </td>
                                        <td>{{$pet->pet_name}}</td>
                                        <td>{{ \Carbon\Carbon::parse($pet->pet_agee)->format('F j, Y') }}</td>
                                        <td>{{$pet->gender}}</td>
                                        <td>{{$pet->breed}}</td>
                                        <td>{{$pet->category}}</td>
                                        <td>
                                            <a  href="{{route('vendor.client.pets.vaccine', ['id' => encrypt($pet->id)] )}}"
                                                class="btn btn-sm btn-success d-block mb-2">
                                                View Vaccines
                                            </a>
                                            <a href="/scan?scan_id={{$pet->qrcodes->code}}&view=public" class="btn btn-sm btn-primary d-block" target="_blank">Ver Perfil</a>
                                        </td>
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