<!doctype html>
<html lang="en">
    <head> 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Woofio</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>

        <div class="container-fluid">

            <div class="row d-flex justify-contents-flex-start">
                <div class="col-md-12 bg-light p-5">
                    <h1 class="text-info">Hemos ubicado a tu mascota!</h1>
                    <span>Soporte Woofio</span>
                </div>

                <div class="col-md-12 p-2">
                    <h4>Alguien ha escaneado la placa de tu mascota en la siguiente ubicación:</h4>
                    <small>Da click en el boton de abajo para ver ubicacion</small>
                    <hr>

                    <a href="{{$data}}" style="display: inline-block; padding: 6px; border: 1px solid black; border-radius: 8%; background-color: #343a40; color: #ffffff; text-decoration: none;">Ver ubicación</a>

                </div>

            </div>

        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>