<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <title><?php echo !empty($title_for_layout) ? $title_for_layout:'Test Blog'; ?></title>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7CMuli:400,700" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{!! asset('css/bootstrap.min.css')!!}" />
    <link rel="stylesheet" href="{!! asset('css/font-awesome.min.css')!!}">
    <link type="text/css" rel="stylesheet" href="{!! asset('css/style.css')!!}" />
</head>
<body id="page-top">
    @include('layouts.blog.header')

    @yield('content')
    
    @include('layouts.blog.footer')
<!-- jQuery Plugins -->
<script src="{!! asset('js/jquery-1.11.1.min.js')!!}"></script>
<script src="{!! asset('js/bootstrap.min.js')!!}"></script>
<script src="{!! asset('js/jquery.stellar.min.js')!!}"></script>
<script src="{!! asset('js/main.js')!!}"></script>
@yield('script')
</body>
</html>
