<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تی شین</title>
    <link rel="shortcut icon" href="img\favicon.ico" type="image/x-icon">

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
    $sessions->null_room_id_while_comment();
?>
<div class="room_error_message">
    <span id="room_error_message_inside">
            <?php
                if (!empty($_SESSION["errors_message"]) && isset($_SESSION["errors_message"])){
                    echo $users->Errors();
                }
            ?>
    </span>
</div>
<section class="parallax-window" data-parallax="scroll" data-image-src="img/hotels_bg.jpg" data-natural-width="1400" data-natural-height="470">
    <div class="parallax-content-1">
        <div class="animated fadeInDown">
            <h1>لیست اتاق های ما </h1>
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
            <p> <a class="btn_map" d href="" aria-expanded="false" aria-controls="collapseMap">دوباره سازی اطلاعات</a>
            </p>
            <div id="filters_col"> <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt"><i class="icon_set_1_icon-65"></i>فیلترها <i class="icon-plus-1 pull-right"></i></a>
                <div class="collapse" id="collapseFilters">
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
        <div class="col-lg-9 col-md-9">
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
                    <div class="col-md-6 col-sm-6 hidden-xs text-right"> <a href="all_hotels_grid.php" class="bt_filters"><i class="icon-th"></i></a>  <a href="#" class="bt_filters"><i class=" icon-list"></i></a>
                    </div>
                </div>
            </div>
            <?php
                $rooms->AllRooms();
            ?>

            <hr>
            <!--<div class="text-center">
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
            </div>-->
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