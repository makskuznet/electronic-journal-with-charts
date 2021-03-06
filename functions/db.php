<?php  
require 'libs/rb.php';
R::setup( 'mysql:host=127.0.0.1;dbname=kursWork',
  'root', '' );
session_start();