<?php
header('Cache-Control: max-age=900');
    require_once("../classes/initialize.php");
    $sessions->login_administrator_and_admin("../index.php");
?>
<?php
if ($_SESSION["user_mode"] == 13) {
    include("includes/administrator_menu.php");
}
else if($_SESSION["user_mode"] == 1){
    include("includes/admin_menu.php");
}
?>

            <div class="add_new_room">
                <div><a href="rooms_create.php">Add New (ROOM) +</a></div>
            </div>

            <div class="panel_rooms col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="errors" class="errors-panel" style="margin-top: 70px;"><?php echo $users->Errors(); ?></div>
                <div id="result"></div>
                <div id="main-result">
                    <?php $rooms->AllRooms_panel(); ?>
                </div>
                <hr>
            </div>
            <div id="keyword-style" style="margin-bottom: 8px">
                    <p id="searching"></p>
                    <input type="text" id="keyword" name="panel_keyword_room" placeholder="Search" />
                    <select class="search-by-witch" name="panel_ByWitch_room">
                        <option>Address</option>
                        <option>Title</option>
                        <option>Descript</option>
                        <option>Score</option>
                        <option>Price</option>
                        <option>Off-Price</option>
                        <option>Person</option>
                    </select>
            </div>

<?php include("includes/footer.php"); ?>
