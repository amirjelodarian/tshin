<?php
    require_once("../classes/initialize.php");
    $sessions->login_administrator_and_admin("../index.php");
    isset($_GET["foodSearchPage"]) ? $foodSearchPage = $_GET["foodSearchPage"] : $foodSearchPage = 1;
    $foods->SerachFood($foodSearchPage);
?>
