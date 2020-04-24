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
    <link href="css\blog.css" rel="stylesheet">


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
<section class="parallax-window" data-parallax="scroll" data-image-src="img/blog-2.jpg" data-natural-width="1400" data-natural-height="470">
    <div class="parallax-content-1">
        <div class="animated fadeInDown">
            <h1>وبلاگ ما</h1>
            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
        </div>
    </div>
</section>
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
        <aside class="col-md-3 add_bottom_30">
            <div class="widget">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="جستجو ..."> <span class="input-group-btn"><button class="btn btn-default" type="button" style="margin-left:0;"><i class="icon-search"></i></button></span>
                </div>
            </div>
            <hr>
            <div class="widget" id="cat_blog">
                <h4>دسته بندی ها</h4>
                <ul>
                    <li><a href="#">مکان های دیدنی</a>
                    </li>
                    <li><a href="#">تورهای برتر</a>
                    </li>
                    <li><a href="#">نکاتی برای مسافران</a>
                    </li>
                    <li><a href="#">مناسبت ها</a>
                    </li>
                </ul>
            </div>
            <hr>
            <div class="widget">
                <h4>پست های اخیر</h4>
                <ul class="recent_post">
                    <li> <i class="icon-calendar-empty"></i> ۲ اردیبهشت ۱۳۹۶
                        <div><a href="#">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </a>
                        </div>
                    </li>
                    <li> <i class="icon-calendar-empty"></i> ۲ اردیبهشت ۱۳۹۶
                        <div><a href="#">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </a>
                        </div>
                    </li>
                    <li> <i class="icon-calendar-empty"></i> ۲ اردیبهشت ۱۳۹۶
                        <div><a href="#">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </a>
                        </div>
                    </li>
                </ul>
            </div>
            <hr>
            <div class="widget tags">
                <h4>برچسب ها</h4>  <a href="#">لورم اپیسوم</a>  <a href="#">سفرنامه</a>  <a href="#">سفر</a>  <a href="#">مسافرت</a>  <a href="#">کلمات لاتین</a>  <a href="#">مسافرت های خارجه</a>
            </div>
        </aside>
        <div class="col-md-9">
            <div class="box_style_1">
                <div class="post">
                    <a href="blog_post.php" title="blog_post.php">
                        <img src="img\blog-3.jpg" alt="" class="img-responsive">
                    </a>
                    <div class="post_info clearfix">
                        <div class="post-left">
                            <ul>
                                <li><i class="icon-calendar-empty"></i> تاریخ <span>۲ اردیبهشت ۱۳۹۶</span>
                                </li>
                                <li><i class="icon-inbox-alt"></i> که در <a href="#">تور های برتر</a>
                                </li>
                                <li><i class="icon-tags"></i> برچسب ها <a href="#">دنیا</a>, <a href="#">سفرنامه ها</a>
                                </li>
                            </ul>
                        </div>
                        <div class="post-right"><i class="icon-comment"></i><a href="#">۲۵ </a>
                        </div>
                    </div>
                    <h2>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم .</h2>
                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد.......</p>
                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد.......</p><a href="blog_post.php" class="btn_1" title="blog_post.php">ادامه مطلب</a>
                </div>
                <hr>
                <div class="post">
                    <a href="blog_post.php" title="blog_post.php">
                        <img src="img\blog-1.jpg" alt="" class="img-responsive">
                    </a>
                    <div class="post_info clearfix">
                        <div class="post-left">
                            <ul>
                                <li><i class="icon-calendar-empty"></i> تاریخ <span>۲ اردیبهشت ۱۳۹۶</span>
                                </li>
                                <li><i class="icon-inbox-alt"></i> که در <a href="#">تور های برتر</a>
                                </li>
                                <li><i class="icon-tags"></i> برچسب ها <a href="#">دنیا</a>, <a href="#">سفرنامه ها</a>
                                </li>
                            </ul>
                        </div>
                        <div class="post-right"><i class="icon-comment"></i><a href="#">۲۵ </a>نظرات</div>
                    </div>
                    <h2>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم .</h2>
                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد......</p><a href="blog_post.php" class=" btn_1">ادامه مطلب</a>
                </div>
                <hr>
                <div class="post">
                    <a href="blog_post.php" title="blog_post.php">
                        <img src="img\blog-2.jpg" alt="" class="img-responsive">
                    </a>
                    <div class="post_info clearfix">
                        <div class="post-left">
                            <ul>
                                <li><i class="icon-calendar-empty"></i> تاریخ <span>۲ اردیبهشت ۱۳۹۶</span>
                                </li>
                                <li><i class="icon-inbox-alt"></i> که در <a href="#">تور های برتر</a>
                                </li>
                                <li><i class="icon-tags"></i> برچسب ها <a href="#">دنیا</a>, <a href="#">سفرنامه ها</a>
                                </li>
                            </ul>
                        </div>
                        <div class="post-right"><i class="icon-comment"></i><a href="#">۲۵ </a>نظرات</div>
                    </div>
                    <h2>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم .</h2>
                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد......</p>
                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد.......</p><a href="blog_post.php" class="btn_1" title="blog_post.php">ادامه مطلب</a>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <ul class="pagination">
                    <li><a href="#">قبلی</a>
                    </li>
                    <li class="active"><a href="#">۱</a>
                    </li>
                    <li><a href="#">۲</a>
                    </li>
                    <li><a href="#">۳</a>
                    </li>
                    <li><a href="#">۴</a>
                    </li>
                    <li><a href="#">۵</a>
                    </li>
                    <li><a href="#">بعدی</a>
                    </li>
                </ul>
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