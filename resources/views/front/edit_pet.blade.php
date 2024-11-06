@extends('front.layouts.app')
@section('content')

    <div class="content">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 mt-3 p-3 bg-white shadow-sm border">
                    <h5 class="mb-3">Editar perfil de mascota</h5>
                    <hr>

                    <form method="POST" action="{{ route('pet.update')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="qr_id" value="{{$pet->qr_id}}">
                        <input type="hidden" name="user_id" value="{{$pet->user_id}}">
                        <input type="hidden" name="pet_id" value="{{$pet->id}}">
                        <input type="hidden" name="old_profile" value="{{$pet->profile}}">

                        <div class="mb-3 d-flex justify-content-center">
                            <img src="/system/public/uploaded_files/pet/{{$pet->profile}}" class="border rounded" style="width:80px">
                        </div>
                        
                        <div class="mb-3">
                            <label for="petName" class="form-label mb-0">Nombre de Mascota</label>
                            <input type="text" name="pet_name" value="{{$pet->pet_name}}" class="form-control" id="petName" placeholder="Enter Pet Name" required>
                        </div>

                        <div class="mb-3">
                            <label for="petAge" class="form-label mb-0">Fecha de Nacimiento</label>
                            <input type="date" name="pet_age" value="{{$pet->pet_age}}" class="form-control" id="petAge" placeholder="Enter Pet Age" required>
                        </div>

                        @if($pet->category == 'dog')
                        <div class="mb-3">
                            <label for="petGender" class="form-label mb-0">Generó</label>
                            <select id="petGender" name="gender" class="form-select form-control">
                                <option value="Macho" {{ $pet->gender === 'Macho' ? 'selected' : '' }}>Macho</option>
                                <option value="Hembra" {{ $pet->gender === 'Hembra' ? 'selected' : '' }}>Hembra</option>
                            </select>
                        </div>
                        @else
                        <div class="mb-3">
                            <label for="petGender" class="form-label mb-0">Generó</label>
                            <select id="petGender" name="gender" class="form-select form-control">
                                <option value="Macho" {{ $pet->gender === 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="Hembra" {{ $pet->gender === 'Femenino' ? 'selected' : '' }}>Femenino</option>
                            </select>
                        </div>
                        @endif

                        <div class="mb-3">
                            <label for="petProfile" class="form-label mb-0">Foto de Perfil</label>
                            <input type="file" name="latest_profile" value="" class="form-control" id="petProfile">
                        </div>

                        <div class="mb-3">
                            <label for="petInstruction" class="form-label mb-0">Instrucción especial</label>
                            <textarea class="form-control" name="special_instruction" required>{{$pet->special_instruction}}</textarea>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Actualizar mascota</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection