@extends('layouts.app')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Pets</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pet list</li>
                    </ol>
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

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Owner Name</th>
                                    <th>Pet Name</th>
                                    <th>Pet DOB</th>
                                    <th>Pet Gender</th>
                                    <th>Pet Category</th>
                                    <th>Pet Breed</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $pets as $pet )
                                    <tr>
                                        <td>{{$pet->users->name}}</td>
                                        <td>{{$pet->pet_name}}</td>
                                        <td>{{$pet->pet_age}}</td>
                                        <td>{{$pet->gender}}</td>
                                        <td>{{$pet->category}}</td>
                                        <td>{{$pet->breed}}</td>
                                        <td>{{$pet->users->city}}</td>
                                        <td>{{$pet->users->state}}</td>
                                        <td>{{$pet->users->address}}</td>
                                        <td>
                                            <a href="{{route('admin.pet.delete', $pet->id)}}" class="btn btn-dark btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <!-- all pet list end   -->

                </div>
            </div>
        </div>
    </section>

@endsection
