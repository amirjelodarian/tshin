<?php require_once("classes/sessions.php"); ?>
<?php
    require_once("classes/users.php");
    global $sessions;
    global $users;
    if(isset($_POST["logout_submit"])) {
        $sessions->logout();
        $users->redirect_to("index.php");
    }
?>
<?php date_default_timezone_set('Asia/Tehran'); ?>
<header>
    <div id="top_line">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6"><i class="icon-phone"></i><strong>0902 3989418</strong>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <ul id="top_links">
                        <li>
                            <form action="<?php echo(htmlspecialchars($_SERVER['PHP_SELF'])); ?>" method="post">
                                <span class="icon-logout"><input type="submit" name="logout_submit" class="logout-btn icon-logout outline" value="خروج" /></span>
                            </form>
                        </li>
                        <li><a href="" id="wishlist_link">لیست علاقه مندی ها</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <div id="logo">
                    <a href="index.php">
                        <img src="#" width="160" height="34" alt="City tours" data-retina="true" class="logo_normal">
                    </a>
                    <a href="index.php">
                        <img src="#" width="160" height="34" alt="City tours" data-retina="true" class="logo_sticky">
                    </a>
                </div>
            </div>
            <nav class="col-md-9 col-sm-9 col-xs-9"> <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>منوی تلفن همراه</span></a>
                <div class="main-menu">
                    <div id="header_menu">
                        <img src="#" width="160" height="34" alt="City tours" data-retina="true">
                    </div><a href="#" class="open_close" id="close_in"><i class="icon_set_1_icon-77"></i></a>
                    <ul>
                        <?php
                            if ($sessions->login_state()){
                                echo("<li class='submenu panel-icon'><a href='panel/' class='icon-tools' target='_blank'>داشبورد</a></li>");
                            }
                        ?>
                        <li class="submenu"> <a href="index.php" class="show-submenu">صفحه اصلی <i class="icon-home"></i></a>
                        </li>
                        <li class="submenu"> <a href="javascript:void(0);" class="show-submenu">جاذبه های تی شین <i class="icon-tree"></i></a>
                            <ul>
                                <li><a href="RoomsList.php">لیست همه اقامتگاه ها</a>
                                </li>
                                <li><a href="FoodsList.php">لیست همه غذا ها</a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu"> <a href="blog.php" class="show-submenu">وبلاگ ما<i class="icon-book-open"></i></a></li>
                        <li class="submenu"> <a href="about.php" class="show-submenu">درباره ما<i class="icon-person"></i></a></li>
                        <li class="submenu"> <a href="contactus.php" class="show-submenu">تماس با ما<i class="icon-contacts"></i></a></li>
                    </ul>
                </div>
                <ul id="top_tools">
                    <li>
                        <div class="dropdown dropdown-search"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-search"></i></a>
                            <div class="dropdown-menu">
                                <form>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="جستجو..."> <span class="input-group-btn"> <button class="btn btn-default" type="button" style="margin-left:0;"> <i class="icon-search"></i> </button> </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="dropdown dropdown-search"> <a href="#" class="dropdown-toggle" data-toggle="drop/rooms_show.phpdown"><i class="icon-megaphone"></i> English</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>