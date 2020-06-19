<?php
    class Functions{
        public static $image_name;
        public function photo_upload($submit){
            global $database,$users;
            if (isset($submit) && isset($_FILES["roomImage"])){
                $files = $_FILES["roomImage"];
                $target_dir = "../img/rooms/";
                $target_file = $target_dir . basename($files["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $uploadOk = 1;
                if (isset($files["tmp_name"]) && !(empty($files["tmp_name"]))){
                    $check = getimagesize($files["tmp_name"]);
                    if ($check == false){
                        if (isset($_SESSION["errors_message"])) {
                            $_SESSION["errors_message"] .= "فایل شما عکس نیست !! .";
                        }else{
                            $_SESSION["errors_message"] = "فایل شما عکس نیست !! .";
                        }
                        $uploadOk = 0;
                    }
                }
                    if (file_exists($target_file)){
                        $_SESSION["image_exists_name"] = $files["name"];
                        if (isset($_SESSION["errors_message"])) {
                            $_SESSION["errors_message"] .= "متاسفانه این فایل یا عکس وجود دارد !! .";
                        }else{
                            $_SESSION["errors_message"] = "متاسفانه این فایل یا عکس وجود دارد !! .";
                        }
                        $uploadOk = 0;
                    }
                    if ($files["size"] > 5242880){
                        if (isset($_SESSION["errors_message"])) {
                            $_SESSION["errors_message"] .= "متاسفانه عکس بیشتر از 5 مگابایت است .";
                        }else{
                            $_SESSION["errors_message"] = "متاسفانه عکس بیشتر از 5 مگابایت است .";
                        }
                        $uploadOk = 0;
                    }
                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
                        if (isset($_SESSION["errors_message"])) {
                            $_SESSION["errors_message"] .= "پسوند عکس ها نامعتبر است !! .";
                        }else{
                            $_SESSION["errors_message"] = "پسوند عکس ها نامعتبر است !! .";
                        }
                        $uploadOk = 0;
                    }
                    if ($uploadOk == 0){
                        if (isset($_SESSION["errors_message"])) {
                            $_SESSION["errors_message"] .= "مشکل در آپلود عکس !! .";
                        }else{
                            $_SESSION["errors_message"] = "مشکل در آپلود عکس !! .";
                        }
                    }else{
                        if (move_uploaded_file($files["tmp_name"],$target_file)){
                            self::$image_name = $files["name"];
                            echo "فایل آپلود شد ." . $files["name"];
                        }else{
                            if (isset($_SESSION["errors_message"])) {
                                $_SESSION["errors_message"] .= "مشکل در آپلود عکس !! .";
                            }else{
                                $_SESSION["errors_message"] = "مشکل در آپلود عکس !! .";
                            }
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
                        if (isset($_SESSION["errors_message"])) {
                            $_SESSION["errors_message"] .= "فایل شما عکس نیست !! .";
                        }else{
                            $_SESSION["errors_message"] = "فایل شما عکس نیست !! .";
                        }
                        $uploadOk = 0;
                    }
                }
                if (file_exists($target_file)){
                    $_SESSION["image_exists_name"] = $files["name"];
                    if (isset($_SESSION["errors_message"])) {
                        $_SESSION["errors_message"] .= "متاسفانه این فایل یا عکس وجود دارد !! .";
                    }else{
                        $_SESSION["errors_message"] = "متاسفانه این فایل یا عکس وجود دارد !! .";
                    }
                    $uploadOk = 0;
                }
                if ($files["size"] > 5242880){
                    if (isset($_SESSION["errors_message"])) {
                        $_SESSION["errors_message"] .= "متاسفانه عکس بیشتر از 5 مگابایت است .";
                    }else{
                        $_SESSION["errors_message"] = "متاسفانه عکس بیشتر از 5 مگابایت است .";
                    }
                    $uploadOk = 0;
                }
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
                    if (isset($_SESSION["errors_message"])) {
                        $_SESSION["errors_message"] .= "پسوند عکس ها نامعتبر است !! .";
                    }else{
                        $_SESSION["errors_message"] = "پسوند عکس ها نامعتبر است !! .";
                    }
                    $uploadOk = 0;
                }
                if ($uploadOk == 0){
                    if (isset($_SESSION["errors_message"])) {
                        $_SESSION["errors_message"] .= "مشکل در آپلود عکس !! .";
                    }else{
                        $_SESSION["errors_message"] = "مشکل در آپلود عکس !! .";
                    }
                }else{
                    if (move_uploaded_file($files["tmp_name"],$target_file)){
                        self::$image_name = $files["name"];
                        echo "فایل آپلود شد ." . $files["name"];
                    }else{
                        if (isset($_SESSION["errors_message"])) {
                            $_SESSION["errors_message"] .= "مشکل در آپلود عکس !! .";
                        }else{
                            $_SESSION["errors_message"] = "مشکل در آپلود عکس !! .";
                        }
                    }
                }
            }
            if (isset($submit) && isset($_FILES["userImage"])){
                $files = $_FILES["userImage"];
                $target_dir = "userimg/";
                $fileName = @trim(basename($files['name']));
                $target_file = $target_dir . $users->mytrim($fileName);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $uploadOk = 1;
                if (isset($files["tmp_name"]) && !(empty($files["tmp_name"]))){
                    $check = getimagesize($files["tmp_name"]);
                    if ($check == false){
                        if (isset($_SESSION["errors_message"])) {
                            $_SESSION["errors_message"] .= "فایل شما عکس نیست !! .";
                        }else{
                            $_SESSION["errors_message"] = "فایل شما عکس نیست !! .";
                        }
                        $uploadOk = 0;
                    }
                }
                if (file_exists($target_file)){
                    $_SESSION["image_exists_name"] = $files["name"];
                    if (isset($_SESSION["errors_message"])) {
                        $_SESSION["errors_message"] .= "متاسفانه این فایل یا عکس وجود دارد !! .";
                    }else{
                        $_SESSION["errors_message"] = "متاسفانه این فایل یا عکس وجود دارد !! .";
                    }
                    $uploadOk = 0;
                }
                if ($files["size"] > 3145728){
                    if (isset($_SESSION["errors_message"])) {
                        $_SESSION["errors_message"] .= "متاسفانه عکس بیشتر از 3 مگابایت است .";
                    }else{
                        $_SESSION["errors_message"] = "متاسفانه عکس بیشتر از 3 مگابایت است .";
                    }
                    $uploadOk = 0;
                }
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
                    if (isset($_SESSION["errors_message"])){
                        $_SESSION["errors_message"] .= "پسوند عکس ها نامعتبر است !! .";
                    }else{
                        $_SESSION["errors_message"] = "پسوند عکس ها نامعتبر است !! .";
                    }
                    $uploadOk = 0;
                }
                if ($uploadOk == 0){
                    if (isset($_SESSION["errors_message"])){
                        $_SESSION["errors_message"] .= "مشکل در آپلود عکس !! .";
                    }else{
                        $_SESSION["errors_message"] = "مشکل در آپلود عکس !! .";
                    }
                }else{
                    if (move_uploaded_file($files["tmp_name"],$target_file)){
                        self::$image_name = $users->mytrim($fileName);
                        echo "فایل آپلود شد ." . $files["name"];
                    }else{
                        if (isset($_SESSION["errors_message"])){
                            $_SESSION["errors_message"] .= "مشکل در آپلود عکس !! .";
                        }else{
                            $_SESSION["errors_message"] = "مشکل در آپلود عکس !! .";
                        }
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
        public function select_double_quote_or_single($value){
            if (isset($value)){
                if (preg_match("/'/")){
                    echo '"';
                }
                if (preg_match('/"/')){
                    echo "'";
                }
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
            global $database;
            if (isset($value)){
                /*for($i = 1;$i <= 5;$i++)
                    $value = $value * 1.6;
                $value = base64_encode($value);*/
                $value = $database->escape_value($value);
                return $value;
            }
        }
        function decrypt_id($value){
            global $users,$database;
            if (isset($value)){
                $value = $database->escape_value($value);
                settype($value,"integer");
                /*$value = base64_decode($value);
                for($i = 1;$i <= 5;$i++)
                    $value = $value / 1.6;
                if((preg_match('/^[0-9]*$/', $value)) && is_numeric($value)){
                    */return $value;
                /*}else{
                    $users->redirect_to("RoomsList.php");
                }*/
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
        function jalali_to_gregorian($jy, $jm, $jd) {
            $jy += 1595;
            $days = -355668 + (365 * $jy) + (((int)($jy / 33)) * 8) + ((int)((($jy % 33) + 3) / 4)) + $jd + (($jm < 7)? ($jm - 1) * 31 : (($jm - 7) * 30) + 186);
            $gy = 400 * ((int)($days / 146097));
            $days %= 146097;
            if ($days > 36524) {
                $gy += 100 * ((int)(--$days / 36524));
                $days %= 36524;
                if ($days >= 365) $days++;
            }
            $gy += 4 * ((int)($days / 1461));
            $days %= 1461;
            if ($days > 365) {
                $gy += (int)(($days - 1) / 365);
                $days = ($days - 1) % 365;
            }
            $gd = $days + 1;
            $sal_a = array(0, 31, (($gy % 4 == 0 and $gy % 100 != 0) or ($gy % 400 == 0))?29:28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
            for ($gm = 0; $gm < 13 and $gd > $sal_a[$gm]; $gm++) $gd -= $sal_a[$gm];
            return array($gy, $gm, $gd);
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
        public function ShowBetweenTwoDateRange($start_day,$end_day){
            $new_date = new DateTime($end_day);
            $new_date->add(new DateInterval('P1D'));
            $end_day = $new_date->format('Y-m-d');
            $period = new DatePeriod(
                new DateTime($start_day),
                new DateInterval('P1D'),
                new DateTime($end_day)
            );
            foreach ($period as $key => $value) {
                echo "new Date(".$value->format('Y,m-1,d') . "),";
            }
        }
        public function DividedStartAndEndDate($date,$sep){
            $date = explode($sep,$date);
            $start_date = $date[0];
            $end_date = $date[1];
            return array($start_date,$end_date);
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
        public function convert_format_for_jalali_to_gregorian($date){
            $date_array = explode("-",$date);
            $year = (int)$date_array[0];
            $month = (int)$date_array[1];
            $day = (int)$date_array[2];
            $GregorianDate = $this->jalali_to_gregorian($year,$month,$day);
            return $GregorianDate;
        }
        public function EN_numTo_FA($str,$toPersian){
            $en = array('0','1','2','3','4','5','6','7','8','9');
            $fa = array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹');
            if ($toPersian == true){ return str_replace($en,$fa,$str); } elseif($toPersian == false){ return str_replace($fa,$en,$str); }
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
        public function today_date($ger = ""){
            $now = strftime("%Y-%m-%d",time());
            $nowSplit = explode("-",$now);
            $YMD = array('year' => $nowSplit[0] , 'month' => $nowSplit[1] , 'day' => $nowSplit[2]);
            if (isset($ger) && $ger == true){
                echo $now;
            }else{
                $jalali = $this->gregorian_to_jalali($YMD['year'],$YMD['month'],$YMD['day']);
                echo $jalali[0]."/".$jalali[1]."/".$jalali[2];
            }
        }
        public function redirect_with_get($url){
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $data = curl_exec($ch);
            curl_close($ch);
        }
    }
    $Functions = new Functions();
?>