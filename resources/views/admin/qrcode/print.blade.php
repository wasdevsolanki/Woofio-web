@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Print QR Code</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Print QR Code</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @if($errors->has('quantity'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Quanity',
                text: 'Please Enter Quantity',
            });
        </script>
    @endif
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">

                    <div class="card">

                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <div class="" role="group" aria-label="Left Buttons">
                                    Quanity: <b>{{$quantity}}</b>
                                    QR Size: <b>{{$qr_size}}</b>
                                </div>
                                <div class="btn-group btn-group-sm" role="group" aria-label="Right Buttons">
                                    <button type="button" class="btn btn-danger" onclick="printDemo('myDiv')">Demo Print</button>
                                    <button type="button" class="btn btn-success" onclick="printOriginal('myDiv')">Original Print</button>
                                </div>
                            </div>
                        </div>

                        <div class="card-body" id="myDiv">
                            @if(isset($qrCodes))
                                @foreach($qrCodes as $qrCode)
                                    <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code">
                                @endforeach
                            @endif
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
    <script>
        function printDemo(divId) {
            var printContents = document.getElementById(divId).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }

        function printOriginal(divId) {
            var confirmation = confirm('Are you sure you want to print and store QR codes?');
            if (confirmation) {
                storeQrCodes(); 
                var printContents = document.getElementById(divId).innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }
        }

        function storeQrCodes()
        {
            var qrCodes = {!! json_encode($qrCodes) !!};
            var qrsize = {!! json_encode($qr_size) !!};
            var qrList = {!! json_encode($qr_list) !!};
            var authToken = '{{ auth()->user()->createToken('token-name')->plainTextToken }}';
            var combinedArray = [];
            const apiURL = '{{ route("admin.qrcode.store") }}';

            // Combine the values into a single array
            for (var i = 0; i < qrCodes.length; i++) {
                var item = {
                    qrCode: qrCodes[i],
                    qrList: qrList[i]
                };
                combinedArray.push(item);
            }

            $.ajax({
                type: 'POST',
                url: apiURL,
                headers: {
                    'Authorization': 'Bearer ' + authToken,
                },
                data: {
                    qrsize: qrsize,
                    Items: JSON.stringify(combinedArray),
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Handle the success response
                    console.log(response.message);
                },
                error: function(xhr, status, error) {
                    // Handle the error response
                    console.error(xhr.responseText);
                }
            });
        }

    </script>

@endsection