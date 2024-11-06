@extends('vendor.layouts.app')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>QR Order</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">QR Order</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">

                <div class="col-sm-8">
                    
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <span class=""><i class="fa fa-cart-plus" aria-hidden="true"></i> Order</span>
                        </div>
                        <form action="{{route('vendor.order.store')}}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{Auth::User()->id}}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="Quantity" class="form-label mb-2">Quantity of QR</label>
                                    <input type="number" class="form-control" name="quantity" id="Quantity" placeholder="Enter Quantity">
                                </div>
                                <div class="form-group">
                                    <label for="Size" class="form-label mb-1">QR Size</label>
                                    <select class="form-control form-select" name="size" aria-label="Size" id="Size">
                                        <option value="50">50</option>
                                        <option value="70">70</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Note" class="form-label mb-1">Note</label>
                                    <textarea name="note" id="Note" rows="3" class="form-control" placeholder="Enter Note"></textarea>
                                </div>
                            </div>

                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i> Order Now </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection