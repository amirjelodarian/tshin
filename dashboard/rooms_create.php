<?php
require_once("../classes/initialize.php");
$sessions->login_administrator_and_admin("../index.php");
if (isset($_POST["submit_create_room"])) {
    $rooms->InsertRoom();
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
        <div id='rooms' class='strip_all_tour_list wow fadeIn' data-wow-delay='0.1s'>
            <div class='row'>
                <h1 class="text-center">(Add Room)</h1>
                <div class='col-lg-4 col-md-4 col-sm-4'>
                    <div class='img_list'>
                        <div class='ribbon top_rated'></div>
                        <img src='img\hotel_2.jpg' alt=''>
                        <div class='short_info'></div>
                        </a>
                    </div>
                    <div class='add_photo'>Add Photo +<input type='file' name='roomImage' /></div>
                    <input type='hidden' name='MAX_FILE_SIZE' value='5242880' />
                </div>
                <div class='clearfix visible-xs-block'></div>
                <div class='col-lg-6 col-md-6 col-sm-6'>
                    <div class='tour_list_desc'>
                        <div class='score'>
                            <select name='room_score'>
                                <option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option>
                            </select>
                        </div>
                        <div class='rating'>
                        </div>
                        <h2><input type='text' style='background: white;' name='room_address' placeholder='گیلان - خیابان مرادی' maxlength='400' required/></h2>
                        <h3><input type='text' style='background: white;' name='room_title' placeholder='اتاق سه نفره' maxlength='200' required/></h3>
                        <p><textarea name='room_description' maxlength='1500' placeholder='اتاقی جا دار و مناسب و با امکانات' required></textarea></p>
                        <ul class='add_info'>
                            <li> <a href='javascript:void(0);' class='tooltip-1 ' data-placement='top' title='وای فای رایگان'><i class='icon_set_1_icon-86'></i></a>
                                <input type='checkbox' class='rooms_checkbox' name='room_wifi' />
                            </li>
                            <li> <a href='javascript:void(0);' class='tooltip-1 ' data-placement='top' title='تلویزیون پلاسما با کانال های اچ دی'><i class='icon_set_2_icon-116'></i></a>
                                <input type='checkbox' class='rooms_checkbox' name='room_television' />
                            </li>
                            <li> <a href='javascript:void(0);' class='tooltip-1' 'data-placement='top' title='استخر شنا'><i class='icon_set_2_icon-110'></i></a>
                                <input type='checkbox' class='rooms_checkbox' name='room_pool' />
                            </li>
                            <li> <a href='javascript:void(0);' class='tooltip-1 'data-placement='top' title='مرکز تناسب اندام'><i class='icon_set_2_icon-117'></i></a>
                                <input type='checkbox' class='rooms_checkbox' name='room_gym' />
                            </li>
                            <li> <a href='javascript:void(0);' class='tooltip-1' 'data-placement='top' title='رستوران'><i class='icon_set_1_icon-58'></i></a>
                                <input type='checkbox' class='rooms_checkbox' name='room_food' />
                            </li>
                            <li> <a href='javascript:void(0);' class='tooltip-1' 'data-placement='top' title='رستوران'><i class='icon_set_1_icon-27'></i></a>
                                <input type='checkbox' class='rooms_checkbox' name='room_parking' />
                            </li>
                        </ul>
                    </div>
                </div>
                <div class='col-lg-2 col-md-2 col-sm-2'>
                    <div class='price_list'>
                        <div>
                            <sup>
                                <input type='text' name='room_main_price' maxlength='9' id="room_main_price" class='insert_input' placeholder='100000' required />  تومان</sup>
                            <span class='normal_price_list'>
                                <input type='text' name='room_off_price' maxlength='9' id="room_off_price" class='insert_input' placeholder='150000'  required /> تومان</span>
                            <small>روزانه / شبانه</small>
                            <span class="room_person_count">چند نفره<input name='room_person_count' minlength="1" id="room_person_count" maxlength="2"  placeholder="5" /></span>
                            <p>
                                <input type='submit' name='submit_create_room' class='submit_btn' value='Add Room' />
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php include("includes/footer.php"); ?>