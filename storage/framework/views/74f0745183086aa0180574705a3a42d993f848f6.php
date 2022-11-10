<!--
=========================================================
* Material Dashboard 2 - v3.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com) & UPDIVISION (https://www.updivision.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by www.creative-tim.com & www.updivision.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['bodyClass']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['bodyClass']); ?>
<?php foreach (array_filter((['bodyClass']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo e(asset('assets')); ?>/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?php echo e(asset('assets')); ?>/img/favicon.png">
    <title>
        Material Dashboard 2 by Creative Tim & UPDIVISION
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="<?php echo e(asset('assets')); ?>/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?php echo e(asset('assets')); ?>/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="<?php echo e(asset('assets')); ?>/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
</head>
<body class="<?php echo e($bodyClass); ?>">

<?php echo e($slot); ?>


<script src="<?php echo e(asset('assets')); ?>/js/core/popper.min.js"></script>
<script src="<?php echo e(asset('assets')); ?>/js/core/bootstrap.min.js"></script>
<script src="<?php echo e(asset('assets')); ?>/js/plugins/perfect-scrollbar.min.js"></script>
<script src="<?php echo e(asset('assets')); ?>/js/plugins/smooth-scrollbar.min.js"></script>
<?php echo $__env->yieldPushContent('js'); ?>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="<?php echo e(asset('assets')); ?>/js/material-dashboard.min.js?v=3.0.0"></script>
</body>
</html>
<?php /**PATH E:\GITHUB\accenturephp\laravel-coding-test-level-1\resources\views/components/layout.blade.php ENDPATH**/ ?>