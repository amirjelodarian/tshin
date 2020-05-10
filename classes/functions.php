<?php
    class Functions{
        public static $image_name;
        public function photo_upload($submit){
            if (isset($submit) && isset($_FILES["roomImage"])){
                $files = $_FILES["roomImage"];
                $target_dir = "../img/rooms/";
                $target_file = $target_dir . basename($files["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $uploadOk = 1;
                if (isset($files["tmp_name"]) && !(empty($files["tmp_name"]))){
                    $check = getimagesize($files["tmp_name"]);
                    if ($check == false){
                        $_SESSION["errors_message"] .= "فایل شما عکس نیست !! .";
                        $uploadOk = 0;
                    }
                }
                    if (file_exists($target_file)){
                        $_SESSION["image_exists_name"] = $files["name"];
                        $_SESSION["errors_message"] .= "متاسفانه این فایل یا عکس وجود دارد !! .";
                        $uploadOk = 0;
                    }
                    if ($files["size"] > 5242880){
                        $_SESSION["errors_message"] .= "متاسفانه عکس بیشتر از 5 مگابایت است .";
                        $uploadOk = 0;
                    }
                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
                        $_SESSION["errors_message"] .= "پسوند عکس ها نامعتبر است !! .";
                        $uploadOk = 0;
                    }
                    if ($uploadOk == 0){
                        $_SESSION["errors_message"] .= "مشکل در آپلود عکس !! .";
                    }else{
                        if (move_uploaded_file($files["tmp_name"],$target_file)){
                            self::$image_name = $files["name"];
                            echo "فایل آپلود شد ." . $files["name"];
                        }else{
                            $_SESSION["errors_message"] .= "مشکل در آپلود عکس !! .";
                        }
                    }
            }
            if (isset($submit) && isset($_FILES["foodImage"])){
                $files = $_FILES["foodImage"];
                $target_dir = "../img/foods/";
                $target_file = $target_dir . basename($files["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $uploadOk = 1;
                if (isset($files["tmp_name"]) && !(empty($files["tmp_name"]))){
                    $check = getimagesize($files["tmp_name"]);
                    if ($check == false){
                        $_SESSION["errors_message"] .= "فایل شما عکس نیست !! .";
                        $uploadOk = 0;
                    }
                }
                if (file_exists($target_file)){
                    $_SESSION["image_exists_name"] = $files["name"];
                    $_SESSION["errors_message"] .= "متاسفانه این فایل یا عکس وجود دارد !! .";
                    $uploadOk = 0;
                }
                if ($files["size"] > 5242880){
                    $_SESSION["errors_message"] .= "متاسفانه عکس بیشتر از 5 مگابایت است .";
                    $uploadOk = 0;
                }
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
                    $_SESSION["errors_message"] .= "پسوند عکس ها نامعتبر است !! .";
                    $uploadOk = 0;
                }
                if ($uploadOk == 0){
                    $_SESSION["errors_message"] .= "مشکل در آپلود عکس !! .";
                }else{
                    if (move_uploaded_file($files["tmp_name"],$target_file)){
                        self::$image_name = $files["name"];
                        echo "فایل آپلود شد ." . $files["name"];
                    }else{
                        $_SESSION["errors_message"] .= "مشکل در آپلود عکس !! .";
                    }
                }
            }
            if (isset($submit) && isset($_FILES["userImage"])){
                $files = $_FILES["userImage"];
                $target_dir = "userimg/";
                $target_file = $target_dir . basename($files["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $uploadOk = 1;
                if (isset($files["tmp_name"]) && !(empty($files["tmp_name"]))){
                    $check = getimagesize($files["tmp_name"]);
                    if ($check == false){
                        $_SESSION["errors_message"] .= "فایل شما عکس نیست !! .";
                        $uploadOk = 0;
                    }
                }
                if (file_exists($target_file)){
                    $_SESSION["image_exists_name"] = $files["name"];
                    $_SESSION["errors_message"] .= "متاسفانه این فایل یا عکس وجود دارد !! .";
                    $uploadOk = 0;
                }
                if ($files["size"] > 3145728){
                    $_SESSION["errors_message"] .= "متاسفانه عکس بیشتر از 3 مگابایت است .";
                    $uploadOk = 0;
                }
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
                    $_SESSION["errors_message"] .= "پسوند عکس ها نامعتبر است !! .";
                    $uploadOk = 0;
                }
                if ($uploadOk == 0){
                    echo "مشکل در آپلود عکس !! .";
                }else{
                    if (move_uploaded_file($files["tmp_name"],$target_file)){
                        self::$image_name = $files["name"];
                        echo "فایل آپلود شد ." . $files["name"];
                    }else{
                        $_SESSION["errors_message"] .= "مشکل در آپلود عکس !! .";
                    }
                }
            }else{
                $_SESSION["errors_message"] = '';
            }

        }

        // for write log file while login or sign up user :)
        public function write_logfile($username,$tel){
            $logfile = "panel/logfile.txt";
            $new = file_exists($logfile) ? false : true;
            if($handle = fopen($logfile,'a')){
                $timestamp = strftime("%Y-%m-%d %H:%M:%S",time());
                $content = "'{$username}' At {$timestamp} | Logged In | TEL : {$tel}\n";
                fwrite($handle,$content);
                fclose($handle);
                if ($new){
                    chmod($logfile,0222);
                }
            }
            else{
                echo "مشکل در ایجاد لاگ فایل !!";
            }
        }
        public function auto_select($option_num,$object){
            if($option_num == $object){
                return "selected";
            }else{
                return null;
            }
        }
        public function divid_date_time_database($date_time){
            $time = substr($date_time,-8);
            $date = substr($date_time,0,10);
            return array($time,$date);
        }
        function encrypt_id($value){
            if (isset($value)){
                $value = $value*4;
                for($i = 1;$i <= 4;$i++){
                    $value = base64_encode($value);
                }
                return $value;
            }
        }
        function decrypt_id($value){
            global $users;
            if (isset($value)){
                for($i = 1;$i <= 4;$i++){
                    $value = base64_decode($value);
                }
                if((preg_match('/^[0-9]*$/', $value)) && is_numeric($value)){
                    $value = $value/4;
                    return $value;
                }else{
                    $users->redirect_to("all_hotels_list.php");
                }
            }
        }
        // pull a iranian site this function :)
        function gregorian_to_jalali($gy,$gm,$gd,$mod=''){
            $g_d_m=array(0,31,59,90,120,151,181,212,243,273,304,334);
            if($gy>1600){
                $jy=979;
                $gy-=1600;
            }else{
                $jy=0;
                $gy-=621;
            }
            $gy2=($gm>2)?($gy+1):$gy;
            $days=(365*$gy) +((int)(($gy2+3)/4)) -((int)(($gy2+99)/100)) +((int)(($gy2+399)/400)) -80 +$gd +$g_d_m[$gm-1];
            $jy+=33*((int)($days/12053));
            $days%=12053;
            $jy+=4*((int)($days/1461));
            $days%=1461;
            if($days > 365){
                $jy+=(int)(($days-1)/365);
                $days=($days-1)%365;
            }
            $jm=($days < 186)?1+(int)($days/31):7+(int)(($days-186)/30);
            $jd=1+(($days < 186)?($days%31):(($days-186)%30));
            return($mod=='')?array($jy,$jm,$jd):$jy.$mod.$jm.$mod.$jd;
        }
        ///////////////////////////////////////
        public function convert_db_format_for_gregorian_to_jalali($date){
            $date_array = explode("-",$date);
            $year = (int)$date_array[0];
            $month = (int)$date_array[1];
            $day = (int)$date_array[2];
            $date = $this->gregorian_to_jalali($year,$month,$day,'<span style="color: crimson">/</span>');
            return $date;
        }
        public function EN_numTo_FA($str,$toPersian){
            $en = array('0','1','2','3','4','5','6','7','8','9');
            $fa = array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹');
            if (isset($toPersian)){ return str_replace($en,$fa,$str); } else{ return str_replace($fa,$en,$str); }
        }


        public function insert_seperator($num) {
            settype($num,"String");
            $n = strlen($num);
            $i = 0;
            $help = $n % 3;
            while ($help != 0) {
                $num = '0'.$num;
                $i++;
                $n = strlen($num);
                $help = $n % 3;
            }
            $arr = str_split($num,3);
            $str = "";
            foreach ($arr as $index) {
                $str = $str.",".$index;
            }
            $i++;
            return substr($str,$i);
        }
        public function give_start_by_number($score_row){
            global $database;
            $score_row = $database->escape_value($score_row);
            switch ($score_row){
                case 1:
                    return "<i class='icon-star voted'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i>";
                    break;
                case 2:
                    return "<i class='icon-star voted'></i><i class='icon-star voted'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i>";
                    break;
                case 3:
                    return "<i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i></i><i class='icon-star-empty'></i></i><i class='icon-star-empty'></i>";
                    break;
                case 4:
                    return "<i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i></i><i class='icon-star-empty'></i>";
                    break;
                case 5:
                    return "<i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i><i class='icon-star voted'></i>";
                    break;
                default:
                    return null;
                    break;
            }
        }
    }
    $Functions = new Functions();
?>