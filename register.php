<?php require_once("classes/initialize.php"); ?>
<!DOCTYPE html>

<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>تی شین</title>
    <link rel="shortcut icon" href="#" type="image/x-icon">
    <!-- CSS -->
    <link href="css/base.css" rel="stylesheet">
    <script src="js/jquery-1.11.2.min.js" type="text/javascript"></script>
    <script src="js/signUp.js" type="text/javascript"></script>
</head>
<body>
<div id="preloader">
    <div class="sk-spinner sk-spinner-wave">
        <div class="sk-rect1"></div>
        <div class="sk-rect2"></div>
        <div class="sk-rect3"></div>
        <div class="sk-rect4"></div>
        <div class="sk-rect5"></div>
    </div>
</div>
<div class="layer"></div>
<?php include("includes/form_header.php"); ?>
<?php
    $users->signup();
?>
<?php
if ($sessions->login_state()){
    $users->redirect_to("index.php");
}
?>
<section id="hero" class="login">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                <div id="login">
                    <div class="text-center">
                        <img src="img\logo_sticky.png" alt="" data-retina="true">
                    </div>
                    <hr>
                    <form method="post" action="<?php echo(htmlspecialchars(($_SERVER['PHP_SELF']))); ?>">
                        <div class="form-group">
                            <label>نام کاربری</label>
                            <input type="text" name="username" maxlength="99" class=" form-control" placeholder="نام کاربری" required />
                        </div>
                        <div class="form-group">
                            <label>شماره موبایل</label>
                            <input type="tel" name="tel" id="tel" onkeyup="return toast_error();" class=" form-control" value="09" placeholder="شماره موبایل" minlength="11" maxlength="11" required />
                            <div class="icon-warning" id="toast-error" onclick="this.style.display='none'" style="display:none;">۱۱ رقم باشد و با 09 شروع شود</div>
                        </div>
                        <div class="form-group">
                            <label>کلمه عبور</label>
                            <input type="password" name="password" minlength="8" maxlength="50" class=" form-control" id="password1" placeholder="کلمه عبور" required />
                        </div>
                        <div class="form-group">
                            <label>تکرار کلمه عبور</label>
                            <input type="password" name="repeat_password" minlength="8" maxlength="50" class=" form-control" id="password2" placeholder="تکرار کلمه عبور" require />
                        </div>
                        <div id="errors"><?php echo $users->Errors(); ?></div>
                        <div id="pass-info" class="clearfix"></div>
                        <input class="btn_full" onclick="toast_error()" name="submit" type="submit" value="ایجاد حساب کاربری" />
                    </form>
                    <a href="login.php" class="small">آیا حساب کاربری دارید ؟ وارد شوید</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include("includes/footer.php"); ?>
<script src="js\jquery-1.11.2.min.js"></script>
<script src="js\common_scripts_min.js"></script>
<script src="js/functions.js"></script>
<script src="js\pw_strenght.js"></script>
</body>
</html>