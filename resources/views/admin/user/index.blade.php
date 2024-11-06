@extends('layouts.app')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Vendors</h1>
                </div>
                <div class="col-sm-6 d-flex justify-content-end">
                    <!-- <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Vendor list</li>
                    </ol> -->
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-user">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add Vendor
                    </button>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Add user model -->
    <div class="modal fade" id="modal-add-user">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{route('admin.user.store')}}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h6 class="modal-title">Add Vendor</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="FirstName" class="form-label mb-1">First Name</label>
                                <input type="text" class="form-control " name="first_name" id="FirstName" placeholder="Enter First Name">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="LastName" class="form-label mb-1">Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="LastName" placeholder="Enter Last Name">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="UserName" class="form-label mb-1">User Name</label>
                                <input type="text" class="form-control" name="name" id="UserName" placeholder="Enter User Name">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="Email" class="form-label mb-1">Email</label>
                                <input type="email" class="form-control" name="email" id="Email" placeholder="Enter email">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="Password" class="form-label mb-1">Password</label>
                                <input type="password" class="form-control" name="password" id="Password" placeholder="Password">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="Gender" class="form-label mb-1">Gender</label>
                                <select class="form-control form-select" name="gender" aria-label="Gender" id="Gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Vendor</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Add user model -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- all user list start -->
                    <div class="card">

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $users as $user )
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->gender}}</td>
                                        <td>
                                            @if( $user->status == 1 )
                                                <span class="badge badge-success rounded-pill d-block p-2">Active</span>
                                            @else
                                                <span class="badge badge-danger rounded-pill d-block p-2">Block</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group w-100">
                                                <a href="{{ route('admin.user.status', ['id' => encrypt($user->id)]) }}" class="btn btn-sm btn-success mb-2">Status</a>
                                                <a href="{{ route('admin.user.delete', ['id' => encrypt($user->id)]) }}" class="btn btn-sm btn-dark mb-2">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- all user list end   -->

                </div>
            </div>
        </div>
    </section>

@endsection
