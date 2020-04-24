<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تی شین</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <!-- CSS -->
    <link href="../css/base.css" rel="stylesheet">
    <link href="../css/skins/square/grey.css" rel="stylesheet">
    <link href="../css/ion.rangeSlider.css" rel="stylesheet">
    <link href="../css/ion.rangeSlider.skinFlat.css" rel="stylesheet">

</head>
<body>
<?php require_once('../classes/rooms.php'); ?>
<?php require_once('../classes/foods.php'); ?>
<?php require_once('../classes/users.php'); ?>
<?php
    if(isset($_POST["logout_submit"])) {
        $sessions->logout();
        $users->redirect_to("../index.php");
    }
?>
<div class="container-fluid">
    <div class="row">
        <div class="panel_menu col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <div class="home"><a href="../index.php"><span class="icon-home" id="icon-home"></span>Home</a></div>
            <ul>
                <li class="icon-tools"><a href="admin.php">Admin</a></li>
                <li class="icon-doc-add"><a href="rooms_show.php">Rooms <span class="count">(<?php $rooms->CountRoom(); ?>)</span></a></li>
                <li class="icon-food"><a href="foods_show.php">Foods <span class="count">(<?php $foods->CountFood(); ?>)</span></a></li>
                <li class="icon-comment-alt-1"><a href="comments_show.php">Comment <span class="count">(<?php $rooms->CountAllRoomComments(); ?>)</span></a></li>
                <li>
                    <form action="<?php echo(htmlspecialchars($_SERVER['PHP_SELF'])); ?>" method="post">
                        <span class="icon-logout"><input type="submit" name="logout_submit" class="logout-btn" value="LogOut" /></span>
                    </form>
                </li>
            </ul>
        </div>