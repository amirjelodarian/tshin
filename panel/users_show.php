<?php
header('Cache-Control: max-age=900');
require_once("../classes/initialize.php");
$sessions->login_administrator("../index.php");
?>
<?php include("includes/administrator_menu.php"); ?>
    <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="row">
            <div id="errors" class="errors-panel" style="margin-top: 70px;"><?php echo $users->Errors(); ?></div>
            <table class="table_admins" id="TABLE_ADMINS">
                <div id="keyword-style">
                    <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="get">
                        <input type="text" id="keyword" name="panel_keyword_user" placeholder="Search" />
                        <select class="search-by-witch" name="panel_ByWitch_user">
                            <option value="Tel">Tel</option>
                            <option value="Username">Username</option>
                        </select>
                        <input type="submit" value="Search" id="submit_search" name="panel_submit_search_user" />
                    </form>
                </div>
                <tbody>
                <tr class="title_th">
                    <th>Pro</th>
                    <th>Username</th>
                    <th>Tel</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                    if (isset($_GET["panel_submit_search_user"])){
                        $users->SerachUserByTelOrUsername();
                    }else{
                        $users->AllUsers();
                    }
                ?>
                </tbody>
            </table><br /><br />
        </div>
        <hr>
    </div>
<?php include("includes/footer.php"); ?>