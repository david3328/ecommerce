<?php

//Crear un usuario
$app->post('/users',function($request,$response){
  require('src/functions/Encrypt.php');
  require('src/functions/execQuery.php');

  $name     = $request->getParam('name');
  $password = $request->getParam('password');
  $password = Encrypt($password);

  $query = "INSERT INTO users (name,password) values ('$name','$password')";
  $rpta;

  if(execQuery($query)){
    $rpta['success'] = true;
    $rpta['code']    = 200;
    $rpta['message'] = 'Registro realizado';
  }else{
    $rpta['success'] = false;
    $rpta['code']    = 500;
    $rpta['message'] = 'No se ha podido agregar el registro';
  }

  echo json_encode($rpta);

});

//Obtener la lista de usuarios
$app->get('/users',function($request,$response){

  require('src/functions/getData.php');

  $query = "SELECT id,name from users";
  $data = getData($query);
  
  $rpta;

  if($data){
    $rpta['success']  = true;
    $rpta['code']     = 200;
    $rpta['message']  = 'Datos obtenidos';
    $rpta['data']     = $data;
  }else{
    $rpta['success']  = false;
    $rpta['code']     = 500;
    $rpta['message']  = 'Error al obtener datos';
   }

   echo json_encode($rpta);

});

//Obtener un único usuario
$app->get('/users/{idUser}',function($request,$response){

});


?>