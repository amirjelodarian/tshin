<?php require_once("classes/initialize.php"); ?>
<!DOCTYPE html>

<html dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>تی شین</title>
    <link rel="shortcut icon" href="#" type="image/x-icon">
    <!-- CSS -->
    <link href="css\base.css" rel="stylesheet">
    <script src="js/jquery-1.11.2.min.js" type="text/javascript"></script>
    <script src="js/signUp.js" type="text/javascript"></script>
    <script>
        window.onload = function () {
            var tel = document.getElementById("tel");
            tel.focus();
            tel.selectionStart = tel.selectionEnd = tel.value.length;
        };
    </script>
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

<section id="hero" class="login">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                <div id="login">
                    <div class="text-center">
                        <img src="img\logo_sticky.png" alt="" data-retina="true">
                    </div>
                    <hr>
                    <form method="post" action="reset_password_check.php">
                        <h4 align="center">تغییر رمز</h4>
                        <div class="form-group">
                            <label>شماره موبایل</label>
                            <input type="tel" name="tel" id="tel" onkeyup="return toast_error();" class=" form-control" value="09" placeholder="شماره موبایل" minlength="11" maxlength="11" required />
                            <div class="icon-warning" id="toast-error" onclick="this.style.display='none'" style="display:none;">۱۱ رقم باشد و با 09 شروع شود</div>
                        </div>
                        <div id="errors"><?php echo $users->Errors(); ?></div>
                        <input class="btn_full" onclick="toast_error()" value="ورود" name="submit" type="submit" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $sessions->DestroyPassResetSessions(); ?>
<?php include("includes/footer.php"); ?>
<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/common_scripts_min.js"></script>
<script src="js/functions.js"></script>
<script src="js/pw_strenght.js"></script>
</body>
</html>