<?php
    require_once("../classes/initialize.php");
    $sessions->login_administrator_and_admin("../index.php");
    isset($_GET["roomSearchPage"]) ? $roomSearchPage = $_GET["roomSearchPage"] : $roomSearchPage = 1;
    $rooms->PanelSerachRoom($roomSearchPage);
?>