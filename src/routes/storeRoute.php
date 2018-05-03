<?php

$app->post('/stores',function($request,$response){

  require('src/functions/Encrypt.php');
  require('src/functions/execQuery.php');

  $name     = $request->getParam('name');
  $brand    = $request->getParam('brand');
  $password = $request->getParam('password');
  $password = Encrypt($password);

  $query = "INSERT INTO store (name,brand,password) values('$name','$brand','$password')";
  $rpta;

  if(execQuery($query)){
    $rpta['success']  = true;
    $rpta['code']     = 200;
    $rpta['message']  = 'Registro completado con éxito.';
  }else{
    $rpta['success']  = false;
    $rpta['code']     = 500;
    $rpta['message']  = 'Error al registrar tienda.';
  }
  
  echo json_encode($rpta);

});

$app->get('/stores',function($request,$response){
  
  require('src/functions/getData.php');

  $query = "SELECT id,name,brand from store";
  $data = getData($query);
  $rpta;

  if($data){
    $rpta['success']  = true;
    $rpta['code']     = 200;
    $rpta['message']  = 'Datos obtenidos.';
    $rpta['data']     = $data;
  }else{
    $rpta['success']  = false;
    $rpta['code']     = 400;
    $rpta['message']  = 'Error al obtener datos.';
  }

  echo json_encode($rpta);

})

?>