@extends('front.layouts.app')
@section('content')

    <div class="content">
        <div class="container">

            <div class="row p-2">

                <div class="col-lg-12 col-md-12 p-4 d-flex justify-content-between">
                    <a href="{{route('user.dashboard')}}" class="btn btn-sm btn-primary"><i class="bi bi-arrow-left"></i> Atras</a>
                    @if( $pet )
                    <h5>Vacunas de <strong>{{ $pet->pet_name }}</strong></h5>
                    <!-- Model form start-->
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-default">Añadir Vacuna</button>
                    <div class="modal fade" id="modal-default">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Añadir Vacuna</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form action="{{ route('vaccine.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $pet->id }}">

                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="VaccineName">Nombre de Vacuna</label>
                                            <input type="text" class="form-control" name="vaccine_name" id="VaccineName" placeholder="Agregar nombre de Vacuna">
                                        </div>

                                        <div class="form-group">
                                            <label for="VaccineDate">Fecha de Vacunación</label>
                                            <input type="date" class="form-control" name="vaccine_date" id="VaccineDate">
                                        </div>

                                        <div class="form-group">
                                            <label for="ExpiryVaccineDate">Fecha de expiración de Vacuna</label>
                                            <input type="date" class="form-control" name="vaccine_expiry_date" id="ExpiryVaccineDate">
                                        </div>

                                        <div class="form-group">
                                            <label for="Veterinary">Nombre de Veterinario</label>
                                            <input type="text" class="form-control" name="veterinary_name" id="Veterinary" placeholder="Nombre de Veterinario">
                                        </div>

                                        <!-- <div class="form-group">
                                            <label for="Detail">Vaccine Detail</label>
                                            <textarea id="Detail" name="detail" class="form-control"></textarea>
                                        </div> -->

                                    </div>

                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Registrar Vacuna</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- Model form end  -->
                    @endif

                </div>

                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Lista de Vacunas</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Vacuna</th>
                                    <th>Fecha de Vacunación</th>
                                    <th>Fecha de expiración de Vacuna</th>
                                    <th>Nombre de Veterinario</th>
{{--                                    <th>Action</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $vaccine as $item )
                                    <tr>
                                        <td>{{ $item->vaccine_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->vaccine_date)->format('F j, Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->vaccine_expiry_date)->format('F j, Y') }}</td>
                                        <td>{{ $item->veterinary_name }}</td>
{{--                                        <td></td>--}}

                                    </tr>
                                @endforeach

                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
