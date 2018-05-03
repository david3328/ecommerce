<?php

  //Registrar un producto
  $app->post('/products',function($request,$response){

    require('src/functions/execQuery.php');

    $name     = $request->getParam('name');
    $price    = $request->getParam('price');

    $query = "INSERT INTO products (name,price) values ('$name',$price)";
    $rpta;

    if(execQuery($query)){
      $rpta['success'] = true;
      $rpta['code']    = 200;
      $rpta['message'] = 'Registro completado con éxito.';
    }else{
      $rpta['success'] = false;
      $rpta['code']    = 400;
      $rpta['message'] = 'Error al registrar producto.';
    }

    echo json_encode($rpta);

  });

  //Obtener todos los productos
  $app->get('/products',function($request,$response){

    require('src/functions/getData.php');

    $query = "SELECT id,name FROM products";

    $data = getData($query);
    $rpta;

    if($data){
      $rpta['success'] = true;
      $rpta['code']    = 200;
      $rpta['message'] = 'Datos obtenidos.';
      $rpta['data']    = $data;
    }else{
      $rpta['success'] = false;
      $rpta['code']    = 400;
      $rpta['message'] = 'Error al obtener datos.';
    }

    echo json_encode($rpta);

  });

  //Obtener los productos por categorías
  $app->get('/products/{idCategory}',function($request,$response){

    require('src/functions/getData.php');

    $idCategory = $request->getAttribute('idCategory');
    $query = "SELECT * FROM products WHERE id_category = '$idCategory'";

    echo json_encode(getData($query));
  });

?>
