<!DOCTYPE html>
<html  class= "dark">
<head>
    <title>All Users</title>
</head>
<body>
    <h1>All Users</h1>
    <ul>
        @foreach($users as $user)
            <li>{{ $user->username }}</li>
        @endforeach
    </ul>
</body>
</html>
