<?php
require_once("../classes/initialize.php");
if(isset($_POST["publish_submit"])){
    $rooms->PublishComment();
}
if(isset($_POST["unpublish_submit"])){
    $rooms->UnPublishComment();
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
    $rooms->CommentsSearch();
    die();
?>