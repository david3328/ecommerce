<?php

$auth = function($request,$response){
  $headerValueArray = $request->getHeader('Authorization');
  $jwt = array_shift($headerValueArray);

  $file = 'src/keys/public.rsa';      
  $key = file_get_contents($file);

  $rpta['success'] = true;
  $decoded = null;

  try {
    $decoded = JWT::decode($jwt, $key, array('RS256'));
  }catch(Exception $e){
    $rpta['success']  = false;
    $rpta['message']  = 'Token inválido.';
  }

  if($rpta['success']){
    $response = $next($request,$response);
    return $response;
  }else{      
    return $response->write(json_encode($rpta));
  }
}

?>