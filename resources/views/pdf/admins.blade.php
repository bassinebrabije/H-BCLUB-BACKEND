<!DOCTYPE html>
<html>
<head>
    <title>Coaching List</title>
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
    <h1>Admins List</h1>
    <table>
        <thead>
            <tr>
           
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Ville</th>
                <th>Gender</th>
                <th>Username</th>
                <th>Joined At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
            <tr>
                <td>{{ $admin->fname }}</td>
                <td>{{ $admin->lname }}</td>  
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->phone }}</td>
                <td>{{ $admin->ville }}</td>
                <td>{{ $admin->sexe }}</td>
                <td>{{ $admin->username }}</td>
                <td>{{ $admin->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
