<!DOCTYPE html>
<html>
<head>
    <title>Members List</title>
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
        img {
            width: 50px;
            height: 50px;
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
                <th>Ville</th>
                <th>Subscription</th>
                <th>Sexe</th>
             
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $member)
            <tr>
                <td>{{ $member->fname }}</td>
                <td>{{ $member->lname }}</td>
                <td>{{ $member->phone }}</td>
                <td>{{ $member->ville }}</td>
                <td>{{ $member->subscription }}</td>
                <td>{{ $member->sexe }}</td>
           
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
