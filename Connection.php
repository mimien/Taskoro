<?php
class Db {
   private static $instance = NULL;

   private function __construct() {}

   public static function get() {
      if (!isset(self::$instance)) {
         $servername = 'localhost';
         $username = 'root';
         $password = '';
         $dbname = 'Taskoro';

         self::$instance = new mysqli($servername, $username, $password, $dbname);

         if (self::$instance->connect_errno) {
            header('HTTP/1.1 500 Error al conectar a la base de datos');
            die(self::$instance->connect_error);
         }
      }
      return self::$instance;
   }
}
?>