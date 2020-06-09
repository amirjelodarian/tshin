<!DOCTYPE html>

<html dir='rtl'>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>تی شین</title>
    <link rel='shortcut icon' href=''#' type='image/x-icon'>

    <!-- CSS -->
    <link href='css\base.css' rel='stylesheet'>
    <link href='css\skins\square\grey.css' rel='stylesheet'>
    <link href='css\ion.rangeSlider.css' rel='stylesheet'>
    <link href='css\ion.rangeSlider.skinFlat.css' rel='stylesheet'>
    <style>
        .modal-backdrop.in
        {
            display: none;
        }
    </style>

</head>
<body>
<div id='preloader'>
    <div class='sk-spinner sk-spinner-wave'>
        <div class='sk-rect1'></div>
        <div class='sk-rect2'></div>
        <div class='sk-rect3'></div>
        <div class='sk-rect4'></div>
        <div class='sk-rect5'></div>
    </div>
</div>
<div class='layer'></div>
<?php
require_once('classes/initialize.php');
global $sessions;
global $foods;
if ($sessions->login_state()){
    include('includes/logged_in_header.php');
}else{
    include('includes/header.php');
}
?>
<?php Foods::FoodDetailsPage(); ?>
<?php include('includes/footer.php'); ?>
<script src='js\jquery-1.11.2.min.js'></script>
<script src='js\common_scripts_min.js'></script>
<script src='js\functions.js'></script>
<script src='js\icheck.js'></script>
<script>
    $('input').iCheck({checkboxClass: 'icheckbox_square-grey', radioClass: 'iradio_square-grey'});
</script>
</body>
</html>