<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="_token" content="{{ csrf_token() }}">
        <title>Recrutamento Mindtec</title>
        
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
        
        <link rel="stylesheet" href="{{ asset('vendor/Ionicons/css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}">
        
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css">
        
        <link rel="stylesheet" href="//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.css">
        <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
        <link rel="stylesheet" href="//cdn.datatables.net/select/1.2.6/css/select.dataTables.min.css">
        <link rel="stylesheet" href="//editor.datatables.net/extensions/Editor/css/editor.dataTables.min.css">
        
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
        
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    
        @yield('css')
    </head>
    <body>
        <script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/jquery/dist/jquery.mask.min.js') }}"></script>
        <script src="{{ asset('vendor/jquery/dist/jquery.slimscroll.min.js') }}"></script>
        
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        
        <script src="//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.js"></script>
        <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="//cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
        
        @yield('body')
        
        @yield('js')
    </body>
</html>