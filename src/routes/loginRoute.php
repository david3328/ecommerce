<?php

use \Firebase\JWT\JWT;

$app->post('/login',function($request,$response){
  
  require('src/functions/getData.php');
  require('src/functions/Encrypt.php');
  
  $name     = $request->getParam('name');
  $password = $request->getParam('password');
  $password = Encrypt($password);
  
  $user = getData("SELECT id,name FROM users WHERE name='$name' and password='$password'");

  $rpta;

  if($user){

    //Requerir clave privada
    $file       = 'src/keys/private.rsa';      
    $privateKey = file_get_contents($file);

    //Generar token
    $token = array(
      "id"   => $user['id'],
      "name" => $user['name'],
      "type" => $data['type']
    );

    //Crear JWT
    $jwt = JWT::encode($token, $privateKey,'RS256');

    $rpta['success'] = true;
    $rpta['code']    = 200;
    $rpta['message'] = 'Autenticación exitosa';
    $rpta['token']   = $jwt;

    echo json_encode($rpta);

  }else{
    $rpta['success'] = false;
    $rpta['code']    = 404;
    $rpta['message'] = 'Error, credenciales incorrectas';
    
    echo json_encode($rpta);
  }

});

?>