<?php
require_once("../classes/initialize.php");
if (!($sessions->login_state())){
    $users->redirect_to("../index.php");
}
include("includes/users_menu.php");
?>
<?php
$SelectReservedMode = $rooms->SelectUserRoomReservation();

if (isset($_POST["delete_all_booked_reservation"])){
    $rooms->DeleteUserAllBookedReservation();
}
if (isset($_POST["delete_all_notbooked_reservation"])){
    $rooms->DeleteUserAllNotBookedReservation();
}
///////////////////////////////////

if (isset($_POST['submit_search'])){
    $rooms->CommentsSearch();
}

if (isset($_POST["delete_single_reservation"])){
    $rooms->DeleteSingleReservation();
}
?>
<h1 id='rooms' align="center">رزرو ها</h1>
<h2>
    <?php
    if ($SelectReservedMode[1] == "booked"){
        echo("
                <div id='rooms' class='published'>({$rooms->CountUserBookedAndNotBookedRoomReservationPanel(1)})&nbsp; رزرو شده ها</div><hr/>
                <form id='unpublish_all_btn' action='{$_SERVER['PHP_SELF']}' method='post'>
                    <input type='submit' name='delete_all_booked_reservation'  class='delete_all_comments delete_room_btn'  value='X حذف همه رزرو شده ها' />
                </form>
            ");
    }elseif ($SelectReservedMode[1] == "notbooked"){
        echo("
                    <div id='rooms' class='unpublished'>({$rooms->CountUserBookedAndNotBookedRoomReservationPanel(0)})&nbsp;در حال رزرو ها</div><hr/>
                    <form id='publish_all_btn' action='{$_SERVER['PHP_SELF']}' method='post'>
                        <input type='submit' name='delete_all_notbooked_reservation'  class='delete_all_comments delete_room_btn'  value='X حذف همه درحال رزروها' />
                    </form>
                ");
    }
    ?>
</h2>
<div class='container-comment-panel col-xs-12 col-sm-12 col-md-12 col-lg-12'>
    <div id="errors" class="errors-panel " style="margin-top: 70px;"><?php echo $users->Errors(); ?></div>
    <form method="get" action="<?php echo($_SERVER['PHP_SELF']); ?>">
        <div class="publish">
            <select name="select_booking">
                <option value="notbooked" id="unpublished" <?php if($SelectReservedMode[1] == "notbooked") echo "selected"; ?>><?php echo("({$rooms->CountUserBookedAndNotBookedRoomReservationPanel(0)})"); ?>&nbsp;در حال رزرو ها</option>
                <option value="booked" id="published" <?php if($SelectReservedMode[1] == "booked") echo "selected"; ?>><?php echo("({$rooms->CountUserBookedAndNotBookedRoomReservationPanel(1)})"); ?>&nbsp;رزرو شده ها</option>
                <input type="submit" name="submit_booking" id="submit_publish" hidden />
            </select>
        </div>
    </form>
    <hr/>
    <?php
    $all_room_reservation_result = $rooms->SelectUserRoomReservation();
    $all_room_reservation_result = $all_room_reservation_result[0];
    while($room_reservation = $database->fetch_array($all_room_reservation_result)){
        if ($rooms_rows = $database->fetch_array($rooms->SelectWithId($room_reservation['room_id']))){
            echo("
                    <div class='comment-panel col-xs-12 col-sm-12' "); if($SelectReservedMode[1] == "booked"){ echo("style='border: 2px solid green'"); }else{ echo("style='border: 2px solid red'"); }  echo(">
                    <span class='reservation-bg-outside'>
                        <img id='reservation-bg' src='../"); Rooms::select_room_image($rooms_rows['room_image']); echo("' alt='تی شین' />
                    </span>
                        ");
            if ($users_row = $database->fetch_array($users->SelectById($room_reservation['user_id']))) {
                echo("<img class='finger-img' "); if($SelectReservedMode[1] == "booked"){ echo("style='border: 4px solid green;'"); }else{ echo("style='border: 4px solid red;'"); }  echo("  id='finger-img-panel-comment' src='"); Users::select_user_image($users_row['user_image']); echo("' alt='' class='img-circle'>");
            }
            $divid_date_time = $Functions->divid_date_time_database($room_reservation['reserve_time']);
            echo("  
                        <h4 id='username-panel-comment'>{$room_reservation['firstname']} {$room_reservation['lastname']}</h4>");
            echo("<blockquote style='float: left;'>شماره رزرو : <span style='color: #00A8FF;font-weight: bold;'>{$room_reservation['reserve_id']}</span></blockquote>");
            echo("<blockquote style='float: left;'>Tel : <span style='color: #00A8FF;font-weight: bold;'>{$users_row['tel']}</span></blockquote>");
            echo("<h6>{$users_row['username']}</h6>");
            if($room_reservation["reserved_mode"] == 1) { echo "<div class='tick'><img src='../img/verify-tick.png' alt='تی شین' /></div>"; }else { echo "<div class='tick'><img src='../img/un-verify.png' alt='تی شین' /></div>"; }
            echo("<br /><h4 style='display: inline-block' class='room_address'>{$database->escape_value($rooms_rows['room_address'])}</h4><h3 style='display: inline-block'>&nbsp;|&nbsp;</h3> 
                                            <h5 style='display: inline-block'>{$database->escape_value($rooms_rows['room_title'])}</h5>");
        }
        echo("
        <div class='survey' id='reservation-content'>
              <h5 class='date-range'>");
        $date_reservation = $Functions->DividedStartAndEndDate($room_reservation['date_range'],"|");
        echo(" از " . $Functions->EN_numTo_FA($Functions->convert_db_format_for_gregorian_to_jalali($date_reservation[0]),true));
        echo(" تا " .$Functions->EN_numTo_FA($Functions->convert_db_format_for_gregorian_to_jalali($date_reservation[1]),true));
        echo("</h5>
              <div class='room-person-count-reservation'><blockquote>رزرو شده برای&nbsp;<span>{$Functions->EN_numTo_FA($room_reservation['reserve_room_person_count'],true)}</span>&nbsp;نفر&nbsp;</blockquote></div>
              </div>
                        <small class='icon-clock-8' id='panel-time-comment'>&nbsp;"); echo $Functions->EN_numTo_FA($divid_date_time[0],true); echo("</small>
                        <small id='panel-date-comment'>"); echo $Functions->EN_numTo_FA($Functions->convert_db_format_for_gregorian_to_jalali($divid_date_time[1]),true); echo("</small><br />
                    <div class='comment-panel-btns col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                         <a href='../Room.php?roomId={$Functions->encrypt_id($rooms_rows['room_id'])}'>
                            <p id='see-room-btn' class='submit_edit'>بازدید اتاق</p>
                         </a>
                        <form action='{$_SERVER['PHP_SELF']}' id='submit-checkbox-form' method='post'>
                            <input type='hidden' name='reserve_id' value='"); echo($Functions->encrypt_id($room_reservation['reserve_id'])); echo("' />
                            <input type='submit' name='delete_single_reservation' value='حذف' class='comments_delete_btn delete_room_btn' />
                        </form>
                    </div>
                        <div class='line'></div>
                    </div>
                
            ");

    }
    $sessions->null_room_id_while_comment(); ?>
    <br /><br />

    <div class="keyword-style-panel">
        <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post">
            <input type="text" id="keyword" name="keyword" placeholder="Search" />
            <select class="search-by-witch" name="ByWitch">
                <option value="username">Username</option>
                <option value="user_id">ID</option>
                <option value="tel">Tel</option>
                <option value="address">Address</option>
                <option value="title">Title</option>
                <option value="survey">Survey</option>
                <option value="score">Score 1-5</option>
            </select>
            <input type="submit" value="Search" id="submit_search" name="submit_search" />
        </form>
    </div>
    <?php include("includes/footer.php"); ?>
