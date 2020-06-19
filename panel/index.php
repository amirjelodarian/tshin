<?php
    require_once("../classes/initialize.php");
    if ($sessions->login_state()){
        if ($_SESSION["user_mode"] == 0){
            $users->redirect_to("user.php");
        }
        if (isset($_SESSION["logged_in_admin"])){
            $users->redirect_to("admin.php");
        }
        if (isset($_SESSION["logged_in_administrator"])){
            $users->redirect_to("administrator.php");
        }
    }else
        $users->redirect_to("../index.php");

?>