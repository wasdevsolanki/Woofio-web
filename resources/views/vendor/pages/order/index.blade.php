@extends('vendor.layouts.app')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h4>{{ $slug }} Orders</h4>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

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
                                    <th>Order Number</th>
                                    <th>Customer</th>
                                    <th>Email</th>
                                    <th>Quantity</th>
                                    <th>Size</th>
                                    <th>Note</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $orders as $order )
                                    <tr>
                                        <td>{{$order->Order_Number}}</td>
                                        <td>{{$order->users->name}}</td>
                                        <td>{{$order->users->email}}</td>
                                        <td>{{$order->quantity}}</td>
                                        <td>{{$order->size}}</td>
                                        <td>{{$order->note}}</td>
                                        <td>
                                            @if( $order->status == 0 )
                                                <span class="badge badge-info d-block p-2">Pending</span>
                                            @elseif( $order->status == 1 )
                                                <span class="badge badge-info d-block p-2">Processing</span>
                                            @elseif( $order->status == 2 )
                                                <span class="badge badge-info d-block p-2">Shipped</span>
                                            @elseif( $order->status == 3 )
                                                <span class="badge badge-info d-block p-2">Delivered</span>
                                            @elseif( $order->status == 4 )
                                                <span class="badge badge-info d-block p-2">Canceled</span>
                                            @elseif( $order->status == 5 )
                                                <span class="badge badge-info d-block p-2">Return</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if( $order->status == 0 && OrderExist($order->id) == null )
                                                <a href="" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-times" aria-hidden="true"></i> Cancel
                                                </a>
                                            @endif
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