<?php

//Crear un usuario
$app->post('/users',function($request,$response){
  require('src/functions/Encrypt.php');
  require('src/functions/execQuery.php');

  $userName         = $request->getParam('name');
  $firstName    = $request->getParam('firstName');
  $lastName     = $request->getParam('lastName');
  $email        = $request->getParam('email');
  $phoneNumber  = $request->getParam('phoneNumber');
  $password     = $request->getParam('password');
  $password     = Encrypt($password);

  $query = "INSERT INTO users (user_name,password,first_name,last_name,email,phone_number) 
            values ('$name','$password','$firstName','$lastName','$email','$phoneNumber')";
  
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

//Crear una dirección para el usuario
$app->post('/users/{idUser}/address',function($request,$response){

  require('src/functions/execQuery.php');

  $idUser = $request->getAttribute('idUser');
  $address = $request->getParam('address');
  $idUbigeo = $request->getParam('idUbigeo');

  $query = "mi consulta para insertar dirección";
  $rpta;

  if(execQuery($query)){
    $rpta['success']  = true;
    $rpta['code']     = 200;
    $rpta['message']  = 'Registro realizado.';
  }else{
    $rpta['success']  = false;
    $rpta['code']     = 400;
    $rpta['message']  = 'No se ha podido agregar el registro.';
  }
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

  require('src/functions/getData.php');  

  $idUser = $request->getAttribute('idUser');
  $query  = "SELECT id,name FROM users WHERE id='$idUser'";

  $user = getData($query);
  $rpta;

  if($user){
    $rpta['success'] = true;
    $rpta['code']    = 200;
    $rpta['message'] = 'Petición exitosa';
    $rpta['data']    = $user;
  }else{
    $rpta['success'] = false;
    $rpta['code']    = 400;
    $rpta['message'] = 'Problema al solicitar usuario';
  }
  echo json_encode($rpta);
});

//Obtener los productos favoritos de un usuario.
$app->get('/users/{idUser}/favorites',function($request,$response){
  
  require('src/funcionts/getData.php');

  $idUser = $request->getAttribute('idUser');

  $query = 'consulta para obtener los favoritos';
  $data  = getData($query);

  echo json_encode($data);

});

//Obtener todos los pedidos de un usuario
$app->get('/users/{idUser}/orders',function($request,$response){

  require('src/functions/getData.php');

  $idUser = $request->getAttribute('idUser');
  $query  = "SELECT * FROM orders WHERE id_user='$idUser'";

  $data = getData($query);

  echo json_encode($data);

});



?>