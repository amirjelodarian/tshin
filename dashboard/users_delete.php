<?php
require_once("../classes/initialize.php");
    $sessions->login_administrator("../index.php");
    if (isset($_POST["submit_delete_user"]) && isset($_POST["user_id"]) && !(empty($_POST["user_id"]))){
        $users->DeleteَUser();
    }else{
        $users->redirect_to("users_show.php");
    }
?>