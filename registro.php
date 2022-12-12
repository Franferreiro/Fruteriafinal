<?php
require "BD_metodos.php";
require "validacion.php";


$error = false;
$errores = "";
if (isset( $_POST["registrar"] )) {
  $oblig = array('nombre', 'apellidos', 'correo', 'telefono', 'psw1', 'psw2');
  
  foreach ($oblig as $campo) {
    if (empty($_POST[$campo])) {
      $error = true;
    }
  }
  if(!$error){

  
  if (validartelefono($_POST["telefono"])) {
    $_POST['telefono'] = test_input($_POST["telefono"]);
  }else{
    $errores= "Teléfono no válido<br>";
  }
  if(comprobarpsw($_POST["psw1"],$_POST["psw2"])){
    $_POST['psw1']=test_input($_POST["psw1"]);

  }else{
    $errores=$errores."Las contraseñas no coinciden";
  }
$_POST['nombre']=test_input($_POST["nombre"]);
$_POST['apellidos']=test_input($_POST["apellidos"]);
$comprobarcorreo=traerusuarioporcorreo($_POST['correo']);
if(!empty($comprobarcorreo)){
  $errores=$errores."Ya hay una cuenta asociada a este correo";

}
if(!$error && empty($errores)){
  $comprobarcorreo=traerusuarioporcorreo($_POST['correo']);
 
  $hasheada=password_hash($_POST['psw1'],PASSWORD_DEFAULT);
  registrarusuarios($_POST['nombre'], $_POST['apellidos'], $_POST['correo'], $_POST['telefono'], $hasheada);
  $usuario = traerusuarioporcorreo($_POST['correo']);
  $idd= $usuario[0]["Id"];
  insertarhistorico($idd, "Registro");
  header('Location: login.php');
}
}    
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/styleindex.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Registro</title>
</head>

<body>
  <header>
    <nav>
      <?php include "_navbar.php" ?>
    </nav>
  </header>
  <section class="form-register">
    <form action="" method="post">
      <h4>Registro</h4>
      <input class="controls" type="text" name="nombre" id="nombres" placeholder="Ingrese su Nombre" value="<?php if (isset($_POST['nombre'])) echo $_POST['nombre']; ?>">
      <input class="controls" type="text" name="apellidos" id="apellidos" placeholder="Ingrese su Apellido" value="<?php if (isset($_POST['apellidos'])) echo $_POST['apellidos']; ?>">
      <input class="controls" type="email" name="correo" id="correo" placeholder="Ingrese su Correo" value="<?php if (isset($_POST['correo'])) echo $_POST['correo']; ?>">
      <input class="controls" type="number" name="telefono" id="telefono" placeholder="Ingrese su Teléfono" value="<?php if (isset($_POST['telefono'])) echo $_POST['telefono']; ?>">
      <input class="controls" type="password" name="psw1" id="psw" placeholder="Ingrese su Contraseña" >
      <input class="controls" type="password" name="psw2" id="psw" placeholder="Repita la Contraseña">
      <input class="botons" type="submit" name="registrar" value="Registrar">
      <?php if ($error) { ?><p style="color: red " ;>Debes rellenar todos los campos</p><?php } ?>
      <?php if (!empty($errores)) { ?><p style="color: red " ;><?php echo $errores?></p><?php } ?>


  </section>
  </form>

</body>

</html>