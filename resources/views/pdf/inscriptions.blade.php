<!DOCTYPE html>
<html>
<head>
    <title>Inscriptions List</title>
       <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        th {
            background-color: #FF0000;
            color: white;
        }
    </style>
</head>
<body>
    <img src="{{ public_path('images/logo.jpg') }}" width="100px" alt="logo">
    <h1>Request List</h1>
    <table>
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Ville</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inscriptions as $inscription)
            <tr>
                <td>{{ $inscription->full_name }}</td>
                <td>{{ $inscription->email }}</td>
                <td>{{ $inscription->ville }}</td>
                <td>{{ $inscription->phone_number }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
