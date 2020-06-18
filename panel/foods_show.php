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
        <div><a href="foods_create.php">Add New (FOOD) +</a></div>
    </div>

        <div class="panel_rooms col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="errors" class="errors-panel" style="margin-top: 70px;"><?php echo $users->Errors(); ?></div>
            <?php
            if (isset($_GET["panel_submit_search_food"])){
                $foods->SerachFood();
            }else{
                $foods->AllFoods_panel();
            }
            ?>
            <hr>
        </div>
        <div id="keyword-style" style="margin-bottom: 8px">
            <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="get">
                <input type="text" id="keyword" name="panel_keyword_food" placeholder="Search" />
                <select class="search-by-witch" name="panel_ByWitch_food">
                    <option value="Title">Title</option>
                    <option value="Descript">Descript</option>
                    <option value="Details">Details</option>
                    <option value="Score">Score</option>
                    <option value="Price">Price</option>
                    <option value="Off-Price">Off-Price</option>
                </select>
                <input type="submit" value="Search" id="submit_search" name="panel_submit_search_food" />
            </form>
        </div>

<?php include("includes/footer.php"); ?>