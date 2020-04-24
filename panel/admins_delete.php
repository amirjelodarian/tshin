<?php

require_once("../classes/initialize.php");
$sessions->login_administrator("../index.php");
if (isset($_POST["submit_delete_admin"]) && isset($_POST["admin_id"]) && !(empty($_POST["admin_id"]))){
    $users->DeleteAdmin();
}else{
    $users->redirect_to("admins_show.php");
}

?>