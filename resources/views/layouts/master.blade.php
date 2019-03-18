<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title','MyBlog')</title>
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

        <link href="/css/appketi.css" rel="stylesheet">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    </head>
    <body>
      <div id="app">
        <example-component></example-component>
      </div>
      
      @if (Route::has('login'))
          <div class="top-right links">
              @auth
                  <a href="{{ url('/home') }}">Home</a>
              @else
                  <a href="{{ route('login') }}">Login</a>
                  <a href="{{ route('register') }}">Register</a>
              @endauth
          </div>
      @endif
    	@include ('layouts.nav')

      @if($flash = session('message'))
      <div id="flash-message" class="alert alert-success" role="alert">
          {{ $flash }}
      </div>
      @endif 

      @role

      @endrole    

    	<div class='container'>
        <div class="row">
       		@yield('content')

          @include('layouts.sidebar')
        </div><!--row-->
   		</div><!--container-->
      
   		@include ('layouts.footer')

      <!-- <script src="/js/manifest.js"></script>

      <script src="/js/vendor.js"></script> -->

      <script src="{{ mix('/js/app.js')  }}"></script>

    </body>
</html>


<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<script>
 
  // MDB Lightbox Init
  $(function () {
    $("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
  });
</script>
