<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="keywords" content="chat ap">
		<!-- Mobile Specific -->
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Favicons Icon -->
		<link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}">

		<!-- Page Title Here -->
		<title>Qsend</title>

    @stack('prepend-styles')

    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

    @stack('addon-styles')

</head>
<body>
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
  
    <div id="main-wrapper">

        @include('layouts.navbar')
       
        @include('layouts.header')
       
        @include('layouts.sidebar')
        
        <div class="content-body">
			<div class="container-fluid">
				@yield('content')
			</div>	
        </div>
       
        @include('layouts.footer')
       
	</div>

    @stack('prepend-scripts')

    @stack('addon-scripts')
	
    
</body>
</html>