<?php
require_once("../classes/initialize.php");
$sessions->login_administrator_and_admin("../index.php");
if (isset($_POST["submit_create_food"])) {
    $foods->InsertFood();
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
        <div class='strip_all_tour_list wow fadeIn animated' id='rooms' data-wow-delay='0.1s' style='visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;'>
            <div class='row'>
                <h1 class="text-center">(Add Food)</h1>
                <div class='col-lg-4 col-md-4 col-sm-4'>
                    <div class='img_list'>
                        <a href='#'>
                            <div class='ribbon top_rated'></div>
                            <img src='' alt=''>
                            <div class='short_info'></div>
                        </a>
                    </div>
                    <div class='add_photo'>Add Photo +<input type='file' name='foodImage' /></div>
                    <input type='hidden' name='MAX_FILE_SIZE' value='5242880' />
                </div>
                <div class='clearfix visible-xs-block'></div>
                <div class='col-lg-6 col-md-6 col-sm-6'>
                    <div class='tour_list_desc'>
                        <div class='score'>
                            <select name='food_score'>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                            </select>
                        </div>
                        <h3><input type='text' style='background: white;' value='' placeholder='قرمه سبزی' name='food_title' maxlength='200' required/></h3>
                        <p><textarea name='food_description' placeholder='توضیحات غذا' maxlength='1500' required></textarea></p>
                        <ul class='add_info'>
                            <p><textarea name='food_details' maxlength='5000' placeholder='روش پخت غدا' required></textarea></p>
                        </ul>
                    </div>
                </div>
                <div class='col-lg-2 col-md-2 col-sm-2'>
                    <div class='price_list'>
                        <div>
                            <sup><input type='text' name='food_main_price' placeholder='15.000' class='insert_input' maxlength='10' value='' required />  تومان</sup>
                            <span class='normal_price_list'><input name='food_off_price' placeholder='20.000' class='insert_input' maxlength='200' value='' required /> تومان</span>
                            <small>روزانه / شبانه</small>
                            <p>
                                <input type='submit' name='submit_create_food' class='submit_btn' value='Add Food' />
                            </p>
                        </div>
                    </div>

                </div>
            </div>
    </form>
</div>
<?php include("includes/footer.php"); ?>