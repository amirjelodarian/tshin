<?php require_once("classes/initialize.php"); ?>
<!DOCTYPE html>

<html dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
    $users->insert_user_verify_code();
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
                    <form method="post" action="<?php echo($_SERVER['PHP_SELF']); ?>">
                        <div class="form-group">
                            <label>کد ارسال شده را وارد کنید</label>
                            <input type="text" name="code" minlength="5" maxlength="5" class=" form-control" id="code" onkeypress="return event.ctrlKey || event.metaKey || event.altKey || event.charCode >= 45 && event.charCode <= 57 && event.charCode!=47" placeholder="کد 5 رقمی" require />
                        </div>
                        <div id="errors">
                            <?php
                                $_SESSION["errors_message"] = " ";
                                if (!(empty($_SESSION["errors_message"])) && $_SESSION["errors_message"] != "" || $_SESSION["errors_message"] != " ") {
                                    echo $users->Errors();
                                }else{
                                    return null;
                                }
                            ?>
                        </div>
                        <div id="pass-info" class="clearfix"></div>
                        <input class="btn_full" name="submit" type="submit" value="ایجاد حساب کاربری" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include("includes/footer.php"); ?>
<script src="js\jquery-1.11.2.min.js"></script>
<script src="js\common_scripts_min.js"></script>
<script src="js\functions.js"></script>
<script src="js\pw_strenght.js"></script>
</body>
</html>