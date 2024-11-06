@extends('front.layouts.app')
@section('content')

    <style>

        .Pet-Register{
            background-image: url('/images/bg/bg_pet.png') !important;
            /*font-family: 'Lobster Two', cursive, Arial, sans-serif;*/

        }
        .form-row{
            width : -webkit-fill-available;
        }
        .form-row label{
            font-size: 0.8em !important;
        }
        .info-data{
            background-image : url('/images/input-placeholder-1.png') !important;
            background-size: cover;
        }
        .pet-lable {
            font-size: 1.2em !important;
        }

        [type="file"] {
            color: black;
            font-size:small;
        }
        [type="file"]::-webkit-file-upload-button {
            background: #ebebeb;
            color: #099EDD;
            border: 0px solid white;
            border-radius: 20px;
            cursor: pointer;
            font-size: 12px;
            font-weight:600;
            outline: none;
            padding: 5px 10px;
            text-transform: uppercase;
        }

    </style>
    <div class="content">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 mt-3">

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <strong>Info is required!</strong></br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(auth::user())
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h5 class="card-title m-0">Panel de usuario</h5>
                            </div>
                            <div class="card-body bg-light">
                                <div class="row d-flex justify-content-end">
                                    <div class="col-md-8">
                                        <h6>Hola!, {{Auth::user()->name}}</h6>
                                    </div>
                                    <div class="col-md-4 d-flex justify-content-end">
                                        <!-- <a class="btn btn-sm btn-primary" href="">Add Pet</a> -->
                                        
                                        @if(isset($qr_id) && $qr_id != null)
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registrationModal">
                                                Añadir Mascota
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(isset($qr_id) && $qr_id != null)
                            <!-- model code  -->
                            <div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="registrationModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="registrationModalLabel">Registrar Mascota</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body Pet-Register">
                                            <!-- Place your registration form HTML here -->

                                            <div class="row p-2">
                                                <div class="col-md-12 d-flex justify-content-center mb-2">
                                                    <img src="/images/woofio-logo.png" width="200">
                                                </div>
                                            </div>

                                            <form method="POST" id="PetRegisterForm" action="{{ route('pet.store') }}" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="qr_id" value="{{ $qr_id }}">

                                                <div class="row form-row">
                                                    <div class="col-4 pet-lable">
                                                        <label for="pet-name">Nombre</label>
                                                    </div>
                                                    <div class="col-8 mb-2">
                                                        <input type="text" name="pet_name" id="pet-name" class="form-control pet-input " aria-label="pet-name">
                                                        @error('pet_name')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row form-row">
                                                    <div class="col-4 pet-lable">
                                                        <label for="age">Fecha de nacimiento</label>
                                                    </div>
                                                    <div class="col-8 mb-2">
                                                        <input type="date" name="pet_age" id="age" class="form-control pet-input " aria-label="age">
                                                        @error('pet_age')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row form-row">
                                                    <div class="col-4 pet-lable">
                                                        <label for="profile">Imagen</label>
                                                    </div>
                                                    <div class="col-8 mb-2">

                                                        <input type="file" class="form-control" name="pet_profile" id="profile">
                                                        @error('pet_profile')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row form-row">
                                                    <div class="col-4 pet-lable">
                                                        <label for="Category">Especié</label>
                                                    </div>
                                                    <div class="col-8 mb-2">
                                                        <select id="Category" name="category" class="form-control form-select  w-100">
                                                            <option value="" selected disabled> -- Seleccionar especié -- </option>
                                                            <option value="dog">Perro</option>
                                                            <option value="cat">Gato</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row form-row">
                                                    <div class="col-4 pet-lable">
                                                        <label for="PetGender">Generó</label>
                                                    </div>
                                                    <div class="col-8 mb-2">
                                                        <select id="PetGender" name="pet_gender" class="form-control form-select  w-100">

                                                        </select>
                                                        @error('pet_gender')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row form-row">
                                                    <div class="col-4 pet-lable">
                                                        <label for="pet-breed">Raza</label>
                                                    </div>
                                                    <div class="col-8 mb-2">
                                                        <select class="form-control form-select  w-100" name="pet_breed" id="pet-breed">

                                                        </select>
                                                        @error('pet_breed')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row form-row">
                                                    <div class="col-4 pet-lable">
                                                        <label for="instruction">Nota</label>
                                                    </div>
                                                    <div class="col-8 mb-2">
                                                        <textarea name="pet_special_instruction" class="form-control pet-input  text-area" id="instruction" ></textarea>
                                                        @error('pet_special_instruction')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>


                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-sm btn-primary" form="PetRegisterForm">Registrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- model code  -->
                        @endif

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title m-0">Mis Mascotas</h5>
                            </div>
                            <div class="card-body Pet-Register">
                                <div class="row d-flex justify-content-end">
                                    <div class="col-md-12">
                                        <!-- table for pets  -->
                                        <table id="example2" class="responsive table table-hover border">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Perfil</th>
                                                    <th scope="col">Mascota</th>
                                                    <th scope="col">Edad</th>
                                                    <th scope="col">Género</th>
                                                    <th scope="col">Instrucción</th>
                                                    <th scope="col">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @if( isset($pets) )
                                                @php $index = 1 @endphp
                                                @foreach( $pets as $pet )
                                                    <tr>
                                                        <th scope="row">{{$index++}}</th>
                                                        <td> <img src="/system/public/uploaded_files/pet/{{$pet->profile}}" alt="" width="50"></td>
                                                        <td>{{$pet->pet_name}}</td>
                                                        <td>{{ \Carbon\Carbon::parse($pet->pet_age)->format('d-M-y') }}</td>
                                                        <td>{{$pet->gender}}</td>
                                                        <td>{{$pet->special_instruction}}</td>
                                                        <td>
                                                            <form action="{{route('pet.edit')}}" method="post">
                                                                @csrf
                                                                <input type="hidden" value="{{$pet->id}}" name="pet_id">
                                                                <input type="hidden" value="{{Auth::user()->id}}" name="user_id">

                                                                <div class="btn-group-vertical btn-group-sm fw-bold w-100" role="group" aria-label="Vertical button group">
                                                                    <button type="submit" class="btn btn-primary ">Editar</button>
                                                                    <a href="/scan?scan_id={{$pet->qrcodes->code}}&view=public" class="btn btn-success" target="_blank">Ver Perfil</a>
                                                                    <a href="{{ route('vaccine.show', $pet->id) }}" class="btn btn-warning ">Cartilla de Vacunación</a>
                                                                </div>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                        <!-- table for pets  -->
                                    </div>
                                </div>
                            </div>
                        </div>

                    @elseif(empty($qr_id) && empty($error) && empty($pet) )
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h5 class="card-title m-0">Scan QR Code</h5>
                            </div>
                            <div class="card-body">
                                <ol class="card-text">
                                    <li class="p-1">Scan the QR code on your pet's tag using a QR code scanning app on your smartphone or laptop.</li>
                                    <li class="p-1">After scanning the code, a registration page will open on your device.</li>
                                    <li class="p-1">Fill in the required information, such as your contact details, pet's name, and any relevant medical information.</li>
                                    <li class="p-1">Click the "Register" button to submit the information and complete the registration process.</li>
                                    <li class="p-1">If your pet goes missing and someone finds them, they can scan the QR code on the tag to access your contact information and reach out to you.</li>
                                </ol>
                                <p class="card-text"><strong>Note:</strong> Remember to ensure that the QR code is visible and easily scannable on your pet's tag for easy access and identification.</p>
                            </div>
                        </div>
                    @elseif( isset($pet) )
                        <div class="card" style="background-image:url('/images/bg/background.png')">
                            <div class="card-body row">
                                <div class="col-md-4">
                                    <img src="/uploaded_files/pet/{{$pet->profile}}" class="img-fluid rounded-start" width="300">
                                </div>
                                <div class="col-md-8 ">
                                    <div class="row w-100 mb-4">
                                        <div class="col-12 display-5 info-data text-light text-center">
                                            {{$pet->pet_name}}
                                        </div>
                                    </div>

                                    <div class="row w-100 mb-2">
                                        <div class="col-4 fw-bold">Age</div>
                                        <div class="col-8 info-data text-light text-center">
                                            {{$pet->pet_age}}
                                        </div>
                                    </div>

                                    <div class="row w-100 mb-2">
                                        <div class="col-4 fw-bold">Gender</div>
                                        <div class="col-8 info-data text-light text-center">
                                            {{$pet->gender}}
                                        </div>
                                    </div>

                                    <div class="row w-100 mb-2">
                                        <div class="col-4 fw-bold">Instruction</div>
                                        <div class="col-8 info-data text-light text-center">
                                            {{$pet->special_instruction}}
                                        </div>
                                    </div>

                                    <div class="row w-100 mt-5">
                                        <div class="col-12">
                                            <h5 class=""><span>Owner Information</span></h5><br>
                                        </div>
                                    </div>

                                    <div class="row w-100 mb-2">
                                        <div class="col-4 fw-bold">Name</div>
                                        <div class="col-8 info-data text-light text-center">
                                            {{$pet->users->name}}
                                        </div>
                                    </div>

                                    <div class="row w-100 mb-2">
                                        <div class="col-4 fw-bold">Email</div>
                                        <div class="col-8 info-data text-light text-center">
                                            {{$pet->users->email}}
                                        </div>
                                    </div>

                                    <div class="row w-100 mb-2">
                                        <div class="col-4 fw-bold">Gender</div>
                                        <div class="col-8 info-data text-light text-center">
                                            {{$pet->users->gender}}
                                        </div>
                                    </div>

                                    <div class="row w-100 mb-2">
                                        <div class="col-4 fw-bold">Mobile</div>
                                        <div class="col-8 info-data text-light text-center">
                                            {{$pet->users->mobile}}
                                        </div>
                                    </div>

                                    <div class="row w-100 mb-2">
                                        <div class="col-4 fw-bold">Address</div>
                                        <div class="col-8 info-data text-light text-center">
                                            {{$pet->users->address}}
                                        </div>
                                    </div>

                                    <div class="row w-100 mb-2">
                                        <div class="col-12">
                                            <a href="tel:+{{$pet->users->mobile}}" class="btn btn-sm btn-warning"><i class="fa fa-phone" aria-hidden="true"></i> Call</a>
                                            <a href="mailto:{{$pet->users->email}}" class="btn btn-sm btn-info"><i class="fa fa-envelope" aria-hidden="true"></i> Mail</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @else
                        <div class="container error-container">
                            <h1 class="error-heading">404</h1>
                            <p class="error-message">Oops! The page you requested could not be found.</p>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    @push('post_script')
        <script src="/system/public/breed.js"></script>
        <script>
            var breeds = Breeds;
            function populateBreed(selectedCat) {
                var BreedDropdown = $("#pet-breed");
                BreedDropdown.empty();

                var SelectedBreed = breeds.find(function (b) {
                    return b.category === selectedCat;
                });

                if (SelectedBreed) {
                    SelectedBreed.breed.forEach(function (b) {
                        BreedDropdown.append('<option value="' + b + '">' + b + '</option>');
                    });
                }
            }

            $("#Category").change(function () {
                var selectedCat = $(this).val();

                var genderSelect = $("#PetGender");
                genderSelect.empty();

                if (selectedCat === 'dog') {
                    genderSelect.append($('<option>', {value: 'macho'}).text('Macho'));
                    genderSelect.append($('<option>', {value: 'hembra'}).text('Hembra'));
                } else if (selectedCat === 'cat') {
                    genderSelect.append($('<option>', {value: 'Masculino'}).text('Masculino'));
                    genderSelect.append($('<option>', {value: 'Femenino'}).text('Femenino'));
                }

                populateBreed(selectedCat);
            });
        </script>
    @endpush
@endsection
