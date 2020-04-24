<?php
    require_once("../../classes/sessions.php");
    $sessions->login_administrator_and_admin("../../index.php");
    if (isset($_SESSION["logged_in_admin"])){
        $users->redirect_to("../admin.php");
    }else if (isset($_SESSION["logged_in_administrator"])){
        $users->redirect_to("../administrator.php");
    }
?>