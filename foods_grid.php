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
    <link href="css\skins\square\grey.css" rel="stylesheet">
    <link href="css\ion.rangeSlider.css" rel="stylesheet">
    <link href="css\ion.rangeSlider.skinFlat.css" rel="stylesheet">
        
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
<section class="parallax-window" data-parallax="scroll" data-image-src="img/foods.jpg" data-natural-width="1400" data-natural-height="470">
    <div class="parallax-content-1">
        <div class="animated fadeInDown">
            <h1>لیست غذا های ما</h1>
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
        <aside class="col-lg-3 col-md-3">
            <p> <a class="btn_map" href="" aria-expanded="false" aria-controls="">دوباره سازی اطلاعات</a>
            </p>
            <div id="filters_col"> <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt"><i class="icon_set_1_icon-65"></i>فیلترها <i class="icon-plus-1 pull-right"></i></a>
                <div class="collapse in" id="collapseFilters">
                    <div class="filter_type">
                        <h6>قیمت</h6>
                        <input type="text" id="range" name="range" value="">
                    </div>
                    <div class="filter_type">
                        <h6>نمایش بر اساس رتبه</h6>
                        <ul>
                            <li>
                                <label>
                                    <input type="checkbox"><span class="rating"><i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81 voted"></i></span>(۱۵)</label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox"><span class="rating"><i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81"></i></span>(۴۵)</label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox"><span class="rating"><i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81"></i><i class="icon_set_1_icon-81"></i></span>(۳۵)</label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox"><span class="rating"><i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81"></i><i class="icon_set_1_icon-81"></i><i class="icon_set_1_icon-81"></i></span>(۲۵)</label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox"><span class="rating"><i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81"></i><i class="icon_set_1_icon-81"></i><i class="icon_set_1_icon-81"></i><i class="icon_set_1_icon-81"></i></span>(۱۵)</label>
                            </li>
                        </ul>
                    </div>
                    <div class="filter_type">
                        <h6>نمایش بر اساس امتیاز</h6>
                        <ul>
                            <li>
                                <label>
                                    <input type="checkbox">فوق العاده: ۹+ (۷۷)</label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox">خیلی خوب: ۸+ (۵۵۲)</label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox">خوب: ۷+ (۹۰۹)</label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox">مورد پسند: ۶+ (۱۱۹۶)</label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox">بدون رتبه (۱۹۸)</label>
                            </li>
                        </ul>
                    </div>
                    <div class="filter_type">
                        <h6>امکان</h6>
                        <ul>
                            <li>
                                <label>
                                    <input type="checkbox">مجاز بودن حیوانات خانگی</label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox">وای فای</label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox">آبگرم</label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox">رستوران</label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox">استخر</label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox">پارکینگ</label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox">مرکز تناسب اندام</label>
                            </li>
                        </ul>
                    </div>
                    <div class="filter_type">
                        <h6>ناحیه</h6>
                        <ul>
                            <li>
                                <label>
                                    <input type="checkbox">مرکز</label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox">جنوب</label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox">شمال</label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox">شرق/غرب</label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="box_style_2"> <i class="icon_set_1_icon-57"></i>
                <h4>درخواست <span>کمک؟</span></h4>  <a href="تلفن تماس://۰۷۶۳۲۰۰۰۰۰۰" class="تلفن">۰۷۶۳۲۰۰۰۰۰۰</a>  <small>شنبه تا پنجشنبه از ساعت ۰۷:۰۰ الی ۲۳:۰۰</small>
            </div>
        </aside>
        <div class="col-lg-9 col-md-8">
            <div id="tools">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="styled-select-filters">
                            <select name="sort_price" id="sort_price">
                                <option value="" selected="">بر اساس قیمت</option>
                                <option value="lower">پایین ترین قیمت</option>
                                <option value="higher">بالاترین قیمت</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="styled-select-filters">
                            <select name="sort_rating" id="sort_rating">
                                <option value="" selected="">بر اساس رتبه بندی</option>
                                <option value="lower">پایینترین رده</option>
                                <option value="higher">بالاترین رتبه</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 hidden-xs text-right"> <a href="#" class="bt_filters"><i class="icon-th"></i></a>  <a href="foods_list.php" class="bt_filters"><i class=" icon-list"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 wow zoomIn" data-wow-delay="0.1s">
                    <div class="hotel_container">
                        <div class="img_container">
                            <a href="#">
                                <img src="img\gemej.jpg" width="800" height="533" class="img-responsive" alt="">
                                <div class="score"><span>۷.۵</span>خوب</div>
                                <div class="short_info hotel">غذای محلی <span class="price"><sup>۸۰.۰۰۰ تومان</sup></span>
                                </div>
                            </a>
                        </div>
                        <div class="hotel_title">
                            <h3><strong> گمج کباب </strong></h3>
                            <div class="rating"> <i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star-empty"></i>
                            </div>
                            <ul class="add_info">
                                <li data-toggle="modal" data-target="#myModal"> <a href="javascript:void(0);" class="tooltip-1" data-placement="top" title="طرز تهیه"><i class="icon-question"></i></a>
                                </li>
                            </ul>
                            <div class="wishlist"> <a class="tooltip_flip tooltip-effect-1" href="#">+<span class="tooltip-content-flip"><span class="tooltip-back">علاقمند شدم</span></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">طرز تهیه گمج کباب </h4>
                                </div>
                                <div class="modal-body">
                                    <p>سبزی و پیاز را خرد کرده و به همراه مقداری زردچوبه داخل گمج ریخته و با شعله ملایم کمی تفت می‌دهیم. گوشت را به صورت تکه‌ای خرد کرده به همراه دانه‌های انار به مواد اضافه می‌کنیم و می‌گذاریم تا با شعله ملایم بپزد. در انتها نمک و فلفل را به آن اضافه می‌کنیم. پس از آنکه گوشت‌ها پخت و خورشت جا افتاد، آماده سرو می‌شود.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 wow zoomIn" data-wow-delay="0.2s">
                    <div class="hotel_container">
                        <div class="img_container">
                            <a href="#">
                                <img src="img\gemej.jpg" width="800" height="533" class="img-responsive" alt="">
                                <div class="score"><span>۷.۵</span>خوب</div>
                                <div class="short_info hotel">غذای محلی <span class="price"><sup>۸۰.۰۰۰ تومان</sup></span>
                                </div>
                            </a>
                        </div>
                        <div class="hotel_title">
                            <h3><strong> گمج کباب </strong></h3>
                            <div class="rating"> <i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star-empty"></i>
                            </div>
                            <ul class="add_info">
                                <li data-toggle="modal" data-target="#myModal"> <a href="javascript:void(0);" class="tooltip-1" data-placement="top" title="طرز تهیه"><i class="icon-question"></i></a>
                                </li>
                            </ul>
                            <div class="wishlist"> <a class="tooltip_flip tooltip-effect-1" href="#">+<span class="tooltip-content-flip"><span class="tooltip-back">علاقمند شدم</span></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">طرز تهیه گمج کباب </h4>
                                </div>
                                <div class="modal-body">
                                    <p>سبزی و پیاز را خرد کرده و به همراه مقداری زردچوبه داخل گمج ریخته و با شعله ملایم کمی تفت می‌دهیم. گوشت را به صورت تکه‌ای خرد کرده به همراه دانه‌های انار به مواد اضافه می‌کنیم و می‌گذاریم تا با شعله ملایم بپزد. در انتها نمک و فلفل را به آن اضافه می‌کنیم. پس از آنکه گوشت‌ها پخت و خورشت جا افتاد، آماده سرو می‌شود.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 wow zoomIn" data-wow-delay="0.5s">
                    <div class="hotel_container">
                        <div class="img_container">
                            <a href="#">
                                <img src="img\gemej.jpg" width="800" height="533" class="img-responsive" alt="">
                                <div class="score"><span>۷.۵</span>خوب</div>
                                <div class="short_info hotel">غذای محلی <span class="price"><sup>۸۰.۰۰۰ تومان</sup></span>
                                </div>
                            </a>
                        </div>
                        <div class="hotel_title">
                            <h3><strong> گمج کباب </strong></h3>
                            <div class="rating"> <i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star-empty"></i>
                            </div>
                            <ul class="add_info">
                                <li data-toggle="modal" data-target="#myModal"> <a href="javascript:void(0);" class="tooltip-1" data-placement="top" title="طرز تهیه"><i class="icon-question"></i></a>
                                </li>
                            </ul>
                            <div class="wishlist"> <a class="tooltip_flip tooltip-effect-1" href="#">+<span class="tooltip-content-flip"><span class="tooltip-back">علاقمند شدم</span></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">طرز تهیه گمج کباب </h4>
                                </div>
                                <div class="modal-body">
                                    <p>سبزی و پیاز را خرد کرده و به همراه مقداری زردچوبه داخل گمج ریخته و با شعله ملایم کمی تفت می‌دهیم. گوشت را به صورت تکه‌ای خرد کرده به همراه دانه‌های انار به مواد اضافه می‌کنیم و می‌گذاریم تا با شعله ملایم بپزد. در انتها نمک و فلفل را به آن اضافه می‌کنیم. پس از آنکه گوشت‌ها پخت و خورشت جا افتاد، آماده سرو می‌شود.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 wow zoomIn" data-wow-delay="0.6s">
                    <div class="hotel_container">
                        <div class="img_container">
                            <a href="#">
                                <img src="img\gemej.jpg" width="800" height="533" class="img-responsive" alt="">
                                <div class="score"><span>۷.۵</span>خوب</div>
                                <div class="short_info hotel">غذای محلی <span class="price"><sup>۸۰.۰۰۰ تومان</sup></span>
                                </div>
                            </a>
                        </div>
                        <div class="hotel_title">
                            <h3><strong> گمج کباب </strong></h3>
                            <div class="rating"> <i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star-empty"></i>
                            </div>
                            <ul class="add_info">
                                <li data-toggle="modal" data-target="#myModal"> <a href="javascript:void(0);" class="tooltip-1" data-placement="top" title="طرز تهیه"><i class="icon-question"></i></a>
                                </li>
                            </ul>
                            <div class="wishlist"> <a class="tooltip_flip tooltip-effect-1" href="#">+<span class="tooltip-content-flip"><span class="tooltip-back">علاقمند شدم</span></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">طرز تهیه گمج کباب </h4>
                                </div>
                                <div class="modal-body">
                                    <p>سبزی و پیاز را خرد کرده و به همراه مقداری زردچوبه داخل گمج ریخته و با شعله ملایم کمی تفت می‌دهیم. گوشت را به صورت تکه‌ای خرد کرده به همراه دانه‌های انار به مواد اضافه می‌کنیم و می‌گذاریم تا با شعله ملایم بپزد. در انتها نمک و فلفل را به آن اضافه می‌کنیم. پس از آنکه گوشت‌ها پخت و خورشت جا افتاد، آماده سرو می‌شود.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 wow zoomIn" data-wow-delay="0.7s">
                    <div class="hotel_container">
                        <div class="img_container">
                            <a href="#">
                                <img src="img\gemej.jpg" width="800" height="533" class="img-responsive" alt="">
                                <div class="score"><span>۷.۵</span>خوب</div>
                                <div class="short_info hotel">غذای محلی <span class="price"><sup>۸۰.۰۰۰ تومان</sup></span>
                                </div>
                            </a>
                        </div>
                        <div class="hotel_title">
                            <h3><strong> گمج کباب </strong></h3>
                            <div class="rating"> <i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star-empty"></i>
                            </div>
                            <ul class="add_info">
                                <li data-toggle="modal" data-target="#myModal"> <a href="javascript:void(0);" class="tooltip-1" data-placement="top" title="طرز تهیه"><i class="icon-question"></i></a>
                                </li>
                            </ul>
                            <div class="wishlist"> <a class="tooltip_flip tooltip-effect-1" href="#">+<span class="tooltip-content-flip"><span class="tooltip-back">علاقمند شدم</span></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">طرز تهیه گمج کباب </h4>
                                </div>
                                <div class="modal-body">
                                    <p>سبزی و پیاز را خرد کرده و به همراه مقداری زردچوبه داخل گمج ریخته و با شعله ملایم کمی تفت می‌دهیم. گوشت را به صورت تکه‌ای خرد کرده به همراه دانه‌های انار به مواد اضافه می‌کنیم و می‌گذاریم تا با شعله ملایم بپزد. در انتها نمک و فلفل را به آن اضافه می‌کنیم. پس از آنکه گوشت‌ها پخت و خورشت جا افتاد، آماده سرو می‌شود.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 wow zoomIn" data-wow-delay="0.8s">
                    <div class="hotel_container">
                        <div class="img_container">
                            <a href="#">
                                <img src="img\gemej.jpg" width="800" height="533" class="img-responsive" alt="">
                                <div class="score"><span>۷.۵</span>خوب</div>
                                <div class="short_info hotel">غذای محلی <span class="price"><sup>۸۰.۰۰۰ تومان</sup></span>
                                </div>
                            </a>
                        </div>
                        <div class="hotel_title">
                            <h3><strong> گمج کباب </strong></h3>
                            <div class="rating"> <i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star-empty"></i>
                            </div>
                            <ul class="add_info">
                                <li data-toggle="modal" data-target="#myModal"> <a href="javascript:void(0);" class="tooltip-1" data-placement="top" title="طرز تهیه"><i class="icon-question"></i></a>
                                </li>
                            </ul>
                            <div class="wishlist"> <a class="tooltip_flip tooltip-effect-1" href="#">+<span class="tooltip-content-flip"><span class="tooltip-back">علاقمند شدم</span></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">طرز تهیه گمج کباب </h4>
                                </div>
                                <div class="modal-body">
                                    <p>سبزی و پیاز را خرد کرده و به همراه مقداری زردچوبه داخل گمج ریخته و با شعله ملایم کمی تفت می‌دهیم. گوشت را به صورت تکه‌ای خرد کرده به همراه دانه‌های انار به مواد اضافه می‌کنیم و می‌گذاریم تا با شعله ملایم بپزد. در انتها نمک و فلفل را به آن اضافه می‌کنیم. پس از آنکه گوشت‌ها پخت و خورشت جا افتاد، آماده سرو می‌شود.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
<script src="js\icheck.js"></script>
<script>
    $('input').iCheck({checkboxClass: 'icheckbox_square-grey', radioClass: 'iradio_square-grey'});
</script>
</body>
</html>