﻿<?php include("includes/search_slider_all_rooms.php"); ?>
                <?php
                if(isset($_POST["user_show_by_all_hotels_room"])){
                    $rooms->ShowAllRoomsBy(true);
                }elseif (isset($_POST["user_submit_search_room"]) && isset($_POST["user_keyword_room"]) && !(empty($_POST["user_keyword_room"]))){
                    $rooms->UserََSerachRoom(true);
                }else{
                    $rooms->AllRooms(true);
                }
                ?>

            <hr>
            <!--<div class="text-center">
                <ul class="pagination">
                    <li><a href="#">قبلی</a>
                    </li>
                    <li class="active"><a href="#">۱</a>
                    </li>
                    <li><a href="#">۲</a>
                    </li>
                    <li><a href="#">۳</a>
                    </li>
                    <li><a href="#">۴</a>
                    </li>
                    <li><a href="#">۵</a>
                    </li>
                    <li><a href="#">بعدی</a>
                    </li>
                </ul>
            </div>-->
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>
<script src="js\jquery-1.11.2.min.js"></script>
<script src="js\common_scripts_min.js"></script>
<script src="js\functions.js"></script>
<script src="js\icheck.js"></script>
<script>
    $('input').iCheck({checkboxClass: 'icheckbox_square-grey', radioClass: 'iradio_square-grey'});
</script>
</body>
</html>