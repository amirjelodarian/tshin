<?php
header('Cache-Control: max-age=900');
require_once("../classes/initialize.php");
$sessions->login_administrator("../index.php");
?>
<?php
    include("includes/administrator_menu.php");
    isset($_GET["page"]) ? $page = $_GET["page"] : $page = 1;
    isset($_GET["userSearchPage"]) ? $userSearchPage = $_GET["userSearchPage"] : $userSearchPage = 1;
?>
    <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="row">
            <div id="errors" class="errors-panel" style="margin-top: 70px;"><?php echo $users->Errors(); ?></div>
            <table class="table_admins" id="TABLE_ADMINS">
                <div id="keyword-style">
                        <input type="text" id="users-keyword" name="panel_keyword_user" placeholder="Search" />
                        <select class="users-search-by-witch" name="panel_ByWitch_user">
                            <option value="Tel">تلفن</option>
                            <option value="Username">نام کاربری</option>
                        </select>
                </div>
                <tbody>
                <tr class="title_th">
                    <th>Pro</th>
                    <th>Username</th>
                    <th>Tel</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <tbody id="result"></tbody>
                <tbody id="main-result">
                    <?php
                        if (isset($_GET['userSearchPage'])){
                            $users->SerachUserByTelOrUsername($userSearchPage);
                        }else{
                            $users->AllUsers($page);
                        }
                    ?>
                </tbody>
                </tbody>
            </table><br /><br />
        </div>
        <hr>
    </div>
<?php include("includes/footer.php"); ?>