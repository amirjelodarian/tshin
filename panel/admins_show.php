<?php
header('Cache-Control: max-age=900');
require_once("../classes/initialize.php");
$sessions->login_administrator("../index.php");
?>
<?php include("includes/administrator_menu.php"); ?>
<div class="add_new_room">
    <div><a href="users_show.php">Add New (Admin) +</a></div>
</div>

<div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="row">
        <div id="errors" class="errors-panel" style="margin-top: 70px;"><?php echo $users->Errors(); ?></div>
        <table class="table_admins">
            <div id="keyword-style" style="margin-bottom: 8px">
                <input type="text" id="admins-keyword" name="panel_keyword_admin" placeholder="Search" />
                <select class="admins-search-by-witch" name="panel_ByWitch_admin">
                    <option value="Tel">Tel</option>
                    <option value="Username">Username</option>
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
            <tbody id="main-result"><?php $users->AllAdmins(); ?></tbody>
            </tbody>
        </table>
    </div>
    <hr>
</div>
<?php include("includes/footer.php"); ?>