</div>
</div>
<script src="../js/jquery-1.11.2.min.js"></script>
<script src="../js/common_scripts_min.js"></script>
<script src="../js/signUp.js"></script>
<script src="../js/functions.js"></script>
<script src="../js/icheck.js"></script>
<script>
    $('input').iCheck({checkboxClass: 'icheckbox_square-grey', radioClass: 'iradio_square-grey'});
</script>
</body>
</html>
<?php

if (isset($_SESSION["errors_message"])) {
    $_SESSION["errors_message"] = '';
}

global $database;
    if ($database->open_connection()){
        $database->close_connection();
    }
?>