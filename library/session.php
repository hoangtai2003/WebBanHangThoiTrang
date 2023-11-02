<?php
    class Session{
        public static function init(){
            if(version_compare(phpversion(), '8.2.4', '<')){
                if(session_id() == ''){
                    session_start();
                }
            }else {
                if(session_status() == PHP_SESSION_NONE){
                    session_start();
                }
            }
        }
        public static function set($key, $val){
            $_SESSION[$key] = $val;
        }
        public static function get($key){
            if(isset($_SESSION[$key])){
                return $_SESSION[$key];
            } else {
                return false;
            }
        }
        public function checkSession(){
            self::init();
            if(self::get('login') == false){
                self::destroy();
                header("Location:login.php");
            }
        }
        public function checkLogin(){
            self::init();
            if(self::get('login') == true){
                header("Location:index.php");
            }
        }
        public function destroy(){
            session_destroy();
            header("Location:login.php");
        }
        
    }
?>