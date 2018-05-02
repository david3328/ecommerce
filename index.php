<?php
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Credentials: true");
  header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
  header('Access-Control-Max-Age: 1000');
  header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

  require 'vendor/autoload.php';
  require 'src/config/core.php';

  $app = new \Slim\App;

  require 'src/routes/index.php';

  $app->run();
?>