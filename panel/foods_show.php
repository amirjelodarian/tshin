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
isset($_GET["page"]) ? $page = $_GET["page"] : $page = 1;
isset($_GET["foodSearchPage"]) ? $foodSearchPage = $_GET["foodSearchPage"] : $foodSearchPage = 1;
?>
    <div class="add_new_room">
        <div><a href="foods_create.php">Add New (FOOD) +</a></div>
    </div>

        <div class="panel_rooms col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="errors" class="errors-panel" style="margin-top: 70px;"><?php echo $users->Errors(); ?></div>
            <div id="result"></div>
            <div id="main-result">
                <?php
                if (isset($_GET['foodSearchPage'])){
                    $foods->SerachFood($foodSearchPage);
                }else{
                    $foods->AllFoods_panel($page);
                }
                ?>
            </div>
            <hr>
        </div>
        <div id="keyword-style" style="margin-bottom: 8px">
            <p id="searching"></p>
            <input type="text" id="food-keyword" name="panel_keyword_food" placeholder="Search" />
            <select class="food-search-by-witch" name="panel_ByWitch_food">
                <option value="Title">عنوان</option>
                <option value="Descript">توضیحات</option>
                <option value="Details">طرز تهیه</option>
                <option value="Score">۱-۵ امتیاز</option>
                <option value="Price">قیمت</option>
                <option value="Off-Price">قبل تخفیف</option>
            </select>
        </div>

<?php include("includes/footer.php"); ?>