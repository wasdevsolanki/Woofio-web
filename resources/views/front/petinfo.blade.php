<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Woofio</title>
    <link rel="icon" type="image/png" href="/images/bg/logo-favicon.png">
    <!-- bootstrap css cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- jquery js cdn -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap');
        @font-face {
            font-family: 'Freude';
            src: url('fonts/Freude.otf') format('opentype'),
                url('fonts/Freude.woff2') format('woff2'),
                url('fonts/Freude.woff') format('woff'),
                url('fonts/Freude.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        } 

        body {
            background-image: url('/images/bg/woofio-bg.png');
            background-repeat: no-repeat;
            background-size: cover;
            /* font-family: "Comic Neue", cursive; */
            font-family: 'Freude', sans-serif;

            font-style: normal;
        }
        .heading-section {
            background-image: url('/images/bg/woofio-cover.png');
            background-repeat: no-repeat;
            background-size: cover;
            padding: 30px 50px 20px 50px;
        }
        #heading {
            color: white;
            font-size: 1.5em;
            font-weight: 600;
            text-align: center;
            line-height: normal;
        }
        textPath {
            alignment-baseline: after-edge;
        }
        table {
            border-collapse: separate;
        }
        table td {
            background-color: transparent !important;
            border: none !important;
        }
        #question {
            background-color: #099EDD !important;
            color: white;
            text-align: center;
            padding: 2px;
            display: flex;
            justify-content: center;
            border: 0.5px solid #099EDD !important;
            border-radius: 20px;
        }
        #answer {
            background-color: white !important;
            color: #099EDD;
            white-space: nowrap;
            text-align: center;
            padding: 2px;
            border: 0.5px solid #099EDD !important;
            border-radius: 20px;

        }
        #answer button {
            padding: 0;
        }
        #profile-heading {
            font-size: 1.2em;
            color: #626a71;
        }
        .profile-square .profile-square-image {
            width: 170px;
            height: 150px;
        }
        
        .profile-square .profile-square-image img {
            object-fit: cover;
            width: 100%;
            height: 100%;
            border: 4px solid #099EDD;
            border-radius: 50%;
            box-shadow: rgba(0, 0, 0, 0.44) 0px 4px 12px;
        }
        
        .profile-square-header span {
            font-size: 1.5em;
            font-weight: 700;
            letter-spacing: 3px;
        }
        .vaccineModel {
            position: absolute;
            /* width: 70px; */
            right: 25px;
            top: 140px;
            padding: 10px;
            border: 1px solid green;
            border-radius: 20px;
            background-color: limegreen;
        }
        .vaccineModelContent {
            background-image: url('/images/bg/vaccine_bg_1.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }
        .vaccineModelContent table {
            background-color: white;
        }
        .vaccineModelContent table tbody {
            border: 1px solid;
        }
        .vaccine-section {
            height: 30rem;
            font-size: 13px;
        }
        .vaccineModelContent .modal-header {
            background-color: #ffd54c;
            border-bottom: 1px solid dodgerblue;
        }
        .LoginActionBtn {
            position: absolute;
            top: 140px;
            color: white;
            background-color: #495057;
            border-radius: 30px;
            padding: 5px;
        }
    </style>

</head>
<body>
<div class="container-fluid">
 
    <!-- header start -->
        <div class="row heading-section">
            <div class="col-md-12" id="heading">
                <strong>{{ Str::ucfirst($pet->pet_name)}}</strong>
            </div>
        </div>
    <!-- header end  -->

    <!-- profile image start -->
    <div class="container mt-2 mb-2">
        <div class="row profile-square justify-content-center text-center">
            
            <div class="col-md-12 profile-square-image">
                @if(! isset($pet->profile) )
                    <img src="/uploaded_files/pet/1690276276.jpeg" class="img-fluid" />
                @else
                    <img src="/uploaded_files/pet/{{$pet->profile}}" class="img-fluid" />
                @endif
            </div>

        </div>

        <a href="https://www.woofio.com.mx" target="_blank" class="LoginActionBtn">
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
            </svg>
        </a>

        @if( $pet->vaccines->isNotEmpty() )

            <button type="button" class="btn vaccineModel" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-clipboard-pulse" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 1.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5zm-5 0A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5v1A1.5 1.5 0 0 1 9.5 4h-3A1.5 1.5 0 0 1 5 2.5zm-2 0h1v1H3a1 1 0 0 0-1 1V14a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V3.5a1 1 0 0 0-1-1h-1v-1h1a2 2 0 0 1 2 2V14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3.5a2 2 0 0 1 2-2m6.979 3.856a.5.5 0 0 0-.968.04L7.92 10.49l-.94-3.135a.5.5 0 0 0-.895-.133L4.232 10H3.5a.5.5 0 0 0 0 1h1a.5.5 0 0 0 .416-.223l1.41-2.115 1.195 3.982a.5.5 0 0 0 .968-.04L9.58 7.51l.94 3.135A.5.5 0 0 0 11 11h1.5a.5.5 0 0 0 0-1h-1.128z"/>
                </svg>
            </button>

            <!-- Vaccine Model -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content rounded-0 vaccineModelContent">
                        <div class="modal-header shadow">
                            <h4 class="modal-title" id="exampleModalLabel">Registro de vacunación</h4>
                            <button type="button" class="btn-close bg-light rounded-pill" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body vaccine-section overflow-y-auto">

                            <div class="row mb-2">
                                <div class="col-12 text-end">
                                    @if(Auth::check())
                                        @if(Auth::user()->role == 'user')
                                            <a href="{{route('vaccine.show', $pet->id)}}" class="btn btn-sm btn-dark">Añadir Vacuna</a>
                                        @endif
                                    @else
                                        <button class="btn btn-sm btn-dark" data-bs-target="#AddVaccine" data-bs-toggle="modal">Add Vaccine</button>
                                    @endif
                                </div>
                            </div>

                            <table class="table table-sm table-bordered border-dark table-responsive">
                                <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Vacuna</th>
                                    <th>Prox dosis</th>
                                    <th>Veterinario</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $pet->vaccines as $item )
                                    <tr>
                                        <td>{{ date('d M y', strtotime($item->vaccine_date)) }}</td>
                                        <td>{{ $item->vaccine_name }}</td>
                                        <td>{{ date('d M y', strtotime($item->vaccine_expiry_date)) }}</td>
                                        <td>{{ $item->veterinary_name }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vaccine Model -->


            <div class="modal fade" id="AddVaccine" aria-hidden="true" aria-labelledby="AddVaccine" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content vaccineModelContent">
                        <div class="modal-header">
                            <h5 class="modal-title fs-5" id="AddVaccine">Sign In</h5>
                            <button type="button" class="btn-sm btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('guest.vaccine.login') }}" method="POST">
                            @csrf
                            <input type="hidden" name="pet_id" value="{{$pet->id}}">
                            <div class="modal-body">

                                <div class="row p-3">
                                    <div class="col-sm-12 mb-2">
                                        <label class="form-label fw-semibold" for="Email">Email</label>
                                        <input type="email" class="form-control" name="email" id="Email" placeholder="Enter Email">
                                    </div>
                                    <div class="col-sm-12">
                                        <label class="from-label fw-semibold" for="Password">Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Enter Password">
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-sm btn-dark p-2">Sign In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        @endif
    </div>
    <!-- profile image end -->

    <!-- profile detail start -->
        <div class="row px-0 pr-0">
            <table class="table mb-1" cellspacing="10" cellpadding="1px">
                <tbody>
                    <tr class="text-center">
                        <td id="profile-heading" colspan="2">¡ME ENCONTRASTE!</td>
                    </tr>
                    <tr>
                        <td id="question">Fecha de nac.</td>
                        <td id="answer">{{ \Carbon\Carbon::parse($pet->pet_age)->format('d-M-y') }}</td>
                    </tr>
                    <tr>
                        <td id="question">Sexo</td>
                        <td id="answer">{{$pet->gender}}</td>
                    </tr>
                    
                    <tr>
                        <td id="question">Raza</td>
                        <td id="answer">{{$pet->breed}}</td>
                    </tr>

                    <!-- owner info start -->
                    <tr class="text-center">
                        <td id="profile-heading" colspan="2">MI Familia ES:</td>
                    </tr>
                    <tr>
                        <td id="question">Dueño</td>
                        <td id="answer">{{$pet->users->first_name}}</td>
                    </tr>
                    <tr>
                        <td id="question">Numero</td>
                        <td id="answer">+{{$pet->users->mobile}}</td>
                    </tr>
                    <tr>
                        <td id="question">Dirección</td>
                        <td id="answer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                            </svg>
                            <button type="button"
                                class="" 
                                data-toggle="popover" 
                                title="{{$pet->users->address}}"   
                                data-bs-placement="top" 
                                id="popoverButton" 
                                data-content="Popover Content" style="background:none; border:0; font-size:1em; color:#099EDD;">
                                {{$pet->users->address}}
                            </button>
                        </td>
                    </tr>
                        <!--owner info end   -->
                </tbody>
            </table>
        </div>
    <!-- profile detail end -->

    <!-- footer start -->
    <div class="container">
        <div class="row bg-warning text-dark p-1 rounded-pill">
            <div class="col-9" style="font-size:0.9em;">
                <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-index-thumb-fill" viewBox="0 0 16 16" style="align-self: center;">
                    <path d="M8.5 1.75v2.716l.047-.002c.312-.012.742-.016 1.051.046.28.056.543.18.738.288.273.152.456.385.56.642l.132-.012c.312-.024.794-.038 1.158.108.37.148.689.487.88.716.075.09.141.175.195.248h.582a2 2 0 0 1 1.99 2.199l-.272 2.715a3.5 3.5 0 0 1-.444 1.389l-1.395 2.441A1.5 1.5 0 0 1 12.42 16H6.118a1.5 1.5 0 0 1-1.342-.83l-1.215-2.43L1.07 8.589a1.517 1.517 0 0 1 2.373-1.852L5 8.293V1.75a1.75 1.75 0 0 1 3.5 0z"/>
                </svg>  
                <button type="button" 
                        class="btn btn-sm text-dark" 
                        data-toggle="popoverInstruction" 
                        title="{{$pet->special_instruction}}"   
                        data-bs-placement="top" 
                        id="popoverInstructionButton" 
                        data-content="Popover Content" style="background:none; border:0;">
                        {{ Str::limit($pet->special_instruction, 20) }}
                </button> -->
                Caracteristicas de la mascota
            </div>
            <div class="col-3 rounded-pill bg-danger text-center d-flex justify-content-center align-items-center">
                <a class="text-decoration-none text-white" href="tel:{{$pet->users->mobile}}">Llamar</a>
            </div>
        </div>
    </div>
    <!-- footer end  -->
</div>

<!-- Custom Modal for Location Permission -->
<div class="modal fade" id="locationPermissionModal" tabindex="-1" role="dialog" aria-labelledby="locationPermissionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="locationPermissionModalLabel">Registró de Ubicación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Necesitamos de tu ubicación para mejorar nuestros servicios.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="denyLocation()">Rechazar</button>
                <button type="button" class="btn btn-primary" onclick="allowLocation()">Permitir</button>
            </div>
        </div>
    </div>
</div>

<div id="getEmail" data-email="{{$pet->users->email}}"></div>
<!-- bootstrap js cnd -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
        crossorigin="anonymous">
</script>

<script>
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
  
        $('[data-toggle="popoverInstruction"]').popover();  
        var button = document.getElementById('popoverButton');
        var buttonText = button.textContent;
        var firstTwoWords = buttonText.trim().split(/\s+/).slice(0, 2).join(' ');
        button.textContent = firstTwoWords;
        $(button).popover();

        var specialInstruction = document.getElementById('popoverInstructionButton');
        var getContent = specialInstruction.textContent;
        var firstTwoInstructionWords = getContent.trim().split(/\s+/).slice(0, 5).join(' ');
        specialInstruction.textContent = firstTwoInstructionWords;
    });


    // Display the location permission modal on page load
    $(document).ready(function() {
        $('#locationPermissionModal').modal('show');
    });

    // Function to handle location permission allowing
    function allowLocation() {
        $('#locationPermissionModal').modal('hide'); // Hide the modal
        getLocation(); // Call your existing getLocation function
    }

    // Function to handle location permission denying
    function denyLocation() {
        $('#locationPermissionModal').modal('hide'); // Hide the modal

        //get email
        const userEmail = $('#getEmail').attr('data-email');
        if (userEmail) {
            $.ajax({
                url:"{{ route('scan.location.deny') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                data: {
                    email: userEmail
                },
                success: function (response) {
                    console.log(response);
                },
                error: function (xhr, status, error) {
                    console.log('Request error:', error);
                }
            });
        }

    }

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    // Display the coordinates in the HTML
                    // const url = 'https://www.google.com/maps/search/street/@'+ latitude +','+ longitude +',17z?entry=ttu';
                    const url = `https://www.google.com/maps/search/?api=1&query=${latitude},${longitude}`;

                    //get email
                    const userEmail = $('#getEmail').attr('data-email');

                    if (url) {
                        $.ajax({
                            url:"{{ route('scan.location') }}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            method: 'POST',
                            data: {
                                url: url,
                                email: userEmail
                            },
                            success: function (response) {
                                console.log(response);
                            },
                            error: function (xhr, status, error) {
                                console.log('Request error:', error);
                            }
                        });
                    }
                },
                function (error) {
                    console.error('User denied geolocation permission');
                },
                {
                    // Add this option to prompt the user for permission each time
                    maximumAge: 0,
                    timeout: 10000,
                    enableHighAccuracy: true
                }
            );
        } else {
            document.getElementById('location-output').innerText =
                'Geolocation is not supported by your browser.';
        }
    }
</script>

</body>
</html>

