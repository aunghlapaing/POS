<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>POS | User Test Auth</title>
</head>
<body>
    <h1>This is User Dashboard TestAuth</h1>
    <span>{{ Auth::user()->first_name }}</span>
    <div>
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-dark" value="Logout"></button>
        </form>
    </div>
    
</body>
</html>