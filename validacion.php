<?php
function test_input($data) {
    $datos = trim($data);
    $datos = stripslashes($datos);
    $datos = htmlspecialchars($datos);
    return $datos;
}

function validaremail($email){
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
       
        return true;
    } 
}
function validartelefono($numero){
    if(is_numeric($numero) && strlen($numero)==9 ){
        return true;
    }else
     return false;
}
function comprobarpsw($psw1,$psw2){
    if (strcmp($psw1, $psw2) == 0) {
       return true;
    }else return false;
}
?>