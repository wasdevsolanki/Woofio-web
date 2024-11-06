<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Woofio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            margin-top: 5px;
            text-align: center;
        }

        .pet-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .pet-table th, .pet-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .pet-table th {
            background-color: #f2f2f2;
            text-align: start;
        }

        .pet-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .pet-table tr:hover {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<div class="container">

    <p>La vacuna de tu mascota está pronto a expirar, por favor acude con un médico para nueva dosis o actualiza tu cartilla.</p>
    <div class="header">
        <h1>Vacunas de tu mascota</h1>
    </div>

    <table class="pet-table">
        <thead>
        <tr>
            <th>Nombre de Mascota</th>
            <th>Vacuna</th>
            <th>Proxima Vacuna</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($vaccines as $vaccine)
            <tr>
                <td>{{ $pet->pet_name }}</td>
                <td>{{ $vaccine->vaccine_name }}</td>
                <td>{{ $vaccine->vaccine_expiry_date }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>

</body>
</html>
