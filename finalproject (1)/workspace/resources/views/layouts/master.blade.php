<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Login/Logout animation concept</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
    
    
    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans'>

    <link rel="stylesheet" href="{{ URL::secure('src/css/main.css') }}">

    
    
    
  </head>

  <body>

    <div class="cont">
  <div class="main">
    <div class="maincontent">
       @include('includes.head')
	<div class="mainbody">
	   @yield('content')

	</div>

	</div>
    </div>
  </div>

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="js/index.js"></script>

    
    
    
  </body>
</html>
