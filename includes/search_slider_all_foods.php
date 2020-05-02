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
        <form method="post" action="<?php echo(htmlspecialchars($_SERVER['PHP_SELF'])); ?>">
            <aside class="col-lg-3 col-md-3">
                <p> <input class="btn_map" aria-expanded="false" type="submit" name="user_show_by_all_hotels_food" aria-controls="collapseMap" value="اعمال فیلتر" />
                </p>
                <div id="filters_col"> <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt"><i class="icon_set_1_icon-65"></i>فیلترها <i class="icon-plus-1 pull-right"></i></a>
                    <div class="collapse" id="collapseFilters">
                        <div class="filter_type">
                            <h6>قیمت</h6>
                            <input type="text" id="price_range_food" name="user_price_range_food" value="">
                        </div>
                        <div class="filter_type">
                            <h6>نمایش بر اساس رتبه</h6>
                            <ul>
                                <li>
                                    <label>
                                        <input name="user_star_score_food" value="5" type="radio" /><span class="rating"><i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81 voted"></i></span>(۵)</label>
                                </li>
                                <li>
                                    <label>
                                        <input name="user_star_score_food" value="4" type="radio" /><span class="rating"><i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81"></i></span>(۴)</label>
                                </li>
                                <li>
                                    <label>
                                        <input name="user_star_score_food" value="3" type="radio" /><span class="rating"><i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81"></i><i class="icon_set_1_icon-81"></i></span>(۳)</label>
                                </li>
                                <li>
                                    <label>
                                        <input name="user_star_score_food" value="2" type="radio" /><span class="rating"><i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81"></i><i class="icon_set_1_icon-81"></i><i class="icon_set_1_icon-81"></i></span>(۲)</label>
                                </li>
                                <li>
                                    <label>
                                        <input name="user_star_score_food" value="1" type="radio" /><span class="rating"><i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81"></i><i class="icon_set_1_icon-81"></i><i class="icon_set_1_icon-81"></i><i class="icon_set_1_icon-81"></i></span>(۱)</label>
                                </li>
                            </ul>
                        </div>
                        <p> <input class="btn_map" aria-expanded="false" type="submit" name="user_show_by_all_hotels_food" aria-controls="collapseMap" value="اعمال فیلتر" />
                    </div>
                </div>
                <div class="box_style_2"> <i class="icon_set_1_icon-57"></i>
                    <h4>درخواست <span>کمک؟</span></h4>  <a href="تلفن تماس://۰۷۶۳۲۰۰۰۰۰۰" class="تلفن">۰۷۶۳۲۰۰۰۰۰۰</a>  <small>شنبه تا پنجشنبه از ساعت ۰۷:۰۰ الی ۲۳:۰۰</small>
                </div>
            </aside>
            <div class="col-lg-9 col-md-9">
                <div id="tools">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="styled-select-filters">
                                <select name="user_sort_price_food" id="sort_price">
                                    <option value="" selected="">بر اساس قیمت</option>
                                    <option id="lower_price" class="icon-down" value="lower">پایین ترین قیمت</option>
                                    <option id="higher_price" class="icon-up" value="higher">بالاترین قیمت</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="styled-select-filters">
                                <select name="user_sort_rating_food" id="sort_rating">
                                    <option value="" selected="">بر اساس رتبه بندی</option>
                                    <option id="lower_rate" class="icon-down" value="lower">پایین ترین رتبه</option>
                                    <option id="higher_rate" class="icon-up" value="higher">بالاترین رتبه</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12 text-center"> <a href="foods_grid.php" class="bt_filters"><i class="icon-th"></i></a>  <a href="foods_list.php" class="bt_filters"><i class=" icon-list"></i></a></div>
        </form>
        <form method="post" action="<?php echo (htmlspecialchars($_SERVER['PHP_SELF'])); ?>">
            <div class="room_search_bar col-md-4 col-xs-12 col-sm-4 col-lg-4">
                <select name="user_ByWitch_food" id="search-by-witch-users" class="search-by-witch">
                    <option>بر اساس</option>
                    <option value="Title">نام غذا</option>
                    <option value="Descript">توضیحات</option>
                </select>
                <input type="text" class="users-keyword" name="user_keyword_food" />
                <span id="users-search-icon" class="icon-search-5"></span>
                <input type="submit"  value="Search" class="users-submit-search" id="submit_search" name="user_submit_search_food" />
            </div>
        </form>
    </div>
</div>