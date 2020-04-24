<?php
require_once("users.php");
class Sessions{
	function __construct(){
		session_start();
	}
	public function logout(){
	    global $users;
	    if (isset($_POST["logout_submit"])) {
            if (isset($_SESSION["logged_in"]) || $_SESSION["logged_in_administrator"] || $_SESSION["logged_in_admin"]) {
                $_SESSION["logged_in"] = null;
                $_SESSION["logged_in_admin"] = null;
                $_SESSION["logged_in_administrator"] = null;
                if (isset($_SESSION["user_id"])) {
                    unset($_SESSION["user_id"]);
                }
                if (isset($_SESSION["user_mode"])) {
                    unset($_SESSION["user_mode"]);
                }
                if (isset($_SESSION["username"])){
                    $_SESSION["username"] = null;
                    unset($_SESSION["username"]);
                }
                if (isset($_SESSION["password"])){
                    $_SESSION["password"] = null;
                    unset($_SESSION["password"]);
                }
                if (isset($_SESSION["tel"])){
                    $_SESSION["tel"] = null;
                    unset($_SESSION["tel"]);
                }
                unset($_SESSION["logged_in"]);
                unset($_SESSION["logged_in_admin"]);
                unset($_SESSION["logged_in_administrator"]);
                session_destroy();
            }
        }
    }
    public function login_state(){
	    if(isset($_SESSION["logged_in"]) && isset($_SESSION["user_id"]) && isset($_SESSION["user_mode"])){
	        return true;
        }else{
	        return false;
        }
    }
    public function login_admin($to){
        global $users;
        if (!(isset($_SESSION["logged_in_admin"]))){
            $users->redirect_to($to);
        }
    }
    public function login_administrator($to){
        global $users;
        if (!(isset($_SESSION["logged_in_administrator"]))){
            $users->redirect_to($to);
        }
    }
    public function login_administrator_and_admin($to){
	    global $users;
        if (!(isset($_SESSION["logged_in_administrator"])) && !(isset($_SESSION["logged_in_admin"]))) {
            $users->redirect_to($to);
        }
    }
    public function null_room_id_while_comment(){
        if (isset($_SESSION["room_id_while_comment"]) || !(empty($_SESSION["room_id_while_comment"]))) {
            $_SESSION["room_id_while_comment"] = '';
            $_SESSION["room_id_while_comment"] = null;
            unset($_SESSION["room_id_while_comment"]);
        }
    }
}
$sessions = new Sessions();
?>