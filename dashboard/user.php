<?php
require_once("../classes/initialize.php");
if (!($sessions->login_state() && $_SESSION["user_mode"] == 0)){
    $users->redirect_to("../index.php");
}
if (isset($_POST["submit_last_edit_panel"])){
    $users->UpdatePanel();
}
?>
<?php include("includes/users_menu.php"); ?>
<div class="panel_rooms col-lg-12 col-md-12 col-sm-12 col-xs-12 edit_main_page">
    <div id="errors" class="errors-panel " style="margin-top: 70px;"><?php echo $users->Errors(); ?></div>
    <div class="administrator_admin">
        <?php
            if($user_details = $database->fetch_array($users->SelectById($_SESSION["user_id"]))):
            ?>
                <h1 dir="ltr">&nbsp;<?php echo($user_details["username"]); ?>&nbsp;خوش آمدید</h1>

       <?php
            endif;
            $users->Panel();
       ?>
    </div>
</div>
<?php include("includes/footer.php"); ?>
