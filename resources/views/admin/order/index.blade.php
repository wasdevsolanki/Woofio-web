@extends('layouts.app')
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
                                                <span class="badge badge-info rounded-pill d-block p-2">Pending</span>
                                            @elseif( $order->status == 1 )
                                                <span class="badge badge-info rounded-pill d-block p-2">Processing</span>
                                            @elseif( $order->status == 2 )
                                                <span class="badge badge-info rounded-pill d-block p-2">Shipped</span>
                                            @elseif( $order->status == 3 )
                                                <span class="badge badge-info rounded-pill d-block p-2">Delivered</span>
                                            @elseif( $order->status == 4 )
                                                <span class="badge badge-info rounded-pill d-block p-2">Canceled</span>
                                            @elseif( $order->status == 5 )
                                                <span class="badge badge-info rounded-pill d-block p-2">Return</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group w-100">
                                                <button type="button" class="btn btn-sm btn-dark mb-2" data-toggle="modal" data-target="#StatusModelStatus{{$order->id}}">Status</button>
                                                @if( OrderExist($order->id) )
                                                    <a href="{{ route('admin.order.generate.download', ['id' => encrypt($order->id)]) }}" class="btn btn-sm btn-success mb-2">Download</a>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-secondary mb-2" id="GenerateBtn{{$order->id}}"  data-toggle="modal" data-target="#StatusModelGenerate{{$order->id}}">Generate</button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Add Status model -->
                                    <div class="modal fade" id="StatusModelStatus{{$order->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <form action="{{route('admin.order.status')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                                    <div class="modal-header ">
                                                        <h6 class="modal-title">Update Status</h6>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-3">
                                                                <label for="Input{{$order->id}}" class="form-label mb-1">Customer Name</label>
                                                                <input type="text" class="form-control border-0 bg-light" name="customer" value="{{$order->users->name}}" id="Input{{$order->id}}" readonly>
                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                <label for="Status" class="form-label mb-1">Order Status</label>
                                                                <select class="form-control form-select" name="status" aria-label="Status" id="Status">
                                                                    <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>Pending</option>
                                                                    <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Processing</option>
                                                                    <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Shipped</option>
                                                                    <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Delivered</option>
                                                                    <option value="4" {{ $order->status == 4 ? 'selected' : '' }}>Canceled</option>
                                                                    <option value="5" {{ $order->status == 5 ? 'selected' : '' }}>Return</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Change Status</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Add Status model -->

                                    <!-- Add Generate PDF model -->
                                    @if( $order->status == 1 )
                                        <div class="modal fade" id="StatusModelGenerate{{$order->id}}">
                                            <div class="modal-dialog">
                                                <form action="{{route('admin.order.generate', $order->id)}}" method="POST">
                                                    @csrf
                                                    <div class="modal-content">

                                                        <input type="hidden" name="order_id" value="{{$order->id}}">
                                                        <div class="modal-header ">
                                                            <h6 class="modal-title">Generate PDF</h6>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row p-3">
                                                                <div class="col-md-12 text-secondary text-center mb-3">
                                                                    <h5>{{ $order->users->name }}</h5>
                                                                </div>
                                                                <div class="col-md-12 text-center">
                                                                    <strong>Are you sure want to generate QR List?</br>This action cannot be undone.</strong>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary" onclick="generatePDF({{ $order->id }})">Generate</button>
                                                        </div>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                    <!-- Add Status model -->

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

    @push('scripts')
        <script>
            function generatePDF (id) {
                $('#GenerateBtn' + id).removeAttr('data-target');
                $('#StatusModelGenerate' + id).removeClass('show');
                $('.modal-backdrop').removeClass('show');
            }
        </script>
    @endpush

@endsection