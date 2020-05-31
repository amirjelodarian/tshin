<?php
require_once("../classes/initialize.php");
$sessions->login_administrator_and_admin("../index.php");
if (isset($_POST["submit_delete_food"])) {
    $foods->DeleteFood();
}else{
    $users->redirect_to("foods_show.php");
}
?>