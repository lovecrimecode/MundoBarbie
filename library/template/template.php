<?php
class Template {
     static $instance = null;
     public function __construct() {
          require 'header.php';
     }
     public function __destruct() {
          require 'footer.php';
     }

     public static function applyTemplate() {
          if (self::$instance === null) {
               self::$instance = new Template();
          }
          return self::$instance;
     }
}