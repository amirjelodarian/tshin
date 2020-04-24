<?php
require_once("../classes/initialize.php");
$sessions->login_administrator_and_admin("../index.php");
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
    ///////////////////////////////////

if (isset($_POST['submit_search'])){
    $rooms->CommentsSearch();
}

    if (isset($_POST["delete_user_comment"])){
        $rooms->DeleteUserComment();
    }
?>
<h1 id='rooms' align="center">Comments</h1>
<h2>
    <?php
        if ($SelcetPublishMode[1] == "published"){
            echo("
                <div id='rooms' class='published'>({$rooms->CountPublishAndUnPublishRoomCommentsPanel(1)})&nbsp;Published</div><hr/>
                <form id='unpublish_all_btn' action='{$_SERVER['PHP_SELF']}' method='post'>
                    <input type='submit' name='unpublish_all_submit' id='unpublish_all_submit' class='submit_edit'  value='Un Publish All' />
                    <input type='submit' name='delete_all_comment_published_submit'  class='delete_all_comments delete_room_btn'  value='X Delete All Published' />
                </form>
            ");
        }elseif ($SelcetPublishMode[1] == "unpublished"){
            echo("
                    <div id='rooms' class='unpublished'>({$rooms->CountPublishAndUnPublishRoomCommentsPanel(0)})&nbsp;Un Published</div><hr/>
                    <form id='publish_all_btn' action='{$_SERVER['PHP_SELF']}' method='post'>
                        <input type='submit' name='publish_all_submit'  class='submit_edit'  value='Publish All' />
                        <input type='submit' name='delete_all_comment_unpublished_submit'  class='delete_all_comments delete_room_btn'  value='X Delete All UnPublished' />
                    </form>
                ");
        }
    ?>
</h2>
<div class='container-comment-panel col-xs-12 col-sm-12 col-md-12 col-lg-12'>
    <div id="errors" class="errors-panel " style="margin-top: 70px;"><?php echo $users->Errors(); ?></div>
    <form method="post" action="<?php echo($_SERVER['PHP_SELF']); ?>">
        <div class="publish">
            <select name="select_publish">
                <option value="unpublished" id="unpublished" <?php if($SelcetPublishMode[1] == "unpublished") echo "selected"; ?>><?php echo("({$rooms->CountPublishAndUnPublishRoomCommentsPanel(0)})"); ?>&nbsp;Un Published</option>
                <option value="published" id="published" <?php if($SelcetPublishMode[1] == "published") echo "selected"; ?>><?php echo("({$rooms->CountPublishAndUnPublishRoomCommentsPanel(1)})"); ?>&nbsp;Published</option>
                <input type="submit" name="submit_publish" id="submit_publish" hidden />
            </select>
        </div>
    </form>
    <hr/>
<?php
$all_room_survey_result = $rooms->SelectRoomComments();
$all_room_survey_result = $all_room_survey_result[0];
    while($room_survey = $database->fetch_array($all_room_survey_result)){

            echo("
                    <div class='comment-panel col-xs-12 col-sm-12 col-md-6 col-lg-6' "); if($SelcetPublishMode[1] == "published"){ echo("style='border: 2px solid green'"); }else{ echo("style='border: 2px solid red'"); }  echo(">
                        ");
                        if ($users_row = $database->fetch_array($users->SelectById($room_survey['user_id']))) {
                            echo("<img class='finger-img' "); if($SelcetPublishMode[1] == "published"){ echo("style='border: 4px solid green;'"); }else{ echo("style='border: 4px solid red;'"); }  echo("  id='finger-img-panel-comment' src='"); Users::select_user_image($users_row['user_image']); echo("' alt='' class='img-circle'>");
                        }
                        $divid_date_time = $Functions->divid_date_time_database($room_survey['survey_date']);
                        echo("
                        <h4 id='username-panel-comment'>{$room_survey['username']}</h4>");
                        echo("<blockquote style='float: left;'>ID : (<span style='color: #00A8FF;font-weight: bold;'>{$users_row['id']}</span>)</blockquote>");
                        echo("<blockquote style='float: left;'>Tel : (<span style='color: #00A8FF;font-weight: bold;'>{$users_row['tel']}</span>)</blockquote>");
                        if ($rooms_rows = $database->fetch_array($rooms->SelectWithId($room_survey['room_id']))){
                            echo("<br /><h4 style='display: inline-block' class='room_address'>{$database->escape_value($rooms_rows['room_address'])}</h4><h3 style='display: inline-block'>&nbsp;|&nbsp;</h3> 
                                            <h5 style='display: inline-block'>{$database->escape_value($rooms_rows['room_title'])}</h5>");
                        }
                        echo("<div class='survey'><p>"); echo(nl2br($room_survey['survey'])); echo("</p></div>
                        <div id='panel-rating-comment' class='rating'> {$rooms->smile_voted_by_price_quality_score_comfort($room_survey['room_price'],$room_survey['room_quality'],$room_survey['room_score'],$room_survey['room_comfort'])}
                        </div>
                        
                        <small class='icon-clock-8' id='panel-time-comment'>&nbsp;"); echo $divid_date_time[0]; echo("</small>
                        <small id='panel-date-comment'>"); echo $divid_date_time[1]; echo("</small><br />
                    <div class='comment-panel-btns col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                        <form action='../single_hotel.php' id='see-room' method='post'>
                            <input type='hidden' name='room_id' value='"); echo($Functions->encrypt_id($room_survey['room_id'])); echo("' />
                            <input type='submit' name='submit' id='see-room-btn' class='submit_edit' value='See Room' />
                        </form>
                        <form action='{$_SERVER['PHP_SELF']}' id='submit-checkbox-form' method='post'>
                            <input type='hidden' name='survey_id' value='"); echo($Functions->encrypt_id($room_survey['id'])); echo("' />
                            <div class='publish-area'>");                                if($room_survey["publish"] == 0) {
                                    echo("<input type='submit' name='publish_submit' id='publish_checkbox_submit' class='submit_edit' value='Publish' />");
                                }
                                if($room_survey["publish"] == 1) {
                                    echo("<input type='submit' name='unpublish_submit' id='unpublish_checkbox_submit' class='submit_edit' value='X  Un Publish' />");
                                }
                                echo("
                                
                            </div>
                            <input type='submit' name='delete_user_comment' value='Delete' class='comments_delete_btn delete_room_btn' />
                        </form>
                        <form action='comments_edit.php' id='submit-checkbox-form' method='post'>
                                <input type='hidden' name='survey_id' value='"); echo($Functions->encrypt_id($room_survey['id'])); echo("' />
                                <input type='submit' name='edit_user_comment' value='Edit' class='edit-comment-panel-btn' />
                        </form>
                    </div>
                        <div class='line'></div>
                    </div>
                
            ");

    }
$sessions->null_room_id_while_comment(); ?>
    <br /><br />
    <hr />
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
                <option value="date">Date 2020-01-01</option>
            </select>
            <input type="submit" value="Search" id="submit_search" name="submit_search" />
        </form>
    </div>
<?php include("includes/footer.php"); ?>
