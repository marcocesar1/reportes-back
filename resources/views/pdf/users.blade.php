<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users Report</title>
    <style>
        .title{
            color: cornflowerblue;
        }
        table, th, td {
            border: 1px solid white;
            border-collapse: collapse;
        }
        th, td {
            background-color: #96D4D4;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h1 class="title">Users Report</h1>
    <div>
        <table>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Address</th>
              <th>City</th>
            </tr>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->address->address}}</td>
                    <td>{{$user->address->city}}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>