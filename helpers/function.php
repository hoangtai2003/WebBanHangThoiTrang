<?php
    class Format{
        public function formateDate($date){
            return date('F j, Y, g:i a', strtotime($date));
        }  
        public function textShorten($text, $limit = 400){
            $text = $text . "";
            $text = substr($text, 0, $limit);
            $text = substr($text, 0, strrpos($text, ''));
            $text = $text.".....";
            return $text;
        }
        //  Kiểm tra form còn trống
        public function validation ($data){
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        } 
        // Kiểm tra tên của serve
        public function title(){
            $path = $_SERVER['SCRIPT_FILENAME'];
            $title = basename($path, '.php');
            if ($title == 'index'){
                $title = 'home';

            } elseif($title == 'contact'){
                $title = 'contact';
            }
            return $title = ucfirst($title);
        }
    }
    function checkPrivilege($uri = false){
        $uri = $uri!=false ? $uri: $_SERVER['REQUEST_URI'];
        if (empty( $_SESSION['current_user']['privileges'])){
            return false;
        }
        $privileges = $_SESSION['current_user']['privileges'];
        $privileges = implode("|", $privileges);
        preg_match('/index\.php|'. $privileges . '/', $uri, $matches);
        return !empty($matches);
    }  
?>