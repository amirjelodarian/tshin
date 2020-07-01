<?php
require_once("../classes/initialize.php");
if (!($sessions->login_state() && $_SESSION["user_mode"] == 0)){
    $users->redirect_to("../index.php");
}
$rooms->ReservationSearch(true);
?>