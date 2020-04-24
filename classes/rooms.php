<?php
    require_once("initialize.php");
    class Rooms{
        //this is for table room_survey
        private $survey_id;
        private $survey; // TEXT
        private $room_quality; // TINYINT(1) 1-5
        private $room_price; // TINYINT(1) 1-5
        private $room_comfort; // TINYINT(1) 1-5
        private $survey_date; // DATE
        private $publish;
        //////////////////
        // this is for table rooms
        public $room_id;
        public $room_address;
        public $room_title; // VARCHAR(200) NOT NULL
        public $room_description; // TEXT NOT NULL
        public $room_score; // TINYINT(1)
        public $room_main_price; // VARCHAR(10) NOT NULL
        public $room_off_price; // VARCHAR(200) NOT NULL
        public $room_food; // BIT(1)
        public $room_gym; // BIT(1)
        public $room_pool; // BIT(1)
        public $room_television; // BIT(1)
        public $room_wifi; // BIT(1)
        public $room_image; // VARCHAR(200)
        public $room_person_count = 0; // TINYINT(1)
        private $username;
        private $user_id;

        // functions for display rooms
        public static function AllRooms(){
            global $database,$Functions;
            $sql = "SELECT * FROM rooms ORDER BY room_id DESC";
            $database->query("SET NAMES 'utf8'");
            $result = $database->query($sql);
            while ($rooms_rows = $database->fetch_array($result)){
                echo ("
                                <div class='strip_all_tour_list wow fadeIn' data-wow-delay='0.1s'>
                                <div class='row'>
                                    <div class='col-lg-4 col-md-4 col-sm-4'>
                                        <div class='wishlist'> <a class='tooltip_flip tooltip-effect-1' href='javascript:void(0);'>+<span class='tooltip-content-flip'><span class='tooltip-back'>علاقمند شدم</span></span></a>
                                        </div>
                                        <div class='img_list'>
                                            <a href='single_hotel.php?room_id={$database->escape_value($rooms_rows['room_id'])}'>
                                                <div class='ribbon top_rated'></div>
                                                <img src='"); self::select_room_image($rooms_rows['room_image']); echo("' alt='تی شین'>
                                                <div class='short_info'></div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class='clearfix visible-xs-block'></div>
                                    <div class='col-lg-6 col-md-6 col-sm-6'>
                                        <div class='tour_list_desc'>
                                        <h4 class='room_address'>{$database->escape_value($rooms_rows['room_address'])}</h4>
                                            <div class='score'>");
                                            echo(self::word_score($rooms_rows['room_score']));
                                            echo("<span>{$database->escape_value($rooms_rows['room_score'])}</span>
                                            </div>
                                            <div class='rating' style='background: white'>
                                            ");
                                            if($database->escape_value($rooms_rows['room_score']) == 1 || $database->escape_value($rooms_rows['room_score']) == 2){
                                                echo "<i class='icon-star voted'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i>";
                                            }else if($database->escape_value($rooms_rows['room_score']) == 3 || $database->escape_value($rooms_rows['room_score']) == 4){
                                                echo "<i class='icon-star voted'></i><i class='icon-star voted'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i>";
                                            }else if($database->escape_value($rooms_rows['room_score']) == 5 || $database->escape_value($rooms_rows['room_score']) == 6){
                                                echo "<i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i>";
                                            }else if($database->escape_value($rooms_rows['room_score']) == 7 || ($rooms_rows['room_score']) == 8){
                                                echo "<i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i></i><i class='icon-star-empty'></i>";
                                            }else if($database->escape_value($rooms_rows['room_score']) == 9 || $database->escape_value($rooms_rows['room_score']) == 10){
                                                echo "<i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i>";
                                            }else{
                                                return null;
                                            }
                                            echo ("
                                            </div>
                                            <h3>{$database->escape_value($rooms_rows['room_title'])}</h3>
                                            <p>");
                                            echo(substr(nl2br(htmlentities($rooms_rows['room_description'])),0,250)."...");
                                            echo("</p>
                                            <ul class='add_info'>
                                                <li> <a href='javascript:void(0);' class='tooltip-1 ");
                                            if($rooms_rows["room_wifi"] == 1){ echo 'rooms_checkbox';}
                                            echo("' data-placement='top' title='وای فای رایگان'><i class='icon_set_1_icon-86'></i></a>
                                                </li>
                                                <li> <a href='javascript:void(0);' class='tooltip-1 ");
                                            if($rooms_rows["room_television"] == 1){ echo 'rooms_checkbox';}
                                            echo("' data-placement='top' title='تلویزیون پلاسما با کانال های اچ دی'><i class='icon_set_2_icon-116'></i></a>
                                                </li>
                                                <li> <a href='javascript:void(0);' class='tooltip-1 ");
                                            if($rooms_rows["room_pool"] == 1){ echo 'rooms_checkbox';}
                                            echo("' data-placement='top' title='استخر شنا'><i class='icon_set_2_icon-110'></i></a>
                                                </li>
                                                <li> <a href='javascript:void(0);' class='tooltip-1 ");
                                            if($rooms_rows["room_gym"] == 1){ echo 'rooms_checkbox';}
                                            echo("' data-placement='top' title='مرکز تناسب اندام'><i class='icon_set_2_icon-117'></i></a>
                                                </li>
                                                <li> <a href='javascript:void(0);' class='tooltip-1 ");
                                            if($rooms_rows["room_food"] == 1){ echo 'rooms_checkbox';}
                                            echo("' data-placement='top' title='رستوران'><i class='icon_set_1_icon-58'></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class='col-lg-2 col-md-2 col-sm-2'>");
                                    if($rooms_rows['room_person_count'] != 0){ echo("<div class='room_person_count_show'>{$rooms_rows['room_person_count']} نفره</div>"); }
                                        echo("
                                        <div class='price_list'>
                                            <div>
                                            <sup>{$database->escape_value($rooms_rows['room_main_price'])} تومان</sup>
                                            <span class='normal_price_list'>{$database->escape_value($rooms_rows['room_off_price'])} تومان</span>
                                                                                       
                                            <small>روزانه / شبانه</small>
                                                <form action='single_hotel.php' method='post'>
                                                    <input name='room_id' type='hidden' value='"); echo($Functions->encrypt_id($rooms_rows['room_id'])); echo("' /> 
                                                    <p><input name='submit' class='food_details_submit' value='جزئیات' type='submit' /></p>
                                                </form> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ");

            }
        }

        // for panel display
        public function AllRooms_panel(){
            global $database,$Functions;
            $sql = "SELECT * FROM rooms ORDER BY room_id DESC";
            $database->query("SET NAMES 'utf8'");
            $result = $database->query($sql);
            while ($rooms_rows = $database->fetch_array($result)){
                echo ("
                
                                <div class='strip_all_tour_list wow fadeIn' id='rooms' data-wow-delay='0.1s'>
                                <div class='row'>
                                    <div class='col-lg-4 col-md-4 col-sm-4'>
                                        <div class='img_list'>
                                            <a href='rooms_edit.php'>
                                                    <div class='ribbon top_rated'></div>
                                                    <img src='../"); self::select_room_image($rooms_rows['room_image']); echo("' alt=''>
                                                    <div class='short_info'></div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class='clearfix visible-xs-block'></div>
                                    <div class='col-lg-6 col-md-6 col-sm-6'>
                                        <div class='tour_list_desc'>
                                            <div class='score'>");
                echo(self::word_score($rooms_rows['room_score']));
                echo("<span>{$database->escape_value($rooms_rows['room_score'])}</span>
                                            </div>
                                            <h3 class='room_address'>{$database->escape_value($rooms_rows['room_address'])}</h3>
                                            <div class='rating'>
                                            ");
                if( $database->escape_value($rooms_rows['room_score']) == 1 || $database->escape_value($rooms_rows['room_score']) == 2){
                    echo "<i class='icon-star voted'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i>";
                }else if($database->escape_value($rooms_rows['room_score']) == 3 || $database->escape_value($rooms_rows['room_score']) == 4){
                    echo "<i class='icon-star voted'></i><i class='icon-star voted'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i>";
                }else if($database->escape_value($rooms_rows['room_score']) == 5 || $database->escape_value($rooms_rows['room_score']) == 6){
                    echo "<i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i>";
                }else if($database->escape_value($rooms_rows['room_score']) == 7 || ($rooms_rows['room_score']) == 8){
                    echo "<i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i></i><i class='icon-star-empty'></i>";
                }else if($database->escape_value($rooms_rows['room_score']) == 9 || $database->escape_value($rooms_rows['room_score']) == 10){
                    echo "<i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i>";
                }else{
                    return null;
                }
                echo ("
                                            </div>
                                            <h3>{$database->escape_value($rooms_rows['room_title'])}</h3>
                                            <p>"); echo(substr(nl2br(htmlentities($rooms_rows['room_description'])),0,200)); echo("</p>
                                            <ul class='add_info'>
                                                    <li> <a href='javascript:void(0);' class='tooltip-1 ");
                if($rooms_rows['room_wifi'] == 1){ echo 'rooms_checkbox';}
                echo("' data-placement='top' title='وای فای رایگان'><i class='icon_set_1_icon-86'></i></a>
                                                </li>
                                                <li> <a href='javascript:void(0);' class='tooltip-1 ");
                if($rooms_rows['room_television'] == 1){ echo 'rooms_checkbox';}
                echo("' data-placement='top' title='تلویزیون پلاسما با کانال های اچ دی'><i class='icon_set_2_icon-116'></i></a>
                                                </li>
                                                <li> <a href='javascript:void(0);' class='tooltip-1 ");
                if($rooms_rows['room_pool'] == 1){ echo 'rooms_checkbox';}
                echo("' data-placement='top' title='استخر شنا'><i class='icon_set_2_icon-110'></i></a>
                                                </li>
                                                <li> <a href='javascript:void(0);' class='tooltip-1 ");
                if($rooms_rows['room_gym'] == 1){ echo 'rooms_checkbox';}
                echo("' data-placement='top' title='مرکز تناسب اندام'><i class='icon_set_2_icon-117'></i></a>
                                                </li>
                                                <li> <a href='javascript:void(0);' class='tooltip-1 ");
                if($rooms_rows['room_food'] == 1){ echo 'rooms_checkbox';}
                echo("' data-placement='top' title='رستوران'><i class='icon_set_1_icon-58'></i></a>
                                                </li>
                                            </ul><hr />
                                            <div id='comment-info'><span style='"); if($this->CountRoomComments($Functions->encrypt_id($rooms_rows['room_id'])) == 0){ echo 'background:red'; } echo("'>{$this->CountRoomComments($Functions->encrypt_id($rooms_rows['room_id']))}</span> : Comment </div>
                                        </div>
                                    </div>
                                    <div class='col-lg-2 col-md-2 col-sm-2'>");
                                    if($rooms_rows['room_person_count'] != 0){ echo("<div class='room_person_count_show'>{$rooms_rows['room_person_count']} نفره</div>"); }
                                        echo("
                                        <div class='price_list'>
                                            <div>
                                            <sup>{$database->escape_value($rooms_rows['room_main_price'])} تومان</sup>
                                            <span class='normal_price_list'>{$database->escape_value($rooms_rows['room_off_price'])} تومان</span>
                                            <small>روزانه / شبانه</small>
                                                <form action='rooms_edit.php' method='post'>
                                                    <input type='submit' name='submit_edit_room' value='Edit Room' class='submit_edit' />
                                                    <input type='hidden' name='room_id' value='");
                                                    echo($Functions->encrypt_id($rooms_rows['room_id']));
                                                    echo("' /> 
                                                </form>
                                                <form method='post' action='rooms_delete.php'>
                                                    <input type='submit' name='submit_delete_room' value='Delete' class='delete_room_btn' />
                                                    <input type='hidden' name='room_id' value='");
                                                    echo($Functions->encrypt_id($rooms_rows['room_id']));
                                                    echo("' />
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ");
            }
        }
        public function EditRoom_panel(){
            global $database,$Functions,$users;
            if (isset($_POST["submit_edit_room"]) && isset($_POST["room_id"])){
                if(preg_match("/^[0-9]*$/",$database->escape_value($Functions->decrypt_id($_POST["room_id"])))){
                    $this->room_id = $database->escape_value($Functions->decrypt_id($_POST["room_id"]));
                }else{
                    $users->redirect_to("rooms_show.php");
                }
            }
            $sql = "SELECT * FROM rooms WHERE room_id={$this->room_id}";
            $database->query("SET NAMES 'utf8'");
            $result = $database->query($sql);
            while ($rooms_rows = $database->fetch_array($result)){
                echo ("
                
                                <div id='rooms' class='strip_all_tour_list wow fadeIn' data-wow-delay='0.1s'>
                                <div class='row'>
                                    <div class='col-lg-4 col-md-4 col-sm-4'>
                                        <div class='img_list'>
                                                <div class='ribbon top_rated'></div>
                                                <img src='../"); self::select_room_image($rooms_rows['room_image']);
                $_SESSION["image_name"] = $rooms_rows["room_image"];
                echo("' alt=''>
                                                <div class='short_info'></div>
                                            </a>
                                        </div>
                                        <div class='add_photo'>Add Photo +<input type='file' name='roomImage' /></div>
                                        <input type='hidden' name='MAX_FILE_SIZE' value='5242880' />
                                    </div>
                                    <div class='clearfix visible-xs-block'></div>
                                    <div class='col-lg-6 col-md-6 col-sm-6'>
                                        <div class='tour_list_desc'>
                                            <div class='score'>");
                echo(self::word_score($rooms_rows['room_score']));
                echo("
                                            <select name='room_score'>
                                                <option {$Functions->auto_select(1,$rooms_rows['room_score'])}>1</option>
                                                <option {$Functions->auto_select(2,$rooms_rows['room_score'])}>2</option>
                                                <option {$Functions->auto_select(3,$rooms_rows['room_score'])}>3</option>
                                                <option {$Functions->auto_select(4,$rooms_rows['room_score'])}>4</option>
                                                <option {$Functions->auto_select(5,$rooms_rows['room_score'])}>5</option>
                                                <option {$Functions->auto_select(6,$rooms_rows['room_score'])}>6</option>
                                                <option {$Functions->auto_select(7,$rooms_rows['room_score'])}>7</option>
                                                <option {$Functions->auto_select(8,$rooms_rows['room_score'])}>8</option>
                                                <option {$Functions->auto_select(9,$rooms_rows['room_score'])}>9</option>
                                                <option {$Functions->auto_select(10,$rooms_rows['room_score'])}>10</option>          
                                            </select>
                                            </div>
                                            <h2><input type='text' class='room_address' style='background: white;' value='{$database->escape_value($rooms_rows['room_address'])}' name='room_address' placeholder='گرگان - خیابان مرادی' maxlength='400' required/></h2>
                                            <h3><input type='text' style='background: white;' value='{$database->escape_value($rooms_rows['room_title'])}' name='room_title' maxlength='200' required/></h3>
                                            <p><textarea name='room_description' maxlength='1500' required>"); echo($rooms_rows['room_description']); echo("</textarea></p>
                                            <ul class='add_info'>
                                                <li> <a href='javascript:void(0);' class='tooltip-1 ");
                if($rooms_rows['room_wifi'] == 1){ echo('rooms_checkbox'); }
                echo ("' data-placement='top' title='وای فای رایگان'><i class='icon_set_1_icon-86'></i></a>
                                                <input type='checkbox' class='rooms_checkbox' name='room_wifi' ");
                if($rooms_rows['room_wifi'] == 1){ echo('checked'); } echo(" />
                                                </li>
                                                <li> <a href='javascript:void(0);' class='tooltip-1 ");
                if($rooms_rows['room_television'] == 1){ echo('rooms_checkbox'); }
                echo("' data-placement='top' title='تلویزیون پلاسما با کانال های اچ دی'><i class='icon_set_2_icon-116'></i></a>
                                                <input type='checkbox' class='rooms_checkbox' name='room_television' ");
                if($rooms_rows['room_television'] == 1){ echo('checked'); } echo(" />
                                                </li>
                                                <li> <a href='javascript:void(0);' class='tooltip-1 ");
                if($rooms_rows['room_pool'] == 1){ echo('rooms_checkbox'); }
                echo("' data-placement='top' title='استخر شنا'><i class='icon_set_2_icon-110'></i></a>
                                                <input type='checkbox' class='rooms_checkbox' name='room_pool' ");
                if($rooms_rows['room_pool'] == 1){ echo('checked'); } echo(" />
                                                </li>
                                                <li> <a href='javascript:void(0);' class='tooltip-1 ");
                if($rooms_rows['room_gym'] == 1){ echo('rooms_checkbox'); }
                echo("'data-placement='top' title='مرکز تناسب اندام'><i class='icon_set_2_icon-117'></i></a>
                                                <input type='checkbox' class='rooms_checkbox' name='room_gym' ");
                if($rooms_rows['room_gym'] == 1){ echo('checked'); } echo(" />
                                                </li>
                                                <li> <a href='javascript:void(0);' class='tooltip-1 ");
                if($rooms_rows['room_food'] == 1){ echo('rooms_checkbox'); }
                echo("' data-placement='top' title='رستوران'><i class='icon_set_1_icon-58'></i></a>
                                                <input type='checkbox' class='rooms_checkbox' name='room_food' ");
                if($rooms_rows['room_food'] == 1){ echo('checked'); } echo(" />
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class='col-lg-2 col-md-2 col-sm-2'>
                                        <div class='price_list'>
                                            <div>
                                            <sup><input type='text' name='room_main_price' class='insert_input' maxlength='10' value='{$database->escape_value($rooms_rows['room_main_price'])}' required />  تومان</sup>
                                            <span class='normal_price_list'><input name='room_off_price' class='insert_input' maxlength='200' value='{$database->escape_value($rooms_rows['room_off_price'])}' required /> تومان</span>
                                            <span class='room_person_count'>چند نفره<input type='text' minlength='1' value='{$database->escape_value($rooms_rows['room_person_count'])}' id='tel' maxlength='2'  placeholder='5' name='room_person_count' /></span>
                                            <small>روزانه / شبانه</small>
                                                <p>
                                                    <input type='hidden' name='room_id' value='");
                                                    echo($Functions->encrypt_id($this->room_id));
                                                    echo("' />
                                                    <input type='submit' name='submit_last_edit_room' class='submit_btn' value='Submit Edit' />
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ");
            }
        }
        public function UpdateRoom(){
            global $database,$Functions,$users;
            if (isset($_POST["submit_last_edit_room"]) && isset($_POST["room_id"])){
                if(preg_match("/^[0-9]*$/",$database->escape_value($Functions->decrypt_id($_POST["room_id"])))){
                    $this->room_id = $database->escape_value($Functions->decrypt_id($_POST["room_id"]));
                }else{
                    $users->redirect_to("rooms_show.php");
                }
                if (isset($_POST['room_address']) && !empty($_POST['room_address'])){
                    $this->room_address = $database->escape_value($_POST['room_address']);
                }else{
                    $users->redirect_to("rooms_edit.php");
                    die();
                }
                $this->room_title = $database->escape_value($_POST["room_title"]);
                $this->room_description = $database->escape_value($_POST["room_description"]);
                if (empty($_POST["room_score"]) || $_POST["room_score"] == 0 || $_POST["room_score"] > 10) {
                    $this->room_score = 1;
                }else{
                    $this->room_score = $database->escape_value($_POST["room_score"]);
                }
                $this->room_main_price = $database->escape_value($_POST["room_main_price"]);
                $this->room_off_price = $database->escape_value($_POST["room_off_price"]);
                $this->room_off_price = nl2br($this->room_off_price);
                if (isset($_POST["room_wifi"])){ $this->room_wifi = 1; }else{ $this->room_wifi = 0; }
                if (isset($_POST["room_television"])){ $this->room_television = 1; }else{ $this->room_television = 0; }
                if (isset($_POST["room_pool"])){ $this->room_pool = 1; }else{ $this->room_pool = 0; }
                if (isset($_POST["room_food"])){ $this->room_food = 1; }else{ $this->room_food = 0; }
                if (isset($_POST["room_gym"])){ $this->room_gym = 1; }else{ $this->room_gym = 0; }
                $this->room_person_count = 0;
                if (!(empty($_POST["room_person_count"])) && isset($_POST["room_person_count"])){
                    if ((preg_match('/^[0-9]*$/', $_POST["room_person_count"])) && $_POST["room_person_count"] <= 127){
                        $this->room_person_count = $_POST["room_person_count"];
                    }
                    else{
                        $this->room_person_count = 0;
                    }
                }else{
                    $this->room_person_count = 0;
                }
                $Functions->photo_upload($_POST["submit_last_edit_room"]);
                $this->room_image = $Functions::$image_name;
                if (isset($_SESSION["image_exists_name"])){
                    $this->room_image = $_SESSION["image_exists_name"];
                }
                if ($this->room_image == '' || $this->room_image == null || empty($this->room_image)){
                    $this->room_image = $_SESSION["image_name"];
                }
                $this->room_image = $database->escape_value($this->room_image);
                $sql = "UPDATE rooms SET room_address='{$this->room_address}' , room_title='{$this->room_title}' , room_description='{$this->room_description}' , room_score={$this->room_score} , room_main_price='{$this->room_main_price}' , room_off_price='$this->room_off_price' , room_wifi={$this->room_wifi} , room_pool={$this->room_pool} , room_food={$this->room_food} , room_television={$this->room_television} , room_gym={$this->room_gym} , room_image='$this->room_image' , room_person_count={$this->room_person_count} WHERE room_id={$this->room_id}";
                $database->query("SET NAMES 'utf8'");
                $result = $database->query($sql);
                if ($result) {
                    $this->room_id = null;
                    unset($this->room_id);
                    $_SESSION["image_exists_name"] = null;
                    unset($_SESSION["image_exists_name"]);
                    unset($_SESSION["image_name"]);
                    $_SESSION["image_name"] = null;
                    $users->redirect_to("rooms_show.php");
                }
            }
        }
        public function InsertRoom(){
            global $database,$Functions,$users;
            if (isset($_POST["submit_create_room"])){
                if (isset($_POST["room_person_count"]) && !(empty($_POST["room_person_count"])) && $_POST["room_person_count"] != "" && preg_match('/^[0-9]*$/', $_POST["room_person_count"]) && $_POST["room_person_count"] <= 127){
                    $this->room_person_count = $_POST["room_person_count"];
                }else{
                    $this->room_person_count = 0;
                }
                if (isset($_POST['room_address']) && !empty($_POST['room_address'])){
                    $this->room_address = $database->escape_value($_POST['room_address']);
                }
                $Functions->photo_upload($_POST["submit_create_room"]);
                $this->room_title = $database->escape_value($_POST["room_title"]);
                $this->room_description = $database->escape_value($_POST["room_description"]);
                if (empty($_POST["room_score"]) || $_POST["room_score"] == 0 || $_POST["room_score"] > 10) {
                    $this->room_score = 1;
                }else{
                    $this->room_score = $database->escape_value($_POST["room_score"]);
                }
                $this->room_main_price = $database->escape_value($_POST["room_main_price"]);
                $this->room_off_price = $database->escape_value($_POST["room_off_price"]);
                $this->room_off_price = nl2br($this->room_off_price);
                if (isset($_POST["room_wifi"])){ $this->room_wifi = 1; }else{ $this->room_wifi = 0; }
                if (isset($_POST["room_television"])){ $this->room_television = 1; }else{ $this->room_television = 0; }
                if (isset($_POST["room_pool"])){ $this->room_pool = 1; }else{ $this->room_pool = 0; }
                if (isset($_POST["room_food"])){ $this->room_food = 1; }else{ $this->room_food = 0; }
                if (isset($_POST["room_gym"])){ $this->room_gym = 1; }else{ $this->room_gym = 0; }
                $sql = "INSERT INTO rooms(room_address,room_title,room_description,room_score,room_main_price,room_off_price,room_wifi,room_television,room_pool,room_food,room_gym,room_image,room_person_count)VALUES('{$this->room_address}','{$this->room_title}','{$this->room_description}',{$this->room_score},'{$this->room_main_price}','{$this->room_off_price}',{$this->room_wifi},{$this->room_television},{$this->room_pool},{$this->room_food},{$this->room_gym},'{$database->escape_value($Functions::$image_name)}',{$this->room_person_count})";
                $database->query("SET NAMES 'utf8'");
                $result = $database->query($sql);
                if ($result) {
                    $users->redirect_to("rooms_show.php");
                }else{
                    echo "مشکل در اضافه کردن اتاق";
                }
            }
        }
        public function DeleteRoom(){
            global $database,$Functions,$users;
            if (isset($_POST["submit_delete_room"]) && isset($_POST["room_id"])){
                if(preg_match("/^[0-9]*$/",$database->escape_value($Functions->decrypt_id($_POST["room_id"])))){
                    $this->room_id = $database->escape_value($Functions->decrypt_id($_POST["room_id"]));
                }else{
                    $users->redirect_to("rooms_show.php");
                }
                $AllResult = $this->SelectWithId($this->room_id);
            }
            if ($row = $database->fetch_array($AllResult)){
                $this->room_image = $row["room_image"];
            }
            if ($this->room_image != "default_room.jpg"){
                unlink("../img/rooms/".$this->room_image);
            }
            $this->DeleteRoomComments($this->room_id);
            $sql = "DELETE FROM rooms WHERE rooms.room_id = {$this->room_id} LIMIT 1";
            $result = $database->query($sql);
            if ($result){
                $users->redirect_to('rooms_show.php');
            }
        }
        public function CountRoom(){
            global $database;
            /*
            $sql = "SELECT COUNT(*) FROM rooms";
            $result = $database->query($sql);
            if($row = $database->fetch_array($result)){
                echo $row['COUNT(*)'];
            }
            */
            // OR
            $sql = "SELECT COUNT(*) AS room_count FROM rooms";
            $result = $database->query($sql);
            if($row = $database->fetch_array($result)){
                echo $row['room_count'];
            }
        }
        public function SelectWithId($id){
            global $database;
            $id = $database->escape_value($id);
            $sql = "SELECT * FROM rooms WHERE room_id ={$id}";
            $result = $database->query($sql);
            return $result;
        }


        // function for search
        public function SerachRoom(){
            global $database,$Functions,$users;
            if (isset($_POST["submit_search"]) && !(empty($_POST["keyword"]))) {
                $keyword = $database->escape_value($_POST['keyword']);
                if (isset($_POST["ByWitch"])){
                    switch ($_POST["ByWitch"]){
                        case 'Address':
                            $sql = "SELECT * FROM rooms WHERE room_address LIKE '%{$keyword}%'";
                            break;
                        case 'Title':
                            $sql = "SELECT * FROM rooms WHERE room_title LIKE '%{$keyword}%'";
                            break;
                        case 'Descript':
                            $sql = "SELECT * FROM rooms WHERE room_description LIKE '%{$keyword}%'";
                            break;
                        case 'Score':
                            $sql = "SELECT * FROM rooms WHERE room_score LIKE '{$keyword}'";
                            break;
                        case 'Price':
                            $sql = "SELECT * FROM rooms WHERE room_main_price LIKE '{$keyword}%'";
                            break;
                        case 'Off-Price':
                            $sql = "SELECT * FROM rooms WHERE room_off_price LIKE '{$keyword}%'";
                            break;
                        case 'Person':
                            $sql = "SELECT * FROM rooms WHERE room_person_count LIKE '{$keyword}'";
                            break;
                        default:
                            $sql = "SELECT * FROM rooms WHERE room_title LIKE '{$keyword}%'";
                            break;
                    }
                }
                $result = $database->query($sql);
                if ($database->num_rows($result) > 0) {
                    while ($rooms_rows = $database->fetch_array($result)) {
                        echo ("
                
                                <div class='strip_all_tour_list wow fadeIn' id='rooms' data-wow-delay='0.1s'>
                                <div class='row'>
                                    <div class='col-lg-4 col-md-4 col-sm-4'>
                                        <div class='img_list'>
                                            <a href='rooms_edit.php'>
                                                    <div class='ribbon top_rated'></div>
                                                    <img src='../"); self::select_room_image($rooms_rows['room_image']); echo("' alt=''>
                                                    <div class='short_info'></div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class='clearfix visible-xs-block'></div>
                                    <div class='col-lg-6 col-md-6 col-sm-6'>
                                        <div class='tour_list_desc'>
                                        <h3 class='room_address'>{$database->escape_value($rooms_rows['room_address'])}</h3>
                                            <div class='score'>");
                        echo(self::word_score($rooms_rows['room_score']));
                        echo("<span>{$database->escape_value($rooms_rows['room_score'])}</span>
                                            </div>
                                            <div class='rating'>
                                            ");
                        if( $database->escape_value($rooms_rows['room_score']) == 1 || $database->escape_value($rooms_rows['room_score']) == 2){
                            echo "<i class='icon-star voted'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i>";
                        }else if($database->escape_value($rooms_rows['room_score']) == 3 || $database->escape_value($rooms_rows['room_score']) == 4){
                            echo "<i class='icon-star voted'></i><i class='icon-star voted'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i>";
                        }else if($database->escape_value($rooms_rows['room_score']) == 5 || $database->escape_value($rooms_rows['room_score']) == 6){
                            echo "<i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i>";
                        }else if($database->escape_value($rooms_rows['room_score']) == 7 || ($rooms_rows['room_score']) == 8){
                            echo "<i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i></i><i class='icon-star-empty'></i>";
                        }else if($database->escape_value($rooms_rows['room_score']) == 9 || $database->escape_value($rooms_rows['room_score']) == 10){
                            echo "<i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i>";
                        }else{
                            return null;
                        }
                        echo ("
                                            </div>
                                            <h3>{$database->escape_value($rooms_rows['room_title'])}</h3>
                                            <p>"); echo(nl2br(htmlentities($rooms_rows['room_description']))); echo("</p>
                                            <ul class='add_info'>
                                                    <li> <a href='javascript:void(0);' class='tooltip-1 ");
                        if($rooms_rows['room_wifi'] == 1){ echo 'rooms_checkbox';}
                        echo("' data-placement='top' title='وای فای رایگان'><i class='icon_set_1_icon-86'></i></a>
                                                </li>
                                                <li> <a href='javascript:void(0);' class='tooltip-1 ");
                        if($rooms_rows['room_television'] == 1){ echo 'rooms_checkbox';}
                        echo("' data-placement='top' title='تلویزیون پلاسما با کانال های اچ دی'><i class='icon_set_2_icon-116'></i></a>
                                                </li>
                                                <li> <a href='javascript:void(0);' class='tooltip-1 ");
                        if($rooms_rows['room_pool'] == 1){ echo 'rooms_checkbox';}
                        echo("' data-placement='top' title='استخر شنا'><i class='icon_set_2_icon-110'></i></a>
                                                </li>
                                                <li> <a href='javascript:void(0);' class='tooltip-1 ");
                        if($rooms_rows['room_gym'] == 1){ echo 'rooms_checkbox';}
                        echo("' data-placement='top' title='مرکز تناسب اندام'><i class='icon_set_2_icon-117'></i></a>
                                                </li>
                                                <li> <a href='javascript:void(0);' class='tooltip-1 ");
                        if($rooms_rows['room_food'] == 1){ echo 'rooms_checkbox';}
                        echo("' data-placement='top' title='رستوران'><i class='icon_set_1_icon-58'></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class='col-lg-2 col-md-2 col-sm-2'>");
                                    if($rooms_rows['room_person_count'] != 0){ echo("<div class='room_person_count_show'>{$rooms_rows['room_person_count']}</div>"); }
                                        echo("
                                        <div class='price_list'>
                                            <div>
                                            <sup>{$database->escape_value($rooms_rows['room_main_price'])} تومان</sup>
                                            <span class='normal_price_list'>{$database->escape_value($rooms_rows['room_off_price'])} تومان</span>                                            <small>روزانه / شبانه</small>
                                                <form action='rooms_edit.php' method='post'>
                                                    <input type='submit' name='submit_edit_room' value='Edit Room' class='submit_edit' />
                                                    <input type='hidden' name='room_id' value='");
                        echo($Functions->encrypt_id($rooms_rows['room_id']));
                        echo("' /> 
                                                </form>
                                                <form method='post' action='rooms_delete.php'>
                                                    <input type='submit' name='submit_delete_room' value='Delete' class='delete_room_btn' />
                                                    <input type='hidden' name='room_id' value='");
                        echo($Functions->encrypt_id($rooms_rows['room_id']));
                        echo("' />
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ");
                    }
                }else { echo "<h1 class='no-result'>No Result !</h1>"; }

            }else{
                $users->redirect_to("rooms_show.php");
            }
        }

        // functions for rooms
        public function word_score($room_score){
                if($room_score == 1 || $room_score == 2) { return 'قابل قبول'; }
                else if ($room_score == 3 || $room_score == 4){ return 'متوسط'; }
                else if ($room_score == 5 || $room_score == 6){ return 'خوب'; }
                else if ($room_score == 7 || $room_score == 8){ return 'خیلی خوب'; }
                else if ($room_score == 9 || $room_score == 10){ return 'عالی'; }
        }

        public static function RoomAttributeById($id){
            global $database,$Functions;
            $id = $Functions->decrypt_id($id);
            $id = $database->escape_value($id);
            $sql = "SELECT * FROM rooms WHERE room_id={$id} ";
            $database->query("SET NAMES 'utf8'");
            $result = $database->query($sql);

            return $rooms_row = $database->fetch_array($result);
        }
        public function select_room_image($rooms_rows){
            global $database,$Functions;
            if(!(empty($rooms_rows))){
                echo 'img/rooms/'.$database->escape_value($rooms_rows);
            }else{
                echo 'img/rooms/default_room.jpg';
            }
        }
        // for single_hotel.php
        public function select_single_hotel_image($rooms_rows){
            global $database;
            if(!(empty($rooms_rows))){
                echo 'img/rooms/'.$database->escape_value($rooms_rows);
            }else{
                echo 'img/rooms/single_hotel_default.jpg';
            }
        }


        /////////////////////////////////////////////////////////////////////////////////////////
        // functions for Rooms Survay////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////////
        // this function is for Insert Comment for Room Review
        public function SelectRoomComments(){
            global $database,$Functions;
            if(isset($_POST["submit_publish"]) && isset($_POST["select_publish"]) && !(empty($_POST["select_publish"]))){
                switch($_POST["select_publish"]){
                    case "unpublished":
                        $sql = "SELECT * FROM room_survey WHERE publish = 0 ORDER BY id DESC";
                        $result = $database->query($sql);
                        $publish_mode = "unpublished";
                        return array($result,$publish_mode);
                        break;
                    case "published":
                        $sql = "SELECT * FROM room_survey WHERE publish = 1 ORDER BY id DESC";
                        $result = $database->query($sql);
                        $publish_mode = "published";
                        return array($result,$publish_mode);
                        break;
                    default:
                        $sql = "SELECT * FROM room_survey WHERE publish = 0 ORDER BY id DESC";
                        $result = $database->query($sql);
                        $publish_mode = "unpublished";
                        return array($result,$publish_mode);
                        break;
                }
            }else{
                $sql = "SELECT * FROM room_survey WHERE publish = 0 ORDER BY id DESC";
                $result = $database->query($sql);
                $publish_mode = "unpublished";
                return array($result,$publish_mode);
            }
        }

        public function EditCommentPanel(){
            global $users,$Functions,$database;
            if (isset($_POST["survey_id"]) && !empty($_POST["survey_id"])){
                $this->survey_id = $Functions->decrypt_id($_POST["survey_id"]);
                $sql = "SELECT * FROM room_survey WHERE id = {$this->survey_id}";
                $result = $database->query($sql);
                if ($room_survey = $database->fetch_array($result)){
                    echo("
                    <h1 class='comment-edit-h'>Comment Edit</h1>
                    <div class='comment-panel-edit col-xs-12 col-sm-12 col-md-6 col-lg-6' "); if($room_survey['publish'] == 1){ echo("style='border: 2px solid green;padding: 16px;'"); }else{ echo("style='border: 2px solid red;padding: 16px;'"); }  echo(">
                        ");
                    if ($users_row = $database->fetch_array($users->SelectById($room_survey['user_id']))) {
                        echo("<img class='finger-img' "); if($room_survey['publish'] == 1){ echo("style='border: 4px solid green;'"); }else{ echo("style='border: 4px solid red;'"); }  echo("  id='finger-img-panel-comment' src='"); Users::select_user_image($users_row['user_image']); echo("' alt='' class='img-circle'>");
                    }
                    $divid_date_time = $Functions->divid_date_time_database($room_survey['survey_date']);
                    echo("
                        <h4 id='username-panel-comment'>{$room_survey['username']}</h4><br />");
                    echo("<blockquote style='float: left;'>ID : (<span style='color: #00A8FF;font-weight: bold;'>{$users_row['id']}</span>)</blockquote>");
                    echo("<blockquote style='float: left;'>Tel : (<span style='color: #00A8FF;font-weight: bold;'>{$users_row['tel']}</span>)</blockquote>");
                    if ($rooms_rows = $database->fetch_array($this->SelectWithId($room_survey['room_id']))){
                        echo("<h4 style='display: inline-block' class='room_address'>{$database->escape_value($rooms_rows['room_address'])}</h4><h3 style='display: inline-block'>&nbsp;|&nbsp;</h3> 
                                            <h5 style='display: inline-block'>{$database->escape_value($rooms_rows['room_title'])}</h5>");
                    }
                    echo("
                    <br />
                    <form action='{$_SERVER['PHP_SELF']}' id='submit-edit-form' method='post'>
                                <input type='hidden' name='survey_id' value='"); echo($Functions->encrypt_id($room_survey['id'])); echo("' />
                                <textarea name='survey' class='survey-edit'>"); echo($room_survey['survey']); echo("</textarea><br />
                                <input type='submit' name='edit_user_comment_submit' style='width: 70px;margin-top: 7px;margin-bottom: 7px;;' value='Edit' class='edit-comment-panel-btn' />
                    </form>
                    <div id='panel-rating-comment' class='rating'> {$this->smile_voted_by_price_quality_score_comfort($room_survey['room_price'],$room_survey['room_quality'],$room_survey['room_score'],$room_survey['room_comfort'])}
                        </div>
                        
                        <small class='icon-clock-8' id='panel-time-comment'>&nbsp;"); echo $divid_date_time[0]; echo("</small>
                        <small id='panel-date-comment'>"); echo $divid_date_time[1]; echo("</small><br /><br />
                    <div class='comment-panel-btns col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                        <form action='../single_hotel.php' id='see-room' method='post'>
                            <input type='hidden' name='room_id' value='"); echo($Functions->encrypt_id($room_survey['room_id'])); echo("' />
                            <input type='submit' name='submit' id='see-room-btn' class='submit_edit' value='See Room' />
                        </form>
                        <form action='{$_SERVER['PHP_SELF']}' id='submit-checkbox-form' method='post'>
                            <input type='hidden' name='survey_id' value='"); echo($Functions->encrypt_id($room_survey['id'])); echo("' />
                            <div class='publish-area'>");                                if($room_survey["publish"] == 0) {
                                    echo("<input type='submit' name='publish_submit' id='publish_checkbox_submit' class='submit_edit' value='Publish' />");
                                }
                                if($room_survey["publish"] == 1) {
                                    echo("<input type='submit' name='unpublish_submit' id='unpublish_checkbox_submit' class='submit_edit' value='X  Un Publish' />");
                                }
                                echo("
                                
                            </div>
                            <input type='submit' name='delete_user_comment' value='Delete' class='comments_delete_btn delete_room_btn' />
                        </form>
                        <div class='line'></div>
                    </div>
                    </div>

                    ");
                }
            }else{
                $users->redirect_to("comments_show.php");
            }
        }
        public function EditComment(){
            global $users,$database,$Functions;
            if (isset($_POST["edit_user_comment_submit"]) && !empty($_POST['survey_id']) && isset($_POST['survey_id'])){
                $this->survey_id = $Functions->decrypt_id($_POST["survey_id"]);
                $this->survey_id = $database->escape_value($this->survey_id);
                if (isset($_POST["survey"])){
                    $this->survey = $database->escape_value($_POST["survey"]);
                    $sql = "UPDATE room_survey SET survey = '{$this->survey}' WHERE id = {$this->survey_id}";
                    $result = $database->query($sql);
                    if (!$result){
                        $_SESSION["errors_message"] .= "مشکلی در ویرایش کامنت رخ داد .";
                        $this->error_state = 1;
                        return $this->error_state;
                        $users->redirect_to("comments_show.php");
                    }
                }else{
                    $users->redirect_to("comments_show.php");
                }
            }
        }
        public function InsertComment($room_id){
            global $sessions,$Functions,$database,$users;
            if (isset($_POST["review_submit"])){
                if ($sessions->login_state()) {
                    if (isset($_POST["room_score_review"]) && !(empty($_POST["room_score_review"])) && isset($_POST["room_comfort_review"]) && !(empty($_POST["room_comfort_review"])) && isset($_POST["room_price_review"]) && !(empty($_POST["room_price_review"])) && isset($_POST["room_quality_review"]) && !(empty($_POST["room_quality_review"])) && isset($_POST["room_text_review"]) && !(empty($_POST["room_text_review"])) && isset($_POST["random_captcha_code"]) && !(empty($_POST["random_captcha_code"]))){
                        if($_POST["random_captcha_code"] != $_SESSION["random_captcha_code"]){
                            $_SESSION["errors_message"] .= "کد کپچا نادرست وارد شده .";
                            $users->redirect_to("single_hotel.php");
                        }else{
                            switch ($_POST["room_score_review"]){
                                case 1: $room_score_review = $_POST["room_score_review"]; break;
                                case 2: $room_score_review = $_POST["room_score_review"]; break;
                                case 3: $room_score_review = $_POST["room_score_review"]; break;
                                case 4: $room_score_review = $_POST["room_score_review"]; break;
                                case 5: $room_score_review = $_POST["room_score_review"]; break;
                                case 6: $room_score_review = $_POST["room_score_review"]; break;
                                case 7: $room_score_review = $_POST["room_score_review"]; break;
                                case 8: $room_score_review = $_POST["room_score_review"]; break;
                                case 9: $room_score_review = $_POST["room_score_review"]; break;
                                case 10: $room_score_review = $_POST["room_score_review"]; break;
                                default: $_SESSION["errors_message"] .= "مشکلی در نادرست وارد کردن فیلد ."; $users->redirect_to("single_hotel.php"); break;
                            }

                            switch ($_POST["room_comfort_review"]){
                                case 13: $room_comfort_review = 0; break;
                                case 1: $room_comfort_review = $_POST["room_comfort_review"]; break;
                                case 2: $room_comfort_review = $_POST["room_comfort_review"]; break;
                                case 3: $room_comfort_review = $_POST["room_comfort_review"]; break;
                                case 4: $room_comfort_review = $_POST["room_comfort_review"]; break;
                                case 5: $room_comfort_review = $_POST["room_comfort_review"]; break;
                                default: $_SESSION["errors_message"] .= "مشکلی در نادرست وارد کردن فیلد ."; $users->redirect_to("single_hotel.php"); break;
                            }
                            switch ($_POST["room_price_review"]){
                                case 13: $room_price_review = 0; break;
                                case 1: $room_price_review = $_POST["room_price_review"]; break;
                                case 2: $room_price_review = $_POST["room_price_review"]; break;
                                case 3: $room_price_review = $_POST["room_price_review"]; break;
                                case 4: $room_price_review = $_POST["room_price_review"]; break;
                                case 5: $room_price_review = $_POST["room_price_review"]; break;
                                default: $_SESSION["errors_message"] .= "مشکلی در نادرست وارد کردن فیلد ."; $users->redirect_to("single_hotel.php"); break;
                            }
                            switch ($_POST["room_quality_review"]){
                                case 13: $room_quality_review = 0; break;
                                case 1: $room_quality_review = $_POST["room_quality_review"]; break;
                                case 2: $room_quality_review = $_POST["room_quality_review"]; break;
                                case 3: $room_quality_review = $_POST["room_quality_review"]; break;
                                case 4: $room_quality_review = $_POST["room_quality_review"]; break;
                                case 5: $room_quality_review = $_POST["room_quality_review"]; break;
                                default: $_SESSION["errors_message"] .= "مشکلی در نادرست وارد کردن فیلد ."; $users->redirect_to("single_hotel.php"); break;
                            }
                            $room_score_review = $database->escape_value($room_score_review);
                            $room_comfort_review = $database->escape_value($room_comfort_review);
                            $room_price_review = $database->escape_value($room_price_review);
                            $room_quality_review = $database->escape_value($room_quality_review);
                            $room_text_review = $_POST["room_text_review"];
                            $room_text_review = $database->escape_value($room_text_review);
                            $room_text_review = nl2br($room_text_review);
                            $this->room_id = $database->escape_value($Functions->decrypt_id($room_id));
                            $this->user_id = $database->escape_value($_SESSION["user_id"]);
                            $this->username = $database->escape_value($_SESSION["username"]);
                            $this->survey = $room_text_review;
                            $this->room_score = $room_score_review;
                            $this->room_quality = $room_quality_review;
                            $this->room_price = $room_price_review;
                            $this->room_comfort = $room_comfort_review;
                            $this->survey_date = strftime("%Y-%m-%d %H:%M:%S",time());
                            $sql = "INSERT INTO room_survey(room_id,user_id,username,survey,room_score,room_quality,room_price,room_comfort,publish,survey_date)
                                VALUES(
                                $this->room_id,
                                $this->user_id,
                                '{$this->username}',
                                '{$this->survey}',
                                $this->room_score,
                                $this->room_quality,
                                $this->room_price,
                                $this->room_comfort,
                                0,
                                '{$this->survey_date}')";
                            $database->query("SET NAMES 'utf8'");
                            $result = $database->query($sql);
                            if ($result){
                                $_SESSION["errors_message"] .= "نظر شما با موفقیت در صف انتظار است .";
                                $users->redirect_to("single_hotel.php");
                            }else{
                                $_SESSION["errors_message"] .= "خطایی رخ داد .";
                            }

                        }
                    }else{
                        $_SESSION["errors_message"] .= "برخی از فیلد ها خالیست یا انتخاب نشده .";
                    }
                }else{
                    $_SESSION["errors_message"] .= "برای درج نظر بایستی به حساب کاربری خود وارد شوید یا حسابی بسازید .";
                }
            }else{
                $users->redirect_to("all_hotels_list.php");
            }
        }
        public function CountAllRoomComments(){
            global $database;

            $sql = "SELECT COUNT(*) AS all_comments_count FROM room_survey";
            $result = $database->query($sql);
            if($row = $database->fetch_array($result)){
                echo $row['all_comments_count'];
            }
        }
        public function DeleteRoomComments($room_id){
            global $database;
            $room_id = $database->escape_value($room_id);
            $sql = "DELETE FROM room_survey WHERE room_survey.room_id = {$room_id}";
            $result = $database->query($sql);
            if(!$result){
                $_SESSION["errors_message"] = "خطا در حذف نظرات اتاق";
            }
        }
        public function CountRoomComments($room_id){
            global $database,$Functions;
            $room_id = $Functions->decrypt_id($room_id);
            $sql = "SELECT COUNT(*) AS comments_count FROM room_survey WHERE room_id={$room_id}";
            $result = $database->query($sql);
            if($row = $database->fetch_array($result)){
                return $row['comments_count'];
            }
        }
        // for panel
        public function CountPublishAndUnPublishRoomCommentsPanel($publish_mode){
            global $database;
            $sql = "SELECT COUNT(*) AS comments_count FROM room_survey WHERE publish={$publish_mode}";
            $result = $database->query($sql);
            if($row = $database->fetch_array($result)){
                return $row['comments_count'];
            }
        }

        public function PublishComment(){
            global $database,$Functions;
            if(isset($_POST["publish_submit"]) && isset($_POST["survey_id"]) && !(empty($_POST["survey_id"]))) {
                $this->survey_id = $Functions->decrypt_id($_POST["survey_id"]);
                    $sql = "UPDATE room_survey SET publish=1 WHERE id = {$this->survey_id}";
                    $result = $database->query($sql);
                    if (!$result){
                        $_SESSION["errors_message"] .= "مشکلی در انتشار کامنت رخ داد .";
                        $this->error_state = 1;
                        return $this->error_state;
                    }
            }
        }
        public function UnPublishComment(){
            global $database,$Functions;
            if(isset($_POST["unpublish_submit"]) && isset($_POST["survey_id"]) && !(empty($_POST["survey_id"]))) {
                $this->survey_id = $Functions->decrypt_id($_POST["survey_id"]);
                    $sql = "UPDATE room_survey SET publish=0 WHERE id = {$this->survey_id}";
                    $result = $database->query($sql);
                    if (!$result){
                        $_SESSION["errors_message"] .= "مشکلی در عدم انتشار کامنت رخ داد .";
                        $this->error_state = 1;
                        return $this->error_state;
                    }
            }
        }
        public function PublishAllComments(){
            global $database;
            if(isset($_POST["publish_all_submit"])) {
                $sql = "UPDATE room_survey SET publish=1";
                $result = $database->query($sql);
                if (!$result){
                    $_SESSION["errors_message"] .= "مشکلی در انتشار همه ی کامنتها رخ داد .";
                    $this->error_state = 1;
                    return $this->error_state;
                }
            }
        }
        public function UnPublishAllComments(){
            global $database;
            if(isset($_POST["unpublish_all_submit"])) {
                $sql = "UPDATE room_survey SET publish=0";
                $result = $database->query($sql);
                if (!$result){
                    $_SESSION["errors_message"] .= "مشکلی در عدم انتشار کامنت رخ داد .";
                    $this->error_state = 1;
                    return $this->error_state;
                }
            }
        }

        public function DeleteUserComment(){
            global $database,$users,$Functions;
            if (isset($_POST["delete_user_comment"]) && isset($_POST["survey_id"]) && !(empty($_POST["survey_id"]))){
                $this->survey_id = $Functions->decrypt_id($_POST["survey_id"]);
                $sql = "DELETE FROM room_survey WHERE room_survey.id = {$this->survey_id} LIMIT 1";
                $result = $database->query($sql);
                if($result){
                    $users->redirect_to($_SERVER['PHP_SELF']);
                }
            }
        }
        public function DeleteAllCommentsPublished(){
            global $database,$users;
            if (isset($_POST["delete_all_comment_published_submit"])){
                $sql = "DELETE FROM room_survey WHERE publish=1";
                $result = $database->query($sql);
                if(!$result){
                    $_SESSION["errors_message"] .= "مشکلی در حذف کامنت های منتشر شده به وجود آمده .";
                    $this->error_state = 1;
                    return $this->error_state;
                }
            }
        }
        public function DeleteAllCommentsUnPublished(){
                global $database,$users;
                if (isset($_POST["delete_all_comment_unpublished_submit"])){
                    $sql = "DELETE FROM room_survey WHERE publish=0";
                    $result = $database->query($sql);
                    if(!$result){
                        $_SESSION["errors_message"] .= "مشکلی در حذف کامنت های منتشر نشده به وجود آمده .";
                        $this->error_state = 1;
                        return $this->error_state;
                    }
                }
        }


        public function CommentsSearch(){
            global $database,$users,$Functions;
            if (isset($_POST['submit_search']) && !(empty($_POST['keyword']))) {
                $keyword = $database->escape_value($_POST['keyword']);
                if (isset($_POST['ByWitch'])) {
                    switch ($_POST['ByWitch']) {
                        case 'user_id':
                            $sql = "SELECT * FROM room_survey WHERE user_id LIKE '{$keyword}'";
                            break;
                        case 'username':
                            $sql = "SELECT * FROM users WHERE username LIKE '%{$keyword}%'";
                            break;
                        case 'tel':
                            $sql = "SELECT * FROM users WHERE tel LIKE '{$keyword}'";
                            break;
                        case 'address':
                            $sql = "SELECT * FROM rooms WHERE room_address LIKE '%{$keyword}%' ";
                            break;
                        case 'title':
                            $sql = "SELECT * FROM rooms WHERE room_title LIKE '%{$keyword}%'";
                            break;
                        case 'survey':
                            $sql = "SELECT * FROM room_survey WHERE survey LIKE '%{$keyword}%'";
                            break;
                        case 'score':
                            $sql = "SELECT * FROM rooms WHERE room_score LIKE '{$keyword}'";
                            break;
                        case 'date':
                            $sql = "SELECT * FROM room_survey WHERE survey_date LIKE '{$keyword}%'";
                            break;
                        default:
                            $users->redirect_to($_SERVER['PHP_SELF']);
                            break;
                    }
                }
            }
        }
        // for single_hotel page
        public function SelectUserRoomComments($room_id){
            global $database,$Functions;
            $this->room_id = $Functions->decrypt_id($room_id);
            $sql = "SELECT * FROM room_survey WHERE room_id={$this->room_id} AND publish=1";
            $result = $database->query($sql);
            return $result;
        }
        public function CountPublishRoomComments($room_id){
            global $database,$Functions;
            $room_id = $Functions->decrypt_id($room_id);
            $sql = "SELECT COUNT(*) AS comments_count FROM room_survey WHERE room_id={$room_id} AND publish=1";
            $result = $database->query($sql);
            if($row = $database->fetch_array($result)){
                return $row['comments_count'];
            }
        }
        public function smile_voted_by_num($num){
            switch ($num) {
                case 1:
                    return "<i class='icon-smile voted'></i><i class='icon-smile'></i><i class='icon-smile'></i><i class='icon-smile'></i><i class='icon-smile'></i>";
                    break;
                case 2:
                    return "<i class='icon-smile voted'></i><i class='icon-smile voted'></i><i class='icon-smile'></i><i class='icon-smile'></i><i class='icon-smile'></i>";
                    break;
                case 3:
                    return "<i class='icon-smile voted'></i><i class='icon-smile voted'></i><i class='icon-smile voted'></i><i class='icon-smile'></i><i class='icon-smile'></i>";
                    break;
                case 4:
                    return "<i class='icon-smile voted'></i><i class='icon-smile voted'></i><i class='icon-smile voted'></i><i class='icon-smile voted'></i><i class='icon-smile'></i>";
                    break;
                case 5:
                    return "<i class='icon-smile voted'></i><i class='icon-smile voted'></i><i class='icon-smile voted'></i><i class='icon-smile voted'></i><i class='icon-smile voted'></i>";
                    break;
                case 13:
                    return "<i class='icon-smile'></i><i class='icon-smile'></i><i class='icon-smile'></i><i class='icon-smile'></i><i class='icon-smile'></i>";
                    break;
                default:
                    return null;
                    break;
            }
        }
        public function avg_room_attr($room_id,$room_attr){
            global $database,$users,$Functions;
            $room_id = $Functions->decrypt_id($room_id);
            $room_attr = $users->mytrim($room_attr);
            $room_attr = $database->escape_value($room_attr);
            $sql = "SELECT AVG({$room_attr}) AS {$room_attr} FROM room_survey WHERE room_id={$room_id} AND publish=1";
            $result = $database->query($sql);
            if($row = $database->fetch_array($result)){
                echo $this->smile_voted_by_num(round($row[$room_attr]));
            }
        }
        public function avg_room_score($room_id){
            global $database,$Functions;
            $room_id = $Functions->decrypt_id($room_id);
            $sql = "SELECT AVG(room_score) AS room_score_avg FROM room_survey WHERE room_id={$room_id} AND publish=1";
            $result = $database->query($sql);
            if($row = $database->fetch_array($result)){
                return $this->smile_voted_by_num(round($row['room_score_avg']/2));
            }
        }
        //for panel
        public function smile_voted_by_price_quality_score_comfort($price,$quality,$score,$comfort){
            global $database;
            $this->room_price = $database->escape_value($price);
            $this->room_quality = $database->escape_value($quality);
            $this->room_score = $database->escape_value($score);
            $this->room_comfort = $database->escape_value($comfort);
            // convert score from 10 to 5 or low then
            $this->room_score = (round($this->room_score)/2);
            $room_spec_avg = round(($this->room_price+$this->room_quality+$this->room_score+$this->room_comfort)/4);
            switch ($room_spec_avg){
                case 0: return "<i class='icon-smile rotateIn'></i><i class='icon-smile'></i><i class='icon-smile'></i><i class='icon-smile'></i><i class='icon-smile'></i>"; break;
                case 1: return "<i class='icon-smile voted'></i><i class='icon-smile'></i><i class='icon-smile'></i><i class='icon-smile'></i><i class='icon-smile'></i>"; break;
                case 2: return "<i class='icon-smile voted'></i><i class='icon-smile voted'></i><i class='icon-smile'></i><i class='icon-smile'></i><i class='icon-smile'></i>"; break;
                case 3: return "<i class='icon-smile voted'></i><i class='icon-smile voted'></i><i class='icon-smile voted'></i><i class='icon-smile'></i><i class='icon-smile'></i>"; break;
                case 4: return "<i class='icon-smile voted'></i><i class='icon-smile voted'></i><i class='icon-smile voted'></i><i class='icon-smile voted'></i><i class='icon-smile'></i>"; break;
                case 5: return "<i class='icon-smile voted'></i><i class='icon-smile voted'></i><i class='icon-smile voted'></i><i class='icon-smile voted'></i><i class='icon-smile voted'></i>"; break;

            }
        }
    }
    $rooms = new Rooms();
?>