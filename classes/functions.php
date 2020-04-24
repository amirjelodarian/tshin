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
                $value = $value*13.5;
                for($i = 1;$i <= 4;$i++){
                    $value = base64_encode($value);
                }
                return $value;
            }
        }
        function decrypt_id($value){
            if (isset($value)){
                for($i = 1;$i <= 4;$i++){
                    $value = base64_decode($value);
                }
                $value = $value/13.5;
                return $value;
            }
        }
    }
    $Functions = new Functions();
?>