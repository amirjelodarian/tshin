<?php include("includes/search_slider_all_rooms.php"); ?>
        <?php
        isset($_GET["page"]) ? $page = $_GET["page"] : $page = 1;
        isset($_GET["roomByPage"]) ? $roomByPage = $_GET["roomByPage"] : $roomByPage = 1;
        isset($_GET["roomSearchPage"]) ? $roomSearchPage = $_GET["roomSearchPage"] : $roomSearchPage = 1;

        if(isset($_POST["user_show_by_all_hotels_room"]) || isset($_GET["roomByPage"])){
            $rooms->ShowAllRoomsBy(false,$roomByPage);
        }elseif (isset($_POST["user_submit_search_room"]) && isset($_POST["user_keyword_room"]) && !(empty($_POST["user_keyword_room"])) || isset($_GET["roomSearchPage"])){
            $rooms->UserََSerachRoom(false,$roomSearchPage);
        }else{
            $rooms->AllRooms(false,'',true,$page);
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