<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">    
    <?php
        if (isset($description_for_layout)) {
            echo "<meta name='description' content='" . $description_for_layout . "' />";
        }
        if (isset($keywords_for_layout)) {
            echo "<meta name='keywords' content='" . $keywords_for_layout . "' />";
        }
        if(isset($meta_title_content)) { ?>
            <meta property="og:title" content="<?php echo $meta_title_content; ?>"/>
    <?php } ?>
    <title><?php echo !empty($title_for_layout) ? $title_for_layout:'Login'; ?></title>
    <link href="{!! asset('css/bootstrap.min.css')!!}" rel="stylesheet" type="text/css">
    <script src="{!! asset('js/jquery-1.11.1.min.js')!!}"></script>
    <script src="{!! asset('js/bootstrap.min.js')!!}"></script>
    <style type="text/css">
        body{
            background-color: #FFF;
        }
        .centered-form{
            margin-top: 60px;
        }

        .centered-form .panel{
            background: rgba(255, 255, 255, 0.8);
            box-shadow: rgba(0, 0, 0, 0.3) 20px 20px 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row centered-form">
            @yield('content')  
        </div>
    </div>    
    @section('css')
    @show
    @section('scripts')
    @show
</body>
</html>
