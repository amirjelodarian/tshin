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
        // this is for table room_reservation
        private $reserve_id;
        /////////////////////////////////////
        // this is for table rooms
        public $room_id;
        public $room_address;
        public $room_title; // VARCHAR(200) NOT NULL
        public $room_description; // TEXT NOT NULL
        public $room_score; // TINYINT(1)
        public $room_main_price; // INT(9) NULL
        public $room_off_price; // INT(9) NULL
        public $room_food; // BIT(1)
        public $room_gym; // BIT(1)
        public $room_pool; // BIT(1)
        public $room_television; // BIT(1)
        public $room_wifi; // BIT(1)
        public $room_parking; // BIT(1)
        public $room_image; // VARCHAR(200)
        public $room_person_count = 0; // TINYINT(1)
        public static $all_room_days = array();
        public static $room_days_reserved = array();
        private $username;
        private $user_id;

        public function __construct()
        {
            $this->AutoBookedReservations();
        }

        // functions for display rooms
        public static function AllRooms($grid = ""){
            global $database,$Functions;
            $sql = "SELECT * FROM rooms ORDER BY room_id DESC";
            $database->query("SET NAMES 'utf8'");
            $result = $database->query($sql);
            while ($rooms_rows = $database->fetch_array($result)){
                if (isset($grid) && $grid == true){
                    echo("
                            <div class='col-md-6 col-sm-6 wow zoomIn' data-wow-delay='0.1s'>
                                <div class='hotel_container'>
                                    <div class='img_container'>
                                        <a href='Room.php?roomId={$Functions->encrypt_id($rooms_rows['room_id'])}'>
                                            <img src='"); self::select_room_image($rooms_rows['room_image']); echo("' width='800' height='533' class='img-responsive' alt='تی شین'>
                                            <div class='ribbon top_rated'></div>
                                        </a>");
                    if($rooms_rows['room_person_count'] != 0){ echo("<div class='room_person_count_show' id='room_person_count_grid_show'>{$rooms_rows['room_person_count']} نفره</div>"); }
                                            echo("<div class='score'>");
                    echo(self::word_score($rooms_rows['room_score']));
                    echo("<span>{$database->escape_value($Functions->EN_numTo_FA($rooms_rows['room_score'], true))}</span>
                                            </div>
                                            <div class='short_info hotel'>{$database->escape_value($rooms_rows['room_address'])}<span class='price'><sup>{$Functions->EN_numTo_FA($Functions->insert_seperator($rooms_rows['room_main_price']),true)} تومان</sup></span></div>
                                    </div>
                                    <div class='hotel_title'>
                                        <h3>{$database->escape_value($rooms_rows['room_title'])}</h3>
                                        <div class='rating'>
                                        ");
                    echo($Functions->give_start_by_number($rooms_rows['room_score']));
                    echo ("
                                        </div>
                                        <div class='wishlist'> <a class='tooltip_flip tooltip-effect-1' href='#'>+<span class='tooltip-content-flip'><span class='tooltip-back'>علاقمند شدم</span></span></a>
                                        </div>
                                        <a href='Room.php?roomId={$Functions->encrypt_id($rooms_rows['room_id'])}'> 
                                            <p class='food_details_submit text-center'>جزئیات</p>
                                        </a> 
                                    </div>
                                </div>
                            </div>
                    ");
                }else{
                    echo ("
                                <div class='strip_all_tour_list wow fadeIn' data-wow-delay='0.1s'>
                                <div class='row'>
                                    <div class='col-lg-4 col-md-4 col-sm-4'>
                                        <div class='wishlist'> <a class='tooltip_flip tooltip-effect-1' href='javascript:void(0);'>+<span class='tooltip-content-flip'><span class='tooltip-back'>علاقمند شدم</span></span></a>
                                        </div>
                                        <div class='img_list'>
                                            <a href='Room.php?roomId={$Functions->encrypt_id($rooms_rows['room_id'])}'>
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
                    echo("<span>{$database->escape_value($Functions->EN_numTo_FA($rooms_rows['room_score'],true))}</span>
                                            </div>
                                            <div class='rating' style='background: white'>
                                            ");
                    echo($Functions->give_start_by_number($rooms_rows['room_score']));
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
                                                <li> <a href='javascript:void(0);' class='tooltip-1 ");
                    if($rooms_rows["room_parking"] == 1){ echo 'rooms_checkbox';}
                    echo("' data-placement='top' title='پارکینگ'><i class='icon_set_1_icon-27'></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class='col-lg-2 col-md-2 col-sm-2'>");
                    if($rooms_rows['room_person_count'] != 0){ echo("<div class='room_person_count_show'>{$Functions->EN_numTo_FA($rooms_rows['room_person_count'],true)} نفره</div>"); }
                    echo("
                                        <div class='price_list'>
                                            <div>
                                            <sup>{$Functions->EN_numTo_FA($Functions->insert_seperator($rooms_rows['room_main_price']),true)} تومان</sup>
                                            <span class='normal_price_list'>{$Functions->EN_numTo_FA($Functions->insert_seperator($rooms_rows['room_off_price']),true)} تومان</span>
                                                                                       
                                            <small>روزانه / شبانه</small>
                                                <a href='Room.php?roomId={$Functions->encrypt_id($rooms_rows['room_id'])}'> 
                                                    <p class='food_details_submit text-center' style='padding: 8px'>جزئیات</p>
                                                </a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ");
                }
            }
        }
        public function ShowAllRoomsBy($grid = ""){
            global $database, $Functions,$users;
            $sql = "SELECT * FROM rooms ";
            if (isset($_POST["user_show_by_all_hotels_room"])) {
                if (isset($_POST["user_star_score_room"])){
                    $this->room_score = $database->escape_value($_POST["user_star_score_room"]);
                    settype($this->room_score,"integer");
                    if (preg_match("/WHERE/",$sql)){
                            $sql .= " && room_score={$this->room_score} ";
                    }else{
                        $sql .= " WHERE room_score={$this->room_score} ";
                    }
                }
                if(isset($_POST["user_wifi_room"])){
                    if (preg_match("/WHERE/",$sql)){
                        $sql .= " && room_wifi=1 ";
                    }else{
                        $sql .= " WHERE room_wifi=1 ";
                    }
                }
                if(isset($_POST["user_television_room"])){
                    if (preg_match("/WHERE/",$sql)){
                        $sql .= " && room_television=1 ";
                    }else{
                        $sql .= " WHERE room_television=1 ";
                    }
                }
                if(isset($_POST["user_food_room"])){
                    if (preg_match("/WHERE/",$sql)){
                        $sql .= " && room_food=1 ";
                    }else{
                        $sql .= " WHERE room_food=1 ";
                    }
                }
                if(isset($_POST["user_pool_room"])){
                    if (preg_match("/WHERE/",$sql)){
                        $sql .= " && room_pool=1 ";
                    }else{
                        $sql .= " WHERE room_pool=1 ";
                    }
                }
                if(isset($_POST["user_parking_room"])){
                    if (preg_match("/WHERE/",$sql)){
                        $sql .= " && room_parking=1 ";
                    }else{
                        $sql .= " WHERE room_parking=1 ";
                    }
                }
                if(isset($_POST["user_gym_room"])){
                    if (preg_match("/WHERE/",$sql)){
                        $sql .= " && room_gym=1 ";
                    }else{
                        $sql .= " WHERE room_gym=1 ";
                    }
                }
                if (isset($_POST["user_price_range_room"]) && !(empty($_POST["user_price_range_room"]))){
                    $price_range = $database->escape_value($_POST["user_price_range_room"]);
                    $price_range = explode(";",$price_range);
                    $first_attr = $price_range[0]; $second_attr = $price_range[1];
                    $first_attr = (int)$first_attr; $second_attr = (int)$second_attr;
                    settype($first_attr,"integer");
                    settype($second_attr,"integer");
                    if (!(empty($first_attr)) && !(empty($second_attr))) {
                        if (preg_match("/WHERE/", $sql)) {
                            $sql .= " && room_main_price BETWEEN {$first_attr} AND {$second_attr} ";
                        } else {
                            $sql .= " WHERE room_main_price BETWEEN {$first_attr} AND {$second_attr} ";
                        }
                    }else{
                        $users->redirect_to("RoomsList.php");
                    }
                }
                if (isset($_POST["user_person_count_range_room"]) && !(empty($_POST["user_person_count_range_room"]))){
                    $person_count_range = $database->escape_value($_POST["user_person_count_range_room"]);
                    $person_count_range = explode(";",$person_count_range);
                    $first_attr = $person_count_range[0]; $second_attr = $person_count_range[1];
                    $first_attr = (int)$first_attr; $second_attr = (int)$second_attr;
                    settype($first_attr,"integer");
                    settype($second_attr,"integer");
                    if (preg_match("/WHERE/",$sql)){
                        $sql .= " && room_person_count BETWEEN {$first_attr} AND {$second_attr} ";
                    }else{
                        $sql .= " WHERE room_person_count BETWEEN {$first_attr} AND {$second_attr} ";
                    }
                }
                $sql .= " ORDER BY room_id DESC";
                if (isset($_POST["user_sort_rating_room"])){
                    switch ($_POST["user_sort_rating_room"]) {
                        case "lower":
                            $sql = "SELECT * FROM rooms ORDER BY room_score ASC";
                            break;
                        case "higher":
                            $sql = "SELECT * FROM rooms ORDER BY room_score DESC";
                            break;
                        default:
                            break;
                    }
                }
                if (isset($_POST["user_sort_price_room"])){
                    switch ($_POST["user_sort_price_room"]) {
                        case "lower":
                            $sql = "SELECT * FROM rooms ORDER BY room_main_price ASC";
                            break;
                        case "higher":
                            $sql = "SELECT * FROM rooms ORDER BY room_main_price DESC";
                            break;
                        default:
                            break;
                    }
                }
                $database->query("SET NAMES 'utf8'");
                $result = $database->query($sql);
                if($database->num_rows($result) == 0){ echo "<h1 class='no-result'>متاسفانه یافت نشد !</h1>"; }
                while ($rooms_rows = $database->fetch_array($result)) {
                    if (isset($grid) && $grid == true){
                        echo("
                            <div class='col-md-6 col-sm-6 wow zoomIn' data-wow-delay='0.1s'>
                                <div class='hotel_container'>
                                    <div class='img_container'>
                                        <a href='Room.php?roomId={$Functions->encrypt_id($rooms_rows['room_id'])}'>
                                            <img src='"); self::select_room_image($rooms_rows['room_image']); echo("' width='800' height='533' class='img-responsive' alt='تی شین'>
                                            <div class='ribbon top_rated'></div>
                                        </a>");
                        if($rooms_rows['room_person_count'] != 0){ echo("<div class='room_person_count_show' id='room_person_count_grid_show'>{$rooms_rows['room_person_count']} نفره</div>"); }
                                            echo("<div class='score'>");
                        echo(self::word_score($rooms_rows['room_score']));
                        echo("<span>{$database->escape_value($Functions->EN_numTo_FA($rooms_rows['room_score'], true))}</span>
                                            </div>
                                            <div class='short_info hotel'>{$database->escape_value($rooms_rows['room_address'])}<span class='price'><sup>{$Functions->EN_numTo_FA($Functions->insert_seperator($rooms_rows['room_main_price']),true)} تومان</sup></span></div>
                                    </div>
                                    <div class='hotel_title'>
                                        <h3>{$database->escape_value($rooms_rows['room_title'])}</h3>
                                        <div class='rating'>
                                        ");
                        echo($Functions->give_start_by_number($rooms_rows['room_score']));
                        echo ("
                                        </div>
                                        <div class='wishlist'> <a class='tooltip_flip tooltip-effect-1' href='#'>+<span class='tooltip-content-flip'><span class='tooltip-back'>علاقمند شدم</span></span></a>
                                        </div>
                                        <a href='Room.php?roomId={$Functions->encrypt_id($rooms_rows['room_id'])}'> 
                                            <p class='food_details_submit text-center'>جزئیات</p>
                                        </a> 
                                    </div>
                                </div>
                            </div>
                    ");
                    } else{
                        echo ("
                                <div class='strip_all_tour_list wow fadeIn' style='background-image: linear-gradient(to left,#e04f67 1%,#fff 35%);' data-wow-delay='0.1s'>
                                <div class='row'>
                                    <div class='col-lg-4 col-md-4 col-sm-4'>
                                        <div class='wishlist'> <a class='tooltip_flip tooltip-effect-1' href='javascript:void(0);'>+<span class='tooltip-content-flip'><span class='tooltip-back'>علاقمند شدم</span></span></a>
                                        </div>
                                        <div class='img_list'>
                                            <a href='Room.php?roomId={$Functions->encrypt_id($rooms_rows['room_id'])}'>
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
                                            <div class='rating'>
                                            ");
                        echo($Functions->give_start_by_number($rooms_rows['room_score']));
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
                                                <li> <a href='javascript:void(0);' class='tooltip-1 ");
                        if($rooms_rows["room_parking"] == 1){ echo 'rooms_checkbox';}
                        echo("' data-placement='top' title='پارکینگ'><i class='icon_set_1_icon-27'></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class='col-lg-2 col-md-2 col-sm-2'>");
                        if($rooms_rows['room_person_count'] != 0){ echo("<div class='room_person_count_show'>{$rooms_rows['room_person_count']} نفره</div>"); }
                        echo("
                                        <div class='price_list'>
                                            <div>
                                            <sup>{$Functions->EN_numTo_FA($database->escape_value($Functions->insert_seperator($rooms_rows['room_main_price'])),true)} تومان</sup>
                                            <span class='normal_price_list'>{$Functions->EN_numTo_FA($database->escape_value($Functions->insert_seperator($rooms_rows['room_off_price'])),true)} تومان</span>
                                                                                       
                                            <small>روزانه / شبانه</small>
                                                <a href='Room.php?roomId={$Functions->encrypt_id($rooms_rows['room_id'])}'> 
                                                    <p class='food_details_submit text-center' style='padding: 8px'>جزئیات</p>
                                                </a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ");
                    }
                }
            }
        }
        public function UserََSerachRoom($grid = ""){
            global $database,$Functions,$users;
            if (isset($_POST["user_submit_search_room"]) && !(empty($_POST["user_keyword_room"]))) {
                $keyword = $database->escape_value($_POST['user_keyword_room']);
                if (isset($_POST["user_ByWitch_room"])){
                    switch ($_POST["user_ByWitch_room"]){
                        case 'Address':
                            $sql = "SELECT * FROM rooms WHERE room_address LIKE '%{$keyword}%'";
                            break;
                        case 'Title':
                            $sql = "SELECT * FROM rooms WHERE room_title LIKE '%{$keyword}%'";
                            break;
                        case 'Descript':
                            $sql = "SELECT * FROM rooms WHERE room_description LIKE '%{$keyword}%'";
                            break;
                        case 'Price':
                            $sql = "SELECT * FROM rooms WHERE room_main_price LIKE '{$keyword}%'";
                            break;
                        default:
                            $sql = "SELECT * FROM rooms WHERE room_address LIKE '%{$keyword}%'";
                            break;
                    }
                }
                $result = $database->query($sql);
                if ($database->num_rows($result) > 0) {
                    while ($rooms_rows = $database->fetch_array($result)) {
                        if (isset($grid) && $grid == true){
                            echo("
                            <div class='col-md-6 col-sm-6 wow zoomIn' data-wow-delay='0.1s'>
                                <div class='hotel_container'>
                                    <div class='img_container'>
                                        <a href='Room.php?roomId={$Functions->encrypt_id($rooms_rows['room_id'])}'>
                                            <img src='"); self::select_room_image($rooms_rows['room_image']); echo("' width='800' height='533' class='img-responsive' alt='تی شین'>
                                            <div class='ribbon top_rated'></div>
                                        </a>");
                            if($rooms_rows['room_person_count'] != 0){ echo("<div class='room_person_count_show' id='room_person_count_grid_show'>{$rooms_rows['room_person_count']} نفره</div>"); }
                                            echo("
                                            <div class='score'>");
                            echo(self::word_score($rooms_rows['room_score']));
                            echo("<span>{$database->escape_value($Functions->EN_numTo_FA($rooms_rows['room_score'], true))}</span>
                                            </div>
                                            <div class='short_info hotel'>{$database->escape_value($rooms_rows['room_address'])}<span class='price'><sup>{$Functions->EN_numTo_FA($Functions->insert_seperator($rooms_rows['room_main_price']),true)} تومان</sup></span></div>
                                    </div>
                                    <div class='hotel_title'>
                                        <h3>{$database->escape_value($rooms_rows['room_title'])}</h3>
                                        <div class='rating'>
                                        ");
                            echo($Functions->give_start_by_number($rooms_rows['room_score']));
                            echo ("
                                        </div>
                                        <div class='wishlist'> <a class='tooltip_flip tooltip-effect-1' href='#'>+<span class='tooltip-content-flip'><span class='tooltip-back'>علاقمند شدم</span></span></a>
                                        </div>
                                        <a href='Room.php?roomId={$Functions->encrypt_id($rooms_rows['room_id'])}'> 
                                            <p class='food_details_submit text-center'>جزئیات</p>
                                        </a> 
                                    </div>
                                </div>
                            </div>
                    ");
                        } else{
                            echo ("
                                <div class='strip_all_tour_list wow fadeIn' data-wow-delay='0.1s'>
                                <div class='row'>
                                    <div class='col-lg-4 col-md-4 col-sm-4'>
                                        <div class='wishlist'> <a class='tooltip_flip tooltip-effect-1' href='javascript:void(0);'>+<span class='tooltip-content-flip'><span class='tooltip-back'>علاقمند شدم</span></span></a>
                                        </div>
                                        <div class='img_list'>
                                            <a href='Room.php?roomId={$Functions->encrypt_id($rooms_rows['room_id'])}'> 
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
                            echo("<span>{$database->escape_value($Functions->EN_numTo_FA($rooms_rows['room_score'],true))}</span>
                                            </div>
                                            <div class='rating' style='background: white'>
                                            ");
                            echo($Functions->give_start_by_number($rooms_rows['room_score']));
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
                                                <li> <a href='javascript:void(0);' class='tooltip-1 ");
                            if($rooms_rows["room_parking"] == 1){ echo 'rooms_checkbox';}
                            echo("' data-placement='top' title='پارکینگ'><i class='icon_set_1_icon-27'></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class='col-lg-2 col-md-2 col-sm-2'>");
                            if($rooms_rows['room_person_count'] != 0){ echo("<div class='room_person_count_show'>{$Functions->EN_numTo_FA($rooms_rows['room_person_count'],true)} نفره</div>"); }
                            echo("
                                        <div class='price_list'>
                                            <div>
                                            <sup>{$Functions->EN_numTo_FA($Functions->insert_seperator($rooms_rows['room_main_price']),true)} تومان</sup>
                                            <span class='normal_price_list'>{$Functions->EN_numTo_FA($Functions->insert_seperator($rooms_rows['room_off_price']),true)} تومان</span>
                                                                                       
                                            <small>روزانه / شبانه</small>
                                                <a href='Room.php?roomId={$Functions->encrypt_id($rooms_rows['room_id'])}'> 
                                                    <p class='food_details_submit text-center' style='padding: 8px'>جزئیات</p>
                                                </a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ");
                        }
                    }
                }else { echo "<h1 class='no-result'>متاسفانه یافت نشد !</h1>"; }

            }else{
                $users->redirect_to($_SERVER["PHP_SELF"]);
            }
        }

        public function DatesRoomReservedAttr($room_id){
            global $Functions,$database,$users;
            $this->room_id = (int)$database->escape_value($Functions->decrypt_id($room_id));
            if(preg_match("/^[0-9]*$/",$this->room_id)){
                $database->query("SET NAMES 'utf8'");
                $sql = "SELECT date_range FROM room_reservation WHERE room_id={$this->room_id} AND reserved_mode=0";
                $date_reserved_room_result = $database->query($sql);
                return $date_reserved_room_result;
            }else{
                $users->redirect_to("RoomsList.php");
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
                                             <a href='../Room.php?roomId={$Functions->encrypt_id($rooms_rows['room_id'])}'>
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
                echo("<span>{$database->escape_value($Functions->EN_numTo_FA($rooms_rows['room_score'],true))}</span>
                                            </div>
                                            <h3 class='room_address'>{$database->escape_value($rooms_rows['room_address'])}</h3>
                                            <div class='rating'>
                                            ");
                echo($Functions->give_start_by_number($rooms_rows['room_score']));
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
                                                <li> <a href='javascript:void(0);' class='tooltip-1 ");
                if($rooms_rows['room_parking'] == 1){ echo 'rooms_checkbox';}
                echo("' data-placement='top' title='پارکینگ'><i class='icon_set_1_icon-27'></i></a>
                                                </li>
                                            </ul><hr />
                                            <div id='comment-info'><span style='"); if($this->CountRoomComments($Functions->encrypt_id($rooms_rows['room_id'])) == 0){ echo 'background:red'; } echo("'>{$Functions->EN_numTo_FA($this->CountRoomComments($Functions->encrypt_id($rooms_rows['room_id'])),true)}</span> : Comment </div>
                                        </div>
                                    </div>
                                    <div class='col-lg-2 col-md-2 col-sm-2'>");
                                    if($rooms_rows['room_person_count'] != 0){ echo("<div class='room_person_count_show'>{$Functions->EN_numTo_FA($rooms_rows['room_person_count'],true)} نفره</div>"); }
                                        echo("
                                        <div class='price_list'>
                                            <div>
                                            <sup>{$database->escape_value($Functions->EN_numTo_FA($Functions->insert_seperator($rooms_rows['room_main_price']),true))} تومان</sup>
                                            <span class='normal_price_list'>{$database->escape_value($Functions->EN_numTo_FA($Functions->insert_seperator($rooms_rows['room_off_price']),true))} تومان</span>
                                            <small>روزانه / شبانه</small>
                                           
                                                <a href='rooms_edit.php?roomId={$Functions->encrypt_id($rooms_rows['room_id'])}'><div class='submit_edit'>ویرایش</div></a>
                                          
                                                <form method='post' action='rooms_delete.php'>
                                                    <input type='submit' name='submit_delete_room' value='حذف' class='delete_room_btn' />
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
            if (!(empty($_GET["roomId"])) && isset($_GET["roomId"])){
                $this->room_id = $database->escape_value($Functions->decrypt_id($_GET["roomId"]));
            $sql = "SELECT * FROM rooms WHERE room_id={$this->room_id}";
            $database->query("SET NAMES 'utf8'");
            $result = $database->query($sql);
                if(!(preg_match("/^[0-9]*$/",$this->room_id))){
                    $users->redirect_to("rooms_show.php");
                }
                if($database->num_rows($result) == 0){
                    $users->redirect_to("rooms_show.php");
                }
            while ($rooms_rows = $database->fetch_array($result)) {
                echo("
                
                                <div id='rooms' class='strip_all_tour_list wow fadeIn' data-wow-delay='0.1s'>
                                <div class='row'>
                                    <div class='col-lg-4 col-md-4 col-sm-4'>
                                        <div class='img_list'>
                                                <div class='ribbon top_rated'></div>
                                                <img src='../");
                self::select_room_image($rooms_rows['room_image']);
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
                                            </select>
                                            </div>
                                            <h2><input type='text' class='room_address' style='background: white;' value='{$database->escape_value($rooms_rows['room_address'])}' name='room_address' placeholder='گرگان - خیابان مرادی' maxlength='400' required/></h2>
                                            <h3><input type='text' style='background: white;' value='{$database->escape_value($rooms_rows['room_title'])}' name='room_title' maxlength='200' required/></h3>
                                            <p><textarea name='room_description' maxlength='1500' required>");
                echo($rooms_rows['room_description']);
                echo("</textarea></p>
                                            <ul class='add_info'>
                                                <li> <a href='javascript:void(0);' class='tooltip-1 ");
                if ($rooms_rows['room_wifi'] == 1) {
                    echo('rooms_checkbox');
                }
                echo("' data-placement='top' title='وای فای رایگان'><i class='icon_set_1_icon-86'></i></a>
                                                <input type='checkbox' class='rooms_checkbox' name='room_wifi' ");
                if ($rooms_rows['room_wifi'] == 1) {
                    echo('checked');
                }
                echo(" />
                                                </li>
                                                <li> <a href='javascript:void(0);' class='tooltip-1 ");
                if ($rooms_rows['room_television'] == 1) {
                    echo('rooms_checkbox');
                }
                echo("' data-placement='top' title='تلویزیون پلاسما با کانال های اچ دی'><i class='icon_set_2_icon-116'></i></a>
                                                <input type='checkbox' class='rooms_checkbox' name='room_television' ");
                if ($rooms_rows['room_television'] == 1) {
                    echo('checked');
                }
                echo(" />
                                                </li>
                                                <li> <a href='javascript:void(0);' class='tooltip-1 ");
                if ($rooms_rows['room_pool'] == 1) {
                    echo('rooms_checkbox');
                }
                echo("' data-placement='top' title='استخر شنا'><i class='icon_set_2_icon-110'></i></a>
                                                <input type='checkbox' class='rooms_checkbox' name='room_pool' ");
                if ($rooms_rows['room_pool'] == 1) {
                    echo('checked');
                }
                echo(" />
                                                </li>
                                                <li> <a href='javascript:void(0);' class='tooltip-1 ");
                if ($rooms_rows['room_gym'] == 1) {
                    echo('rooms_checkbox');
                }
                echo("'data-placement='top' title='مرکز تناسب اندام'><i class='icon_set_2_icon-117'></i></a>
                                                <input type='checkbox' class='rooms_checkbox' name='room_gym' ");
                if ($rooms_rows['room_gym'] == 1) {
                    echo('checked');
                }
                echo(" />
                                                </li>
                                                <li> <a href='javascript:void(0);' class='tooltip-1 ");
                if ($rooms_rows['room_food'] == 1) {
                    echo('rooms_checkbox');
                }
                echo("' data-placement='top' title='رستوران'><i class='icon_set_1_icon-58'></i></a>
                                                <input type='checkbox' class='rooms_checkbox' name='room_food' ");
                if ($rooms_rows['room_food'] == 1) {
                    echo('checked');
                }
                echo(" />
                                                </li>
                                                <li> <a href='javascript:void(0);' class='tooltip-1 ");
                if ($rooms_rows['room_parking'] == 1) {
                    echo('rooms_checkbox');
                }
                echo("' data-placement='top' title='پارکینگ'><i class='icon_set_1_icon-27'></i></a>
                                                <input type='checkbox' class='rooms_checkbox' name='room_parking' ");
                if ($rooms_rows['room_parking'] == 1) {
                    echo('checked');
                }
                echo(" />
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class='col-lg-2 col-md-2 col-sm-2'>
                                        <div class='price_list'>
                                            <div>
                                            <sup><input type='text' name='room_main_price' class='insert_input' id='room_main_price' maxlength='9' value='{$database->escape_value($rooms_rows['room_main_price'])}' required />  تومان</sup>
                                            <span class='normal_price_list'><input name='room_off_price' type='text' id='room_off_price' class='insert_input' maxlength='9' value='{$database->escape_value($rooms_rows['room_off_price'])}' required /> تومان</span>
                                            <span class='room_person_count'>چند نفره<input type='text' minlength='1' value='{$database->escape_value($rooms_rows['room_person_count'])}' id='room_person_count' maxlength='2'  placeholder='5' name='room_person_count' /></span>
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
        }
        public function UpdateRoom(){
            global $database,$Functions,$users;
            if (isset($_POST["submit_last_edit_room"]) && isset($_POST["room_id"])){
                if(preg_match("/^[0-9]*$/",$database->escape_value($Functions->decrypt_id($_POST["room_id"])))){
                    $this->room_id = $database->escape_value($Functions->decrypt_id($_POST["room_id"]));
                }else{
                    $users->redirect_to("rooms_show.php");
                }
                if (isset($_POST["room_main_price"]) && !(empty($_POST["room_main_price"])) && $_POST["room_main_price"] != "" && preg_match('/^[0-9]*$/', $_POST["room_main_price"]) && $_POST["room_main_price"] <= 999999999 && strlen($_POST["room_main_price"]) <= 9){
                    $this->room_main_price = $database->escape_value($_POST["room_main_price"]);
                }else{
                    $this->room_main_price = 0;
                }
                if (isset($_POST["room_off_price"]) && !(empty($_POST["room_off_price"])) && $_POST["room_off_price"] != "" && preg_match('/^[0-9]*$/', $_POST["room_off_price"]) && $_POST["room_off_price"] <= 999999999 && strlen($_POST["room_off_price"]) <= 9){
                    $this->room_off_price = $database->escape_value($_POST["room_off_price"]);
                }else{
                    $this->room_off_price = 0;
                }
                if (isset($_POST['room_address']) && !empty($_POST['room_address'])){
                    $this->room_address = $database->escape_value($_POST['room_address']);
                }else{
                    $users->redirect_to("rooms_edit.php");
                    die();
                }
                $this->room_title = $database->escape_value($_POST["room_title"]);
                $this->room_description = $database->escape_value($_POST["room_description"]);
                if (empty($_POST["room_score"]) || $_POST["room_score"] == 0 || $_POST["room_score"] > 5) {
                    $this->room_score = 1;
                }else{
                    $this->room_score = $database->escape_value($_POST["room_score"]);
                }
                if (isset($_POST["room_wifi"])){ $this->room_wifi = 1; }else{ $this->room_wifi = 0; }
                if (isset($_POST["room_television"])){ $this->room_television = 1; }else{ $this->room_television = 0; }
                if (isset($_POST["room_pool"])){ $this->room_pool = 1; }else{ $this->room_pool = 0; }
                if (isset($_POST["room_food"])){ $this->room_food = 1; }else{ $this->room_food = 0; }
                if (isset($_POST["room_gym"])){ $this->room_gym = 1; }else{ $this->room_gym = 0; }
                if (isset($_POST["room_parking"])){ $this->room_parking = 1; }else{ $this->room_parking = 0; }
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
                $sql = "UPDATE rooms SET room_address='{$this->room_address}' , room_title='{$this->room_title}' , room_description='{$this->room_description}' , room_score={$this->room_score} , room_main_price={$this->room_main_price} , room_off_price={$this->room_off_price} , room_wifi={$this->room_wifi} , room_parking={$this->room_parking} , room_pool={$this->room_pool} , room_food={$this->room_food} , room_television={$this->room_television} , room_gym={$this->room_gym} , room_image='$this->room_image' , room_person_count={$this->room_person_count} WHERE room_id={$this->room_id}";
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
                if (isset($_POST["room_main_price"]) && !(empty($_POST["room_main_price"])) && $_POST["room_main_price"] != "" && preg_match('/^[0-9]*$/', $_POST["room_main_price"]) && $_POST["room_main_price"] <= 999999999 && strlen($_POST["room_main_price"]) <= 9){
                    $this->room_main_price = $database->escape_value($_POST["room_main_price"]);
                }else{
                    $this->room_main_price = 0;
                }
                if (isset($_POST["room_off_price"]) && !(empty($_POST["room_off_price"])) && $_POST["room_off_price"] != "" && preg_match('/^[0-9]*$/', $_POST["room_off_price"]) && $_POST["room_off_price"] <= 999999999 && strlen($_POST["room_off_price"]) <= 9){
                    $this->room_off_price = $database->escape_value($_POST["room_off_price"]);
                }else{
                    $this->room_off_price = 0;
                }
                if (isset($_POST['room_address']) && !empty($_POST['room_address'])){
                    $this->room_address = $database->escape_value($_POST['room_address']);
                }
                $Functions->photo_upload($_POST["submit_create_room"]);
                $this->room_title = $database->escape_value($_POST["room_title"]);
                $this->room_description = $database->escape_value($_POST["room_description"]);
                if (empty($_POST["room_score"]) || $_POST["room_score"] == 0 || $_POST["room_score"] > 5) {
                    $this->room_score = 1;
                }else{
                    $this->room_score = $database->escape_value($_POST["room_score"]);
                }
                if (isset($_POST["room_wifi"])){ $this->room_wifi = 1; }else{ $this->room_wifi = 0; }
                if (isset($_POST["room_television"])){ $this->room_television = 1; }else{ $this->room_television = 0; }
                if (isset($_POST["room_pool"])){ $this->room_pool = 1; }else{ $this->room_pool = 0; }
                if (isset($_POST["room_food"])){ $this->room_food = 1; }else{ $this->room_food = 0; }
                if (isset($_POST["room_gym"])){ $this->room_gym = 1; }else{ $this->room_gym = 0; }
                if (isset($_POST["room_parking"])){ $this->room_parking = 1; }else{ $this->room_parking = 0; }
                $sql = "INSERT INTO rooms(room_address,room_title,room_description,room_score,room_main_price,room_off_price,room_wifi,room_parking,room_television,room_pool,room_food,room_gym,room_image,room_person_count)VALUES('{$this->room_address}','{$this->room_title}','{$this->room_description}',{$this->room_score},{$this->room_main_price},{$this->room_off_price},{$this->room_wifi},{$this->room_parking},{$this->room_television},{$this->room_pool},{$this->room_food},{$this->room_gym},'{$database->escape_value($Functions::$image_name)}',{$this->room_person_count})";
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
            $this->DeleteReservationByRoomId($this->room_id);
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

        // function for search panel
        public function PanelSerachRoom(){
            global $database,$Functions,$users;
            if (isset($_GET["panel_submit_search_room"]) && !(empty($_GET["panel_keyword_room"]))) {
                $keyword = $database->escape_value($_GET['panel_keyword_room']);
                if (isset($_GET["panel_ByWitch_room"])){
                    switch ($_GET["panel_ByWitch_room"]){
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
                            $sql = "SELECT * FROM rooms WHERE room_address LIKE '%{$keyword}%'";
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
                                            <a href='../Room.php?roomId={$Functions->encrypt_id($rooms_rows['room_id'])}'>
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
                        echo("<span>{$database->escape_value($Functions->EN_numTo_FA($rooms_rows['room_score'],true))}</span>
                                            </div>
                                            <div class='rating'>
                                            ");
                        echo($Functions->give_start_by_number($rooms_rows['room_score']));
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
                                    if($rooms_rows['room_person_count'] != 0){ echo("<div class='room_person_count_show'>{$Functions->EN_numTo_FA($rooms_rows['room_person_count'],true)}</div>"); }
                                        echo("
                                        <div class='price_list'>
                                            <div>
                                            <sup>{$database->escape_value($Functions->EN_numTo_FA($Functions->insert_seperator($rooms_rows['room_main_price']),true))} تومان</sup>
                                            <span class='normal_price_list'>{$database->escape_value($Functions->EN_numTo_FA($Functions->insert_seperator($rooms_rows['room_off_price']),true))} تومان</span>                                            <small>روزانه / شبانه</small>
                                                <a href='rooms_edit.php?roomId={$Functions->encrypt_id($rooms_rows['room_id'])}'><div class='submit_edit'>ویرایش</div></a>
                                                <form method='post' action='rooms_delete.php'>
                                                    <input type='submit' name='submit_delete_room' value='حذف' class='delete_room_btn' />
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
                    $users->redirect_to($_SERVER["PHP_SELF"]);
            }
        }

        // functions for rooms
        public function word_score($room_score){
            switch ($room_score){
            case 1: return 'قابل قبول'; break;
            case 2: return 'متوسط'; break;
            case 3: return 'خوب'; break;
            case 4: return 'خیلی خوب'; break;
            case 5: return 'عالی'; break;
            }
        }

        public static function RoomAttributeById($id,$users_room = ""){
            global $database,$Functions;
            $id = $Functions->decrypt_id($id);
            $id = $database->escape_value($id);
            if ($users_room == true){
                $sql = "SELECT * FROM rooms WHERE room_id={$id} LIMIT 1";
            }else{
                $sql = "SELECT * FROM rooms WHERE room_id={$id}";
            }
            $database->query("SET NAMES 'utf8'");
            $result = $database->query($sql);
            return $result;
        }
        public function select_room_image($rooms_rows){
            global $database,$Functions;
            if(!(empty($rooms_rows))){
                echo 'img/rooms/'.$database->escape_value($rooms_rows);
            }else{
                echo 'img/rooms/default_room.jpg';
            }
        }
        // for Room.php
        public function select_single_hotel_image($rooms_rows){
            global $database;
            if(!(empty($rooms_rows))){
                echo 'img/rooms/'.$database->escape_value($rooms_rows);
            }else{
                echo 'img/rooms/single_hotel_default.jpg';
            }
        }


        /////////////////////////////////////////////////////////////////////////////////////////
        // functions for Rooms Survey////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////////
        // this function is for Insert Comment for Room Review
        public function SelectRoomComments(){
            global $database,$Functions;
            if(isset($_GET["submit_publish"]) && isset($_GET["select_publish"]) && !(empty($_GET["select_publish"]))){
                switch($_GET["select_publish"]){
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
            if (isset($_GET["commentId"]) && !empty($_GET["commentId"])){
                $this->survey_id = $Functions->decrypt_id($_GET["commentId"]);
                $sql = "SELECT * FROM room_survey WHERE id = {$this->survey_id}";
                $result = $database->query($sql);
                if ($database->num_rows($result) == 0){
                    $users->redirect_to("comments_show.php");
                }
                if(!(preg_match("/^[0-9]*$/",$this->survey_id))){
                    $users->redirect_to("comments_show.php");
                }
                if ($room_survey = $database->fetch_array($result)){
                    echo("
                    <h1 class='comment-edit-h'>Comment Edit</h1>
                    <div class='comment-panel-edit col-xs-12 col-sm-12 col-md-6 col-lg-6' "); if($room_survey['publish'] == 1){ echo("style='border: 2px solid #00A8FF;padding: 16px;'"); }else{ echo("style='border: 2px solid #ca0d30;padding: 16px;'"); }  echo(">
                        ");
                    if ($users_row = $database->fetch_array($users->SelectById($room_survey['user_id']))) {
                        echo("<img class='finger-img' "); if($room_survey['publish'] == 1){ echo("style='border: 4px solid #00A8FF;'"); }else{ echo("style='border: 4px solid #ca0d30;'"); }  echo("  id='finger-img-panel-comment' src='"); Users::select_user_image($users_row['user_image']); echo("' alt='' class='img-circle'>");
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
                        <small id='panel-date-comment'>"); echo $Functions->convert_db_format_for_gregorian_to_jalali($divid_date_time[1]); echo("</small><br /><br />
                    <div class='comment-panel-btns col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                        <form action='../Room.php' id='see-room' method='post'>
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
                    if (isset($_POST["room_score_review"]) && !(empty($_POST["room_score_review"])) && $_POST["room_score_review"] <= 5 && isset($_POST["room_comfort_review"]) && !(empty($_POST["room_comfort_review"])) && isset($_POST["room_price_review"]) && !(empty($_POST["room_price_review"])) && isset($_POST["room_quality_review"]) && !(empty($_POST["room_quality_review"])) && isset($_POST["room_text_review"]) && !(empty($_POST["room_text_review"])) && isset($_POST["random_captcha_code"]) && !(empty($_POST["random_captcha_code"]))){
                        if($_POST["random_captcha_code"] != $_SESSION["random_captcha_code"]){
                            $_SESSION["errors_message"] .= "کد کپچا نادرست وارد شده .";
                            $users->redirect_to("Room.php?roomId={$room_id}");
                        }else{
                            switch ($_POST["room_score_review"]){
                                case 1: $room_score_review = $_POST["room_score_review"]; break;
                                case 2: $room_score_review = $_POST["room_score_review"]; break;
                                case 3: $room_score_review = $_POST["room_score_review"]; break;
                                case 4: $room_score_review = $_POST["room_score_review"]; break;
                                case 5: $room_score_review = $_POST["room_score_review"]; break;
                                default: $_SESSION["errors_message"] .= "مشکلی در نادرست وارد کردن فیلد ."; $users->redirect_to("Room.php?roomId={$room_id}"); break;
                            }

                            switch ($_POST["room_comfort_review"]){
                                case 13: $room_comfort_review = 0; break;
                                case 1: $room_comfort_review = $_POST["room_comfort_review"]; break;
                                case 2: $room_comfort_review = $_POST["room_comfort_review"]; break;
                                case 3: $room_comfort_review = $_POST["room_comfort_review"]; break;
                                case 4: $room_comfort_review = $_POST["room_comfort_review"]; break;
                                case 5: $room_comfort_review = $_POST["room_comfort_review"]; break;
                                default: $_SESSION["errors_message"] .= "مشکلی در نادرست وارد کردن فیلد ."; $users->redirect_to("Room.php?roomId={$room_id}"); break;
                            }
                            switch ($_POST["room_price_review"]){
                                case 13: $room_price_review = 0; break;
                                case 1: $room_price_review = $_POST["room_price_review"]; break;
                                case 2: $room_price_review = $_POST["room_price_review"]; break;
                                case 3: $room_price_review = $_POST["room_price_review"]; break;
                                case 4: $room_price_review = $_POST["room_price_review"]; break;
                                case 5: $room_price_review = $_POST["room_price_review"]; break;
                                default: $_SESSION["errors_message"] .= "مشکلی در نادرست وارد کردن فیلد ."; $users->redirect_to("Room.php?roomId={$room_id}"); break;
                            }
                            switch ($_POST["room_quality_review"]){
                                case 13: $room_quality_review = 0; break;
                                case 1: $room_quality_review = $_POST["room_quality_review"]; break;
                                case 2: $room_quality_review = $_POST["room_quality_review"]; break;
                                case 3: $room_quality_review = $_POST["room_quality_review"]; break;
                                case 4: $room_quality_review = $_POST["room_quality_review"]; break;
                                case 5: $room_quality_review = $_POST["room_quality_review"]; break;
                                default: $_SESSION["errors_message"] .= "مشکلی در نادرست وارد کردن فیلد ."; $users->redirect_to("Room.php?roomId={$room_id}"); break;
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
                                $users->redirect_to("Room.php?roomId={$room_id}");
                            }else{
                                $_SESSION["errors_message"] .= "خطایی رخ داد .";
                                $users->redirect_to("Room.php?roomId={$room_id}");
                            }

                        }
                    }else{
                        $_SESSION["errors_message"] .= "برخی از فیلد ها خالیست یا انتخاب نشده .";
                        $users->redirect_to("Room.php?roomId={$room_id}");
                    }
                }else{
                    $_SESSION["errors_message"] .= "برای درج نظر بایستی به حساب کاربری خود وارد شوید یا حسابی بسازید .";
                    $users->redirect_to("Room.php?roomId={$room_id}");
                }
            }else{
                $users->redirect_to("Room.php?roomId={$room_id}");
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
        // for panel /////////////////////////////////////////////////////////////////////
            // Comment

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
        public function DeleteSingleReservation(){
            global $database,$users,$Functions;
            if (isset($_POST["delete_single_reservation"]) && isset($_POST["reserve_id"]) && !(empty($_POST["reserve_id"]))){
                $this->reserve_id = $Functions->decrypt_id($_POST["reserve_id"]);
                $sql = "DELETE FROM room_reservation WHERE room_reservation.reserve_id = {$this->reserve_id} LIMIT 1";
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
            global $database,$users,$Functions,$rooms;
            if (isset($_POST['submit_search']) && !(empty($_POST['keyword']))) {
                $keyword = $database->escape_value($_POST['keyword']);
                if (isset($_POST['ByWitch'])) {
                    switch ($_POST['ByWitch']) {
                        case 'user_id':
                            $sql = "SELECT * FROM room_survey WHERE user_id={$keyword} ORDER BY id DESC";
                            break;
                        case 'username':
                            $sql = "SELECT * FROM room_survey WHERE username LIKE '%{$keyword}%' ORDER BY id DESC";
                            break;
                        case 'tel':
                            $sql = "SELECT * FROM users INNER JOIN room_survey ON users.id = room_survey.user_id AND users.tel LIKE '{$keyword}%'";
                            break;
                        case 'address':
                            $sql = "SELECT * FROM rooms INNER JOIN room_survey ON rooms.room_id = room_survey.room_id AND rooms.room_address LIKE '%{$keyword}%' ORDER BY id DESC";
                            break;
                        case 'title':
                            $sql = "SELECT * FROM rooms INNER JOIN room_survey ON rooms.room_id = room_survey.room_id AND rooms.room_title LIKE '%{$keyword}%' ORDER BY id DESC";
                            break;
                        case 'survey':
                            $sql = "SELECT * FROM room_survey WHERE survey LIKE '%{$keyword}%' ORDER BY id DESC";
                            break;
                        default:
                            $users->redirect_to($_SERVER['PHP_SELF']);
                            break;
                    }
                    if (!empty($sql)){
                        $database->query("SET NAMES 'utf8'");
                        $result = $database->query($sql);
                        if ($database->num_rows($result) > 0) {
                            while ($rows = $database->fetch_array($result)) {
                                echo("
                                    <div class='comment-panel col-xs-12 col-sm-12 col-md-6 col-lg-6'>");
                                        if ($users_row = $database->fetch_array($users->SelectById($rows['user_id']))) {
                                            echo("<img class='finger-img' id='finger-img-panel-comment' src='"); Users::select_user_image($users_row['user_image']); echo("' alt='' class='img-circle'>");
                                        }
                                        $divid_date_time = $Functions->divid_date_time_database($rows['survey_date']);
                                        echo("
                                        <h4 id='username-panel-comment'>{$rows['username']}</h4>");
                                        echo("<blockquote style='float: left;'>Comment Id : <span style='color: #00A8FF;font-weight: bold;'>{$rows['id']}</span></blockquote>");
                                        echo("<blockquote style='float: left;'>Tel : <span style='color: #00A8FF;font-weight: bold;'>{$users_row['tel']}</span></blockquote>");
                                        if ($rooms_rows = $database->fetch_array($rooms->SelectWithId($rows['room_id']))){
                                            echo("<br /><h4 style='display: inline-block' class='room_address'>{$database->escape_value($rooms_rows['room_address'])}</h4><h3 style='display: inline-block'>&nbsp;|&nbsp;</h3> 
                                                    <h5 style='display: inline-block'>{$database->escape_value($rooms_rows['room_title'])}</h5>");
                                        }
                                        echo("<div class='survey'><p>"); echo(nl2br($rows['survey'])); echo("</p></div>
                                        <div id='panel-rating-comment' class='rating'> {$rooms->smile_voted_by_price_quality_score_comfort($rows['room_price'],$rows['room_quality'],$rows['room_score'],$rows['room_comfort'])} </div>
                                        <small class='icon-clock-8' id='panel-time-comment'>&nbsp;"); echo $Functions->EN_numTo_FA($divid_date_time[0],true); echo("</small>
                                            <small id='panel-date-comment'>"); echo $Functions->EN_numTo_FA($Functions->convert_db_format_for_gregorian_to_jalali($divid_date_time[1]),true); echo("</small><br />
                                            <div class='comment-panel-btns col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                                                     <a href='../Room.php?roomId={$Functions->encrypt_id($rooms_rows['room_id'])}'>
                                                        <p id='see-room-btn' class='submit_edit'>بازدید اتاق</p>
                                                     </a>
                                                    <form action='{$_SERVER['PHP_SELF']}' id='submit-checkbox-form' method='post'>
                                                        <input type='hidden' name='survey_id' value='"); echo($Functions->encrypt_id($rows['id'])); echo("' />
                                                        <div class='publish-area'>");
                                                        if($rows["publish"] == 0) {
                                                                echo("<input type='submit' name='publish_submit' id='publish_checkbox_submit' class='submit_edit' value='منتشر' />");
                                                            }
                                                            if($rows["publish"] == 1) {
                                                                echo("<input type='submit' name='unpublish_submit' id='unpublish_checkbox_submit' class='submit_edit' value='X  غیر منتشر' />");
                                                            }
                                                            echo("
                                                            
                                                        </div>
                                                        <input type='submit' name='delete_user_comment' value='حذف' class='comments_delete_btn delete_room_btn' />
                                                    </form>
                                                    <a class='edit-comment-panel-btn' href='comments_edit.php?commentId={$Functions->decrypt_id($rows['id'])}'>ویرایش</a>
                                                </div>
                                                    <div class='line'></div></hr >
                                            </div>
                                    

                                ");
                            }
                        }else{ echo "<h1>متاسفانه یافت نشد !</h1>"; }
                    }else{ $users->redirect_to($_SERVER['PHP_SELF']); }
                }
            }
        }


            // Reservation For Administrator And Admins
        public function SelectRoomReservation(){
            global $database,$Functions;
            if(isset($_GET["submit_booking"]) && isset($_GET["select_booking"]) && !(empty($_GET["select_booking"]))){
                switch($_GET["select_booking"]){
                    case "notbooked":
                        $sql = "SELECT * FROM room_reservation WHERE reserved_mode = 0 ORDER BY reserve_id DESC";
                        $result = $database->query($sql);
                        $booking_mode = "notbooked";
                        return array($result,$booking_mode);
                        break;
                    case "booked":
                        $sql = "SELECT * FROM room_reservation WHERE reserved_mode = 1 ORDER BY reserve_id DESC";
                        $result = $database->query($sql);
                        $booking_mode = "booked";
                        return array($result,$booking_mode);
                        break;
                    default:
                        $sql = "SELECT * FROM room_reservation WHERE reserved_mode = 0 ORDER BY reserve_id DESC";
                        $result = $database->query($sql);
                        $booking_mode = "notbooked";
                        return array($result,$booking_mode);
                        break;
                }
            }else{
                $sql = "SELECT * FROM room_reservation WHERE reserved_mode = 0 ORDER BY reserve_id DESC";
                $result = $database->query($sql);
                $booking_mode = "notbooked";
                return array($result,$booking_mode);
            }
        }
        public function CountAllRoomReservation(){
            global $database;
            $sql = "SELECT COUNT(*) AS all_reservation_count FROM room_reservation";
            $result = $database->query($sql);
            if($row = $database->fetch_array($result)){
                echo $row['all_reservation_count'];
            }
        }
        public function CountBookedAndNotBookedRoomReservationPanel($publish_mode){
            global $database;
            $sql = "SELECT COUNT(*) AS reservation_count FROM room_reservation WHERE reserved_mode={$publish_mode}";
            $result = $database->query($sql);
            if($row = $database->fetch_array($result)){
                return $row['reservation_count'];
            }
        }
        public function BookedPublish(){
            global $database,$Functions;
            if(isset($_POST["booking_submit"]) && isset($_POST["reserve_id"]) && !(empty($_POST["reserve_id"]))) {
                $this->reserve_id = $Functions->decrypt_id($_POST["reserve_id"]);
                $sql = "UPDATE room_reservation SET reserved_mode=1 WHERE reserve_id = {$this->reserve_id}";
                $result = $database->query($sql);
                if (!$result){
                    $_SESSION["errors_message"] .= "مشکلی در تایید رزرو رخ داد .";
                    $this->error_state = 1;
                    return $this->error_state;
                }
            }
        }
        public function NotBookedPublish(){
            global $database,$Functions;
            if(isset($_POST["notbooked_submit"]) && isset($_POST["reserve_id"]) && !(empty($_POST["reserve_id"]))) {
                $this->reserve_id = $Functions->decrypt_id($_POST["reserve_id"]);
                $sql = "UPDATE room_reservation SET reserved_mode=0 WHERE reserve_id = {$this->reserve_id}";
                $result = $database->query($sql);
                if (!$result){
                    $_SESSION["errors_message"] .= "مشکلی در عدم تایید رزرو رخ داد .";
                    $this->error_state = 1;
                    return $this->error_state;
                }
            }
        }
        public function NotBookedAllBooked(){
            global $database;
            if(isset($_POST["notbooked_all_booked"])) {
                $sql = "UPDATE room_reservation SET reserved_mode=0";
                $result = $database->query($sql);
                if (!$result){
                    $_SESSION["errors_message"] .= "مشکلی در عدم تایید رزرو ها رخ داد .";
                    $this->error_state = 1;
                    return $this->error_state;
                }
            }
        }
        public function BookedAllNotBooked(){
            global $database;
            if(isset($_POST["booked_all_notbooked"])) {
                $sql = "UPDATE room_reservation SET reserved_mode=1";
                $result = $database->query($sql);
                if (!$result){
                    $_SESSION["errors_message"] .= "مشکلی در انتشار همه ی کامنتها رخ داد .";
                    $this->error_state = 1;
                    return $this->error_state;
                }
            }
        }
        public function DeleteAllBookedReservation(){
            global $database,$users;
            if (isset($_POST["delete_all_booked_reservation"])){
                $sql = "DELETE FROM room_reservation WHERE reserved_mode=1";
                $result = $database->query($sql);
                if(!$result){
                    $_SESSION["errors_message"] .= "مشکلی در حذف رزرو های تایید شده به وجود آمده .";
                    $this->error_state = 1;
                    return $this->error_state;
                }
            }
        }
        public function DeleteAllNotBookedReservation(){
            global $database,$users;
            if (isset($_POST["delete_all_notbooked_reservation"])){
                $sql = "DELETE FROM room_reservation WHERE reserved_mode=0";
                $result = $database->query($sql);
                if(!$result){
                    $_SESSION["errors_message"] .= "مشکلی در حذف رزروهای تایید نشده به وجود آمده .";
                    $this->error_state = 1;
                    return $this->error_state;
                }
            }
        }

        public function AutoBookedReservations(){
            global $database,$Functions;

            // 86400 is one day (24 Hours)
            // 43200 is half day (12 Hours)
            // this is now time as asia tehran ///////////////////////////////////////////
            $date = new DateTime("now", new DateTimeZone('Asia/Tehran') );
            $now_date = strtotime($date->format('Y-m-d H:i:s'));
            //////////////////////////////////////////////////////////////////////////////

            $sql = "SELECT * FROM room_reservation WHERE reserved_mode=0";
            $database->query("SET NAMES 'utf8'");
            $result = $database->query($sql);
            while ($row = $database->fetch_array($result)){
                $room_date_arr = $Functions->DividedStartAndEndDate($row['date_range'],"|");

                // 43200 is 12 Hours to mean tomorrow clock 12 AM////////////////////////////////
                $room_date = strftime($room_date_arr[1]." 24:00:00",$now_date);
                $room_date_stamp = strtotime($room_date)+43200;
                /////////////////////////////////////////////////////////////////////////////////

                if ($room_date_stamp < $now_date){
                    $booked_sql = "UPDATE room_reservation SET reserved_mode=1 WHERE reserve_id = {$row['reserve_id']}";
                    $database->query($booked_sql);
                }

            }
        }
        public function DeleteReservationByRoomId($id){
            global $database, $Functions;
            $this->reserve_id = $id;
            $sql = "DELETE FROM room_reservation WHERE room_reservation.room_id = {$this->reserve_id}";
            $result = $database->query($sql);
            if ($result)
                return true;
            else
                return false;
        }


           // Just For Users with 0 user_mode
        public function SelectUserRoomReservation(){
            global $database,$Functions;
            if(isset($_GET["submit_booking"]) && isset($_GET["select_booking"]) && !(empty($_GET["select_booking"]))){
                switch($_GET["select_booking"]){
                    case "notbooked":
                        $sql = "SELECT * FROM room_reservation WHERE user_id={$_SESSION['user_id']} AND reserved_mode = 0 ORDER BY reserve_id DESC";
                        $result = $database->query($sql);
                        $booking_mode = "notbooked";
                        return array($result,$booking_mode);
                        break;
                    case "booked":
                        $sql = "SELECT * FROM room_reservation WHERE user_id={$_SESSION['user_id']} AND reserved_mode = 1 ORDER BY reserve_id DESC";
                        $result = $database->query($sql);
                        $booking_mode = "booked";
                        return array($result,$booking_mode);
                        break;
                    default:
                        $sql = "SELECT * FROM room_reservation WHERE user_id={$_SESSION['user_id']} AND reserved_mode = 0 ORDER BY reserve_id DESC";
                        $result = $database->query($sql);
                        $booking_mode = "notbooked";
                        return array($result,$booking_mode);
                        break;
                }
            }else{
                $sql = "SELECT * FROM room_reservation WHERE user_id={$_SESSION['user_id']} AND reserved_mode = 0 ORDER BY reserve_id DESC";
                $result = $database->query($sql);
                $booking_mode = "notbooked";
                return array($result,$booking_mode);
            }
        }
        public function DeleteUserAllBookedReservation(){
            global $database,$users;
            if (isset($_POST["delete_all_booked_reservation"])){
                $sql = "DELETE FROM room_reservation WHERE user_id={$_SESSION['user_id']} AND reserved_mode=1";
                $result = $database->query($sql);
                if(!$result){
                    $_SESSION["errors_message"] .= "مشکلی در حذف رزرو های تایید شده به وجود آمده .";
                    $this->error_state = 1;
                    return $this->error_state;
                }
            }
        }
        public function DeleteUserAllNotBookedReservation(){
            global $database,$users;
            if (isset($_POST["delete_all_notbooked_reservation"])){
                $sql = "DELETE FROM room_reservation WHERE user_id={$_SESSION['user_id']} AND reserved_mode=0";
                $result = $database->query($sql);
                if(!$result){
                    $_SESSION["errors_message"] .= "مشکلی در حذف رزروهای تایید نشده به وجود آمده .";
                    $this->error_state = 1;
                    return $this->error_state;
                }
            }
        }
        public function CountUserAllRoomReservation(){
            global $database;
            $sql = "SELECT COUNT(*) AS all_user_reservation_count FROM room_reservation WHERE user_id={$_SESSION['user_id']}";
            $result = $database->query($sql);
            if($row = $database->fetch_array($result)){
                echo $row['all_user_reservation_count'];
            }
        }
        public function CountUserBookedAndNotBookedRoomReservationPanel($publish_mode){
            global $database;
            $sql = "SELECT COUNT(*) AS reservation_count FROM room_reservation WHERE user_id={$_SESSION['user_id']} AND reserved_mode={$publish_mode}";
            $result = $database->query($sql);
            if($row = $database->fetch_array($result)){
                return $row['reservation_count'];
            }
        }
        //////////////////////////////////////////////////////////////////////////////////

        // for Room page
        public function ReserveRoom($room_id,$max_person_room){
            global $users,$Functions,$database,$sessions;
            if (isset($_POST["reserve_submit"]) && isset($room_id) && !(empty($room_id))){
                if ($sessions->login_state()) {
                    // main code after main conditions
                    if (isset($_POST["reserve_firstname"]) && !(empty($_POST["reserve_firstname"])) && isset($_POST["reserve_lastname"]) && !(empty($_POST["reserve_lastname"])) && isset($_POST["reserve_date"]) && !(empty($_POST["reserve_date"]))){
                        $max_person_room = (int)$max_person_room;
                        // this conditions is for check room person count
                        if (isset($_POST["reserve_person_count"]) && !(empty($_POST["reserve_person_count"]))){
                            $this->room_person_count = $_POST["reserve_person_count"];
                            $this->room_person_count = (int)$this->room_person_count;
                            if($this->room_person_count >= 1 && $this->room_person_count <= $max_person_room){
                                $this->room_person_count = $database->escape_value($_POST["reserve_person_count"]);
                            }else{ $_SESSION["errors_message"] .= "خطایی در ظرفیت افراد رخ داد ."; $users->redirect_to("Room.php?roomId={$room_id}"); }
                        }else{ $this->room_person_count = 1; }
                        /////////////////////////////////////////////////

                        $reserve_firstname = $database->escape_value($_POST["reserve_firstname"]);
                        $reserve_lastname = $database->escape_value($_POST["reserve_lastname"]);
                        if (strlen($reserve_firstname) > 150 || strlen($reserve_lastname) > 150){
                            $_SESSION["errors_message"] .= "نام یا نام خانوادگی کمتر از 150 کارکتر باشد ."; $users->redirect_to("Room.php?roomId={$room_id}");
                        }
                        $reserve_date = $database->escape_value($_POST["reserve_date"]);
                            $reserve_date = $this->convert_date_to_gregorian($reserve_date, $room_id);
                            $roomDayFreeOrNot = $this->DayFreeOrNot($reserve_date,$room_id);
                            if($roomDayFreeOrNot == false){
                                $_SESSION["errors_message"] .= "متاسفانه روز های انتخاب شده از قبل رزرو شده ."; $users->redirect_to("Room.php?roomId={$room_id}");
                            }
                            $now_time = strftime("%Y-%m-%d %H:%M:%S", time());
                            $this->room_id = $database->escape_value($Functions->decrypt_id($room_id));
                            $this->user_id = $_SESSION["user_id"];
                            $sql = "INSERT INTO room_reservation(room_id,user_id,firstname,lastname,date_range,reserve_room_person_count,reserve_time,reserved_mode)VALUES({$this->room_id},{$this->user_id},'{$reserve_firstname}','{$reserve_lastname}','{$reserve_date}',{$this->room_person_count},'{$now_time}',0)";
                            $database->query("SET NAMES 'utf8'");
                            $result = $database->query($sql);
                            if ($result) {
                                $_SESSION["errors_message"] .= "با موفقیت رزرو شد .";
                                $users->redirect_to("Room.php?roomId={$room_id}");
                            } else {
                                $_SESSION["errors_message"] .= "خطایی در رزرو پیش آمده .";
                                $users->redirect_to("Room.php?roomId={$room_id}");
                            }

                    }else{ $_SESSION["errors_message"] .= "برخی از فیلد ها خالیست یا انتخاب نشده ."; $users->redirect_to("Room.php?roomId={$room_id}"); }
                    //////////////////////////////////



                }else{ $_SESSION["errors_message"] .= "برای رزرو بایستی به حساب کاربری خود وارد شوید یا حسابی بسازید ."; $users->redirect_to("Room.php?roomId={$room_id}"); }
            }else{ $users->redirect_to("Room.php?roomId={$room_id}"); }
        }
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
                    return "<i class='icon-star voted'></i><i class='icon-star'></i><i class='icon-star'></i><i class='icon-star'></i><i class='icon-star'></i>";
                    break;
                case 2:
                    return "<i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star'></i><i class='icon-star'></i><i class='icon-star'></i>";
                    break;
                case 3:
                    return "<i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star'></i><i class='icon-star'></i>";
                    break;
                case 4:
                    return "<i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star'></i>";
                    break;
                case 5:
                    return "<i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i>";
                    break;
                case 13:
                    return "<i class='icon-star'></i><i class='icon-star'></i><i class='icon-star'></i><i class='icon-star'></i><i class='icon-star'></i>";
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
        public function score_by_comments($room_id){
            global $database,$users,$Functions;
            $room_id = $Functions->decrypt_id($room_id);
            $room_survey_col = array('room_score','room_comfort','room_quality','room_price');
            $sum = 0;
            foreach ($room_survey_col as $room_attr){
                $sql = "SELECT AVG({$room_attr}) AS {$room_attr} FROM room_survey WHERE room_id={$room_id} AND publish=1";
                $result = $database->query($sql);
                if($row = $database->fetch_array($result)) {
                    $sum = $sum+($row[$room_attr]);
                }
            }
            return round($sum/4);
        }

        public function DayFreeOrNot($date,$room_id){
            global $Functions,$users,$database;
            $room_id = $Functions->decrypt_id($room_id);
            $range_date_self_room = explode("|",$date);
            $start_day_room = $range_date_self_room[0];
            $end_day_room = $range_date_self_room[1];
            $Functions->ShowBetweenTwoDateRange($start_day_room,$end_day_room,true);

            $sql = "SELECT date_range FROM room_reservation WHERE room_id={$room_id} AND reserved_mode = 0";
            $result = $database->query($sql);
            while ($data_ranges = $database->fetch_array($result)){
                $range_date_room = explode("|",$data_ranges["date_range"]); $start_day = $range_date_room[0]; $end_day = $range_date_room[1];
                $Functions::AllDateRange($start_day,$end_day);
            }
            $a1=array("fds");
            $a2=array("a","b","c","d","s","fds");

            $DaysResult = array_intersect(Rooms::$all_room_days,Rooms::$room_days_reserved);
            if($DaysResult){
                return false;
            }else{
                return true;
            }
        }
        public function convert_date_to_gregorian($date,$room_id){
            global $Functions,$users;
            $reserve_date = $users->mytrim($Functions->EN_numTo_FA($date,false));
            $reserve_date_del_nbsp = str_replace("/","",$reserve_date);
            $reserve_date_from = substr($reserve_date_del_nbsp,0,8);
            $reserve_date_to = substr($reserve_date_del_nbsp,-8);

            $reserve_date_from_year = (int)substr($reserve_date_from,0,4);
            $reserve_date_from_mounth = (int)substr($reserve_date_from,4,2);
            $reserve_date_from_day = (int)substr($reserve_date_from,6,2);

            $reserve_date_to_year = (int)substr($reserve_date_to,0,4);
            $reserve_date_to_mounth = (int)substr($reserve_date_to,4,2);
            $reserve_date_to_day = (int)substr($reserve_date_to,6,2);

            $reserve_date_from_last = $Functions->jalali_to_gregorian($reserve_date_from_year,$reserve_date_from_mounth,$reserve_date_from_day);
            $reserve_date_to_last = $Functions->jalali_to_gregorian($reserve_date_to_year,$reserve_date_to_mounth,$reserve_date_to_day);

            $reserve_date_from_last = $reserve_date_from_last[0]."-".$reserve_date_from_last[1]."-".$reserve_date_from_last[2];
            $reserve_date_to_last = $reserve_date_to_last[0]."-".$reserve_date_to_last[1]."-".$reserve_date_to_last[2];

            $reserve_date_from_last_stamp = strtotime($reserve_date_from_last,time());
            $reserve_date_to_last_stamp = strtotime($reserve_date_to_last,time());

            if($reserve_date_to_last_stamp >= $reserve_date_from_last_stamp){
                return $reserve_date = $reserve_date_from_last."|".$reserve_date_to_last;
            }else{
                $_SESSION["errors_message"] .= "تاریخ وارد شده نامعتبر است ."; $users->redirect_to("Room.php?roomId={$room_id}");
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
            $room_spec_avg = round(($this->room_price+$this->room_quality+$this->room_score+$this->room_comfort)/4);
            switch ($room_spec_avg){
                case 0: return "<i class='icon-star rotateIn'></i><i class='icon-star'></i><i class='icon-star'></i><i class='icon-star'></i><i class='icon-star'></i>"; break;
                case 1: return "<i class='icon-star voted'></i><i class='icon-star'></i><i class='icon-star'></i><i class='icon-star'></i><i class='icon-star'></i>"; break;
                case 2: return "<i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star'></i><i class='icon-star'></i><i class='icon-star'></i>"; break;
                case 3: return "<i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star'></i><i class='icon-star'></i>"; break;
                case 4: return "<i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star'></i>"; break;
                case 5: return "<i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i>"; break;

            }
        }
    }
    $rooms = new Rooms();
?>