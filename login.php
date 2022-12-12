<?php
require "BD_metodos.php";

$usuario = [];
$errorcontraseña = false;
$errorusuario = false;
if (isset($_POST["boton"])) {




    if (!empty($_POST['correo']) && !empty($_POST['pwd'])) {

        $usuario = traerusuarioporcorreo($_POST['correo']);
        if (empty($usuario)) {
            $errorusuario=true;
        } else {

            if (!password_verify($_POST['pwd'], $usuario[0]["Psw"])) {
                $errorcontraseña = true;
            } else {
                print_r($usuario);
                session_start();
                $_SESSION["id"] = $usuario[0]["Id"];
                $_SESSION["user"] = $usuario[0]["Nombre"];
                $_SESSION["apellido"] = $usuario[0]["Apellido"];
                $_SESSION["correo"] = $usuario[0]["Correo"];
                $_SESSION["telefono"] = $usuario[0]["Telefono"];
                $_SESSION["img"] = $usuario[0]["Imagen"];
                $_SESSION["rol"] = $usuario[0]["Rol"];
                insertarhistorico($_SESSION["id"],"Login");
                header('Location: index.php');
            }
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styleindex.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <nav>
            <?php include "_navbar.php" ?>
        </nav>
    </header>
    <section class="form-register">
        <form action="" method="post">
            <h4>Inicio</h4>


            <input class="controls" type="email" name="correo" id="correo" placeholder="Ingrese su Correo" value="<?php if (isset($_POST['correo'])) echo $_POST['correo']; ?>">
            <input class="controls" type="password" name="pwd" id="contraseña" placeholder="Ingrese su Contraseña">

            <input class="botons" name="boton" type="submit" value="Inicio">
            <p style="color: white;">Puedes registrarte <a style="color:#07a231" href="registro.php"> aquí</a>.</p>
             <?php if ($errorusuario) {
                echo "<p style='color:red'>Usuario no encontrado</p>";
            }else if($errorcontraseña){
                echo "<p style='color:red'>Contraseña errónea</p>";

            }
            ?>
        </form>
    </section>

</body>

</html>