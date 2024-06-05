<!DOCTYPE html>
<html>
<head>
    <title>Inscriptions List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Inscriptions List</h1>
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
