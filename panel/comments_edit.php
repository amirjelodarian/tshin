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
    if(isset($_POST["publish_submit"])){
        $rooms->PublishComment();
    }
    if(isset($_POST["unpublish_submit"])){
        $rooms->UnPublishComment();
    }
    if (isset($_POST["delete_user_comment"])){
        $rooms->DeleteUserComment();
    }
if (isset($_POST["edit_user_comment_submit"])){
    $rooms->EditComment();
}
?>
    <?php
        if (isset($_POST["edit_user_comment"]) && isset($_POST["survey_id"]) && !empty($_POST["survey_id"])){
            $rooms->EditCommentPanel();
        }else{
            $users->redirect_to("comments_show.php");
        }
    ?>
    <?php include("includes/footer.php"); ?>
