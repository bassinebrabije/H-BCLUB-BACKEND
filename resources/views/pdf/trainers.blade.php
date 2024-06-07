<!DOCTYPE html>
<html>
<head>
    <title>Trainers List</title>
    <style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: #FF0000;
  color: white;
}
    </style>
</head>
<body>
    <h1>Trainers List</h1>
    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Ville</th>
                <th>Gender</th>
                <th>about</th>
                <th>Joined At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trainers as $trainer)
            <tr>
                <td>{{ $trainer->fname }}</td>
                <td>{{ $trainer->lastname }}</td>
                <td>{{ $trainer->phone }}</td>
                <td>{{ $trainer->email  }}</td>
                <td>{{ $trainer->ville }}</td>
                 <td>{{ $trainer->sexe }}</td>
                <td>{{ $trainer->about }}</td>
                <td>{{ $trainer->created_at }}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
