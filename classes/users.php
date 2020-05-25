<?php
ob_start();
require_once("database.php");
require_once("sessions.php");
require_once("functions.php");
    class Users extends MYSQLDatabase{
        private $user_id;
        private $username;
        private $password;
        private $tel;
        private $user_mode;
        public $user_image;
        private $repeat_password;
        private $random_code;
        public $errors;
        public $error_state;
        // everybody is user like of admin
        // admin user_mode = 1
        // administrator user_mode = 13
        public function redirect_to($to){
            header("Location: ".$to);
            exit;
        }
        public function signup(){
            global $database;
            if (isset($_POST["submit"])) {
                $this->username = $_POST["username"];
                $this->password = $this->mytrim($_POST["password"]);
                $this->tel = $this->mytrim($_POST["tel"]);
                $this->repeat_password = $this->mytrim($_POST["repeat_password"]);
                    if (isset($this->username) && !empty($this->username) && isset($this->password) && !empty($this->password) && isset($this->tel) && !empty($this->tel) && isset($this->repeat_password) && !empty($this->repeat_password) && $this->check_tel($this->tel) == 0 && $this->password_rate($this->password) == 0 && $this->check_username($this->username) == 0) {
                        if($_POST["random_captcha_code"] != $_SESSION["random_captcha_code"]){
                            $_SESSION["errors_message"] = "کد کپچا نادرست وارد شده .";
                            $this->error_state = 1;
                            return $this->error_state;
                            $this->redirect_to("register.php");
                        }else {
                            $this->username = $database->escape_value($this->username);
                            $this->password = $database->escape_value($this->password);
                            $this->tel = $database->escape_value($this->tel);
                            $_SESSION["username"] = $this->username;
                            $_SESSION["tel"] = $this->mytrim($this->tel);
                            $_SESSION["password"] = $this->mytrim($this->password);
                            $code = $this->random_num_generator();
                            /*$this->send_code_with_sms($this->tel,$_SESSION["random_code"],$this->username);*/
                            $this->redirect_to("code.php");
                        }

                    } elseif (empty($this->username) || empty($this->password) || empty($this->tel) || empty($this->repeat_password)) {
                        $_SESSION["errors_message"] .= 'برخی از فیلد ها خالی است .';
                        $this->error_state = 1;
                        return $this->error_state;
                    }
                }
        }
        public function login(){
            global $database,$Functions;
            if (isset($_POST["login_submit"])){
                $this->tel = $this->mytrim($_POST["tel"]);
                $this->password = $this->mytrim($_POST["password"]);
                $this->tel = $database->escape_value($this->tel);
                $this->password = $database->escape_value($this->password);
                if (isset($_POST["tel"]) && !(empty($_POST["tel"])) && isset($_POST["password"]) && !(empty($_POST["password"])) && $this->password_rate_login($this->password) == 0) {
                    $sql_login = "SELECT * FROM users WHERE tel='{$this->tel}' AND password='{$this->password}' LIMIT 1";
                    if($_POST["random_captcha_code"] != $_SESSION["random_captcha_code"]){
                        $_SESSION["errors_message"] = "کد کپچا نادرست وارد شده .";
                        $this->error_state = 1;
                        return $this->error_state;
                        $this->redirect_to("login.php");
                    }
                    $result = $database->query($sql_login);
                    if ($database->num_rows($result) == 1) {
                        $_SESSION["logged_in"] = true;
                        if($users_row = $database->fetch_array($result)){
                            $Functions->write_logfile($users_row["username"],$this->tel);
                            $_SESSION["user_id"] = $users_row["id"];
                            $_SESSION["random_captcha_code"] = null;
                            unset($_SESSION["random_captcha_code"]);
                            $_SESSION["username"] = $users_row["username"];
                            switch($users_row["user_mode"]) {
                                case 0:
                                    $_SESSION["user_mode"] = 0;
                                    $this->redirect_to("index.php");
                                    break;
                                case 1:
                                    $_SESSION["user_mode"] = 1;
                                    $_SESSION["logged_in_admin"] = true;
                                    $this->redirect_to("panel/admin.php");
                                    break;
                                case 13:
                                    $_SESSION["user_mode"] = 13;
                                    $_SESSION["logged_in_administrator"] = true;
                                    $this->redirect_to("panel/administrator.php");
                                    break;
                                default:
                                    $this->redirect_to("index.php");
                                    break;
                            }
                        }

                    }else{
                        if(isset($_SESSION["errors_message"]))
                            $_SESSION["errors_message"] .= 'شماره یا رمز اشتباه است !!';
                        else
                            $_SESSION["errors_message"] = 'شماره یا رمز اشتباه است !!';
                        $this->error_state = 1;
                        return $this->error_state;
                        $this->redirect_to("login.php");
                    }
                } elseif (empty($this->password) || empty($this->tel)) {
                    $_SESSION["errors_message"] .= 'برخی از فیلد ها خالی است .';
                    $this->error_state = 1;
                    return $this->error_state;
                }
            }
        }
        public function send_code_with_sms($receptor,$code,$username){
            require 'kavenegar-api/KavenegarApi.php';
            $sender = "1000596446";
            $receptor = @trim($receptor);
            $message = $username. " , کد شما این است ".$code;
            $api = new \Kavenegar \KavenegarApi("7075342B51466A4D536B534E464973534541317973394A66675052766E65546346417877725530726131453D");
            if($api -> Send ( $sender,$receptor,$message)){
                return null;
            }else{
                $_SESSION["errors_message"] .= 'مشکل در ارسال کد !! .';
                $this->error_state = 1;
            }

        }
        public function insert_user_verify_code(){
            global $database,$Functions;
                $this->username = $_SESSION["username"];
                $this->password = $_SESSION["password"];
                $this->tel = $_SESSION["tel"];
                $this->random_code = $_SESSION["random_code"];
                if (isset($_POST["submit"]) && isset($_SESSION["random_code"]) && !(empty($_POST["code"])) && is_numeric($this->tel) && $this->check_tel($this->tel) == 0){
                        $code = $_POST["code"];
                    if ($code == $this->random_code){
                        $database->query("SET NAMES 'utf8'");
                        $sql = "INSERT INTO `users`(`username`,`password`,`tel`,user_mode) VALUES ('{$this->username}','{$this->password}','{$this->tel}',0)";
                        $result = $database->query($sql);
                        if ($result) {
                            $_SESSION["logged_in"] = true;
                            $_SESSION["user_mode"] = 0;
                            if($user_row = $database->fetch_array($this->SelectByTelAndPassword($this->tel,$this->password))){ $_SESSION["user_id"] = $user_row["id"]; }
                            $Functions->write_logfile($this->username,$this->tel);
                            $_SESSION["random_code"] = null;
                            unset($_SESSION["random_code"]);
                            $this->redirect_to("index.php");
                        }else{
                            $_SESSION["logged_in"] = false;
                            $this->redirect_to("register.php");
                            echo '<script>alert("خطا در ثبت نام")</script>';
                        }
                    }else{
                         $_SESSION["errors_message"] .='کد اشتباه است .';
                         $this->error_state = 1;
                         return $this->error_state;
                    }
                }else if(!(isset($_SESSION["random_code"]))){
                    $this->redirect_to("register.php");
                }else{
                    $_SESSION["errors_message"] =' ';
                    $_SESSION["errors_message"] .='لطفا کد را وارد کنید .';
                    $this->error_state = 1;
                    return $this->error_state;
                }

        }
        public function SelectByTelAndPassword($tel,$password){
            global $database;
            $sql = "SELECT * FROM users WHERE tel='{$tel}' AND password='{$password}'";
            $result = $database->query($sql);
            return $result;
        }
        public function mytrim($str){
            $str = str_replace(" ","",$str);
            return $str;
        }
        public function check_username($username){
            $this->username = $username;
            if ((strlen($this->username)) >= 100){
                $_SESSION["errors_message"] .= 'نام کاربری کمتر از 99 کارکتر باشد .';
                $this->error_state = 1;
                return $this->error_state;
                $this->redirect_to("register.php");
            }
        }
        public function password_rate($password){
            if (!(isset($_SESSION["errors_message"])) && empty($_SESSION["errors_message"])){
                $_SESSION["errors_message"] = " ";
            }
            $this->password = $password;
            if (strlen($this->password) < 8 || strlen($this->repeat_password) < 8) {
                    $_SESSION["errors_message"] .= 'رمز بالای ۸ رقم باشد .';
                    $this->error_state = 1;
                    return $this->error_state;
            }
            else if($this->password !== $this->repeat_password){
                $_SESSION["errors_message"] .= 'مغایرت در تکرار رمز .';
                $this->error_state = 1;
                return $this->error_state;
            }
        }
        public function password_rate_login($password){
            $this->password = $password;
            if (strlen($this->password) < 8) {
                $_SESSION["errors_message"] .= 'رمز بالای ۸ رقم باشد .';
                $this->error_state = 1;
                return $this->error_state;
            }
        }

        // this function for reset password
        public function CheckResetPassword(){
            global $database;
            if (isset($_POST["submit"]) && isset($_POST["tel"])){
                $this->tel = $database->escape_value($_POST["tel"]);
                if ($this->check_tel_for_reset_pass($this->tel) == 0){
                    $this->random_num_generator();
                    /*$this->send_code_with_sms($this->tel,$_SESSION["random_code"],"تی شین");*/
                    $_SESSION["reset_tel"] = $this->tel;
                    $this->redirect_to("reset_password_check.php");
                }else{
                    $_SESSION["reset_tel"] = null;
                    unset($_SESSION["reset_tel"]);
                    $this->redirect_to("reset_password.php");
                }
            }
        }
        public function ResetPasswordCheckCode(){
            global $database;
            $this->tel = $database->escape_value($_SESSION["reset_tel"]);
            $this->random_code = $_SESSION["random_code"];
            if (isset($_POST["reset_pass_submit"]) && isset($_SESSION["random_code"]) && !(empty($_POST["code"])) && is_numeric($this->tel) && $this->check_tel_for_reset_pass($this->tel) == 0){
                $code = $_POST["code"];
                if ($code == $this->random_code){
                    $_SESSION["random_code"] = null;
                    unset($_SESSION["random_code"]);
                    $_SESSION["reset_ok"] = true;
                    $this->redirect_to("reset_password_submit.php");
                }else{
                    $_SESSION["errors_message"] .='کد اشتباه است .';
                    $this->error_state = 1;
                    return $this->error_state;
                    $this->redirect_to("reset_password_check.php");
                }
            }else if(!(isset($_SESSION["random_code"]))){
                $this->redirect_to("reset_password.php");
            }else{
                $_SESSION["errors_message"] =' ';
                $_SESSION["errors_message"] .='لطفا کد را وارد کنید .';
                $this->error_state = 1;
                return $this->error_state;
            }

        }
        public function ResetPassword(){
            global $database,$Functions;
            if (isset($_SESSION["reset_ok"]) && $_SESSION["reset_tel"] && isset($_POST["password"]) && isset($_POST["repeat_password"])){
                $this->password = $this->mytrim($_POST["password"]);
                $this->repeat_password = $this->mytrim($_POST["repeat_password"]);
                if ($this->password_rate($this->password) == 0){
                    $this->tel = $database->escape_value($_SESSION["reset_tel"]);
                    $_SESSION["reset_tel"] = null;
                    unset($_SESSION["reset_tel"]);
                    $_SESSION["reset_ok"] = null;
                    unset($_SESSION["reset_ok"]);
                    $_SESSION["reset_tel"] = null;
                    unset($_SESSION["reset_tel"]);
                    $this->password = $database->escape_value($_POST["password"]);
                    $this->repeat_password = $database->escape_value($_POST["repeat_password"]);
                    $sql = "UPDATE users SET password='{$this->password}' WHERE tel={$this->tel}";
                    $database->query("SET NAMES 'utf8'");
                    $result = $database->query($sql);
                    if ($result) {
                        $_SESSION["logged_in"] = true;
                        if($user_row = $database->fetch_array($this->SelectByTelAndPassword($this->tel,$this->password))){
                            $this->username = $user_row["username"];
                            $_SESSION["user_id"] = $user_row["id"];
                            switch($user_row["user_mode"]) {
                                case 0:
                                    $_SESSION["user_mode"] = 0;
                                    $_SESSION["errors_message"] = " ";
                                    $_SESSION["errors_message"] = "رمز با موفقیت تغییر کرد";
                                    $this->redirect_to("index.php");
                                    break;
                                case 1:
                                    $_SESSION["user_mode"] = 1;
                                    $_SESSION["logged_in_admin"] = true;
                                    $_SESSION["errors_message"] = " ";
                                    $_SESSION["errors_message"] = "رمز با موفقیت تغییر کرد";
                                    $this->redirect_to("panel/admin.php");
                                    break;
                                case 13:
                                    $_SESSION["user_mode"] = 13;
                                    $_SESSION["logged_in_administrator"] = true;
                                    $_SESSION["errors_message"] = " ";
                                    $_SESSION["errors_message"] = "رمز با موفقیت تغییر کرد";
                                    $this->redirect_to("panel/administrator.php");
                                    break;
                                default:
                                    $this->redirect_to("index.php");
                                    break;
                            }
                        }
                        $Functions->write_logfile($this->username,$this->tel);
                        $this->redirect_to("index.php");
                    }else{
                        $_SESSION["logged_in"] = false;
                        echo '<script>window.replace("index.php");</script>';
                        echo '<script>alert("خطا در ورود به سیستم")</script>';
                    }
                }
            }
        }
        public function check_tel_for_reset_pass($tel){
            global $database;
            if (isset($tel)) {
                $this->tel = $database->escape_value($tel);
                $sql = "SELECT tel FROM users WHERE tel='{$this->tel}'";
                $result = $database->query($sql);
                if ($database->num_rows($result) == 0) {
                    if (isset($_SESSION["errors_message"])) {
                        $_SESSION["errors_message"] = 'این شماره موبایل ثبت نشده !! لطفا ثبت نام کنید .';
                        $this->error_state = 1;
                        return $this->error_state;
                    }
                }
                if (strlen($this->tel) != 11){
                    $_SESSION["errors_message"] .= 'شماره تلفن ۱۱ رقمی باشد .';
                    $this->error_state = 1;
                    return $this->error_state;
                }
                if ((substr($this->tel,0,2)) !== "09"){
                    $_SESSION["errors_message"] = ' ';
                    $_SESSION["errors_message"] .= 'شماره تلفن  با 09 شروع شود .';
                    $this->error_state = 1;
                    return $this->error_state;
                }
                if(!(is_numeric($this->tel))){
                    $_SESSION["errors_message"] .= 'شماره تلفن عدد باشد .';
                    $this->error_state = 1;
                    return $this->error_state;
                }
                if(!preg_match( '/^[\-+]?[0-9]*\.*\,?[0-9]+$/', $this->tel)){
                    $_SESSION["errors_message"] .= 'در فیلد شماره تلفن فقط از اعداد استفاده کنید .';
                    $this->error_state = 1;
                    return $this->error_state;
                }
            }
        }
        /////////////////////////////////////////

        public function password_encrypt($pass){

        }
        public function check_tel($tel){
            global $database;
            if (isset($tel)) {
                $this->tel = $database->escape_value($tel);
                $sql = "SELECT tel FROM users WHERE tel='{$this->tel}'";
                $result = $database->query($sql);
                if ($database->num_rows($result) > 0) {
                    if (isset($_SESSION["errors_message"])){
                        $_SESSION["errors_message"] .= 'این شماره موبایل قبلا ثبت شده !! لطفا از شماره دیگری استفاده کنید .';
                        $this->error_state = 1;
                        return $this->error_state;
                    }else{
                        $_SESSION["errors_message"] = 'این شماره موبایل قبلا ثبت شده !! لطفا از شماره دیگری استفاده کنید .';
                        $this->error_state = 1;
                        return $this->error_state;
                    }
                }
                if (strlen($this->tel) != 11){
                    $_SESSION["errors_message"] .= 'شماره تلفن ۱۱ رقمی باشد .';
                    $this->error_state = 1;
                    return $this->error_state;
                }
                if ((substr($this->tel,0,2)) !== "09"){
                    $_SESSION["errors_message"] = ' ';
                    $_SESSION["errors_message"] .= 'شماره تلفن  با 09 شروع شود .';
                    $this->error_state = 1;
                    return $this->error_state;
                }
                if(!(is_numeric($this->tel))){
                    $_SESSION["errors_message"] .= 'شماره تلفن عدد باشد .';
                    $this->error_state = 1;
                    return $this->error_state;
                }
                if(!preg_match( '/^[\-+]?[0-9]*\.*\,?[0-9]+$/', $this->tel)){
                    $_SESSION["errors_message"] .= 'در فیلد شماره تلفن فقط از اعداد استفاده کنید .';
                    $this->error_state = 1;
                    return $this->error_state;
                }
            }
        }
        public function Errors(){
            if (isset($_SESSION["errors_message"])){
                $error_explode = explode(".",$_SESSION["errors_message"]);
                $error_implode = implode("<br />",$error_explode);
                return $error_implode;
            }
        }
        private function random_num_generator(){
            $_SESSION["random_code"] = rand(10000,99999);
        }





        // this functions for admins panel
        public function AllAdmins(){
            global $database,$Functions;
            // Admins id equal 1
            $sql = "SELECT * FROM users WHERE user_mode=1";
            $result = $database->query($sql);

            while($admins_row = $database->fetch_array($result)){
                    echo("
                    
                        <tr style='background: #d75e30'>
                            <td><img class='finger-img' style='border:2px solid darkorange' src='"); self::select_user_image($admins_row['user_image']); echo("' alt='تی شین'></td>
                            <td class='admins_username'>{$admins_row['username']}</td>
                            <td class='admins_tel'>{$admins_row['tel']}</td>
                            <td>
                                <form action='admins_edit.php' method='post'>
                                    <input type='hidden' name='admin_id' value='"); echo($Functions->encrypt_id($admins_row['id'])); echo("'/>
                                    <input type='submit' name='submit_edit_admin' class='input_edit_admins' value='Edit' />
                                </form>
                            </td>
                            <td>
                                <form action='admins_delete.php' method='post'>
                                    <input type='hidden' name='admin_id' value='"); echo($Functions->encrypt_id($admins_row['id'])); echo("'/>
                                    <input type='submit' name='submit_delete_admin' class='input_delete_admins delete_room_btn' value='Delete' />
                                </form>
                            </td>
                        </tr>
                    ");
            }
        }
        public function EditAdmins_panel(){
            global $database,$Functions;
            // Admins id equal 1
            if (isset($_POST["submit_edit_admin"]) && !(empty($_POST["submit_edit_admin"])) && isset($_POST["admin_id"]) && !(empty($_POST["admin_id"]))){
                if (preg_match("/^[0-9]*$/",$database->escape_value($Functions->decrypt_id($_POST["admin_id"])))){
                    $this->user_id = $Functions->decrypt_id($_POST["admin_id"]);
                }
                $sql = "SELECT * FROM users WHERE id={$this->user_id} AND user_mode=1";
                $result = $database->query($sql);

                if($admins_row = $database->fetch_array($result)) {
                    echo("
                            <div class='edit_admin_panel col-xs-12'>
                            <form action='{$_SERVER['PHP_SELF']}' method='post' enctype='multipart/form-data'>
                                        <div class='img_list col-lg-4 col-md-4 col-sm-6 col-xs-12' id='edit_admin_image'>
                                            <img src='"); self::select_user_image($admins_row['user_image']);
                $_SESSION["image_name"] = $admins_row['user_image'];
                echo("' alt=''>
                                            <select id='select-input-image' name='select-input-image'>
                                                <option value='browse-file' name='browseFileOption' id='browse-file'>Browse File...</option>
                                                <option value='url-image' name='urlImageOption' id='url-image'>Link Or Url Image</option> 
                                            </select>  
                                            <div class='add_photo_user'>Add Photo +<input type='file' id='browse-file-input' class='edit_input_image' name='userImage' /><input type='url' id='url-image-input' placeholder='www.image.com' class='edit_input_image' name='userImageUrl' /></div>
                                        </div>
                                        <input type='hidden' name='MAX_FILE_SIZE' value='3145728' />
                                            <input type='hidden' name='admin_id' value='");
                        echo($Functions->encrypt_id($admins_row['id']));
                        echo("'/>
                                        <div class='admin_info col-xs-12'>
                                            <span id='admin_label'>UserName&nbsp;:</span>&nbsp;<input class='edit_admin_username' value='{$admins_row['username']}' name='admin_username' /><hr />
                                            <span id='admin_label'>Tel:</span>&nbsp;<span class='edit_admin_tel'>{$admins_row['tel']}</span><hr />
                                            
                                            <input type='submit'  name='submit_last_edit_admin' class='edit_admin_input' value='Edit' /> 
                                       
                                    </form>
                                        <form action='admins_delete.php' method='post'>
                                            <input type='hidden' name='admin_id' value='");
                        echo($Functions->encrypt_id($admins_row['id']));
                        echo("'/>
                                            <input type='submit' name='submit_delete_admin' class='edit_delete_admins delete_room_btn' value='Delete' />
                                        </form>
                                    </div>
                                
                                </div>
                        ");
                }
            }else{
                $this->redirect_to("admins_show.php");
            }
        }
        public function UpdateAdmin(){
            global $database,$Functions;
            if (isset($_POST["submit_last_edit_admin"]) && !(empty($_POST["submit_last_edit_admin"])) && isset($_POST["admin_id"]) && !(empty($_POST["admin_id"]))){
                if (preg_match("/^[0-9]*$/",$database->escape_value($Functions->decrypt_id($_POST["admin_id"])))){
                    $this->user_id = $Functions->decrypt_id($_POST["admin_id"]);
                }else{
                    $this->redirect_to("admins_show.php");
                }
                if (!(isset($_POST["admin_username"])) || empty($_POST["admin_username"])){
                    $_SESSION["errors_message"] .= "نام کاربری نباید خالی باشد .";
                    $this->error_state = 1;
                    return $this->error_state;
                    $this->redirect_to("admins_show.php");
                }
                $this->username = $database->escape_value($_POST["admin_username"]);

                    $Functions->photo_upload($_POST["submit_last_edit_admin"]);
                    $this->user_image = $Functions::$image_name;
                    if (isset($_SESSION["image_exists_name"])) {
                        $this->user_image = $_SESSION["image_exists_name"];
                    }
                    if ($this->user_image == '' || $this->user_image == null || empty($this->user_image)) {
                        $this->user_image = $_SESSION["image_name"];
                    }
                    if (isset($_POST["userImageUrl"]) && !(empty($_POST["userImageUrl"])) && filter_var($_POST["userImageUrl"],FILTER_VALIDATE_URL)){
                        $this->user_image = $database->escape_value($_POST["userImageUrl"]);
                    }else if (!filter_var($_POST["userImageUrl"],FILTER_VALIDATE_URL)){
                        $_SESSION["errors_message"] .= "لینک عکس نا معتبر است !  .";
                    }
                    $sql = "UPDATE users SET username='{$this->username}' , user_image='{$database->escape_value($this->user_image)}' WHERE id={$this->user_id}";
                    $database->query("SET NAMES 'utf8'");
                    $result = $database->query($sql);
                    if ($result) {
                        $this->user_id = null;
                        unset($this->user_id);
                        $_SESSION["image_exists_name"] = null;
                        unset($_SESSION["image_exists_name"]);
                        unset($_SESSION["image_name"]);
                        $_SESSION["image_name"] = null;
                        $this->redirect_to("admins_show.php");
                    }
            }else{
                $this->redirect_to("admins_show.php");
            }
        }
        public function DeleteAdmin(){
            global $database,$Functions;
            if (isset($_POST["submit_delete_admin"]) && !(empty($_POST["submit_delete_admin"])) && isset($_POST["admin_id"]) && !(empty($_POST["admin_id"]))){
                if (preg_match("/^[0-9]*$/",$database->escape_value($Functions->decrypt_id($_POST["admin_id"])))){
                    $this->user_id = $Functions->decrypt_id($_POST["admin_id"]);
                }else{
                    $this->redirect_to("admins_show.php");
                }

                $sql = "UPDATE users SET user_mode=0 WHERE id={$this->user_id}";
                $database->query("SET NAMES 'utf8'");
                $result = $database->query($sql);
                if ($result) {
                    $this->user_id = null;
                    unset($this->user_id);
                    $this->redirect_to("admins_show.php");
                }
            }else{
                $this->redirect_to("admins_show.php");
            }
        }
        public function CountAdmins(){
            global $database;
            /*
            $sql = "SELECT COUNT(*) FROM rooms";
            $result = $database->query($sql);
            if($row = $database->fetch_array($result)){
                echo $row['COUNT(*)'];
            }
            */
            // OR
            $sql = "SELECT COUNT(*) AS admins_count FROM users WHERE user_mode=1";
            $result = $database->query($sql);
            if($row = $database->fetch_array($result)){
                echo $row['admins_count'];
            }
        }


        // this functions for Users panel
        public function AllUsers(){
            global $database,$Functions;
            // Admins id equal 1
            $sql = "SELECT * FROM users WHERE user_mode=0 OR user_mode=1";
            $result = $database->query($sql);

            while($users_row = $database->fetch_array($result)){
                echo("
                    
                        <tr "); if($users_row['user_mode'] == 1){ echo 'style="background: #d75e30;"'; } echo(">
                            <td><img class='finger-img' ");
                            if($users_row['user_mode'] == 1){ echo 'style="border:2px solid darkorange"'; }
                            echo("src='"); self::select_user_image($users_row['user_image']); echo("' alt='تی شین'></td>
                            <td class='admins_username'>{$users_row['username']}</td>
                            <td class='admins_tel'>{$users_row['tel']}</td>
                            <td>");
                            if($users_row['user_mode'] == 1) {
                                echo("
                                <form action = 'admins_edit.php' method = 'post' >
                                    <input type = 'hidden' name = 'admin_id' value = '"); echo($Functions->encrypt_id($users_row['id'])); echo("' />
                                    <input type = 'submit' name = 'submit_edit_admin' class='input_edit_admins' value = 'Edit' />
                                </form >
                                ");
                            }else if($users_row['user_mode'] == 0){
                                echo("
                                <form action = 'users_edit.php' method = 'post' >
                                    <input type = 'hidden' name = 'user_id' value = '"); echo($Functions->encrypt_id($users_row['id'])); echo("' />
                                    <input type = 'submit' name = 'submit_edit_user' class='input_edit_admins' value = 'Edit' />
                                </form >
                                ");
                            }
                            echo("
                            </td>
                            <td>");
                            if($users_row["user_mode"] == 1){
                                echo("
                                <form action='admins_delete.php' method='post'>
                                    <input type='hidden' name='admin_id' value='"); echo($Functions->encrypt_id($users_row['id'])); echo("'/>
                                    <input type='submit' name='submit_delete_admin' class='input_delete_admins delete_room_btn' value='Delete' />
                                </form>");
                            }else if($users_row["user_mode"] == 0){
                                echo("
                                <form action='users_delete.php' method='post'>
                                    <input type='hidden' name='user_id' value='"); echo($Functions->encrypt_id($users_row['id'])); echo("'/>
                                    <input type='submit' name='submit_delete_user' class='input_delete_admins delete_room_btn' value='Delete' />
                                </form>");
                            }
                            echo("
                            </td>
                        </tr>
                    ");
            }
        }
        public function EditUsers_panel(){
            global $database,$Functions;
            // Admins id equal 1
            if (isset($_POST["submit_edit_user"]) && !(empty($_POST["submit_edit_user"])) && isset($_POST["user_id"]) && !(empty($_POST["user_id"]))){
                if (preg_match("/^[0-9]*$/",$database->escape_value($Functions->decrypt_id($_POST["user_id"])))){
                    $this->user_id = $Functions->decrypt_id($_POST["user_id"]);
                }
                $sql = "SELECT * FROM users WHERE id={$this->user_id} AND user_mode=0";
                $result = $database->query($sql);

                if($users_row = $database->fetch_array($result)) {
                    echo("
                            <div class='edit_admin_panel col-xs-12'>
                            <form action='{$_SERVER['PHP_SELF']}' method='post' enctype='multipart/form-data'>
                                        <div class='img_list col-lg-4 col-md-4 col-sm-6 col-xs-12' id='edit_admin_image'>
                                            <img src='"); self::select_user_image($users_row['user_image']);
                    $_SESSION["image_name"] = $users_row['user_image'];
                    echo("' alt=''>
                                            <select id='select-input-image' name='select-input-image'>
                                                <option value='browse-file' name='browseFileOption' id='browse-file'>Browse File...</option>
                                                <option value='url-image' name='urlImageOption' id='url-image'>Link Or Url Image</option> 
                                            </select>  
                                            <div class='add_photo_user'>Add Photo +<input type='file' id='browse-file-input' class='edit_input_image' name='userImage' /><input type='url' id='url-image-input' placeholder='www.image.com' class='edit_input_image' name='userImageUrl' /></div> 
                                        </div>
                                        <input type='hidden' name='MAX_FILE_SIZE' value='3145728' />
                                            <input type='hidden' name='user_id' value='");
                    echo($Functions->encrypt_id($users_row['id']));
                    echo("'/>
                                        <div class='admin_info col-xs-12'>
                                            <span id='admin_label'>UserName&nbsp;:</span>&nbsp;<input class='edit_admin_username' value='{$users_row['username']}' name='user_username' /><hr />
                                            <span id='admin_label'>Tel:</span>&nbsp;<span class='edit_user_tel'>{$users_row['tel']}</span><hr />
                                            <span id='admin_label'>Admin: </span>&nbsp;<input name='user_mode' type='checkbox' /><hr />
                                            <input type='submit'  name='submit_last_edit_user' class='edit_admin_input' value='Edit' /> 
                                       
                                    </form>
                                        <form action='users_delete.php' method='post'>
                                            <input type='hidden' name='user_id' value='");
                    echo($Functions->encrypt_id($users_row['id']));
                    echo("'/>
                                            <input type='submit' name='submit_delete_user' class='edit_delete_admins delete_room_btn' value='Delete' />
                                        </form>
                                    </div>
                                
                                </div>
                        ");
                }
            }else{
                $this->redirect_to("admins_show.php");
            }
        }
        public function UpdateUser(){
            global $database,$Functions;
            if (isset($_POST["submit_last_edit_user"]) && !(empty($_POST["submit_last_edit_user"])) && isset($_POST["user_id"]) && !(empty($_POST["user_id"]))){
                if (preg_match("/^[0-9]*$/",$database->escape_value($Functions->decrypt_id($_POST["user_id"])))){
                    $this->user_id = $Functions->decrypt_id($_POST["user_id"]);
                }else{
                    $this->redirect_to("users_show.php");
                }
                if (!(isset($_POST["user_username"])) || empty($_POST["user_username"])){
                    $_SESSION["errors_message"] .= "نام کاربری نباید خالی باشد .";
                    $this->error_state = 1;
                    return $this->error_state;
                    $this->redirect_to("users_show.php");
                }
                $this->username = $database->escape_value($_POST["user_username"]);

                $Functions->photo_upload($_POST["submit_last_edit_user"]);
                $this->user_image = $Functions::$image_name;
                if (isset($_SESSION["image_exists_name"])) {
                    $this->user_image = $_SESSION["image_exists_name"];
                }
                if ($this->user_image == '' || $this->user_image == null || empty($this->user_image)) {
                    $this->user_image = $_SESSION["image_name"];
                }
                if (isset($_POST["userImageUrl"]) && !(empty($_POST["userImageUrl"])) && filter_var($_POST["userImageUrl"],FILTER_VALIDATE_URL)){
                    $this->user_image = $database->escape_value($_POST["userImageUrl"]);
                }else if (!filter_var($_POST["userImageUrl"],FILTER_VALIDATE_URL)){
                    $_SESSION["errors_message"] .= "لینک عکس نا معتبر است !  .";
                }
                if(isset($_POST["user_mode"])){
                    $this->user_mode = 1;
                }else{
                    $this->user_mode = 0;
                }
                $sql = "UPDATE users SET username='{$this->username}' , user_image='{$database->escape_value($this->user_image)}' , user_mode={$this->user_mode} WHERE id={$this->user_id}";
                $database->query("SET NAMES 'utf8'");
                $result = $database->query($sql);
                if ($result) {
                    $this->user_id = null;
                    unset($this->user_id);
                    $_SESSION["image_exists_name"] = null;
                    unset($_SESSION["image_exists_name"]);
                    unset($_SESSION["image_name"]);
                    $_SESSION["image_name"] = null;
                    $this->redirect_to("users_show.php");
                }
            }else{
                $this->redirect_to("users_show.php");
            }
        }
        public function DeleteَUser(){
            global $database,$Functions;
            if (isset($_POST["submit_delete_user"]) && !(empty($_POST["submit_delete_user"])) && isset($_POST["user_id"]) && !(empty($_POST["user_id"]))){
                if (preg_match("/^[0-9]*$/",$database->escape_value($Functions->decrypt_id($_POST["user_id"])))){
                    $this->user_id = $Functions->decrypt_id($_POST["user_id"]);
                }else{
                    $this->redirect_to("users_show.php");
                }

                $AllResult = $this->SelectById($this->user_id);
                if ($row = $database->fetch_array($AllResult)){
                    $this->user_image = $row["user_image"];
                }
                if ($this->user_image != "default_user.png"){
                    unlink("userimg/".$this->user_image);
                }
                $reservation_sql = "DELETE FROM room_reservation WHERE room_reservation.user_id={$this->user_id}";
                $survey_sql = "DELETE FROM room_survey WHERE room_survey.user_id={$this->user_id}";
                $sql = "DELETE FROM users WHERE users.id={$this->user_id} AND user_mode=0 LIMIT 1";
                $database->query("SET NAMES 'utf8'");
                $reservation_query = $database->query($reservation_sql);
                $survey_query = $database->query($survey_sql);
                if ($reservation_sql && $survey_query){
                    $result = $database->query($sql);
                    if ($result) {
                        $this->user_id = null;
                        unset($this->user_id);
                        $this->redirect_to("users_show.php");
                    }
                }
            }else{
                $this->redirect_to("users_show.php");
            }
        }
        public function CountUsers(){
            global $database;
            /*
            $sql = "SELECT COUNT(*) FROM rooms";
            $result = $database->query($sql);
            if($row = $database->fetch_array($result)){
                echo $row['COUNT(*)'];
            }
            */
            // OR
            $sql = "SELECT COUNT(*) AS admins_count FROM users";
            $result = $database->query($sql);
            if($row = $database->fetch_array($result)){
                echo $row['admins_count'];
            }
        }


        // this functions for Administrator
        public function SelectById($id){
            global $database;
            $id = $database->escape_value($id);
            $sql = "SELECT * FROM users WHERE id={$id}";
            $result = $database->query($sql);
            return $result;
        }
        public function Panel(){
            global $database,$Functions;
            // Admins id equal 1
            if (isset($_SESSION["user_id"])){
                $sql = "SELECT * FROM users WHERE id={$_SESSION["user_id"]}";
                $result = $database->query($sql);

                if($user_row = $database->fetch_array($result)) {
                    echo("
                            <div class='edit_admin_panel col-xs-12'>
                            <form action='{$_SERVER['PHP_SELF']}' method='post' enctype='multipart/form-data'>
                                        <div class='img_list col-lg-4 col-md-4 col-sm-6 col-xs-12' id='edit_admin_image'>
                                            <img src='"); self::select_user_image($user_row['user_image']);
                    $_SESSION["image_name"] = $user_row['user_image'];
                    echo("' alt=''>
                                            <select id='select-input-image' name='select-input-image'>
                                                <option value='browse-file' name='browseFileOption' id='browse-file'>Browse File...</option>
                                                <option value='url-image' name='urlImageOption' id='url-image'>Link Or Url Image</option> 
                                            </select>  
                                            <div class='add_photo_user'>Add Photo +<input type='file' id='browse-file-input' class='edit_input_image' name='userImage' /><input type='url' id='url-image-input' placeholder='www.image.com' class='edit_input_image' name='userImageUrl' /></div>
                                            
                                        </div>
                                        <input type='hidden' name='MAX_FILE_SIZE' value='3145728' />
                                            <input type='hidden' name='user_id' value='");
                    echo($Functions->encrypt_id($user_row['id']));
                    echo("'/>
                                        <div class='admin_info col-xs-12'>
                                            <span id='admin_label'>UserName&nbsp;:</span>&nbsp;<input class='edit_admin_username' value='{$user_row['username']}' name='user_username' required /><hr />
                                            <span id='admin_label'>Tel:</span>&nbsp;<span class='edit_user_tel'>{$user_row['tel']}</span><hr />
                                            <div class='change-password-outside'><h5>* Change Password *</h5></div><br />
                                            <div class='change-password-inside'>
                                                <span id='admin_label'>New Password:</span>&nbsp;<input class='edit_admin_username' name='new_password' type='password' placeholder='New Password' /><hr />
                                                <span id='admin_label'>Repeat Password:</span>&nbsp;<input class='edit_admin_username' name='repeat_password' type='password' placeholder='Repeat Password' /><hr />
                                            </div><br />
                                            <input type='submit'  name='submit_last_edit_panel' class='edit_admin_input' value='Edit' /> 
                                       
                                    </form>
                                    </div>
                                
                                </div>
                        ");
                }
            }else{
                $this->redirect_to("../index.php");
            }
        }
        public function UpdatePanel(){
            global $database,$Functions;
            if (isset($_POST["submit_last_edit_panel"]) && !(empty($_POST["submit_last_edit_panel"])) && isset($_POST["user_id"]) && !(empty($_POST["user_id"]))){
                if (preg_match("/^[0-9]*$/",$database->escape_value($Functions->decrypt_id($_POST["user_id"])))){
                    $this->user_id = $Functions->decrypt_id($_POST["user_id"]);
                }else{
                    $this->redirect_to($_SERVER["PHP_SELF"]);
                }
                if (!(isset($_POST["user_username"])) || empty($_POST["user_username"])){
                    $_SESSION["errors_message"] .= "نام کاربری نباید خالی باشد .";
                    $this->error_state = 1;
                    return $this->error_state;
                    $this->redirect_to($_SERVER["PHP_SELF"]);
                }
                $this->username = $database->escape_value($_POST["user_username"]);
                $Functions->photo_upload($_POST["submit_last_edit_panel"]);
                $this->user_image = $Functions::$image_name;
                if (isset($_SESSION["image_exists_name"])) {
                    $this->user_image = $_SESSION["image_exists_name"];
                }
                if ($this->user_image == '' || $this->user_image == null || empty($this->user_image)) {
                    $this->user_image = $_SESSION["image_name"];
                }
                if (isset($_POST["userImageUrl"]) && !(empty($_POST["userImageUrl"])) && filter_var($_POST["userImageUrl"],FILTER_VALIDATE_URL)){
                    $this->user_image = $database->escape_value($_POST["userImageUrl"]);
                }else if (!filter_var($_POST["userImageUrl"],FILTER_VALIDATE_URL)){
                    $_SESSION["errors_message"] .= "لینک عکس نا معتبر است !  .";
                }
                if(isset($_POST["new_password"]) && !(empty($_POST["new_password"])) && isset($_POST["repeat_password"]) && !(empty($_POST["repeat_password"]))){
                    if($_POST["new_password"] != $_POST["repeat_password"]){
                        $_SESSION["errors_message"] .= "مغایرت در تکرار رمز";
                        $this->error_state = 1;
                        return $this->error_state;
                        $this->redirect_to($_SERVER["PHP_SELF"]);
                    }else{
                        if (strlen($_POST["new_password"]) < 8){
                            $_SESSION["errors_message"] .= "رمز بالای ۸ رقم باشد .";
                            $this->error_state = 1;
                            return $this->error_state;
                            $this->redirect_to($_SERVER["PHP_SELF"]);
                        }else{
                            $this->password = $this->mytrim($_POST["new_password"]);
                            $this->password = $database->escape_value($this->password);
                            $this->user_image = $database->escape_value($this->user_image);
                            $sql = "UPDATE users SET username='{$this->username}' , password='{$this->password}', user_image='{$this->user_image}' WHERE id={$this->user_id}";
                            $_SESSION["errors_message"] .= "<رمز با موفقیت تغییر کرد> .";
                        }
                    }


                }else{
                    $this->user_image = $database->escape_value($this->user_image);
                    $sql = "UPDATE users SET username='{$this->username}' , user_image='{$this->user_image}' WHERE id={$this->user_id}";
                }
                $database->query("SET NAMES 'utf8'");
                $result = $database->query($sql);
                if ($result) {
                    $this->user_id = null;
                    unset($this->user_id);
                    $_SESSION["image_exists_name"] = null;
                    unset($_SESSION["image_exists_name"]);
                    unset($_SESSION["image_name"]);
                    $_SESSION["image_name"] = null;
                    $this->redirect_to($_SERVER["PHP_SELF"]);
                }
            }else{
                $this->redirect_to($_SERVER["PHP_SELF"]);
            }
        }

        // This Function For Search Box And By Tel Or Username
        public function SerachUserByTelOrUsername(){
            global $database,$Functions;
            if (isset($_POST["panel_submit_search_user"]) && !(empty($_POST["panel_keyword_user"]))) {
                $keyword = $database->escape_value($_POST['panel_keyword_user']);
                if (isset($_POST["panel_ByWitch_user"])){
                    switch ($_POST["panel_ByWitch_user"]){
                        case 'Tel':
                            $sql = "SELECT * FROM users WHERE tel LIKE '{$keyword}%'";
                            break;
                        case 'Username':
                            $sql = "SELECT * FROM users WHERE username LIKE '%{$keyword}%'";
                            break;
                        default:
                            $sql = "SELECT * FROM users";
                            break;
                    }
                }
                $result = $database->query($sql);
                if ($database->num_rows($result) > 0) {
                    while ($users_row = $database->fetch_array($result)) {
                        echo("
                    
                        <tr ");
                        if ($users_row['user_mode'] == 1) {
                            echo 'style="background: #d75e30;"';
                        }
                        echo(">
                            <td><img class='finger-img' ");
                        if ($users_row['user_mode'] == 1) {
                            echo 'style="border:2px solid darkorange"';
                        }
                        echo("src='");
                        self::select_user_image($users_row['user_image']);
                        switch ($_POST["panel_ByWitch_user"]){
                            case 'Tel':
                                echo("' alt='تی شین'></td>
                                <td class='admins_username'>{$users_row['username']}</td>
                                <td class='admins_tel' style='color: #00A8FF;text-shadow: 2px 2px 1px black;'>{$users_row['tel']}</td><td>");
                                break;
                            case 'Username':
                                echo("' alt='تی شین'></td>
                                <td class='admins_username' style='color: #00A8FF;text-shadow: 2px 2px 1px black;'>{$users_row['username']}</td>
                                <td class='admins_tel'>{$users_row['tel']}</td><td>");
                                break;
                            default:
                                break;
                        }
                        if ($users_row['user_mode'] == 1) {
                            echo("
                                <form action = 'admins_edit.php' method = 'post' >
                                    <input type = 'hidden' name = 'admin_id' value = '");
                            echo($Functions->encrypt_id($users_row['id']));
                            echo("' />
                                    <input type = 'submit' name = 'submit_edit_admin' class='input_edit_admins' value = 'Edit' />
                                </form >
                                ");
                        } else if ($users_row['user_mode'] == 0) {
                            echo("
                                <form action = 'users_edit.php' method = 'post' >
                                    <input type = 'hidden' name = 'user_id' value = '");
                            echo($Functions->encrypt_id($users_row['id']));
                            echo("' />
                                    <input type = 'submit' name = 'submit_edit_user' class='input_edit_admins' value = 'Edit' />
                                </form >
                                ");
                        }
                        echo("
                            </td>
                            <td>");
                        if ($users_row["user_mode"] == 1) {
                            echo("
                                <form action='admins_delete.php' method='post'>
                                    <input type='hidden' name='admin_id' value='");
                            echo($Functions->encrypt_id($users_row['id']));
                            echo("'/>
                                    <input type='submit' name='submit_delete_admin' class='input_delete_admins delete_room_btn' value='Delete' />
                                </form>");
                        } else if ($users_row["user_mode"] == 0) {
                            echo("
                                <form action='users_delete.php' method='post'>
                                    <input type='hidden' name='user_id' value='");
                            echo($Functions->encrypt_id($users_row['id']));
                            echo("'/>
                                    <input type='submit' name='submit_delete_user' class='input_delete_admins delete_room_btn' value='Delete' />
                                </form>");
                        }
                        echo("
                            </td>
                        </tr>
                    ");
                    }
                } else {
                    echo "<h1 class='no-result'>No Result !</h1>";
                }
            }else{
                $this->redirect_to("users_show.php");
            }
        }
        public function SerachAdminByTelOrUsername(){
            global $database,$Functions;
            if (isset($_POST["panel_submit_search_admin"]) && !(empty($_POST["panel_keyword_admin"]))) {
                $keyword = $database->escape_value($_POST['panel_keyword_admin']);
                if (isset($_POST["panel_ByWitch_admin"])){
                    switch ($_POST["panel_ByWitch_admin"]){
                        case 'Tel':
                            $sql = "SELECT * FROM users WHERE user_mode=1 AND tel LIKE '{$keyword}%'";
                            break;
                        case 'Username':
                            $sql = "SELECT * FROM users WHERE user_mode=1 AND username LIKE '%{$keyword}%'";
                            break;
                        default:
                            $sql = "SELECT * FROM users WHERE user_mode=1";
                            break;
                    }
                }
                $result = $database->query($sql);
                if ($database->num_rows($result) > 0) {
                    while ($admins_row = $database->fetch_array($result)) {
                        echo("
                    
                        <tr style='background: #d75e30'>
                            <td><img class='finger-img' style='border:2px solid darkorange' src='"); self::select_user_image($admins_row['user_image']); echo("' alt='تی شین'></td>
                            <td class='admins_username'>{$admins_row['username']}</td>
                            <td class='admins_tel'>{$admins_row['tel']}</td>
                            <td>
                                <form action='admins_edit.php' method='post'>
                                    <input type='hidden' name='admin_id' value='"); echo($Functions->encrypt_id($admins_row['id'])); echo("'/>
                                    <input type='submit' name='submit_edit_admin' class='input_edit_admins' value='Edit' />
                                </form>
                            </td>
                            <td>
                                <form action='admins_delete.php' method='post'>
                                    <input type='hidden' name='admin_id' value='"); echo($Functions->encrypt_id($admins_row['id'])); echo("'/>
                                    <input type='submit' name='submit_delete_admin' class='input_delete_admins delete_room_btn' value='Delete' />
                                </form>
                            </td>
                        </tr>
                    ");
                    }
                } else {
                    echo "<h1 class='no-result'>No Result !</h1>";
                }
            }else{
                $this->redirect_to("admins_show.php");
            }
        }

        public function select_user_image($row){
            global $database;
            if(!(empty($row))){
                if(filter_var($row,FILTER_VALIDATE_URL)){
                    echo $database->escape_value($row);
                }else{
                    echo 'userimg/'.$database->escape_value($row);
                }
            }else{
                echo 'userimg/default_user.png';
            }
        }
        public function select_user_image_for_comment($row){
            global $database;
            if(!(empty($row))){
                if(filter_var($row,FILTER_VALIDATE_URL)){
                    echo $row;
                }else{
                    echo 'panel/userimg/'.$database->escape_value($row);
                }
            }else{
                echo 'panel/userimg/default_user.png';
            }
        }

    }
    $users = new Users();
?>