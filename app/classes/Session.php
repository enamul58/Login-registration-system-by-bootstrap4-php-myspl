<?php


namespace App\classes;


class Session
{
    public static function init(){
        session_start();
    }
   public static function set($key, $value){
       session_start();
       $_SESSION[$key] = $value;
   }
   public static function get($key){
       session_start();
       if(isset($_SESSION[$key])){
           return $_SESSION[$key];
       }else{
           return false;
       }
   }

}