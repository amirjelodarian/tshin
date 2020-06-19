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
<body onload="startTime()">
<?php require_once('../classes/initialize.php'); ?>
<?php
if(isset($_POST["logout_submit"])) {
    $sessions->logout();
    $users->redirect_to("../index.php");
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="mobile-menu"><div class="icon-menu" id="icon_menu"></div><div class="icon-close">X</div></div>
        <div class="panel_menu col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <div class="home"><a href="../index.php" target="_blank"><span class="icon-home" id="icon-home"></span>خانه</a></div>
            <div class="DateTime">
                <p id="today-time"></p>
                <p id="today-date">
                    <?php
                    global $Functions;
                    $Functions->today_date();
                    ?>
                </p>
            </div>
            <ul>
                <li class="icon-tools"><a href="administrator.php">مدیریت</a></li>
                <li class="icon-doc-add"><a href="rooms_show.php">اتاق ها <span class="count">(<?php $rooms->CountRoom(); ?>)</span></a></li>
                <li class="icon-food"><a href="foods_show.php">غداها <span class="count">(<?php $foods->CountFood(); ?>)</span></a></li>
                <li class="icon-user-male"><a href="admins_show.php">ادمین ها <span class="count">(<?php $users->CountAdmins(); ?>)</span> </a></li>
                <li class="icon-users-1"><a href="users_show.php">کاربران <span class="count">(<?php $users->CountUsers(); ?>)</span></a></li>
                <li class="icon-comment-alt-1"><a href="comments_show.php">نظرات <span class="count">(<?php $rooms->CountAllRoomComments(); ?>)</span></a></li>
                <li class="icon-book"><a href="reservation_show.php">رزرو ها <span class="count">(<?php $rooms->CountAllRoomReservation(); ?>)</span></a></li>
                <li>
                    <form action="<?php echo(htmlspecialchars($_SERVER['PHP_SELF'])); ?>" method="post">
                        <span class="icon-logout"><input type="submit" name="logout_submit" class="logout-btn" value="خروج" /></span>
                    </form>
                </li>
            </ul>
        </div>
        <div class="panel_menu_mobile col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <div class="home"><a href="../index.php" target="_blank"><span class="icon-home" id="icon-home"></span>خانه</a></div>-
            <div class="DateTime">
                <p id="today-time-mobile"></p>
                <p id="today-date-mobile">
                    <?php
                    global $Functions;
                    $Functions->today_date();
                    ?>
                </p>
            </div>
            <ul>
                <li class="icon-tools"><a href="administrator.php">مدیریت</a></li>
                <li class="icon-doc-add"><a href="rooms_show.php">اتاق ها <span class="count">(<?php $rooms->CountRoom(); ?>)</span></a></li>
                <li class="icon-food"><a href="foods_show.php">غداها <span class="count">(<?php $foods->CountFood(); ?>)</span></a></li>
                <li class="icon-user-male"><a href="admins_show.php">ادمین ها <span class="count">(<?php $users->CountAdmins(); ?>)</span> </a></li>
                <li class="icon-users-1"><a href="users_show.php">کاربران <span class="count">(<?php $users->CountUsers(); ?>)</span></a></li>
                <li class="icon-comment-alt-1"><a href="comments_show.php">نظرات <span class="count">(<?php $rooms->CountAllRoomComments(); ?>)</span></a></li>
                <li class="icon-book"><a href="reservation_show.php">رزرو ها <span class="count">(<?php $rooms->CountAllRoomReservation(); ?>)</span></a></li>
                <li>
                    <form action="<?php echo(htmlspecialchars($_SERVER['PHP_SELF'])); ?>" method="post">
                        <span class="icon-logout"><input type="submit" name="logout_submit" class="logout-btn" value="خروج" /></span>
                    </form>
                </li>
            </ul>
        </div>