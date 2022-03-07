<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laravel Assessment</title>
  <link href="{{ url('css/app.css') }}" rel="stylesheet" type="text/css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
</head>
<body>
  <div class="container">
    @yield('main')
  </div>
  <script src="{{ url('js/app.js') }}" type="text/js"></script>
  <script type="text/javascript">
    $('.date').datepicker({  
      format: 'yyyy-mm-dd'
     });  
</script> 
</body>
</html>