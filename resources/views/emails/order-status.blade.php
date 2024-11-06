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

    <div class="header">
        <h1>Order Status</h1>
    </div>

    <table class="pet-table">
        <thead>
        <tr>
            <th>Order #</th>
            <th>Quantity</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $data['order_number'] }}</td>
            <td>{{ $data['quantity'] }}</td>
            <td>
                @if( $data['status'] ==  0 )
                    Pending
                @elseif( $data['status'] == 1 )
                    Processing
                @elseif( $data['status'] == 2 )
                    Shipped
                @elseif( $data['status'] ==  3)
                    Delivered
                @elseif ( $data['status'] == 4 )
                    Cancelled
                @elseif( $data['status'] == 5 )
                    Return
                @endif
            </td>
        </tr>
        </tbody>
    </table>

</div>

</body>
</html>
