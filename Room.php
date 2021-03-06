﻿<!DOCTYPE html>
<html dir='rtl'>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>تی شین</title>

    <link rel='shortcut icon' href='#' type='image/x-icon'>
    <!-- CSS -->
    <link href='css/base.css' rel='stylesheet'>
    <link rel="stylesheet" href="datapicker/src/jquery.md.bootstrap.datetimepicker.style.css" />
    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/common_scripts_min.js"></script>
    <script src="js/functions.js"></script>
    <script src="js/signUp.js"></script>
</head>
<body>
<div id='preloader'>
    <div class='sk-spinner sk-spinner-wave'>
        <div class='sk-rect1'></div>
        <div class='sk-rect2'></div>
        <div class='sk-rect3'></div>
        <div class='sk-rect4'></div>
        <div class='sk-rect5'></div>
    </div>
</div>
<div class='layer'></div>
<?php
require_once('classes/initialize.php');
global $sessions,$users,$rooms,$Functions;

// this is for include header
if ($sessions->login_state()){
    include('includes/logged_in_header.php');
}else{
    include('includes/header.php');
}
//this is for show room details
if (isset($_GET['roomId']) && !(empty($_GET["roomId"])) || isset($_POST['room_id']) && !(empty($_POST['room_id']))) {
    global $users;
    //////////////////////////////////////////
    if (isset($_POST['room_id']) && !(empty($_POST['room_id']))){
        $room_id = $database->escape_value($_POST['room_id']);
    }
    if (isset($_GET['roomId']) && !(empty($_GET["roomId"]))){
        $room_id = $database->escape_value($_GET['roomId']);
    }
    settype($room_id,"integer");
    // This condition for while id is just number
    if(!(preg_match("/^[0-9]*$/",$Functions->decrypt_id($room_id)))){
        $users->redirect_to("RoomsList.php");
    }
    /////////////////////////////////////////

    $room_result = Rooms::RoomAttributeById($room_id,true);
    if ($database->num_rows($room_result) == 0){
        $users->redirect_to("RoomsList.php");
    }else{
    $roomattribute = $database->fetch_array($room_result);
    if ($roomattribute) {
        ?>
        <script type="text/javascript">
            var room_objects = {
                "room_person_count": <?php echo $roomattribute['room_person_count']; ?>,
                "reservation_date" : function () {
                    $('#inputDate3-1').change(function () {
                        return $("#inputDate3-1").val();
                    });
                }
            };
            var room_json_data =  room_objects/*JSON.stringify(room_objects)*/;
        </script>
        <?php
        echo("
                <section class='parallax-window' data-parallax='scroll' data-image-src='");
        $rooms->select_single_hotel_image($roomattribute['room_image']);
        echo("' data-natural-width='1400' data-natural-height='470'>
    <div class='parallax-content-2'>
        <div class='container'>
            <div class='row'>
                <div class='col-md-8 col-sm-8'> 
                    <span class='rating'>
                    ");
        echo($Functions->give_start_by_number($roomattribute['room_score']));
        echo("
                    </span>
                    <h4 class='room_title'>{$roomattribute['room_title']}</h4>  <span>");
        if ($roomattribute['room_person_count'] != 0) {
            echo "ظرفیت {$Functions->EN_numTo_FA($roomattribute['room_person_count'],true)} نفر";
        }
        echo("</span>
                </div>
                <div class='col-md-4 col-sm-4'>
                <p class='room_address_single_hotel'>{$database->escape_value($roomattribute['room_address'])}</p>
                    <div id='price_single_main' class='hotel'>از / هر شب <span><sup>{$Functions->EN_numTo_FA($Functions->insert_seperator($roomattribute['room_main_price']),true)} تومان</sup></span>
                    </div>
                    <span class='normal_price_in'>{$Functions->EN_numTo_FA($Functions->insert_seperator($roomattribute['room_off_price']),true)} تومان</span>
                   
                </div>
            </div>
        </div>
    </div>
</section>
<div id='position'>
    <div class='container'>
        <ul>
            <li><a href=''#'>صفحه اصلی</a>
            </li>
            <li><a href=''#'>اقامتگاه ها </a>
            </li>
            <li>اقمتکاه جورخانه</li>
        </ul>
    </div>
</div>
<div class='collapse' id='collapseMap'></div>
<div class='container margin_60'>
    <div class='row'>
        <div class='col-md-8' id='single_tour_desc'>
            <div id='single_tour_feat'>
                <ul>
                    <li><i id='in_room_checkbox' class='icon_set_2_icon-116 "); if ($roomattribute["room_television"] == 1) echo "rooms_checkbox'"; echo("'></i>تلویزیون</li>
                    <li><i id='in_room_checkbox' class='icon_set_1_icon-86  "); if ($roomattribute["room_wifi"] == 1) echo "rooms_checkbox'"; echo("'></i>وای فای رایگان</li>
                    <li><i id='in_room_checkbox' class='icon_set_2_icon-110  "); if ($roomattribute["room_pool"] == 1) echo "rooms_checkbox'"; echo("'></i>استخر</li>
                    <li><i id='in_room_checkbox' class='icon_set_2_icon-117  "); if ($roomattribute["room_gym"] == 1) echo "rooms_checkbox'"; echo("'></i>باشگاه یا لوازم ورزشی</li>
                    <li><i id='in_room_checkbox' class='icon-food-1  "); if ($roomattribute["room_food"] == 1) echo "rooms_checkbox'"; echo("'></i>صبحانه</li>
                    <li><i id='in_room_checkbox' class='icon_set_1_icon-27  "); if ($roomattribute["room_parking"] == 1) echo "rooms_checkbox'"; echo("'></i>پارکینگ اختصاصی</li>
                </ul>
            </div>
            <p class='visible-sm visible-xs'><a class='btn_map' data-toggle='collapse' href=''#collapseMap' aria-expanded='false' aria-controls='collapseMap'>مشاهده نقشه</a>
            </p>
            <div class='images slider'>image slider</div>
            <hr>
            <div class='row' style='background-color: white;box-shadow: 0 1px 6px 0 rgba(0,0,0,.1)'>
                <div class='col-md-3'>
                    <h3>شرح</h3>
                </div>
                <div class='col-md-9'>
                    <div class='row'>
                        <div class='col-md-6 col-sm-6'>
                            <ul class='list_ok'><hr />");
        if ($roomattribute["room_food"] == 1)
            echo "<li>غدا</li>";
        if ($roomattribute["room_gym"] == 1)
            echo "<li>باشگاه یا لوازم ورزشی</li>";
        if ($roomattribute["room_pool"] == 1)
            echo "<li>استخر</li>";
        if ($roomattribute["room_television"] == 1)
            echo "<li>تلویزیون</li>";
        if ($roomattribute["room_wifi"] == 1)
            echo "<li>وای فای</li>";
        if ($roomattribute["room_parking"] == 1)
            echo "<li>پارکینگ اختصاصی</li><hr />";

        echo("
                            </ul>
                        </div>
                        <div class='col-md-6 col-sm-6'>
                            <ul class='list_ok'>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class='row' id=''#map' style='background-color: white;box-shadow: 0 1px 6px 0 rgba(0,0,0,.1)'>
                <div class='col-md-3'>
                    <h3>نمایش 360</h3>
                </div>
                <div class='col-md-9' id='map'>
                    <h4>نمایش 360</h4>
                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد.</p>
                    <iframe src='https://www.google.com/maps/embed?pb=!4v1575385685178!6m8!1m7!1sCAoSLEFGMVFpcE5nNWFmQ09XOFVFbFlmSlJmRnUxSldNTzlCSXpCUWtDcHpHMmo4!2m2!1d37.42878231576422!2d49.71355649999998!3f352.28!4f-0.6099999999999994!5f0.7820865974627469' width='600' height='450' frameborder='0' style='border:0;' allowfullscreen=''></iframe>
                </div>
            </div>
            <hr>
            <div class='row' style='background-color: white;box-shadow: 0 1px 6px 0 rgba(0,0,0,.1)'>
                <div class='col-md-3'>
                    <h3>انواع اتاق </h3>
                </div>
                <div class='col-md-9'>
                    <h4>اتاق یک نفره</h4>
                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد.</p>
                    <div class='row'>
                        <div class='col-md-6 col-sm-6'>
                            <ul class='list_icons'>
                                <li><i class='icon_set_1_icon-86'></i> وای فای رایگان</li>
                                <li><i class='icon_set_2_icon-116'></i> تلویزیون پلاسما</li>
                                <li><i class='icon_set_2_icon-106'></i> جعبه ایمنی</li>
                            </ul>
                        </div>
                        <div class='col-md-6 col-sm-6'>
                            <ul class='list_ok'>
                                <li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</li>
                                <li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</li>
                                <li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</li>
                            </ul>
                        </div>
                    </div>
                    <div class='row magnific-gallery'>
                        <div class='col-md-3 col-sm-3 col-xs-3'>
                            <a href='img/carousel/1.jpg'>
                                <img src='img/carousel/1.jpg' alt='Image' class='img-responsive'>
                            </a>
                        </div>
                        <div class='col-md-3 col-sm-3 col-xs-3'>
                            <a href='img/carousel/2.jpg'>
                                <img src='img/carousel/2.jpg' alt='Image' class='img-responsive'>
                            </a>
                        </div>
                        <div class='col-md-3 col-sm-3 col-xs-3'>
                            <a href='img/carousel/3.jpg'>
                                <img src='img/carousel/3.jpg' alt='Image' class='img-responsive'>
                            </a>
                        </div>
                        <div class='col-md-3 col-sm-3 col-xs-3'>
                            <a href='img/carousel/4.jpg'>
                                <img src='img/carousel/4.jpg' alt='Image' class='img-responsive'>
                            </a>
                        </div>
                    </div>
                    <hr>
                    <h4>اتاق دو تخته</h4>
                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد.</p>
                    <div class='row'>
                        <div class='col-md-6 col-sm-6'>
                            <ul class='list_icons'>
                                <li><i class='icon_set_1_icon-86'></i> وای فای رایگان</li>
                                <li><i class='icon_set_2_icon-116'></i> تلویزیون پلاسما</li>
                                <li><i class='icon_set_2_icon-106'></i> جعبه ایمنی</li>
                            </ul>
                        </div>
                        <div class='col-md-6 col-sm-6'>
                            <ul class='list_ok'>
                                <li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</li>
                                <li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</li>
                                <li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</li>
                            </ul>
                        </div>
                    </div>
                    <div class='row magnific-gallery'>
                        <div class='col-md-3 col-sm-3 col-xs-3'>
                            <a href='img/carousel/1.jpg'>
                                <img src='img/carousel/1.jpg' alt='Image' class='img-responsive'>
                            </a>
                        </div>
                        <div class='col-md-3 col-sm-3 col-xs-3'>
                            <a href='img/carousel/2.jpg'>
                                <img src='img/carousel/2.jpg' alt='Image' class='img-responsive'>
                            </a>
                        </div>
                        <div class='col-md-3 col-sm-3 col-xs-3'>
                            <a href='img/carousel/3.jpg'>
                                <img src='img/carousel/3.jpg' alt='Image' class='img-responsive'>
                            </a>
                        </div>
                        <div class='col-md-3 col-sm-3 col-xs-3'>
                            <a href='img/carousel/4.jpg'>
                                <img src='img/carousel/4.jpg' alt='Image' class='img-responsive'>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class='row'>
                <div class='col-md-3'>
                    <h3>بررسی</h3>
                        <a href='#' class='btn_1 add_bottom_30' data-toggle='modal' name='survey_submit' data-target='#myReview'>نظر شما</a>                </div>
                <div class='col-md-9'>
                <div class='review-result'>
                    <div id='score_detail'>
                    <span>{$Functions->EN_numTo_FA($rooms->score_by_comments($room_id),true)}</span>");
                     echo $rooms->word_score($rooms->score_by_comments($room_id));
                    echo(" 
                    <small> بر اساس ");
                    echo($Functions->EN_numTo_FA($rooms->CountPublishRoomComments($room_id), true));
                echo(" نظر</small>
                    </div>
                    <div class='row' id='rating_summary'>
                        <div class='col-md-6'>
                            <ul>
                                <li>قیمت
                                    <div class='rating'>");
                                        $rooms->avg_room_attr($room_id, 'room_price');
                                        echo("
                                    </div>
                                </li>
                                <li>آسایش
                                    <div class='rating'> ");
                                        $rooms->avg_room_attr($room_id, 'room_comfort');
                                    echo("
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class='col-md-6'>
                            <ul>
                                <li>کیفیت
                                    <div class='rating'> ");
                                        $rooms->avg_room_attr($room_id, 'room_quality');
                                    echo("
                                    </div>
                                </li>
                                <li>امتیاز
                                    <div class='rating'> ");
                                        echo $rooms->avg_room_attr($room_id, 'room_score');
                                    echo("
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                    <hr>");
                        $result = $rooms->SelectUserRoomComments($room_id);
                        while ($room_survey = $database->fetch_array($result)) {
                            if ($users_row = $database->fetch_array($users->SelectById($room_survey['user_id']))) {
                                $divid_date_time = $Functions->divid_date_time_database($room_survey['survey_date']);
                                echo("
                                                            <div id='single-hotel-comment' class='review_strip_single'>
                                                                <img id='finger-img-panel-comment' src='");
                                Users::select_user_image_for_comment($users_row["user_image"]);
                                echo("' alt='تی شین' class='img-circle'>
                                                                <h4>{$users_row['username']}</h4>
                                                                <p>");
                                echo(nl2br($room_survey['survey']));
                                echo("</p>
                                                                <div class='rating'> {$rooms->smile_voted_by_price_quality_score_comfort($room_survey['room_price'],$room_survey['room_quality'],$room_survey['room_score'],$room_survey['room_comfort'])}</div>
                                                                <small class='icon-clock-8' style='float: left;margin-top: 18px' id='panel-time-comment'>&nbsp;");
                                echo $Functions->EN_numTo_FA($divid_date_time[0], true);
                                echo("</small>
                                                                <small id='panel-date-comment' style='float: left;margin-top: 18px'>");
                                echo $Functions->EN_numTo_FA($Functions->convert_db_format_for_gregorian_to_jalali($divid_date_time[1]), true);
                                echo("</small><br /><br />
                                                            </div>
                                                        ");
                            }
                        }
                                            if (isset($_POST["reserve_submit"])) {
                                                $rooms->ReserveRoom($room_id,$roomattribute['room_person_count']);
                                            }
        echo("
                </div>
            </div>
        </div>
        <aside class='col-md-4'>
            <p class='hidden-sm hidden-xs'> <a class='btn_map scrollTo' href=''#map'>نمایش بر روی نقشه</a>
            </p>
            <div class='box_style_1 expose'>
                <form  method='post' action='"); echo(htmlspecialchars($_SERVER['PHP_SELF'])); echo("'>
                    <input type='hidden' value='{$room_id}' name='room_id' hidden />
                    <h3 class='inner' id='reservation'>رزرو</h3>
                    <div class='row'>
                        <div class='col-md-6 col-sm-6'>
                            <div class='form-group'>
                                <label>نام</label>
                                <input class='form-control' name='reserve_firstname' maxlength='50' id='name_booking' type='text' required />
                            </div>
                        </div>
                        <div class='col-md-6 col-sm-6'>
                            <div class='form-group'>
                                <label>نام خانوادگی</label>
                                <input class='form-control' name='reserve_lastname' maxlength='100' id='last_name_booking' type='text' required />
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class='row'>
                        <div class='col-lg-12 col-xs-12 col-md-12 col-sm-12' id='data-picker-range'>
                           <div class='input-group' id='data-picker-range'>
                                <div class='input-group-prepend calender-btn'>
                                    <span class='input-group-text cursor-pointer icon-calendar' id='date3-1'>انتخاب زمان ورود و خروج</span>
                                </div>
                                <input type='text' readonly id='inputDate3-1' class='calender-self' name='reserve_date' placeholder='۱۳۹۹/۰۴/۰۳ - ۱۳۹۹/۰۴/۱۲' aria-label='date3-1' aria-describedby='date3-1' required />
                           </div>
                        </div>
                    </div><hr />
                    <div class='row'>
                    <label class='text-center'>ظرفیت <span style='color: #00A8FF;'>{$roomattribute['room_person_count']}</span> نفر</label>
                        <div class='col-md-12 col-sm-12 person-count'>
                            <div class='form-group'>
                                <label class='person-count-text'>تعداد نفرات</label>
                                <div class='person-count-inside'>
                                    <div class='numbers-row'>
                                        <input type='text' value='1' maxlength='{$roomattribute['room_person_count']}' id='adults' class='qty2 form-control' name='reserve_person_count' min='1' max='{$roomattribute['room_person_count']}' />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type='submit' name='reserve_submit' value='الان رزرو کنید' class='btn_full' />
                </form>
            </div>
            <div class='box_style_4'> <i class='icon_set_1_icon-90'></i>
                <h4><span>ارتباط </span> از طریق تلفن</h4>  <a href='تلفن://۰۰۴۵۴۲۳۴۴۵۹۹' class='phone'>۰۷۶-۳۲۵۶۸۴۲۶</a>  <small>شنبه تا پنجشنبه از ساعت ۷:۰۰الی۲۳:۰۰</small>
            </div>
        </aside>
    </div>
</div>
            ");

        // this is for check if is set review submit
        if (isset($_POST["review_submit"])) {
            $rooms->InsertComment($room_id);
        }
        ?>
        <div id='overlay'></div>
        <div class='modal fade' id='myReview' tabindex='-1' role='dialog' aria-labelledby='myReviewLabel'
             aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span
                                aria-hidden='true'>&times;</span>
                        </button>
                        <h4 class='modal-title' id='myReviewLabel'>نظرات شما</h4>
                    </div>
                    <div class='modal-body'>
                        <div id='message-review'></div>
                        <form action='<?php echo(htmlspecialchars($_SERVER["PHP_SELF"])); ?>' method='post'>
                            <div class='row'>
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label>امتیاز</label>
                                        <select class='form-control' name='room_score_review' id='room_score_review'
                                                required>
                                            <option value=''>لطفا انتخاب کنید</option>
                                            <?php
                                            for ($counter = 1; $counter <= 5; $counter++)
                                                echo "<option value='{$counter}'>{$counter}</option>";
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label>آسایش</label>
                                        <select class='form-control' name='room_comfort_review' id='comfort_review'
                                                required>
                                            <option value=''>لطفا انتخاب کنید</option>
                                            <option value='13'>من نمی دانم</option>
                                            <option value='1'>کم</option>
                                            <option value='2'>کافی</option>
                                            <option value='3'>خوب</option>
                                            <option value='4'>عالی</option>
                                            <option value='5'>بسیار عالی</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label>قیمت</label>
                                        <select class='form-control' name='room_price_review' id='price_review'
                                                required>
                                            <option value=''>لطفا انتخاب کنید</option>
                                            <option value='13'>خیلی زیاد</option>
                                            <option value='1'>زیاد</option>
                                            <option value='2'>متوسط</option>
                                            <option value='3'>خوب</option>
                                            <option value='4'>عالی</option>
                                            <option value='5'>بسیار مناسب و به صرفه</option>
                                        </select>
                                    </div>
                                </div>
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label>کیفیت</label>
                                        <select class='form-control' name='room_quality_review' id='quality_review'
                                                required>
                                            <option value=''>لطفا انتخاب کنید</option>
                                            <option value='13'>من نمی دانم</option>
                                            <option value='1'>کم</option>
                                            <option value='2'>کافی</option>
                                            <option value='3'>خوب</option>
                                            <option value='4'>عالی</option>
                                            <option value='5'>بسیار عالی</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class='form-group'>
                                <textarea name='room_text_review' id='review_text_textarea' class='form-control'
                                          style='height:100px' placeholder='متن خود را بنویسید' required></textarea>
                            </div>
                            <div class='form-group'>
                                <img src="classes/captcha.php" class="captcha_code" title="کد را در کادر وارد کنید"/>
                                <input type='text' id="tel" name="random_captcha_code" class='verify_review'
                                       minlength="4" title="کد را در کادر وارد کنید" maxlength="4" placeholder='1234'
                                       required/>
                            </div>
                            <hr/>
                            <input type='hidden' hidden value='<?php echo $room_id; ?>' name="room_id"/>
                            <input type='submit' value='Submit' name="review_submit" class='btn_1' id='submit-review'>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="datapicker/src/jquery.md.bootstrap.datetimepicker.js" type="text/javascript"></script>
        <script type="text/javascript">
            $('#inputDate3-1').prop("readonly", true);
            $('#date3-1').MdPersianDateTimePicker({
                targetTextSelector: '#inputDate3-1',
                disableBeforeToday: true,
                disabledDates: [
                    <?php
                        $date_reserved_room_result = $rooms->DatesRoomReservedAttr($room_id);
                        while($dates_room_reserved = $database->fetch_array($date_reserved_room_result)) {
                            $range_date_room = explode("|",$dates_room_reserved["date_range"]); $start_day = $range_date_room[0]; $end_day = $range_date_room[1];
                            echo $Functions->ShowBetweenTwoDateRange($start_day,$end_day,false);
                        }
                    ?>
                ],
                monthsToShow: [0, 2],
                rangeSelector: true
            });
        </script>
        <?php
        }else{
            $users->redirect_to("RoomsList.php");
        }
    }
}else{
    $users->redirect_to("RoomsList.php");
}
?>

<div class="now-reserve-btn">
    <a href="#reservation">
        <div class="now-reserve-inside">
            <p>همین حالا رزرو کنید</p>
        </div>
    </a>
</div>
<div class="room_error_message">
    <span id="room_error_message_inside">
            <?php
                if (!empty($_SESSION["errors_message"]) && isset($_SESSION["errors_message"])){
                    echo $users->Errors();
                    $_SESSION["errors_message"] = "";
                    unset($_SESSION["errors_message"]);
                }
            ?>
    </span>
</div>
<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/common_scripts_min.js"></script>
<script src="js/functions.js"></script>
<script src="js/signUp.js"></script>
<?php include('includes/footer.php'); ?>
</body>
</html>
