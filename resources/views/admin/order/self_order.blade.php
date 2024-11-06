@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->

    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4>Self Order</h4>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-cart-plus" aria-hidden="true"></i>
                            Order Detail
                        </div>
                        <div class="card-body">
                            <form  method="POST" action="{{ route('admin.self.order.self') }}">
                                @csrf

                                <div class="row g-2">

                                    <div class="col-sm-12 mb-3">
                                        <label class="form-label" for="Name">Select order for </label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <select class="custom-select" id="Name" name="user_id" aria-label="Name" aria-describedby="Name">
                                                @foreach( $users as $user )
                                                    <option value="{{$user->id}}"> {{$user->name}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label d-flex justify-content-between align-items-center" for="Quantity">
                                            Enter Quantity 
                                            <small class="text-danger mb-0">Max 1000</small>
                                        </label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-cubes" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input type="number" name="quantity" class="form-control" id="Quantity" max="1000" placeholder="Enter Quantity" aria-label="Quantity" aria-describedby="Quantity">
                                        </div>
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label" for="Size">Enter QR Size</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <select class="custom-select" id="Size" name="size" aria-label="Size" aria-describedby="Size">
                                                <option value="50">50</option>
                                                <option value="75">75</option>
                                                <option value="100">100</option>
                                                <option value="150">150</option>
                                                <option value="200">200</option>
                                                <option value="250">250</option>
                                                <option value="300">300</option>
                                                <option value="500">500</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <label class="form-label" for="Detail">Order Details</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-align-left" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <textarea class="form-control" name="note" id="Detail" placeholder="Enter Order Details" aria-label="Detail" aria-describedby="Detail"></textarea>
                                        </div>
                                    </div>

                                </div>


                                <div class="row mt-3">
                                    <div class="col-sm-12 text-right">
                                        <button  type="submit" class="btn btn-primary">
                                            <i class="fa fa-arrow-right" aria-hidden="true"></i> Generate
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection