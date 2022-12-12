<?php
require "Config/conexiones_BD.php";

function listarusuarios()
{
    $base = conectar("admin");
    $sql = $base->prepare("SELECT * FROM usuarios ");
    $sql->execute();
    $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    $sql = null;
    $base = null;
    return $resultado;
}
function traerusuarioporcorreo($correo)
{
    try {
        $base = conectar("admin");
        $sql = $base->prepare("SELECT * FROM usuarios WHERE Correo=:correo");
        $sql->bindParam(":correo", $correo);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        $sql = null;
        $base = null;
        return $resultado;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}
function registrarusuarios($nombre, $apellido, $correo, $telefono, $psw, $rol = 2)
{
    try {
        $base = conectar("admin");
        $sql = $base->prepare("INSERT INTO usuarios(Nombre,Apellido,Correo,Telefono,Psw,Rol) VALUES(:nombre,:apellido,:correo,:telefono,:psw,:rol)");
        $sql->bindParam(":nombre", $nombre);
        $sql->bindParam(":apellido", $apellido);
        $sql->bindParam(":correo", $correo);
        $sql->bindParam(":telefono", $telefono);
        $sql->bindParam(":psw", $psw);
        $sql->bindParam(":rol", $rol);
        $sql->execute();
        $sql = null;
        $base = null;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}
function modificarperfil($id, $nombre, $apellido, $correo, $telefono, $img)
{
    try {
        $base = conectar("admin");
        $sql = $base->prepare("UPDATE usuarios SET Nombre=:nombre , Apellido=:apellido , Correo=:correo, Telefono=:telefono, Imagen=:img WHERE Id=:id");
        $sql->bindParam(':id', $id);
        $sql->bindParam(':nombre', $nombre);
        $sql->bindParam(':apellido', $apellido);
        $sql->bindParam(':correo', $correo);
        $sql->bindParam(':telefono', $telefono);
        $sql->bindParam(':img', $img);
        $sql->execute();

        $sql =  null;
        $base = null;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}
function insertarhistorico($id, $tipo)
{
    try {
        $base = conectar("admin");
        $sql = $base->prepare("INSERT INTO historico(Id_usuario,tipo_operacion) VALUES(:id_usuario,:tipo_operacion)");
        $sql->bindParam(":id_usuario", $id);
        $sql->bindParam(":tipo_operacion", $tipo);
        $sql->execute();
        $sql = null;
        $base = null;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}
function consultarhistoriausuario($id)
{
    try {
        $base = conectar("admin");
        $sql = $base->prepare("SELECT * FROM historico WHERE Id_usuario=:id ORDER BY fecha DESC LIMIT 5");
        $sql->bindParam(":id", $id);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        $sql = null;
        $base = null;
        return $resultado;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}
function consultarhistoriausuarioporfecha($id, $inicio, $final)
{
    try {
        $base = conectar("admin");
        $sql = $base->prepare("SELECT * FROM historico WHERE Id_usuario=:id AND :inicio <= fecha  AND :final >= fecha ORDER BY fecha DESC ");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":inicio", $inicio);
        $sql->bindParam(":final", $final);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        $sql = null;
        $base = null;
        return $resultado;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}
function consultarhistoriausuarioportipo($id, $tipo)
{
    try {
        $base = conectar("admin");
        $sql = $base->prepare("SELECT * FROM historico WHERE Id_usuario=:id AND tipo_operacion=:tipo_operacion  ORDER BY fecha DESC ");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":tipo_operacion", $tipo);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        $sql = null;
        $base = null;
        return $resultado;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}
function listarparcelas()
{
    $base = conectar("admin");
    $sql = $base->prepare("SELECT * FROM parcelas ");
    $sql->execute();
    $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    $sql = null;
    $base = null;
    return $resultado;
}
function buscarparcelaportipo($tipo)
{
    $base = conectar("admin");
    $sql = $base->prepare("SELECT * FROM parcelas WHERE tipo=:tipo ");
    $sql->bindParam(":tipo", $tipo);
    $sql->execute();
    $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    $sql = null;
    $base = null;
    return $resultado;
}
function comprobarhoras($dia, $id)
{
    $base = conectar("admin");
    $sql = $base->prepare("SELECT hora FROM reservas WHERE fecha=:dia AND Id_parcela=:id");
    $sql->bindParam(":dia", $dia);
    $sql->bindParam(":id", $id);
    $sql->execute();
    $resultado = $sql->fetchAll(PDO::FETCH_NUM);
    $sql = null;
    $base = null;
    return $resultado;
}
function insertarreserva($idparcela, $fecha, $hora, $idusuario)
{
    try {
        $base = conectar("admin");
        $sql = $base->prepare("INSERT INTO reservas(Id_parcela,fecha,hora,Id_usuario) VALUES(:id_parcela,:fecha,:hora,:idusuario)");
        $sql->bindParam(":id_parcela", $idparcela);
        $sql->bindParam(":fecha", $fecha);
        $sql->bindParam(":hora", $hora);
        $sql->bindParam(":idusuario", $idusuario);
        $sql->execute();
        $sql = null;
        $base = null;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}
function añadirrhuerto($tipo, $precio, $metros, $imagen, $descripcion)
{
    try {
        $base = conectar("admin");
        $sql = $base->prepare("INSERT INTO parcelas(tipo,precio,metros,imagen,descripcion) VALUES(:tipo,:precio,:metros,:imagen,:descripcion)");
        $sql->bindParam(':tipo', $tipo);
        $sql->bindParam(':precio', $precio);
        $sql->bindParam(':metros', $metros);
        $sql->bindParam(':imagen', $imagen);
        $sql->bindParam(':descripcion', $descripcion);

        $sql->execute();

        $sql =  null;
        $base = null;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}
function borrarrhuerto($id)
{
    try {
        $base = conectar("admin");
        $base->beginTransaction();

        $sql = $base->prepare("DELETE FROM parcelas WHERE Id=:id");
        $sql->bindParam(':id', $id);
        $sql->execute();
        $sql =  null;


        $sql2 = $base->prepare("DELETE FROM reservas WHERE Id_parcela=:id2");
        $sql2->bindParam(':id2', $id);
        $sql2->execute();
        $sql2 =  null;


        $base->commit();
    } catch (PDOException $e) {
        $base->rollBack();
        print $e->getMessage();
    }
}
function buscarparcelaporid($id)
{
    $base = conectar("admin");
    $sql = $base->prepare("SELECT * FROM parcelas WHERE Id=:id ");
    $sql->bindParam(":id", $id);
    $sql->execute();
    $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    $sql = null;
    $base = null;
    return $resultado;
}
function modificarhuerto($id, $tipo, $precio, $metros, $imagen, $descripcion)
{
    echo $precio;
    try {
        $base = conectar("admin");

        $sql = $base->prepare("UPDATE parcelas SET tipo=:tipo , precio=:precio , metros=:metros, imagen=:imagen, descripcion=:descripcion WHERE Id=:id");

        $sql->bindParam(':tipo', $tipo);
        $sql->bindParam(':precio', $precio);
        $sql->bindParam(':metros', $metros);
        $sql->bindParam(':imagen', $imagen);
        $sql->bindParam(':descripcion', $descripcion);
        $sql->bindParam(':id', $id);
        $sql->execute();

        $sql =  null;
        $base = null;
    } catch (PDOException $e) {
        echo "Error aqui";
        print $e->getMessage();
    }
}

function reservaspendientes($estado="Pendiente")
{
    $base = conectar("admin");
    $sql = $base->prepare("SELECT * FROM reservas WHERE estado=:estado ");
    $sql->bindParam(":estado", $estado);
    $sql->execute();
    $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    $sql = null;
    $base = null;
    return $resultado;
}


function check_seleccionados($lista, $id) {

    for ($i = 0; $i < count($lista); $i++) {
        if (isset($_POST[$id . "" . $i])) {
            $seleccionados[] = $lista[$i]["Id"];
        }
    }
    return $seleccionados;
}


function modificar_estado_reserva_lista_seleccionados($seleccionadas,$estado) {
    try {
        $base = conectar("admin");
        for ($i = 0; $i < count($seleccionadas); $i++) {
            $sql = $base->prepare("UPDATE reservas SET estado = :estado WHERE Id=:id");
            $sql->bindParam(":id", $seleccionadas[$i]);
            $sql->bindParam(":estado", $estado);
            $sql->execute();
        }
        $sql = null;
        $base = null;
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}