<?php
    require_once("../classes/initialize.php");
    $sessions->login_administrator("../index.php");
    isset($_GET["adminSearchPage"]) ? $adminSearchPage = $_GET["adminSearchPage"] : $adminSearchPage = 1;
    $users->SerachAdminByTelOrUsername($adminSearchPage);
?>
