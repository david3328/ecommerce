<?php
  require_once('src/config/class.Conexion.php');
  function getData($query) {
    $bd=new Conexion();
    $sql = $bd->query($query);
    if(mysqli_num_rows($sql) > 0){
        $return_array = array();
        while($row = mysqli_fetch_assoc($sql)){
            array_push($return_array,$row);
        }
        return $return_array;
    }else{
        return false;
    }
  }
?>