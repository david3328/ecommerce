<?php
  require_once('src/config/class.Conexion.php');
  function execQuery($query) {
    $bd=new Conexion();
    $sql = $bd->query($query);
    if($bd->affected_rows>0){
      return true;
    }else{
      return false;
    }
  }
?>