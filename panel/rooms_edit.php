<?php
require_once("../classes/initialize.php");
    $sessions->login_administrator_and_admin("../index.php");
    if (isset($_POST["submit_last_edit_room"])){
        $rooms->UpdateRoom();
    }
if (isset($_GET["delete_room_pro_img"]))
    $rooms->DeleteRoomImg();
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
                            if (isset($_GET["roomId"])){
                                $rooms->EditRoom_panel();
                            }else{
                                $users->redirect_to("rooms_show.php");
                            }
                        ?>
                    </form>
                </div>
<?php include("includes/footer.php"); ?>