<?php

  $app-post('/favorites',function($request,$response){

    require('src/functions/execQuery.php');

    $idUser    = $request->getParam('idUser');
    $idProduct = $request->getParam('idProduct');

    $query="INSERT INTO favorites (id_user,id_product) values('$idUser','$idProduct')";
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

    echo json_encode($rpta);

  });

?>