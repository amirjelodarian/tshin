<?php
    class MYSQLDatabase{
        private $connection;
        private $last_query;
        function __construct(){
            $this->open_connection();
            $this->query("SET NAMES 'utf8'");
        }
        public function open_connection(){
            defined("DB_HOST") ? null : define("DB_HOST","localhost");
            defined("DB_USER") ? null : define("DB_USER","root");
            defined("DB_PASS") ? null : define("DB_PASS","");
            defined("DB_NAME") ? null : define("DB_NAME","tshin");
            $this->connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            if (mysqli_connect_errno()){
                die("Error Database Connection ".mysqli_connect_errno()."<br />".mysqli_connect_error());
            }
        }
        public function close_connection(){
            if (isset($this->connection)){
                mysqli_close($this->connection);
                unset($this->connection);
            }
        }
        public function query($sql){
            $this->last_query = $sql;
            $result = mysqli_query($this->connection,$sql);
            $this->confirm_query($result);
            return $result;
        }
        public function escape_value($value){
            $magic_quotes_active = get_magic_quotes_gpc();
            $new_enough_php = function_exists("mysqli_real_escape_string");// i.e. PHP >= v4.3.0
            if ($new_enough_php){ // PHP v4.3.0 or higher
                // undo any magic quote effects so mysql_real_escape_string can do the work
                if ($magic_quotes_active){
                    $value = stripslashes($value);
                }
                $value = mysqli_real_escape_string($this->connection,$value);
            } else{ // Before PHP v4.3.0
                // if magic quotes aren't already on then add slashes manually
                if (!$magic_quotes_active){
                    $value = addslashes($value);
                }
                // if magic quotes are active, then the slashes already exist
            }
            return $value;
        }
        public function fetch_array($result_set){
            return mysqli_fetch_assoc($result_set);
        }
        public function num_rows($result_set){
            return mysqli_num_rows($result_set);
        }
        public function insert_id(){
            return mysqli_insert_id($this->connection);
        }
        public function affected_rows(){
            return mysqli_affected_rows($this->connection);
        }
        public function confirm_query($result){
            if (!$result){
                $output = "Database query failed : <br />";
                mysqli_connect_error() . "<br /><br />";
                $output .= "Last SQL Query : <br /> ".$this->last_query;
                die($output);
            }
        }
        public function free_result($result){
            if ($result) {
                return mysqli_free_result($result);
            }
        }
    }
    $database = new MYSQLDatabase();
    $db = & $database;
?>