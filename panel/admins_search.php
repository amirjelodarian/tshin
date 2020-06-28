<?php
    require_once("../classes/initialize.php");
    $sessions->login_administrator("../index.php");
    $users->SerachAdminByTelOrUsername();
?>
