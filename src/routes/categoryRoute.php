<?php

  $app->post('/categories',function($request,$response){

    require('src/functions/execQuery.php');

    $name = $request->getParam('name');
    $query = "INSERT INTO categories(name) values ('$name')";

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

  $app->get('/categories',function($request,$response){
    
    require('src/functions/getData.php');

    $query = "SELECT * FROM categories";

    echo json_encode(getData($query));

  })
?>