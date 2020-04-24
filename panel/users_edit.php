<?php
require_once("../classes/initialize.php");
$sessions->login_administrator("../index.php");
if (isset($_POST["submit_last_edit_user"])){
    $users->UpdateUser();
}
?>
<?php include("includes/administrator_menu.php"); ?>

    <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 edit_main_page">
        <div class="row">
            <?php
            if (isset($_POST["submit_edit_user"])){
                $users->EditUsers_panel();
            }else{
                $users->redirect_to("users_show.php");
            }
            ?>
        </div>
    </div>

<?php include("includes/footer.php"); ?>