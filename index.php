<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تی شین</title>

    <link rel="shortcut icon" href="#" type="image/x-icon">
    <link href="css\base.css" rel="stylesheet">
    <link href="rs-plugin\css\settings.css" rel="stylesheet">

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
    global $sessions,$Functions;
    if ($sessions->login_state()){
        include("includes/logged_in_header.php");
    }else{
        include("includes/header.php");
    }
?>
<div class="tp-banner-container">
    <div class="tp-banner">
        <ul>
            <li data-transition="fade" data-slotamount="7" data-masterspeed="500" data-saveperformance="on" data-title="Intro Slide">
                <img src="img\slides_bg\dummy.png" alt="slidebg1" data-lazyload="img/slides_bg/slide_1.jpg" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                <div class="tp-caption white_heavy_40 customin customout text-center text-uppercase" data-x="center" data-y="center" data-hoffset="0" data-voffset="-20" data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-speed="1000" data-start="1700" data-easing="Back.easeInOut" data-endspeed="300" style="z-index: 5; max-width: auto; max-height: auto; white-space: nowrap;">
                    <h1 style="color: white"> اقامتگاه بومگردی تی شین</h1>
                </div>
                <div class="tp-caption customin tp-resizeme rs-parallaxlevel-0 text-center" data-x="center" data-y="center" data-hoffset="0" data-voffset="15" data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-speed="500" data-start="2600" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.05" data-endelementdelay="0.1" style="z-index: 9; max-width: auto; max-height: auto; white-space: nowrap;">
                    <div style="color:#ffffff; font-size:16px; text-transform:uppercase">شهرهای گردشگری / تور / راهنمای تور</div>
                </div>
                <div class="tp-caption customin tp-resizeme rs-parallaxlevel-0" data-x="center" data-y="center" data-hoffset="0" data-voffset="70" data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-speed="500" data-start="2900" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-linktoslide="next" style="z-index: 12;"><a href='all_tour_list.php' class="button_intro">نمایش </a>  <a href='Room.php' class=" button_intro outline">ادامه مطلب</a>
                </div>
            </li>
            <li data-transition="fade" data-slotamount="7" data-masterspeed="500" data-saveperformance="on" data-title="Intro Slide">
                <img src="img\slides_bg\dummy.png" alt="slidebg1" data-lazyload="img/slides_bg/slide_2.jpg" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                <div class="tp-caption white_heavy_40 customin customout text-center text-uppercase" data-x="center" data-y="center" data-hoffset="0" data-voffset="-20" data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-speed="1000" data-start="1700" data-easing="Back.easeInOut" data-endspeed="300" style="z-index: 5; max-width: auto; max-height: auto; white-space: nowrap;">
                    <h1 style="color:white;"> بندرانزلی، استان گیلان </h1>
                </div>
                <div class="tp-caption customin tp-resizeme rs-parallaxlevel-0 text-center" data-x="center" data-y="center" data-hoffset="0" data-voffset="15" data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-speed="500" data-start="2600" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.05" data-endelementdelay="0.1" style="z-index: 9; max-width: auto; max-height: auto; white-space: nowrap;">
                    <div style="color:#ffffff; font-size:16px; text-transform:uppercase">ابنیه تاریخی / تور گردی / راهنمای موزه ها</div>
                </div>
                <div class="tp-caption customin tp-resizeme rs-parallaxlevel-0" data-x="center" data-y="center" data-hoffset="0" data-voffset="70" data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-speed="500" data-start="2900" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-linktoslide="next" style="z-index: 12;"><a href='all_tour_list.php' class="button_intro">نمایش </a>  <a href='Room.php' class=" button_intro outline">ادامه مطلب</a>
                </div>
            </li>
            <li data-transition="fade" data-slotamount="7" data-masterspeed="500" data-saveperformance="on" data-title="Intro Slide">
                <img src="img\slides_bg\dummy.png" alt="slidebg1" data-lazyload="img/slides_bg/slide_3.jpg" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                <div class="tp-caption white_heavy_40 customin customout text-center text-uppercase" data-x="center" data-y="center" data-hoffset="0" data-voffset="-20" data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-speed="1000" data-start="1700" data-easing="Back.easeInOut" data-endspeed="300" style="z-index: 5; max-width: auto; max-height: auto; white-space: nowrap;">
                    <h1 style="color: white"> گردشگری روستایی درحوالی دریای خزر </h1>
                </div>
                <div class="tp-caption customin tp-resizeme rs-parallaxlevel-0 text-center" data-x="center" data-y="center" data-hoffset="0" data-voffset="15" data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-speed="500" data-start="2600" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.05" data-endelementdelay="0.1" style="z-index: 9; max-width: auto; max-height: auto; white-space: nowrap;">
                    <div style="color:#ffffff; font-size:16px; text-transform:uppercase">ارائه انواع خدمات</div>
                </div>
                <div class="tp-caption customin tp-resizeme rs-parallaxlevel-0" data-x="center" data-y="center" data-hoffset="0" data-voffset="70" data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-speed="500" data-start="2900" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-linktoslide="next" style="z-index: 12;"><a href='all_tour_list.php' class="button_intro">نمایش تورها</a>  <a href='Room.php' class=" button_intro outline">ادامه مطلب</a>
                </div>
            </li>
        </ul>
        <div class="tp-bannertimer tp-bottom"></div>
    </div>
</div>
<div class="container margin_60">
    <div class="main_title">
        <h2>اقاممتگاه های <span>برتر</span> تی شین </h2>
        <p>اولین اقامتگاه بوم گردی گیلان در منطقه آزاد انزلی</p>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.1s">
            <div class="tour_container">
                <div class="img_container">
                    <a href="Room.php">
                        <img src="img\tour_box_1.jpg" class="img-responsive" alt="">
                        <div class="ribbon top_rated"></div>
                        <div class="short_info"> <i class="icon_set_1_icon-44"></i>اقامتگاه <span class="price"><sup>۶۰.۰۰۰ تومان</sup></span>
                        </div>
                    </a>
                </div>
                <div class="tour_title">
                    <h3><strong>اقامتگاه</strong> قدیمی گیلان</h3>
                    <div class="rating"> <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i>
                    </div>
                    <div class="wishlist"> <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">علاقه مند شدم</span></span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.2s">
            <div class="tour_container">
                <div class="img_container">
                    <a href="Room.php">
                        <img src="img\tour_box_1.jpg" width="800" height="533" class="img-responsive" alt="">
                        <div class="ribbon top_rated"></div>
                        <div class="short_info"> <i class="icon_set_1_icon-44"></i>اقامتگاه <span class="price"><sup>۶۰.۰۰۰ تومان</sup></span>
                        </div>
                    </a>
                </div>
                <div class="tour_title">
                    <h3><strong>اقامتگاه</strong> قدیمی گیلان</h3>
                    <div class="rating"> <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i>
                    </div>
                    <div class="wishlist"> <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">علاقه مند شدم</span></span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.3s">
            <div class="tour_container">
                <div class="img_container">
                    <a href="Room.php">
                        <img src="img\tour_box_1.jpg" width="800" height="533" class="img-responsive" alt="">
                        <div class="ribbon top_rated"></div>
                        <div class="short_info"> <i class="icon_set_1_icon-44"></i>اقامتگاه <span class="price"><sup>۶۰.۰۰۰ تومان</sup></span>
                        </div>
                    </a>
                </div>
                <div class="tour_title">
                    <h3><strong>اقامتگاه</strong> قدیمی گیلان</h3>
                    <div class="rating"> <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i>
                    </div>
                    <div class="wishlist"> <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">علاقه مند شدم</span></span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.4s">
            <div class="tour_container">
                <div class="img_container">
                    <a href="Room.php">
                        <img src="img\tour_box_1.jpg" width="800" height="533" class="img-responsive" alt="">
                        <div class="ribbon top_rated"></div>
                        <div class="short_info"> <i class="icon_set_1_icon-44"></i>اقامتگاه <span class="price"><sup>۶۰.۰۰۰ تومان</sup></span>
                        </div>
                    </a>
                </div>
                <div class="tour_title">
                    <h3><strong>اقامتگاه</strong> قدیمی گیلان</h3>
                    <div class="rating"> <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i>
                    </div>
                    <div class="wishlist"> <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">علاقه مند شدم</span></span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.5s">
            <div class="tour_container">
                <div class="img_container">
                    <a href="Room.php">
                        <img src="img\tour_box_1.jpg" width="800" height="533" class="img-responsive" alt="">
                        <div class="ribbon top_rated"></div>
                        <div class="short_info"> <i class="icon_set_1_icon-44"></i>اقامتگاه <span class="price"><sup>۶۰.۰۰۰ تومان</sup></span>
                        </div>
                    </a>
                </div>
                <div class="tour_title">
                    <h3><strong>اقامتگاه</strong> قدیمی گیلان</h3>
                    <div class="rating"> <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i>
                    </div>
                    <div class="wishlist"> <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">علاقه مند شدم</span></span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.6s">
            <div class="tour_container">
                <div class="img_container">
                    <a href="Room.php">
                        <img src="img\tour_box_1.jpg" width="800" height="533" class="img-responsive" alt="">
                        <div class="ribbon top_rated"></div>
                        <div class="short_info"> <i class="icon_set_1_icon-44"></i>اقامتگاه <span class="price"><sup>۶۰.۰۰۰ تومان</sup></span>
                        </div>
                    </a>
                </div>
                <div class="tour_title">
                    <h3><strong>اقامتگاه</strong> قدیمی گیلان</h3>
                    <div class="rating"> <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i>
                    </div>
                    <div class="wishlist"> <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">علاقه مند شدم</span></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p class="text-center add_bottom_30"> <a href="all_hotels_list.php" class="btn_1 medium"><i class="icon-eye-7"></i>مشاهده همه اقامتگاه ها</a>
    </p>
    <hr>
    <div class="main_title">
        <h2><span>اتاق های </span> ما</h2>
        <p>اولین اقامتگاه بوم گردی گیلان در منطقه آزاد انزلی</p>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.1s">
            <div class="hotel_container">
                <div class="img_container">
                    <a href="Room.php">
                        <img src="img\hotel_1.jpg" width="800" height="533" class="img-responsive" alt="">
                        <div class="ribbon top_rated"></div>
                        <div class="score"><span>4.۵</span>خوب</div>
                        <div class="short_info hotel">اتاق ۲ نفره<span class="price"><sup>۴۲.۰۰۰ تومان</sup></span>
                        </div>
                    </a>
                </div>
                <div class="hotel_title">
                    <h3><strong> طبقه اول خانه </strong>شکیلی</h3>
                    <div class="rating"> <i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star-empty"></i>
                    </div>
                    <div class="wishlist"> <a class="tooltip_flip tooltip-effect-1" href="#">+<span class="tooltip-content-flip"><span class="tooltip-back">علاقمند شدم</span></span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.2s">
            <div class="hotel_container">
                <div class="img_container">
                    <a href="Room.php">
                        <img src="img\hotel_1.jpg" width="800" height="533" class="img-responsive" alt="">
                        <div class="ribbon top_rated"></div>
                        <div class="score"><span>4.۵</span>خوب</div>
                        <div class="short_info hotel">اتاق ۲ نفره<span class="price"><sup>۴۲.۰۰۰ تومان</sup></span>
                        </div>
                    </a>
                </div>
                <div class="hotel_title">
                    <h3><strong> طبقه اول خانه </strong>شکیلی</h3>
                    <div class="rating"> <i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star-empty"></i>
                    </div>
                    <div class="wishlist"> <a class="tooltip_flip tooltip-effect-1" href="#">+<span class="tooltip-content-flip"><span class="tooltip-back">علاقمند شدم</span></span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.3s">
            <div class="hotel_container">
                <div class="img_container">
                    <a href="Room.php">
                        <img src="img\hotel_1.jpg" width="800" height="533" class="img-responsive" alt="">
                        <div class="ribbon top_rated"></div>
                        <div class="score"><span>4.۵</span>خوب</div>
                        <div class="short_info hotel">اتاق ۲ نفره<span class="price"><sup>۴۲.۰۰۰ تومان</sup></span>
                        </div>
                    </a>
                </div>
                <div class="hotel_title">
                    <h3><strong> طبقه اول خانه </strong>شکیلی</h3>
                    <div class="rating"> <i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star-empty"></i>
                    </div>
                    <div class="wishlist"> <a class="tooltip_flip tooltip-effect-1" href="#">+<span class="tooltip-content-flip"><span class="tooltip-back">علاقمند شدم</span></span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.4s">
            <div class="hotel_container">
                <div class="img_container">
                    <a href="Room.php">
                        <img src="img\hotel_1.jpg" width="800" height="533" class="img-responsive" alt="">
                        <div class="ribbon top_rated"></div>
                        <div class="score"><span>4.۵</span>خوب</div>
                        <div class="short_info hotel">اتاق ۲ نفره<span class="price"><sup>۴۲.۰۰۰ تومان</sup></span>
                        </div>
                    </a>
                </div>
                <div class="hotel_title">
                    <h3><strong> طبقه اول خانه </strong>شکیلی</h3>
                    <div class="rating"> <i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star-empty"></i>
                    </div>
                    <div class="wishlist"> <a class="tooltip_flip tooltip-effect-1" href="#">+<span class="tooltip-content-flip"><span class="tooltip-back">علاقمند شدم</span></span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.5s">
            <div class="hotel_container">
                <div class="img_container">
                    <a href="Room.php">
                        <img src="img\hotel_1.jpg" width="800" height="533" class="img-responsive" alt="">
                        <div class="ribbon top_rated"></div>
                        <div class="score"><span>4.۵</span>خوب</div>
                        <div class="short_info hotel">اتاق ۲ نفره<span class="price"><sup>۴۲.۰۰۰ تومان</sup></span>
                        </div>
                    </a>
                </div>
                <div class="hotel_title">
                    <h3><strong> طبقه اول خانه </strong>شکیلی</h3>
                    <div class="rating"> <i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star-empty"></i>
                    </div>
                    <div class="wishlist"> <a class="tooltip_flip tooltip-effect-1" href="#">+<span class="tooltip-content-flip"><span class="tooltip-back">علاقمند شدم</span></span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.6s">
            <div class="hotel_container">
                <div class="img_container">
                    <a href="Room.php">
                        <img src="img\hotel_1.jpg" width="800" height="533" class="img-responsive" alt="">
                        <div class="ribbon top_rated"></div>
                        <div class="score"><span>4.۵</span>خوب</div>
                        <div class="short_info hotel">اتاق ۲ نفره<span class="price"><sup>۴۲.۰۰۰ تومان</sup></span>
                        </div>
                    </a>
                </div>
                <div class="hotel_title">
                    <h3><strong> طبقه اول خانه </strong>شکیلی</h3>
                    <div class="rating"> <i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star-empty"></i>
                    </div>
                    <div class="wishlist"> <a class="tooltip_flip tooltip-effect-1" href="#">+<span class="tooltip-content-flip"><span class="tooltip-back">علاقمند شدم</span></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p class="text-center nopadding"> <a href="all_hotels_list.php" class="btn_1 medium"><i class="icon-eye-7"></i>مشاهده همه هتل ها</a>
    </p>
</div>
<div class="white_bg">
    <div class="container margin_60">
        <div class="main_title">
            <h2>امکانات های <span>محبوب</span> دیگر</h2>
            <p>اولین اقامتگاه بوم گردی گیلان در منطقه آزاد انزلی</p>
        </div>
        <div class="row add_bottom_45">
            <div class="col-md-4 other_tours">
                <ul>
                    <li><a href="#"><i class="icon_set_1_icon-3"></i>صنایع دستی<span class="other_tours_price">۵۰.۰۰۰ تومان</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-30"></i>نشه محل ها<span class="other_tours_price">۳۰.۰۰۰ تومان</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-44"></i>اتاق ها<span class="other_tours_price">۶۰.۰۰۰ تومان</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-3"></i>اقامتگاه ها<span class="other_tours_price">۶۰.۰۰۰ تومان</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-44"></i>غذا ها<span class="other_tours_price">۹۰.۰۰۰ تومان</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-3"></i>جاذبه ها<span class="other_tours_price">۴۵.۰۰۰ تومان</span></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4 other_tours">
                <ul>
                    <li><a href="#"><i class="icon_set_1_icon-3"></i>صنایع دستی<span class="other_tours_price">۵۰.۰۰۰ تومان</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-30"></i>نشه محل ها<span class="other_tours_price">۳۰.۰۰۰ تومان</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-44"></i>اتاق ها<span class="other_tours_price">۶۰.۰۰۰ تومان</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-3"></i>اقامتگاه ها<span class="other_tours_price">۶۰.۰۰۰ تومان</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-44"></i>غذا ها<span class="other_tours_price">۹۰.۰۰۰ تومان</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-3"></i>جاذبه ها<span class="other_tours_price">۴۵.۰۰۰ تومان</span></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4 other_tours">
                <ul>
                    <li><a href="#"><i class="icon_set_1_icon-3"></i>صنایع دستی<span class="other_tours_price">۵۰.۰۰۰ تومان</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-30"></i>نشه محل ها<span class="other_tours_price">۳۰.۰۰۰ تومان</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-44"></i>اتاق ها<span class="other_tours_price">۶۰.۰۰۰ تومان</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-3"></i>اقامتگاه ها<span class="other_tours_price">۶۰.۰۰۰ تومان</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-44"></i>غذا ها<span class="other_tours_price">۹۰.۰۰۰ تومان</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-3"></i>جاذبه ها<span class="other_tours_price">۴۵.۰۰۰ تومان</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="banner colored">
            <h4>دیدن اقامتگا های ما <span></span></h4>
            <p>در آلاچیق‌های چوبی تی شین، آماده پذیرایی از مهمانان گرامی اقامتگاه با انواع مخلفات و غذاهای محلی گیلان هستیم.</p><a href="Room.php" class="btn_1 white">مشاهده همه</a>
        </div>
    </div>
</div>
<section class="promo_full">
    <div class="promo_full_wp magnific">
        <div>
            <h3>متعلق به تمامی نقاط</h3>
            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p><a href="https://www.aparat.com/video/video/embed/videohash/SqDig/vt/frame" class="video"><i class="icon-play-circled2-1"></i></a>
        </div>
    </div>
</section>
<div class="container margin_60">
    <div class="main_title">
        <h2>چرا اقامتگاه <span>تی شین ؟</span></h2>
        <p>اولین اقامتگاه بوم گردی گیلان در منطقه آزاد انزلی</p>
    </div>
    <div class="row">
        <div class="col-md-4 wow zoomIn" data-wow-delay="0.2s">
            <div class="feature_home"> <i class="icon_set_1_icon-41"></i>
                <h3><span>اسکله </span>بوم گردی تی شین</h3>
                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p><a href="about.php" class="btn_1 outline">ادامه مطلب</a>
            </div>
        </div>
        <div class="col-md-4 wow zoomIn" data-wow-delay="0.4s">
            <div class="feature_home"> <i class="icon_set_1_icon-30"></i>
                <h3><span>بیش از ۱۰۰۰</span> مشتری</h3>
                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p><a href="about.php" class="btn_1 outline">ادامه مطلب</a>
            </div>
        </div>
        <div class="col-md-4 wow zoomIn" data-wow-delay="0.6s">
            <div class="feature_home"> <i class="icon_set_1_icon-57"></i>
                <h3><span>پشتیبانی </span> ۲۴ ساعته</h3>
                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p><a href="about.php" class="btn_1 outline">ادامه مطلب</a>
            </div>
        </div>
    </div>
    <hr>
</div>

<?php include("includes/footer.php"); ?>
<script src="js\jquery-1.11.2.min.js"></script>
<script src="js\common_scripts_min.js"></script>
<script src="js\functions.js"></script>
<script src="rs-plugin\js\jquery.themepunch.tools.min.js"></script>
<script src="rs-plugin\js\jquery.themepunch.revolution.min.js"></script>
<script src="js\revolution_func.js"></script>
</body>

</html>