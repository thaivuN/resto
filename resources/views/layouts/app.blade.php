<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>Foody - @yield('title')</title>
      <!-- Styles -->
      <link href="/css/app.css" rel="stylesheet">
      <link href="/css/custom.css" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <!-- Scripts -->
      <script>
         window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            ]); ?>
      </script>
      <script src="https://use.fontawesome.com/d16d023904.js"></script>
      
   </head>
   <body id="index_body">
      <div>
         <!-- http://pastebin.com/qAWxNq6s -->
         @yield('content')
      </div>
      <!-- Scripts -->
      <script src="/js/app.js"></script>

   </body>
</html>