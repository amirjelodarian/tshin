<!DOCTYPE html>

<html dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تی شین</title>
    <link rel="shortcut icon" href="#" type="image/x-icon">

    <!-- CSS -->
    <link href="css\base.css" rel="stylesheet">

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
<?php
    require_once("classes/initialize.php");
    global $sessions;
    if ($sessions->login_state()){
        include("includes/logged_in_header.php");
    }else{
        include("includes/header.php");
    }
?>
<?php require_once("classes/initialize.php"); ?>
<div id="map_contact" class=" col-lg-12">
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d103690.92597807983!2d51.35262745976019!3d35.693214588901384!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sfr!4v1575642055300!5m2!1sen!2sfr" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
</div>
<div id="directions">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form action="http://maps.google.com/maps" method="get" target="_blank" style="padding: 15px;padding-bottom: 0;">
                    <div class="input-group">
                        <input type="text" name="saddr" placeholder="نقطه شروع خود را وارد کنید" class="form-control style-2">
                        <input type="hidden" name="daddr" value="Tehran Province ,Pasteur Square"> <span class="input-group-btn"><button class="btn" type="submit" value="Get directions" style="margin-left:0;">دریافت جهات</button></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="position">
    <div class="container">
        <ul>
            <li><a href="#">صفحه اصلی</a>
            </li>
            <li><a href="#">دسته بندی</a>
            </li>
            <li>صفحه فعال</li>
        </ul>
    </div>
</div>
<div class="container margin_60">
    <div class="row">
        <div class="col-md-8 col-sm-8">
            <div class="form_title">
                <h3><strong><i class="icon-pencil"></i></strong>فرم را پر کنید</h3>
                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</p>
            </div>
            <div class="step">
                <div id="message-contact"></div>
                <form method="post" action="assets/contact.php" id="contactform">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>نام خانوادگی</label>
                                <input type="text" class="form-control" id="name_contact" name="name_contact" placeholder="نام خود را وارد کنید">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>نام خانوادگی</label>
                                <input type="text" class="form-control" id="lastname_contact" name="lastname_contact" placeholder="نام خانوادگی خود را وارد کنید">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>پست الکترونیک</label>
                                <input type="email" id="email_contact" name="email_contact" class="form-control" placeholder="ایمیل خود را وارد کنید ">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>تلفن</label>
                                <input type="text" id="phone_contact" name="phone_contact" class="form-control" placeholder="شماره تلفن را وارد کنید">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>پیام</label>
                                <textarea rows="5" id="message_contact" name="message_contact" class="form-control" placeholder="پیام خود را بنویسید" style="height:200px;"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>تایید کد کپچا</label>
                            <input type="text" id="verify_contact" class=" form-control add_bottom_30" placeholder="آیا شما انسان هستید !!!">
                            <input type="submit" value="ارسال" class="btn_1" id="submit-contact">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="box_style_1">
                <h4>نشانی <span><i class="icon-pin pull-right"></i></span></h4>
                <p>تهران جنت اباد شمالی</p>
                <hr>
                <h4>کمک رسانی<span><i class="icon-help pull-right"></i></span></h4>
                <p>ورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
                <ul id="contact-info">
                    <li>۰۷۶۳۲۲۲۹۱۲۷</li>
                    <li><a href="#">Info@digiao.ir</a>
                    </li>
                </ul>
            </div>
            <div class="box_style_4"> <i class="icon_set_1_icon-57"></i>
                <h4>درخواست <span>کمک؟</span></h4>  <a href="تلفن تماس://۰۷۶۳۲۰۰۰۰۰۰" class="تلفن">۰۷۶۳۲۰۰۰۰۰۰</a>  <small>شنبه تا پنجشنبه از ساعت ۰۷:۰۰ الی ۲۳:۰۰</small>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>
<script src="js\jquery-1.11.2.min.js"></script>
<script src="js\common_scripts_min.js"></script>
<script src="js\functions.js"></script>
</body>
</html>