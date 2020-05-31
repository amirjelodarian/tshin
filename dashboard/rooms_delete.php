<?php
require_once("../classes/initialize.php");
    $sessions->login_administrator_and_admin("../index.php");
    if (isset($_POST["submit_delete_room"])) {
            $rooms->DeleteRoom();
    }else{
        $users->redirect_to("rooms_show.php");
    }
?>