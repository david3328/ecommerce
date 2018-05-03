<?php

  //Agregar la orden de un usuario
  $app->post('/orders/{idUser}',function($request,$response){

    require('src/functions/execQuery.php');

    $idUser = $request->getAttribute('idUser');
    
    $query = 'consulta para registrar las ordenes';

    if(execQuery($query)){
      $rpta['success']  = true;
      $rpta['code']     = 200;
      $rpta['message']  = 'Registro realizado con éxito.';
    }else{
      $rpta['success']  = false;
      $rpta['code']     = 400;
      $rpta['message']  = 'No se ha podido agregar el registro.';
    }

    echo json_encode($rpta);

  });

  //Obtener una orden
  $app->get('/orders/{idOrder}',function($request,$response){

    require('src/functions/getData.php');

    $idOrder = $request->getAttribute('idOrder');
    $query = "SELECT * FROM order WHERE id='$idOrder'";

    echo json_encode(getData($query));

  })

?>