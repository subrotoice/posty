<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <title>Home Posty</title>
</head>

<body class="bg-gray-200">
  <nav class="p-6 bg-white flex justify-between mb-6">
    <ul class="flex items-center"> 
        <li>
            <a href="" class="p-3">Home</a>
        </li>
        <li>
            <a href="" class="p-3">Dashboard</a>
        </li>
        <li>
            <a href="{{ route('posts') }}" class="p-3">Post</a>
        </li>
    </ul>
    <ul class="flex items-center">
        @auth
            <li>
                <a href="" class="p-3">{{ auth()->user()->name }}</a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="post" class="inline p-3">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
        @endauth
        @guest
            <li>
                <a href="{{ route('login') }}" class="p-3">Login</a>
            </li>
            <li>
                <a href="{{ route('register') }}" class="p-3">Register</a> 
            </li>
        @endguest

    </ul>
  </nav> 

  @yield('content')

</body>
</html>