@extends('front.layouts.app')
@section('content')
<style>
    .content-wrapper {
        min-height: 0px !important;
    }

    .hero_section {
        background: url('/images/bg/create__user_bg.png') no-repeat center;
        height: 50vh;
        background-size: cover;
        display: flex;
        justify-content: center;
    }
    .company_logo img{
        width: 100px;
    }

    .welcome_content {
        font-size: 1.5em;
        font-weight: 700;
        color: #626a71;
        font-family: system-ui;
        text-align: center;
    }

    .welcome_footer_content {
        font-size: 1.3em;
        font-weight: 600; 
        color: #3498db;
        font-family: system-ui;
        text-align: center;
    }

    .welcome_footer_content a {
        color: #3498db;
        text-decoration: underline;
    }

</style>

    <div class="container">
        <div class="row justify-content-center" >
            <div path="{{$scan_id}}" id="Path"></div>
            <div class="col-md-8 hero_section border">
{{--                <div class="company_logo mt-4">--}}
{{--                    <img src="/images/bg/petlogo.png" class="img-fluid" alt="">--}}
{{--                </div>--}}
            </div>

            <div class="col-md-8 p-3 mt-3 welcome_content">
                Bienvenido  a la red <span class="badge text-white border rounded-pill" style="background-color:#3498db;">#1</span> en México para cuidar a tu mascota
            </div>

            <div class="col-md-8 p-3">
                <a href="{{ route('register') }}" class="btn border rounded-pill p-2 pt-1 pb-1 w-100 text-light register_button" style="background-color:#3498db;">Crear Perfil</a>
            </div>
            
            <div class="col-md-8 welcome_footer_content">
                Ya tienes cuenta? </br> 
                <a href="{{ route('login') }}" class="text-decoration-underline login_button">Registra otra mascota Aquí</a>
            </div>
            
        </div>
    </div>

@endsection
