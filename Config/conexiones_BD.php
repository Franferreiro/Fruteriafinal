<?php

/* 
 *Clase para realizar las conexiones a la Base de datos
 */
function conectar ($rol){

    try{
    $campos = configuracion('../FRUTERIA/Config/BD_configuracion.xml', '../FRUTERIA/Config/BD_configuracion.xsd', $rol);
    $server="b7wdzbskxuoxflwzb0wc-mysql.services.clever-cloud.com";
    $dbname="b7wdzbskxuoxflwzb0wc";
    $base = new PDO("mysql:dbname=$dbname;host=$server", $campos[0], $campos[1]);
		if (!$base) {
    die("Connection failed: " . mysqli_connect_error());
}
        return $base;
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
function configuracion($name, $xsd, $rol) {

    //Devuelve un array de 2 strings: nombre y password
    $conf = new DOMDocument();
    $conf->load($name);

    if (!$conf->schemaValidate($xsd)) {
        throw new PDOException("Ficheiro de usuarios no valido");
    }


    $xml = simplexml_load_file($name);
//Conversión a cadena de texto con "", porque si no, el xpath nos devuelve
//un objeto de tipo SimpleXMLElement
    $array = [
        "" . $xml->xpath('//nombre[../rol="' . $rol . '"]')[0],
        "" . $xml->xpath('//password[../rol="' . $rol . '"]')[0]
    ];
    return $array;
}