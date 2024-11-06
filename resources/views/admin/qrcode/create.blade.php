@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Generate QR Code</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">QR Code</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @if($errors->has('quantity'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Enter Quanity',
                text: 'Please Enter Quantity',
            });
        </script>
    @endif
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header">Generate QR</div>
                        <div class="card-body">
                            <form  method="POST" action="{{ route('admin.qrcode.generate') }}">
                                @csrf

                                <div class="card-text pb-2">
                                    <small>
                                        <i class="fa fa-info-circle text-secondary" aria-hidden="true"></i>
                                        Website URL to generate QR Code
                                    </small>
                                </div>

                                <div class="row g-2">
                                    <div class="col-sm-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                <i class="fa fa-cubes" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input type="number" name="quantity" class="form-control" value="{{$quantity ?? ''}}" placeholder="Enter Quantity" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-2">
                                    <div class="col-sm-12 text-right">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <select class="custom-select" id="qr_size" name="qr_size" aria-label="Username" aria-describedby="basic-addon1">
                                                <option value="50"  @if( isset($qr_size) && $qr_size == 50) selected @endif>50</option>
                                                <option value="75"  @if( isset($qr_size) && $qr_size == 75) selected @endif>75</option>
                                                <option value="100" @if( isset($qr_size) && $qr_size == 100) selected @endif>100</option>
                                                <option value="150" @if( isset($qr_size) && $qr_size == 150) selected @endif>150</option>
                                                <option value="200" @if( isset($qr_size) && $qr_size == 200) selected @endif>200</option>
                                                <option value="250" @if( isset($qr_size) && $qr_size == 250) selected @endif>250</option>
                                                <option value="300" @if( isset($qr_size) && $qr_size == 300) selected @endif>300</option>
                                                <option value="500" @if( isset($qr_size) && $qr_size == 500) selected @endif>500</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-2">
                                    <div class="col-sm-12 text-right">
                                        <button  type="submit" class="btn btn-primary"><i class="fa fa-qrcode" aria-hidden="true"></i> Generate QR</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h4><small>In-Active </small>{{$inactive}}</h4>
                            <h4><small>Active </small>{{$active}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection