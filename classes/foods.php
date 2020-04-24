<?php
require_once("database.php");
require_once("sessions.php");
require_once("functions.php");
class Foods{
    public $food_id;
    public $food_title; // VARCHAR(200) NOT NULL
    public $food_description; // TEXT NOT NULL
    public $food_score; // TINYINT(1)
    public $food_main_price; // VARCHAR(10) NOT NULL
    public $food_off_price; // VARCHAR(200) NOT NULL
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
    // foods_list.php
    public static function AllFoods(){
        global $database,$Functions;
        $sql = "SELECT * FROM foods ORDER BY food_id DESC";
        $database->query("SET NAMES 'utf8'");
        $result = $database->query($sql);
        while ($foods_rows = $database->fetch_array($result)){
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
            echo("<span>{$database->escape_value($foods_rows['food_score'])}</span>
                            </div>
                            <div class='rating'>");
            if($database->escape_value($foods_rows['food_score']) == 1 || $database->escape_value($foods_rows['food_score']) == 2){
                echo "<i class='icon-star voted'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i>";
            }else if($database->escape_value($foods_rows['food_score']) == 3 || $database->escape_value($foods_rows['food_score']) == 4){
                echo "<i class='icon-star voted'></i><i class='icon-star voted'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i>";
            }else if($database->escape_value($foods_rows['food_score']) == 5 || $database->escape_value($foods_rows['food_score']) == 6){
                echo "<i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i>";
            }else if($database->escape_value($foods_rows['food_score']) == 7 || ($foods_rows['food_score']) == 8){
                echo "<i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i></i><i class='icon-star-empty'></i>";
            }else if($database->escape_value($foods_rows['food_score']) == 9 || $database->escape_value($foods_rows['food_score']) == 10){
                echo "<i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i>";
            }else{
                return null;
            }
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
                                echo(substr(htmlentities($foods_rows['food_details']),0,150)."...");
                                echo("</p>
                              </div>
                            </ul>
                        </div>
                    </div>
                    <div class='col-lg-2 col-md-2 col-sm-2'>
                        <div class='price_list'>
                            <div>
                            <sup>{$database->escape_value($foods_rows['food_main_price'])} تومان</sup>
                            <span class='normal_price_list'>{$database->escape_value($foods_rows['food_off_price'])} تومان</span>
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
            echo("<span>{$database->escape_value($foods_rows['food_score'])}</span>
                            </div>
                            <div class='rating'>");
            if($database->escape_value($foods_rows['food_score']) == 1 || $database->escape_value($foods_rows['food_score']) == 2){
                echo "<i class='icon-star voted'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i>";
            }else if($database->escape_value($foods_rows['food_score']) == 3 || $database->escape_value($foods_rows['food_score']) == 4){
                echo "<i class='icon-star voted'></i><i class='icon-star voted'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i>";
            }else if($database->escape_value($foods_rows['food_score']) == 5 || $database->escape_value($foods_rows['food_score']) == 6){
                echo "<i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i>";
            }else if($database->escape_value($foods_rows['food_score']) == 7 || ($foods_rows['food_score']) == 8){
                echo "<i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i></i><i class='icon-star-empty'></i>";
            }else if($database->escape_value($foods_rows['food_score']) == 9 || $database->escape_value($foods_rows['food_score']) == 10){
                echo "<i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i>";
            }else{
                return null;
            }
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
                            <sup>{$database->escape_value($foods_rows['food_main_price'])} تومان</sup>
                            <span class='normal_price_list'>{$database->escape_value($foods_rows['food_off_price'])} تومان</span>
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
                                                <option {$Functions->auto_select(6, $foods_rows['food_score'])}>6</option>
                                                <option {$Functions->auto_select(7, $foods_rows['food_score'])}>7</option>
                                                <option {$Functions->auto_select(8, $foods_rows['food_score'])}>8</option>
                                                <option {$Functions->auto_select(9, $foods_rows['food_score'])}>9</option>
                                                <option {$Functions->auto_select(10, $foods_rows['food_score'])}>10</option>          
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
            if (empty($_POST["food_score"]) || $_POST["food_score"] == 0 || $_POST["food_score"] > 10) {
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
            if (empty($_POST["food_score"]) || $_POST["food_score"] == 0 || $_POST["food_score"] > 10) {
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
        if($food_score == 1 || $food_score == 2) { return 'قابل قبول'; }
        else if ($food_score == 3 || $food_score == 4){ return 'متوسط'; }
        else if ($food_score == 5 || $food_score == 6){ return 'خوب'; }
        else if ($food_score == 7 || $food_score == 8){ return 'خیلی خوب'; }
        else if ($food_score == 9 || $food_score == 10){ return 'عالی'; }
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
        if (isset($_POST["submit_search"]) && !(empty($_POST["keyword"]))) {
            $keyword = $database->escape_value($_POST['keyword']);
            if (isset($_POST["ByWitch"])){
                switch ($_POST["ByWitch"]){
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
                    echo("<span>{$database->escape_value($foods_rows['food_score'])}</span>
                            </div>
                            <div class='rating'>");
                    if($database->escape_value($foods_rows['food_score']) == 1 || $database->escape_value($foods_rows['food_score']) == 2){
                        echo "<i class='icon-star voted'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i>";
                    }else if($database->escape_value($foods_rows['food_score']) == 3 || $database->escape_value($foods_rows['food_score']) == 4){
                        echo "<i class='icon-star voted'></i><i class='icon-star voted'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i>";
                    }else if($database->escape_value($foods_rows['food_score']) == 5 || $database->escape_value($foods_rows['food_score']) == 6){
                        echo "<i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i>";
                    }else if($database->escape_value($foods_rows['food_score']) == 7 || ($foods_rows['food_score']) == 8){
                        echo "<i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i></i><i class='icon-star-empty'></i>";
                    }else if($database->escape_value($foods_rows['food_score']) == 9 || $database->escape_value($foods_rows['food_score']) == 10){
                        echo "<i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i>";
                    }else{
                        return null;
                    }
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
                            <sup>{$database->escape_value($foods_rows['food_main_price'])} تومان</sup>
                            <span class='normal_price_list'>{$database->escape_value($foods_rows['food_off_price'])} تومان</span>
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