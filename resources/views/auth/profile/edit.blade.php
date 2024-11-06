<x-laravel-ui-adminlte::adminlte-layout>
    <body class="hold-transition login-page">

    <div class="login-box mt-5 mb-5">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="login-logo mt-3">
            @if(isset($user->profile))
                <img src="/system/public/uploaded_files/user/{{$user->profile}}" class="img-fluid" width="70">
            @else
                <img src="/images/pet_logo.png" width="100">
            @endif
        </div>
        <!-- /.login-logo -->

        <!-- /.login-box-body -->
        <div class="card">
            <div class="card-header">
                <a href="{{url('/')}}" class="btn btn-sm btn-primary "><i class="fa fa-arrow-left" aria-hidden="true"></i> Inició</a>
            </div>
            <div class="card-body login-card-body">
                <p class="login-box-msg"><strong>Editar Perfil</strong></p>

                <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{$user->profile}}" name="old_profile">
                    <div class="input-group mb-3">
                        <input type="text" name="first_name" value="{{$user->first_name}}" placeholder="First Name"
                               class="form-control @error('first_name') is-invalid @enderror">
                        <div class="input-group-append">
                            <div class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></div>
                        </div>
                        @error('first_name')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" name="last_name" value="{{ $user->last_name }}" placeholder="Last Name"
                               class="form-control @error('last_name') is-invalid @enderror">
                        <div class="input-group-append">
                            <div class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></div>
                        </div>
                        @error('last_name')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" name="name" value="{{$user->name}}" placeholder="Name"
                               class="form-control @error('name') is-invalid @enderror">
                        <div class="input-group-append">
                            <div class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></div>
                        </div>
                        @error('name')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="email" name="email" value="{{$user->email}}" placeholder="Email"
                               class="form-control @error('email') is-invalid @enderror">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                        </div>
                        @error('email')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password" value="" placeholder="Password"
                               class="form-control @error('password') is-invalid @enderror">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" name="mobile" value="{{$user->mobile}}" placeholder="Mobile"
                               class="form-control @error('mobile') is-invalid @enderror">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fa fa-phone-square" aria-hidden="true"></i>
                            </div>
                        </div>
                        @error('mobile')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                            <option value="Male" {{ $user->gender === 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $user->gender === 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fa fa-address-card" aria-hidden="true"></i>
                            </div>
                        </div>
                        @error('gender')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

{{--                    <div class="input-group mb-3">--}}
{{--                        <input type="file" name="latest_profile" value="" placeholder="Mobile"--}}
{{--                               class="form-control @error('latest_profile') is-invalid @enderror">--}}
{{--                        <div class="input-group-append">--}}
{{--                            <div class="input-group-text">--}}
{{--                                <i class="fa fa-file" aria-hidden="true"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        @error('latest_profile')--}}
{{--                        <span class="error invalid-feedback">{{ $message }}</span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}

                    <div class="input-group mb-3">
                        <input type="text" name="address" value="{{$user->address}}" placeholder="Address"
                               class="form-control @error('address') is-invalid @enderror">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fa fa-address-card" aria-hidden="true"></i>
                            </div>
                        </div>
                        @error('address')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Actualizar Perfil</button>
                        </div>
                    </div>
                </form>

            </div>
            <!-- /.login-card-body -->
        </div>

    </div>
    <!-- /.login-box -->
    </body>
</x-laravel-ui-adminlte::adminlte-layout>
