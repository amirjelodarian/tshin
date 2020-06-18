<?php
require_once("../classes/initialize.php");
$sessions->login_administrator_and_admin("../index.php");
if (isset($_POST["submit_last_edit_food"])){
    $foods->UpdateFood();
}
?>
<?php
if ($_SESSION["user_mode"] == 13) {
    include("includes/administrator_menu.php");
}
else if($_SESSION["user_mode"] == 1){
    include("includes/admin_menu.php");
}
?>

<div class="panel_rooms col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <form class="rooms_edit_form" action="<?php echo(htmlspecialchars($_SERVER['PHP_SELF'])); ?>" method="post" enctype="multipart/form-data">
        <?php
        if (isset($_GET["foodId"])){
            $foods->EditFood_panel();
        }else{
            $users->redirect_to("foods_show.php");
        }
        ?>
    </form>
</div>
<?php include("includes/footer.php"); ?>