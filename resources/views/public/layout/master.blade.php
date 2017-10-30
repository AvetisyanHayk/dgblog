<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta name="author" content="Hayk AVETISYAN"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ URL::to('css/reset.css')  }}" type="text/css"/>
    <link rel="stylesheet" href="{{ URL::to('css/screen.css')  }}" type="text/css"/>
    <title>dgblog</title>
</head>
<body>
@yield('body')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>