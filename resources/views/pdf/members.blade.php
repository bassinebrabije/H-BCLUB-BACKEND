<!DOCTYPE html>
<html>
<head>
    <title>Members List</title>
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

    <h1>Members List</h1>
    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Ville</th>
                <th>Gender</th>
                <th>Subscription</th>
                <th>Joined At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $member)
            <tr>
                <td>{{ $member->fname }}</td>
                <td>{{ $member->lname }}</td>
                <td>{{ $member->phone }}</td>
                <td>{{ $member->email }}</td>
                <td>{{ $member->ville }}</td>
                <td>{{ $member->sexe }}</td>
                <td>{{ $member->subscription }}</td>
               
                <td>{{ $member->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
