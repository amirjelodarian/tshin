<?php
require_once("../classes/initialize.php");
$sessions->login_administrator_and_admin("../index.php");
header('Cache-Control: max-age=900');
?>
<?php
if ($_SESSION["user_mode"] == 13) {
    include("includes/administrator_menu.php");
}
else if($_SESSION["user_mode"] == 1){
    include("includes/admin_menu.php");
}
$SelcetPublishMode = $rooms->SelectRoomComments();
    if(isset($_POST["publish_submit"])){
        $rooms->PublishComment();
    }
    if(isset($_POST["unpublish_submit"])){
        $rooms->UnPublishComment();
    }

    //For All Comments /////////////////
    if (isset($_POST["publish_all_submit"])){
        $rooms->PublishAllComments();
    }
    if(isset($_POST["unpublish_all_submit"])){
        $rooms->UnPublishAllComments();
    }
    if (isset($_POST["delete_all_comment_published_submit"])){
        $rooms->DeleteAllCommentsPublished();
    }
    if (isset($_POST["delete_all_comment_unpublished_submit"])){
        $rooms->DeleteAllCommentsUnPublished();
    }

    if (isset($_POST["delete_user_comment"])){
        $rooms->DeleteUserComment();
    }
//////////////////////////////////////////////////////////////////////////////


?>


<!-- For Search -->
<script src="../js/jquery-1.11.2.min.js"></script>
<script src="../js/common_scripts_min.js"></script>
<script src="../js/signUp.js"></script>
<script src="../js/functions.js"></script>
<script src="../js/icheck.js"></script>
<div class="keyword-style-panel">
    <form action="<?php echo(htmlspecialchars($_SERVER['PHP_SELF'])); ?>" method="post">
        <input type="text" id="keyword" name="keyword" placeholder="Search" />
        <select class="search-by-witch" name="ByWitch">
            <option value="username">Username</option>
            <option value="user_id">ID</option>
            <option value="tel">Tel</option>
            <option value="address">Address</option>
            <option value="title">Title</option>
            <option value="survey">Survey</option>
        </select>
        <input type="submit" value="Search" id="submit_search" class="comment_submit_search" name="submit_search" />
    </form>
</div>
<div class='container-comment-panel col-xs-12 col-sm-12 col-md-12 col-lg-12'>
    <?php
        if (isset($_POST['submit_search'])){
            echo "<h1>جستجو</h1>";
            $rooms->CommentsSearch();
            die();
        }
    ?>
</div>




<h1 id='rooms' align="center">نظرات</h1>
<h2>

    <?php
        if ($SelcetPublishMode[1] == "published"){
            echo("
                <div id='rooms' class='published'>({$rooms->CountPublishAndUnPublishRoomCommentsPanel(1)})&nbsp;منتشر شده ها</div><hr/>
                <form id='unpublish_all_btn' action='{$_SERVER['PHP_SELF']}' method='post'>
                    <input type='submit' name='unpublish_all_submit' id='unpublish_all_submit' class='submit_edit delete_room_btn' value='غیر منتشر کردن همه' />
                    <input type='submit' name='delete_all_comment_published_submit'  class='delete_all_comments delete_room_btn' value='X حذف همه منتشر شده ها' />
                </form>
            ");
        }elseif ($SelcetPublishMode[1] == "unpublished"){
            echo("
                    <div id='rooms' class='unpublished'>({$rooms->CountPublishAndUnPublishRoomCommentsPanel(0)})&nbsp;منتشر نشده ها</div><hr/>
                    <form id='publish_all_btn' action='{$_SERVER['PHP_SELF']}' method='post'>
                        <input type='submit' name='publish_all_submit'  style='width: 130px' class='submit_edit delete_room_btn'  value='منتشر کردن همه' />
                        <input type='submit' name='delete_all_comment_unpublished_submit'  class='delete_all_comments delete_room_btn'  value='X حذف همه منتشر نشده ها' />
                    </form>
                ");
        }
    ?>
</h2>
<div class='container-comment-panel col-xs-12 col-sm-12 col-md-12 col-lg-12'>

    <div id="errors" class="errors-panel " style="margin-top: 70px;"><?php echo $users->Errors(); ?></div>
    <form method="get" action="<?php echo($_SERVER['PHP_SELF']); ?>">
        <div class="publish">
            <select name="select_publish">
                <option value="unpublished" id="unpublished" <?php if($SelcetPublishMode[1] == "unpublished") echo "selected"; ?>><?php echo("({$rooms->CountPublishAndUnPublishRoomCommentsPanel(0)})"); ?>&nbsp;منتشر نشده ها</option>
                <option value="published" id="published" <?php if($SelcetPublishMode[1] == "published") echo "selected"; ?>><?php echo("({$rooms->CountPublishAndUnPublishRoomCommentsPanel(1)})"); ?>&nbsp;منتشر شده ها</option>
                <input type="submit" name="submit_publish" id="submit_publish" hidden />
            </select>
        </div>
    </form>
    <hr/>
    <div id='main-comment'>
<?php
$all_room_survey_result = $rooms->SelectRoomComments();
$all_room_survey_result = $all_room_survey_result[0];
    while($room_survey = $database->fetch_array($all_room_survey_result)){

            echo("
                    <div class='comment-panel col-xs-12 col-sm-12 col-md-6 col-lg-6' "); if($SelcetPublishMode[1] == "published"){ echo("style='border: 2px solid #00A8FF'"); }else{ echo("style='border: 2px solid #ca0d30'"); }  echo(">
                        ");
                        if ($users_row = $database->fetch_array($users->SelectById($room_survey['user_id']))) {
                            echo("<img class='finger-img' "); if($SelcetPublishMode[1] == "published"){ echo("style='border: 4px solid #00A8FF;'"); }else{ echo("style='border: 4px solid #ca0d30;'"); }  echo("  id='finger-img-panel-comment' src='"); Users::select_user_image($users_row['user_image']); echo("' alt='' class='img-circle'>");
                        }
                        $divid_date_time = $Functions->divid_date_time_database($room_survey['survey_date']);
                        echo("
                        <h4 id='username-panel-comment'>{$room_survey['username']}</h4>");
                        echo("<blockquote style='float: left;'>Comment Id : <span style='color: #00A8FF;font-weight: bold;'>{$room_survey['id']}</span></blockquote>");
                        echo("<blockquote style='float: left;'>Tel : <span style='color: #00A8FF;font-weight: bold;'>{$users_row['tel']}</span></blockquote>");
                        if ($rooms_rows = $database->fetch_array($rooms->SelectWithId($room_survey['room_id']))){
                            echo("<br /><h4 style='display: inline-block' class='room_address'>{$database->escape_value($rooms_rows['room_address'])}</h4><h3 style='display: inline-block'>&nbsp;|&nbsp;</h3> 
                                        <h5 style='display: inline-block'>{$database->escape_value($rooms_rows['room_title'])}</h5>
                                        <span class='reservation-bg-outside'>
                                            <img id='reservation-bg' src='../"); Rooms::select_room_image($rooms_rows['room_image']); echo("' alt='تی شین' />
                                        </span>
                    ");
                        }
                        echo("<div class='survey'><p>"); echo(nl2br($room_survey['survey'])); echo("</p></div>
                        <div id='panel-rating-comment' class='rating'> {$rooms->smile_voted_by_price_quality_score_comfort($room_survey['room_price'],$room_survey['room_quality'],$room_survey['room_score'],$room_survey['room_comfort'])} </div>
                        
                        <small class='icon-clock-8' id='panel-time-comment'>&nbsp;"); echo $Functions->EN_numTo_FA($divid_date_time[0],true); echo("</small>
                        <small id='panel-date-comment'>"); echo $Functions->EN_numTo_FA($Functions->convert_db_format_for_gregorian_to_jalali($divid_date_time[1]),true); echo("</small><br />
                    <div class='comment-panel-btns col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                         <a href='../Room.php?roomId={$Functions->encrypt_id($rooms_rows['room_id'])}'>
                            <p id='see-room-btn' class='submit_edit'>بازدید اتاق</p>
                         </a>
                        <form action='{$_SERVER['PHP_SELF']}' id='submit-checkbox-form' method='post'>
                            <input type='hidden' name='survey_id' value='"); echo($Functions->encrypt_id($room_survey['id'])); echo("' />
                            <div class='publish-area'>");                                if($room_survey["publish"] == 0) {
                                    echo("<input type='submit' name='publish_submit' id='publish_checkbox_submit' class='submit_edit' value='منتشر' />");
                                }
                                if($room_survey["publish"] == 1) {
                                    echo("<input type='submit' name='unpublish_submit' id='unpublish_checkbox_submit' class='submit_edit' value='X  غیر منتشر' />");
                                }
                                echo("
                                
                            </div>
                            <input type='submit' name='delete_user_comment' value='حذف' class='comments_delete_btn delete_room_btn' />
                        </form>
                        <a class='edit-comment-panel-btn' href='comments_edit.php?commentId={$Functions->decrypt_id($room_survey['id'])}'>ویرایش</a>
                    </div>
                        <div class='line'></div>
                  </div>
                
            ");

    }
?>
    </div>
    <br /><br />
    <hr />
<?php include("includes/footer.php"); ?>
