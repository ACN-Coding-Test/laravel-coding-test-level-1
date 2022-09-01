<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test</title>
    <link href="{!! asset('css/bootstrap.min.css')!!}" rel="stylesheet">
    <link href="{!! asset('css/font-awesome.min.css')!!}" rel="stylesheet">
    <link href="{!! asset('css/styles.css')!!}" rel="stylesheet">
    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>
<body>
    @include('layouts.admin.header')
    @include('layouts.admin.sidebar')
    @yield('content') 
    <input id="crf_token" value="{{ csrf_token() }}" type="hidden">
    <!-- End wrapper-->


<!-- Bootstrap core JavaScript-->   
    <script src="{!! asset('js/jquery-1.11.1.min.js')!!}"></script>
    <script src="{!! asset('js/bootstrap.min.js')!!}"></script>
    <script src="{!! asset('js/custom.js?v=1')!!}"></script>
    <!-- Page level custom scripts -->
    <script src="{!! asset('plugin/toastr/toastr.min.js') !!}"></script>

    <script type="text/javascript">
        $('document').ready(function(){
            <?php  if(session()->pull('flash_message_level') == 'success'){ ?>
                toastr["success"]("<?php echo session()->pull('flash_message'); ?>", "Success");
            <?php }else if(session()->pull('flash_message_level') == 'error'){ ?>
                toastr["error"]("<?php echo session()->pull('flash_message'); ?>", "Error");
            <?php }else if(session()->pull('flash_message_level') == 'warning'){?>
                toastr["warning"]("<?php echo session()->pull('flash_message'); ?>", "Warning");
            <?php }else if(session()->pull('flash_message_level') == 'info'){ ?>
                toastr["info"]("<?php echo session()->pull('flash_message'); ?>", "Info"); 
            <?php }?>
            toastr.options = {
              "closeButton": false,
              "debug": false,
              "newestOnTop": false,
              "progressBar": false,
              "rtl": false,
              "positionClass": "toast-top-right",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": 300,
              "hideDuration": 1000,
              "timeOut": 5000,
              "extendedTimeOut": 1000,
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }

            loadNotifications();   
        });

        
        function loadNotifications(){
            
            $.ajax({url: '{{url("notifications_count")}}', success: function(result){
                $("#notiification_count").html(result);
            }});
            $.ajax({url: '{{url("notifications")}}', success: function(result){
                $("#notification").html(result);
                setTimeout('loadNotifications', 10000);
            }});
        }
    </script>
@section('scripts')

@show
</body>
</html>
