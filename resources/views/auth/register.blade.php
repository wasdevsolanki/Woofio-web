<title>Register</title>
<x-laravel-ui-adminlte::adminlte-layout>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        .register-page {
            background-image: url('/images/bg/woofio-bg.png');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
    </style>
    <body class="hold-transition register-page">

    <div class="register-box">

        <div class="register-logo">
            <img src="/images/woofio-logo.png" width="200">
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Formulario de inscripción</p>

                <form method="post" action="{{ route('register.user') }}"  enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="qr_id" id="qr_id" value="{{ Request::input('qr_id') }}">


                    <div class="input-group mb-3">
                        <input type="text" name="firstname" id="firstname"
                               class="form-control @error('firstname') is-invalid @enderror" value=""
                               placeholder="Nombre">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-user"></span></div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" name="lastname" id="lastname"
                               class="form-control @error('lastname') is-invalid @enderror" value=""
                               placeholder="Apellido">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-user"></span></div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" name="username" id="username"
                               class="form-control @error('username') is-invalid @enderror" value=""
                               placeholder="Usuario">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-user"></span></div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="form-control @error('email') is-invalid @enderror" placeholder="Correo">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-lock"></span></div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password_confirmation" class="form-control"
                               placeholder="Reescribe tu Contraseña">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-lock"></span></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                            <option value="male">Masculino</option>
                            <option value="female">Femenino</option>
                            <option value="other">Otro</option>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <input type="tel" name="mobile" class="form-control @error('mobile') is-invalid @enderror" id="mobile" placeholder="Número de teléfono">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-phone"></span></div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <select class="form-control @error('state') is-invalid @enderror" name="country" id="Country">
                            <option value="" disabled selected> --- Select Country ---</option>
                            <option value="maxico">México</option>
                            <option value="usa">United States of America</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <select class="form-control @error('state') is-invalid @enderror" name="state" id="State">
                            <option value="" disabled selected> --- Seleccionar Estado --- </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <select class="form-control @error('state') is-invalid @enderror" name="city" id="City">
                            <option value="" disabled selected> --- Seleccionar Ciudad ---</option>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                          <textarea name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Dirección"></textarea>
                          <div class="input-group-append">
                              <div class="input-group-text"><span class="fas fa-home"></span></div>
                          </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" id="submitButton" class="btn btn-primary btn-block">Register</button>
                        </div>

                        <div class="col-12 d-flex justify-content-end pt-2">
                            <a href="{{ route('login') }}">ya tengo una cuenta</a>
                        </div>
                    </div>

                </form>


            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->

        <!-- /.form-box -->
    </div>
    <!-- /.register-box -->

    <script src="/system/public/location.js"></script>
    <script>
    $(document).ready(function () {

        var states = Locations;
        function populateStates(country) {
            var statesDropdown = $("#State");
            statesDropdown.empty();

            // Filter states based on selected country
            var filteredStates = states.filter(function (item) {
                return item.country === country;
            });

            // Populate states dropdown
            filteredStates.forEach(function (state) {
                statesDropdown.append('<option value="' + state.state + '">' + state.state + '</option>');
            });
        }


        function populateCities(state) {
            var citiesDropdown = $("#City");
            citiesDropdown.empty();

            // Find selected state
            var selectedState = states.find(function (s) {
                return s.state === state;
            });

            if (selectedState) {
                // Populate cities dropdown
                selectedState.cities.forEach(function (city) {
                    citiesDropdown.append('<option value="' + city + '">' + city + '</option>');
                });
            }
        }

        $("#Country").change(function () {
            var selectedCountry = $(this).val();
            populateStates(selectedCountry);
        });

        $("#State").change(function () {
            var selectedState = $(this).val();
            populateCities(selectedState);
        });


        });
    </script>
    </body>
</x-laravel-ui-adminlte::adminlte-layout>