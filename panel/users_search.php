<?php
    require_once("../classes/initialize.php");
$sessions->login_administrator("../index.php");
    isset($_GET["userSearchPage"]) ? $userSearchPage = $_GET["userSearchPage"] : $userSearchPage = 1;
    $users->SerachUserByTelOrUsername($userSearchPage);
?>