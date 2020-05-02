<?php
require_once("database.php");
require_once("sessions.php");
require_once("functions.php");
class Foods{
    public $food_id;
    public $food_title; // VARCHAR(200) NOT NULL
    public $food_description; // TEXT NOT NULL
    public $food_score; // TINYINT(1)
    public $food_main_price; // INT(9) NULL
    public $food_off_price; // INT(9) NULL
    public $food_details; // TEXT NOT NULL
    public $food_image; // VARCHAR(200)

    // functions for display FOODS in FrontEnd For USERS

    // food_details.php
    public static function FoodDetailsPage(){
        global $users,$Functions;
        if (isset($_POST['submit']) && isset($_POST['food_id'])) {
            $food_id = $_POST['food_id'];
            $foodattribute = Foods::FoodAttributeById($food_id);
            if ($foodattribute) {
                echo("
        <section class='parallax-window' data-parallax='scroll' data-image-src='img/foods.jpg' data-natural-width='1400'
                 data-natural-height='470'>
            <div class='parallax-content-1'>
                <div class='animated fadeInDown'>
                    <h1>طرز تهیه {$foodattribute['food_title']}</h1>
                </div>
            </div>
        </section>
        <div id='position'>
            <div class='container'>
                <ul>
                    <li><a href=''#'>صفحه اصلی</a>
                    </li>
                    <li><a href=''#'>دسته بندی</a>
                    </li>
                    <li>صفحه فعال</li>
                </ul>
            </div>
        </div>
        <div class='container margin_60'>
            <div class='row'>
                <img class='food_details_image' src='img/foods/{$foodattribute['food_image']}' />
                <h1>{$foodattribute['food_title']}</h1><hr />
                <p class='food_details'>"); echo(nl2br(htmlentities($foodattribute['food_details']))); echo("</p>
            </div>
        </div>");
            }
        }else{
            $users->redirect_to("foods_list.php");
        }
    }
    // foods_list.php And foods_grid.php
    public static function AllFoods($grid = ""){
        global $database,$Functions;
        $sql = "SELECT * FROM foods ORDER BY food_id DESC";
        $database->query("SET NAMES 'utf8'");
        $result = $database->query($sql);
        while ($foods_rows = $database->fetch_array($result)){
            if (isset($grid) && $grid == true){
                echo("
                            <div class='col-md-6 col-sm-6 wow zoomIn' data-wow-delay='0.7s'>
                                    <div class='hotel_container'>
                                        <div class='img_container'>
                                            <a href='#'>
                                                <img src='"); self::select_food_image($foods_rows['food_image']); echo("' width='800' height='533' class='img-responsive' alt='تی شین'>
                                                <div class='score'><span>{$Functions->EN_numTo_FA($database->escape_value($foods_rows['food_score']),true)}</span>"); echo(self::word_score($foods_rows['food_score'])); echo("</div>
                                                <div class='short_info hotel'>"); echo(substr(nl2br(htmlentities($foods_rows['food_description'])),0,150)."..."); echo("<span class='price'><sup>{$Functions->EN_numTo_FA($Functions->insert_seperator($database->escape_value($foods_rows['food_main_price'])),true)} تومان</sup></span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class='hotel_title'>
                                            <h3><strong>{$database->escape_value($foods_rows['food_title'])}</strong></h3>
                                            <div class='rating'>"); echo $Functions->give_start_by_number($foods_rows['food_score']); echo("</div>
                                            <form action='food_details.php' method='post'>
                                                <input name='food_id' type='hidden' value='"); echo($Functions->encrypt_id($foods_rows['food_id'])); echo("' /> 
                                                <p><input name='submit' class='food_details_submit' value='طرز تهیه' type='submit' /></p>
                                            </form>
                                            <div class='wishlist'> <a class='tooltip_flip tooltip-effect-1' href='#'>+<span class='tooltip-content-flip'><span class='tooltip-back'>علاقمند شدم</span></span></a>
                                            </div>
                                        </div>
                                    </div>
                             </div>
                        ");
            }else{
                echo ("
                                <div class='strip_all_tour_list wow fadeIn animated' data-wow-delay='0.1s' style='visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;'>
                <div class='row'>
                    <div class='col-lg-4 col-md-4 col-sm-4'>
                        <div class='wishlist'> <a class='tooltip_flip tooltip-effect-1' href='javascript:void(0);'>+<span class='tooltip-content-flip'><span class='tooltip-back'>علاقمند شدم</span></span></a>
                        </div>
                        <div class='img_list'>
                            <a href='#'>
                                <div class='ribbon top_rated'></div>
                                <img src='"); self::select_food_image($foods_rows['food_image']); echo("' alt=''>
                                <div class='short_info'></div>
                            </a>
                        </div>
                    </div>
                    <div class='clearfix visible-xs-block'></div>
                    <div class='col-lg-6 col-md-6 col-sm-6'>
                        <div class='tour_list_desc'>
                            <div class='score'>");
                echo(self::word_score($foods_rows['food_score']));
                echo("<span>{$Functions->EN_numTo_FA($database->escape_value($foods_rows['food_score']),true)}</span>
                            </div>
                            <div class='rating'>");
                echo $Functions->give_start_by_number($foods_rows['food_score']);
                echo ("
                            </div>
                            <h3><strong>{$database->escape_value($foods_rows['food_title'])}</strong> </h3>
                            <p>");
                echo(substr(nl2br(htmlentities($foods_rows['food_description'])),0,150)."...");
                echo("</p>
                <ul class='add_info'>
                              <div class='food-detail fade in'>
                                <h6 class='food-detail-title'>طرز تهیه {$foods_rows['food_title']} </h6>
                                <p>");
                echo(substr(htmlspecialchars($foods_rows['food_details']),0,150)."...");
                echo("</p>
                              </div>
                            </ul>
                        </div>
                    </div>
                    <div class='col-lg-2 col-md-2 col-sm-2'>
                        <div class='price_list'>
                            <div>
                            <sup>{$Functions->EN_numTo_FA($Functions->insert_seperator($database->escape_value($foods_rows['food_main_price'])),true)} تومان</sup>
                            <span class='normal_price_list'>{$Functions->EN_numTo_FA($Functions->insert_seperator($database->escape_value($foods_rows['food_off_price'])),true)} تومان</span>
                            <small>روزانه / شبانه</small>
                            <form action='food_details.php' method='post'>
                                <input name='food_id' type='hidden' value='"); echo($Functions->encrypt_id($foods_rows['food_id'])); echo("' /> 
                                <p><input name='submit' class='food_details_submit' value='طرز تهیه' type='submit' /></p>
                            </form>                   
                            </div>
                        </div>
                    </div>
            </div>
            </div>
                            ");
            }
        }
    }
    public function ShowAllFoodsBy($grid = ""){
        global $database, $Functions;
        $sql = "SELECT * FROM foods ";
        if (isset($_POST["user_show_by_all_hotels_food"])) {
            if (isset($_POST["user_star_score_food"])){
                $this->food_score = $database->escape_value($_POST["user_star_score_food"]);
                if (preg_match("/WHERE/",$sql)){
                    $sql .= " && food_score={$this->food_score} ";
                }else{
                    $sql .= " WHERE food_score={$this->food_score} ";
                }
            }
            if (isset($_POST["user_price_range_food"]) && !(empty($_POST["user_price_range_food"]))){
                $range = $database->escape_value($_POST["user_price_range_food"]);
                $range = explode(";",$range);
                $first_attr = $range[0]; $second_attr = $range[1];
                $first_attr = (int)$first_attr; $second_attr = (int)$second_attr;
                if (preg_match("/WHERE/",$sql)){
                    $sql .= " && food_main_price BETWEEN {$first_attr} AND {$second_attr} ";
                }else{
                    $sql .= " WHERE food_main_price BETWEEN {$first_attr} AND {$second_attr} ";
                }
            }
            $sql .= " ORDER BY food_id DESC";
            if (isset($_POST["user_sort_rating_food"])){
                switch ($_POST["user_sort_rating_food"]) {
                    case "lower":
                        $sql = "SELECT * FROM foods ORDER BY food_score ASC";
                        break;
                    case "higher":
                        $sql = "SELECT * FROM foods ORDER BY food_score DESC";
                        break;
                    default:
                        break;
                }
            }
            if (isset($_POST["user_sort_price_food"])){
                switch ($_POST["user_sort_price_food"]) {
                    case "lower":
                        $sql = "SELECT * FROM foods ORDER BY food_main_price ASC";
                        break;
                    case "higher":
                        $sql = "SELECT * FROM foods ORDER BY food_main_price DESC";
                        break;
                    default:
                        break;
                }
            }
            $database->query("SET NAMES 'utf8'");
            $result = $database->query($sql);
            if($database->num_rows($result) == 0){ echo "<h1 class='no-result'>متاسفانه یافت نشد !</h1>"; }
            while ($foods_rows = $database->fetch_array($result)) {
                if (isset($grid) && $grid == true){
                    echo("
                            <div class='col-md-6 col-sm-6 wow zoomIn' data-wow-delay='0.7s'>
                                    <div class='hotel_container'>
                                        <div class='img_container'>
                                            <a href='#'>
                                                <img src='"); self::select_food_image($foods_rows['food_image']); echo("' width='800' height='533' class='img-responsive' alt='تی شین'>
                                                <div class='score'><span>{$Functions->EN_numTo_FA($database->escape_value($foods_rows['food_score']),true)}</span>"); echo(self::word_score($foods_rows['food_score'])); echo("</div>
                                                <div class='short_info hotel'>"); echo(substr(nl2br(htmlentities($foods_rows['food_description'])),0,150)."..."); echo("<span class='price'><sup>{$Functions->EN_numTo_FA($Functions->insert_seperator($database->escape_value($foods_rows['food_main_price'])),true)} تومان</sup></span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class='hotel_title'>
                                            <h3><strong>{$database->escape_value($foods_rows['food_title'])}</strong></h3>
                                            <div class='rating'>"); echo $Functions->give_start_by_number($foods_rows['food_score']); echo("</div>
                                            <form action='food_details.php' method='post'>
                                                <input name='food_id' type='hidden' value='"); echo($Functions->encrypt_id($foods_rows['food_id'])); echo("' /> 
                                                <p><input name='submit' class='food_details_submit' value='طرز تهیه' type='submit' /></p>
                                            </form>
                                            <div class='wishlist'> <a class='tooltip_flip tooltip-effect-1' href='#'>+<span class='tooltip-content-flip'><span class='tooltip-back'>علاقمند شدم</span></span></a>
                                            </div>
                                        </div>
                                    </div>
                             </div>
                        ");
                } else{
                    echo ("
                                <div class='strip_all_tour_list wow fadeIn animated' data-wow-delay='0.1s' style='visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;'>
                <div class='row'>
                    <div class='col-lg-4 col-md-4 col-sm-4'>
                        <div class='wishlist'> <a class='tooltip_flip tooltip-effect-1' href='javascript:void(0);'>+<span class='tooltip-content-flip'><span class='tooltip-back'>علاقمند شدم</span></span></a>
                        </div>
                        <div class='img_list'>
                            <a href='#'>
                                <div class='ribbon top_rated'></div>
                                <img src='"); self::select_food_image($foods_rows['food_image']); echo("' alt=''>
                                <div class='short_info'></div>
                            </a>
                        </div>
                    </div>
                    <div class='clearfix visible-xs-block'></div>
                    <div class='col-lg-6 col-md-6 col-sm-6'>
                        <div class='tour_list_desc'>
                            <div class='score'>");
                    echo(self::word_score($foods_rows['food_score']));
                    echo("<span>{$Functions->EN_numTo_FA($database->escape_value($foods_rows['food_score']),true)}</span>
                            </div>
                            <div class='rating'>");
                    echo $Functions->give_start_by_number($foods_rows['food_score']);
                    echo ("
                            </div>
                            <h3><strong>{$database->escape_value($foods_rows['food_title'])}</strong> </h3>
                            <p>");
                    echo(substr(nl2br(htmlentities($foods_rows['food_description'])),0,150)."...");
                    echo("</p>
<ul class='add_info'>
                              <div class='food-detail fade in'>
                                <h6 class='food-detail-title'>طرز تهیه {$foods_rows['food_title']} </h6>
                                <p>");
                    echo(substr(htmlspecialchars($foods_rows['food_details']),0,150)."...");
                    echo("</p>
                              </div>
                            </ul>
                        </div>
                    </div>
                    <div class='col-lg-2 col-md-2 col-sm-2'>
                        <div class='price_list'>
                            <div>
                            <sup>{$Functions->EN_numTo_FA($Functions->insert_seperator($database->escape_value($foods_rows['food_main_price'])),true)} تومان</sup>
                            <span class='normal_price_list'>{$Functions->EN_numTo_FA($Functions->insert_seperator($database->escape_value($foods_rows['food_off_price'])),true)} تومان</span>
                            <small>روزانه / شبانه</small>
                            <form action='food_details.php' method='post'>
                                <input name='food_id' type='hidden' value='"); echo($Functions->encrypt_id($foods_rows['food_id'])); echo("' /> 
                                <p><input name='submit' class='food_details_submit' value='طرز تهیه' type='submit' /></p>
                            </form>                   
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
    public function UserََSerachFood($grid = ""){
        global $database,$Functions,$users;
        if (isset($_POST["user_submit_search_food"]) && !(empty($_POST["user_keyword_food"]))) {
            $keyword = $database->escape_value($_POST['user_keyword_food']);
            if (isset($_POST["user_ByWitch_food"])){
                switch ($_POST["user_ByWitch_food"]){
                    case 'Title':
                        $sql = "SELECT * FROM foods WHERE food_title LIKE '%{$keyword}%'";
                        break;
                    case 'Descript':
                        $sql = "SELECT * FROM foods WHERE food_description LIKE '%{$keyword}%'";
                        break;
                    default:
                        $sql = "SELECT * FROM foods WHERE food_title LIKE '%{$keyword}%'";
                        break;
                }
            }
            $result = $database->query($sql);
            if ($database->num_rows($result) > 0) {
                while ($foods_rows = $database->fetch_array($result)) {
                    if (isset($grid) && $grid == true){
                        echo("
                            <div class='col-md-6 col-sm-6 wow zoomIn' data-wow-delay='0.7s'>
                                    <div class='hotel_container'>
                                        <div class='img_container'>
                                            <a href='#'>
                                                <img src='"); self::select_food_image($foods_rows['food_image']); echo("' width='800' height='533' class='img-responsive' alt='تی شین'>
                                                <div class='score'><span>{$Functions->EN_numTo_FA($database->escape_value($foods_rows['food_score']),true)}</span>"); echo(self::word_score($foods_rows['food_score'])); echo("</div>
                                                <div class='short_info hotel'>"); echo(substr(nl2br(htmlentities($foods_rows['food_description'])),0,150)."..."); echo("<span class='price'><sup>{$Functions->EN_numTo_FA($Functions->insert_seperator($database->escape_value($foods_rows['food_main_price'])),true)} تومان</sup></span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class='hotel_title'>
                                            <h3><strong>{$database->escape_value($foods_rows['food_title'])}</strong></h3>
                                            <div class='rating'>"); echo $Functions->give_start_by_number($foods_rows['food_score']); echo("</div>
                                            <form action='food_details.php' method='post'>
                                                <input name='food_id' type='hidden' value='"); echo($Functions->encrypt_id($foods_rows['food_id'])); echo("' /> 
                                                <p><input name='submit' class='food_details_submit' value='طرز تهیه' type='submit' /></p>
                                            </form>
                                            <div class='wishlist'> <a class='tooltip_flip tooltip-effect-1' href='#'>+<span class='tooltip-content-flip'><span class='tooltip-back'>علاقمند شدم</span></span></a>
                                            </div>
                                        </div>
                                    </div>
                             </div>
                        ");
                    } else{
                        echo ("
                                <div class='strip_all_tour_list wow fadeIn animated' data-wow-delay='0.1s' style='visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;'>
                <div class='row'>
                    <div class='col-lg-4 col-md-4 col-sm-4'>
                        <div class='wishlist'> <a class='tooltip_flip tooltip-effect-1' href='javascript:void(0);'>+<span class='tooltip-content-flip'><span class='tooltip-back'>علاقمند شدم</span></span></a>
                        </div>
                        <div class='img_list'>
                            <a href='#'>
                                <div class='ribbon top_rated'></div>
                                <img src='"); self::select_food_image($foods_rows['food_image']); echo("' alt='تی شین'>
                                <div class='short_info'></div>
                            </a>
                        </div>
                    </div>
                    <div class='clearfix visible-xs-block'></div>
                    <div class='col-lg-6 col-md-6 col-sm-6'>
                        <div class='tour_list_desc'>
                            <div class='score'>");
                        echo(self::word_score($foods_rows['food_score']));
                        echo("<span>{$Functions->EN_numTo_FA($database->escape_value($foods_rows['food_score']),true)}</span>
                            </div>
                            <div class='rating'>");
                        echo $Functions->give_start_by_number($foods_rows['food_score']);
                        echo ("
                            </div>
                            <h3><strong>{$database->escape_value($foods_rows['food_title'])}</strong> </h3>
                            <p>");
                        echo(substr(nl2br(htmlentities($foods_rows['food_description'])),0,150)."...");
                        echo("</p>
<ul class='add_info'>
                              <div class='food-detail fade in'>
                                <h6 class='food-detail-title'>طرز تهیه {$foods_rows['food_title']} </h6>
                                <p>");
                        echo(substr(htmlspecialchars($foods_rows['food_details']),0,150)."...");
                        echo("</p>
                              </div>
                            </ul>
                        </div>
                    </div>
                    <div class='col-lg-2 col-md-2 col-sm-2'>
                        <div class='price_list'>
                            <div>
                            <sup>{$Functions->EN_numTo_FA($Functions->insert_seperator($database->escape_value($foods_rows['food_main_price'])),true)} تومان</sup>
                            <span class='normal_price_list'>{$Functions->EN_numTo_FA($Functions->insert_seperator($database->escape_value($foods_rows['food_off_price'])),true)} تومان</span>
                            <small>روزانه / شبانه</small>
                            <form action='food_details.php' method='post'>
                                <input name='food_id' type='hidden' value='"); echo($Functions->encrypt_id($foods_rows['food_id'])); echo("' /> 
                                <p><input name='submit' class='food_details_submit' value='طرز تهیه' type='submit' /></p>
                            </form>                   
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

    // for Display Panel For Admin And Administrator
    // foods_show.php
    public function AllFoods_panel(){
        global $database,$Functions;
        $sql = "SELECT * FROM foods ORDER BY food_id DESC";
        $database->query("SET NAMES 'utf8'");
        $result = $database->query($sql);
        while ($foods_rows = $database->fetch_array($result)){
            echo ("
                                <div class='strip_all_tour_list wow fadeIn animated' id='rooms' data-wow-delay='0.1s' style='visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;'>
                <div class='row'>
                    <div class='col-lg-4 col-md-4 col-sm-4'>
                        <div class='img_list'>
                            <a href='#'>
                                <div class='ribbon top_rated'></div>
                                <img src='../"); self::select_food_image($foods_rows['food_image']); echo("' alt=''>
                                <div class='short_info'></div>
                            </a>
                        </div>
                    </div>
                    <div class='clearfix visible-xs-block'></div>
                    <div class='col-lg-6 col-md-6 col-sm-6'>
                        <div class='tour_list_desc'>
                            <div class='score'>");
            echo(self::word_score($foods_rows['food_score']));
            echo("<span>{$Functions->EN_numTo_FA($database->escape_value($foods_rows['food_score']),true)}</span>
                            </div>
                            <div class='rating'>");
            echo $Functions->give_start_by_number($foods_rows['food_score']);
            echo ("
                            </div>
                            <h3><strong>{$database->escape_value($foods_rows['food_title'])}</strong> </h3>
                            <p>");
            echo(substr(nl2br(htmlentities($foods_rows['food_description'])),0,200)."...");
            echo("</p>
                            <ul class='add_info'>
                              <div class='food-detail fade in'>
                                <h6 class='food-detail-title'>طرز تهیه {$foods_rows['food_title']} </h6>
                                <p>");
                                echo(substr(htmlentities($foods_rows['food_details']),0,200)."...");
                                echo("</p>
                              </div>
                            </ul>
                        </div>
                    </div>
                    <div class='col-lg-2 col-md-2 col-sm-2'>
                        <div class='price_list'>
                            <sup>{$Functions->EN_numTo_FA($Functions->insert_seperator($database->escape_value($foods_rows['food_main_price'])),true)} تومان</sup>
                            <span class='normal_price_list'>{$Functions->EN_numTo_FA($Functions->insert_seperator($database->escape_value($foods_rows['food_off_price'])),true)} تومان</span>
                            <small>روزانه / شبانه</small>
                                                <form action='foods_edit.php' method='post'>
                                                    <input type='submit' name='submit_edit_food' value='Edit Food' class='submit_edit' />
                                                    <input type='hidden' name='food_id' value='");
                                                    echo($Functions->encrypt_id($foods_rows['food_id']));
                                                    echo("' /> 
                                                </form>
                                                <form method='post' action='foods_delete.php'>
                                                    <input type='submit' name='submit_delete_food' value='Delete' class='delete_room_btn' />
                                                    <input type='hidden' name='food_id' value='");
                                                    echo($Functions->encrypt_id($foods_rows['food_id']));
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
    // foods_edit.php
    public function EditFood_panel(){
        global $database,$users,$Functions;
        if (isset($_POST["submit_edit_food"]) && isset($_POST["food_id"])){
            if(preg_match("/^[0-9]*$/",$database->escape_value($Functions->decrypt_id($_POST["food_id"])))){
                $this->food_id = $database->escape_value($Functions->decrypt_id($_POST["food_id"]));
            }else{
                $users->redirect_to("foods_show.php");
            }
        }
        $sql = "SELECT * FROM foods WHERE food_id={$this->food_id}";
        $database->query("SET NAMES 'utf8'");
        $result = $database->query($sql);
        while ($foods_rows = $database->fetch_array($result)){
            echo ("
                                <div class='strip_all_tour_list wow fadeIn animated' id='rooms' data-wow-delay='0.1s' style='visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;'>
                <div class='row'>
                    <div class='col-lg-4 col-md-4 col-sm-4'>
                        <div class='img_list'>
                            <a href='#'>
                                <div class='ribbon top_rated'></div>
                                                <img src='../"); self::select_food_image($foods_rows['food_image']);
                $_SESSION["image_name"] = $foods_rows["food_image"];
                echo("' alt=''>
                                <div class='short_info'></div>
                            </a>
                        </div>
                        <div class='add_photo'>Add Photo +<input type='file' name='foodImage' /></div>
                    <input type='hidden' name='MAX_FILE_SIZE' value='5242880' />
                    </div>
                    <div class='clearfix visible-xs-block'></div>
                    <div class='col-lg-6 col-md-6 col-sm-6'>
                        <div class='tour_list_desc'>
                            <div class='score'>");
                echo(self::word_score($foods_rows['food_score']));
                echo("
                                            <select name='food_score'>
                                                <option {$Functions->auto_select(1, $foods_rows['food_score'])}>1</option>
                                                <option {$Functions->auto_select(2, $foods_rows['food_score'])}>2</option>
                                                <option {$Functions->auto_select(3, $foods_rows['food_score'])}>3</option>
                                                <option {$Functions->auto_select(4, $foods_rows['food_score'])}>4</option>
                                                <option {$Functions->auto_select(5, $foods_rows['food_score'])}>5</option>          
                                            </select>
                                            </div>
                            <h3><input type='text' style='background: white;' value='{$database->escape_value($foods_rows['food_title'])}' name='food_title' maxlength='200' required/></h3>
                                            <p><textarea name='food_description' placeholder='توضیحات غدا' maxlength='1500' required>"); echo($foods_rows['food_description']); echo("</textarea></p>
                            <ul class='add_info'>
                                <p><textarea name='food_details' placeholder='دستور پخت غدا' maxlength='1500' required>"); echo($foods_rows['food_details']); echo("</textarea></p>
                            </ul>
                        </div>
                    </div>
                    <div class='col-lg-2 col-md-2 col-sm-2'>
                                        <div class='price_list'>
                                            <div>
                                            <sup><input type='text' name='food_main_price' placeholder='15.000' class='insert_input' maxlength='10' value='{$database->escape_value($foods_rows['food_main_price'])}' required />  تومان</sup>
                                            <span class='normal_price_list'><input name='food_off_price' placeholder='20.000' class='insert_input' maxlength='200' value='{$database->escape_value($foods_rows['food_off_price'])}' required /> تومان</span>
                                            <small>روزانه / شبانه</small>
                                                <p>
                                                    <input type='hidden' name='food_id' value='");
                                                    echo($Functions->encrypt_id($this->food_id));
                                                    echo("' />
                                                    <input type='submit' name='submit_last_edit_food' class='submit_btn' value='Submit Edit' />
                                                </p>
                                            </div>
                                        </div>
                                        
            </div>
            </div>
                            ");
        }
    }
    // foods_edit.php
    public function UpdateFood(){
        global $database,$users,$Functions;
        if (isset($_POST["submit_last_edit_food"]) && isset($_POST["food_id"])){
            if(preg_match("/^[0-9]*$/",$database->escape_value($Functions->decrypt_id($_POST["food_id"])))){
                $this->food_id = $database->escape_value($Functions->decrypt_id($_POST["food_id"]));
            }else{
                $users->redirect_to("foods_show.php");
            }
            $this->food_title = $database->escape_value($_POST["food_title"]);
            $this->food_description = $database->escape_value($_POST["food_description"]);
            if(isset($_POST["food_details"])){
                $this->food_details = $database->escape_value($_POST["food_details"]);
            }else{
                $this->food_details = "  ";
            }
            if (empty($_POST["food_score"]) || $_POST["food_score"] == 0 || $_POST["food_score"] > 5) {
                $this->food_score = 1;
            }else{
                $this->food_score = $database->escape_value($_POST["food_score"]);
            }
            $this->food_main_price = $database->escape_value($_POST["food_main_price"]);
            $this->food_off_price = $database->escape_value($_POST["food_off_price"]);
            $this->food_off_price = nl2br($this->food_off_price);
            $Functions->photo_upload($_POST["submit_last_edit_food"]);
            $this->food_image = $Functions::$image_name;
            if (isset($_SESSION["image_exists_name"])){
                $this->food_image = $_SESSION["image_exists_name"];
            }
            if ($this->food_image == '' || $this->food_image == null || empty($this->food_image)){
                $this->food_image = $_SESSION["image_name"];
            }
            $this->food_image = $database->escape_value($this->food_image);
            $sql = "UPDATE foods SET food_title='{$this->food_title}' , food_description='{$this->food_description}' , food_score={$this->food_score} , food_main_price='{$this->food_main_price}' , food_off_price='$this->food_off_price' , food_details='$this->food_details' , food_image='$this->food_image' WHERE food_id={$this->food_id}";
            $database->query("SET NAMES 'utf8'");
            $result = $database->query($sql);
            if ($result) {
                $this->food_id = null;
                unset($this->food_id);
                $_SESSION["image_exists_name"] = null;
                unset($_SESSION["image_exists_name"]);
                unset($_SESSION["image_name"]);
                $_SESSION["image_name"] = null;
                $users->redirect_to("foods_show.php");
            }
        }
    }
    // foods_create.php
    public function InsertFood(){
        global $database,$users,$Functions;
        if (isset($_POST["submit_create_food"])){
            $Functions->photo_upload($_POST["submit_create_food"]);
            $this->food_title = $database->escape_value($_POST["food_title"]);
            $this->food_description = $database->escape_value($_POST["food_description"]);
            if (empty($_POST["food_score"]) || $_POST["food_score"] == 0 || $_POST["food_score"] > 5) {
                $this->food_score = 1;
            }else{
                $this->food_score = $database->escape_value($_POST["food_score"]);
            }
            $this->food_main_price = $database->escape_value($_POST["food_main_price"]);
            $this->food_off_price = $database->escape_value($_POST["food_off_price"]);
            $this->food_off_price = nl2br($this->food_off_price);
            $this->food_details = $database->escape_value($_POST["food_details"]);
            $sql = "INSERT INTO foods(food_title,food_description,food_score,food_main_price,food_off_price,food_details,food_image)VALUES('{$this->food_title}','{$this->food_description}',{$this->food_score},'{$this->food_main_price}','{$this->food_off_price}','$this->food_details','{$database->escape_value($Functions::$image_name)}')";
            $database->query("SET NAMES 'utf8'");
            $result = $database->query($sql);
            if ($result) {
                $users->redirect_to("foods_show.php");
            }else{
                echo "مشکل در اضافه کردن غذا";
            }
        }
    }
    // foods_delete.php
    public function DeleteFood(){
        global $database,$users,$Functions;
        if (isset($_POST["submit_delete_food"]) && isset($_POST["food_id"])){
            if(preg_match("/^[0-9]*$/",$database->escape_value($Functions->decrypt_id($_POST["food_id"])))){
                $this->food_id = $database->escape_value($Functions->decrypt_id($_POST["food_id"]));
            }else{
                $users->redirect_to("foods_show.php");
            }
            $AllResult = $this->SelectWithId($this->food_id);
        }
        if ($row = $database->fetch_array($AllResult)){
            $this->food_image = $row["food_image"];
        }
        if ($this->food_image != "default_food.jpg"){
            unlink("../img/foods/".$this->food_image);
        }
        $sql = "DELETE FROM foods WHERE foods.food_id = {$this->food_id} LIMIT 1";
        $result = $database->query($sql);
        if ($result){
            $users->redirect_to('foods_show.php');
        }
    }
    public function CountFood(){
        global $database;
        /*
        $sql = "SELECT COUNT(*) FROM rooms";
        $result = $database->query($sql);
        if($row = $database->fetch_array($result)){
            echo $row['COUNT(*)'];
        }
        */
        // OR
        $sql = "SELECT COUNT(*) AS food_count FROM foods";
        $result = $database->query($sql);
        if($row = $database->fetch_array($result)){
            echo $row['food_count'];
        }
    }

    // functions for foods
    public function SelectWithId($id){
        global $database,$Functions;
        $id = $database->escape_value($id);
        $sql = "SELECT * FROM foods WHERE food_id ={$id}";
        $result = $database->query($sql);
        return $result;
    }
    public static function FoodAttributeById($id){
        global $database,$Functions;
        $id = $Functions->decrypt_id($id);
        $id = $database->escape_value($id);
        $sql = "SELECT * FROM foods WHERE food_id={$id} ";
        $database->query("SET NAMES 'utf8'");
        $result = $database->query($sql);
        return $foods_rows = $database->fetch_array($result);
    }
    public function word_score($food_score){
        if($food_score == 1) { return 'قابل قبول'; }
        else if ($food_score == 2){ return 'متوسط'; }
        else if ($food_score == 3){ return 'خوب'; }
        else if ($food_score == 4){ return 'خیلی خوب'; }
        else if ($food_score == 5){ return 'عالی'; }
    }
    public function select_food_image($foods_rows){
        global $database;
        if(!(empty($foods_rows))){
            echo 'img/foods/'.$database->escape_value($foods_rows);
        }else{
            echo 'img/foods/default_food.jpg';
        }
    }

    //function for search food
    public function SerachFood(){
        global $database,$users,$Functions;
        if (isset($_POST["panel_submit_search_food"]) && !(empty($_POST["panel_keyword_food"]))) {
            $keyword = $database->escape_value($_POST['panel_keyword_food']);
            if (isset($_POST["panel_ByWitch_food"])){
                switch ($_POST["panel_ByWitch_food"]){
                    case 'Title':
                        $sql = "SELECT * FROM foods WHERE food_title LIKE '%{$keyword}%'";
                        break;
                    case 'Descript':
                        $sql = "SELECT * FROM foods WHERE food_description LIKE '%{$keyword}%'";
                        break;
                    case 'Score':
                        $sql = "SELECT * FROM foods WHERE food_score LIKE '{$keyword}'";
                        break;
                    case 'Price':
                        $sql = "SELECT * FROM foods WHERE food_main_price LIKE '{$keyword}%'";
                        break;
                    case 'Off-Price':
                        $sql = "SELECT * FROM foods WHERE food_off_price LIKE '{$keyword}%'";
                        break;
                    case 'Details':
                        $sql = "SELECT * FROM foods WHERE food_details LIKE '%{$keyword}%'";
                        break;
                    default:
                        $sql = "SELECT * FROM foods WHERE food_title LIKE '%{$keyword}%'";
                }
            }
            $result = $database->query($sql);
            if ($database->num_rows($result) > 0) {
                while ($foods_rows = $database->fetch_array($result)) {
                    echo ("
                                <div class='strip_all_tour_list wow fadeIn animated' id='rooms' data-wow-delay='0.1s' style='visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;'>
                <div class='row'>
                    <div class='col-lg-4 col-md-4 col-sm-4'>
                        <div class='wishlist'> <a class='tooltip_flip tooltip-effect-1' href='javascript:void(0);'>+<span class='tooltip-content-flip'><span class='tooltip-back'>علاقمند شدم</span></span></a>
                        </div>
                        <div class='img_list'>
                            <a href='#'>
                                <div class='ribbon top_rated'></div>
                                <img src='../"); self::select_food_image($foods_rows['food_image']); echo("' alt=''>
                                <div class='short_info'></div>
                            </a>
                        </div>
                    </div>
                    <div class='clearfix visible-xs-block'></div>
                    <div class='col-lg-6 col-md-6 col-sm-6'>
                        <div class='tour_list_desc'>
                            <div class='score'>");
                    echo(self::word_score($foods_rows['food_score']));
                    echo("<span>{$Functions->EN_numTo_FA($database->escape_value($foods_rows['food_score']),true)}</span>
                            </div>
                            <div class='rating'>");
                    echo $Functions->give_start_by_number($foods_rows['food_score']);
                    echo ("
                            </div>
                            <h3><strong>{$database->escape_value($foods_rows['food_title'])}</strong> </h3>
                            <p>");
                    echo(substr(nl2br(htmlentities($foods_rows['food_description'])),0,200)."...");
                    echo("</p>
                            <ul class='add_info'>
                              <div class='food-detail fade in'>
                                <h6 class='food-detail-title'>طرز تهیه {$foods_rows['food_title']} </h6>
                                <p>");
                    echo(substr(htmlentities($foods_rows['food_details']),0,200)."...");
                    echo("</p>
                              </div>
                            </ul>
                        </div>
                    </div>
                    <div class='col-lg-2 col-md-2 col-sm-2'>
                        <div class='price_list'>
                            <sup>{$Functions->EN_numTo_FA($Functions->insert_seperator($database->escape_value($foods_rows['food_main_price'])),true)} تومان</sup>
                            <span class='normal_price_list'>{$Functions->EN_numTo_FA($Functions->insert_seperator($database->escape_value($foods_rows['food_off_price'])),true)} تومان</span>
                            <small>روزانه / شبانه</small>
                                                <form action='foods_edit.php' method='post'>
                                                    <input type='submit' name='submit_edit_food' value='Edit Food' class='submit_edit' />
                                                    <input type='hidden' name='food_id' value='");
                    echo($Functions->encrypt_id($foods_rows['food_id']));
                    echo("' /> 
                                                </form>
                                                <form method='post' action='foods_delete.php'>
                                                    <input type='submit' name='submit_delete_food' value='Delete' class='delete_room_btn' />
                                                    <input type='hidden' name='food_id' value='");
                    echo($Functions->encrypt_id($foods_rows['food_id']));
                    echo("' />
                                                </form>
                            </div>
                        </div>
                    </div>
            </div>
            </div>
                            ");
                }
            } else {
                echo "<h1 class='no-result'>No Result !</h1>";
            }
        }else{
            $users->redirect_to("foods_show.php");
        }
    }
}
$foods = new Foods();
?>