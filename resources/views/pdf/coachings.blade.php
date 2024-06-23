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
    <h1>Coaching List</h1>
    <table>
        <thead>
            <tr>
                <th>Member  Full Name</th>
                <th>Member Phone</th>
                <th>Member Ville</th>  

                <th>Trainer  Full Name</th>
                <th>Trainer Phone</th>
                <th>Trainer Ville</th>  
               
            </tr>
        </thead>
        <tbody>
            @foreach ($coachings as $coaching)
            <tr>
                <td>{{ $coaching->member->fname }} {{ $coaching->member->lname }}</td>
                <td>{{ $coaching->member->phone }}</td>
                <td>{{ $coaching->member->ville }}</td>

                <td>{{ $coaching->trainer->fname }} {{ $coaching->trainer->lastname }}</td>
                <td>{{ $coaching->trainer->phone }}</td>
                <td>{{ $coaching->trainer->ville }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
