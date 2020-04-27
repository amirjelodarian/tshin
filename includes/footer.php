<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-3">
                <h3>تماس با ما</h3>  <a href="#" id="phone">09023989418</a>  <a href="#" id="email_footer">Info@tishin.com</a>
            </div>
            <div class="col-md-3 col-sm-3">
                <h3>در باره ما</h3>
                <ul>
                    <li><a href="about.php">درباره ما</a>
                    </li>
                    <li><a href="login.php">ورود</a>
                    </li>
                    <li><a href="register.php">ثبت نام</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-3">
                <h3>كشف كردن</h3>
                <ul>
                    <li><a href="blog.php">وبلاگ ها</a>
                    </li>
                    <li><a href="all_hotels_list.php">اقامتگاه های ما </a>
                    </li>
                    <li><a href="gallery.html">گالری</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-2 col-sm-3">
                <h3>زبان سایت</h3>
                <div class="styled-select">
                    <select class="form-control" name="lang" id="lang">
                        <option value="English" selected="">فارسی</option>
                        <option value="English" selected="">English</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="social_footer">
                    <ul>
                        <li><a href="#"><i class="icon-facebook"></i></a>
                        </li>
                        <li><a href="#"><i class="icon-twitter"></i></a>
                        </li>
                        <li><a href="#"><i class="icon-google"></i></a>
                        </li>
                        <li><a href="#"><i class="icon-instagram"></i></a>
                        </li>
                        <li><a href="#"><i class="icon-pinterest"></i></a>
                        </li>
                        <li><a href="#"><i class="icon-vimeo"></i></a>
                        </li>
                        <li><a href="#"><i class="icon-youtube-play"></i></a>
                        </li>
                        <li><a href="#"><i class="icon-linkedin"></i></a>
                        </li>
                    </ul>
                    <p>کلیه حقوق این سایت متعلق به تی شین می باشد.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<div id="toTop"></div>
<?php

if (isset($_SESSION["errors_message"])) {
    if ($_SESSION["errors_message"] == "رمز با موفقیت تغییر کرد"){
     echo $_SESSION['errors_message'];
    }else{
     $_SESSION["errors_message"] = " ";
    }
}
global $database;
    if ($database->open_connection()){
        $database->close_connection();
    }
?>