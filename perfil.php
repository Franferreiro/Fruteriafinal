<?php
require "BD_metodos.php";
session_start();
$imagen_actual;
if (isset($_POST["Guardar"])) {




    if (isset($_FILES['nuevaimagen']) && $_FILES['nuevaimagen']['error'] === UPLOAD_ERR_OK) {
        
        $imagen = $_POST['nuevaimagen'];
        $mensaje_error;
        //Obtener detalles del fichero
        $fileTmpPath = $_FILES['nuevaimagen']['tmp_name'];
        $fileName = $_FILES['nuevaimagen']['name'];
        $fileSize = $_FILES['nuevaimagen']['size'];
        $fileType = $_FILES['nuevaimagen']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        //Limpiar los caracteres especiales
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        //Creamos un array con las extensiones permitidas
        $allowedfileExtensions = array('jpg', 'gif', 'png');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $directorio = 'img/imgperfil'; //Declaramos un  variable con la ruta donde guardaremos los archivos
            //Validamos si la ruta de destino existe, en caso de no existir la creamos
            if (!file_exists($directorio)) {
                //0777 son los permisos
                mkdir($directorio, 0777) or die("No se puede crear el directorio;n");
            }
            $dir = opendir($directorio); //Abrimos el directorio de destino
            $target_path = $directorio . '/' . $newFileName; //Indicamos la ruta de destino, así como el nombre del archivo
            if (move_uploaded_file($fileTmpPath, $target_path)) {

                $imagen_actual_ruta = $_SESSION["img"];
                $imagen_actual_aux = explode("/", $imagen_actual_ruta);
                $imagen_actual = end($imagen_actual_aux);

                //Aqui compruebo si la imagen por defecto es la que esta,si es el caso no la borro pero si no lo es borro la imagen anterior
                if ($imagen_actual === "anonimo.png") {
                    $_SESSION["img"] = $target_path;
                    header('Location:perfil.php');
                } else {
                    unlink($imagen_actual_ruta);
                    $_SESSION["img"] = $target_path;
                    header('Location:perfil.php');
                }
            } else {
                echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
            }
            closedir($dir); //Cerramos el directorio de destino
        }
    } else {
        $mensaje_error = "El archivo introducido no es una imagen (jpg,gif,png)";
    }

    $_SESSION["user"] = $_POST["Usuario"];
    $_SESSION["telefono"] = $_POST["Telefono"];
    $_SESSION["apellido"] = $_POST["Apellido"];
    $_SESSION["correo"] = $_POST["Correo"];



    modificarperfil($_SESSION["id"], $_SESSION["user"], $_SESSION["apellido"], $_SESSION["correo"], $_SESSION["telefono"], $_SESSION["img"]);
    insertarhistorico($_SESSION["id"], "Modificación");
}
if (isset($_POST["Cerrar"])) {
    insertarhistorico($_SESSION["id"], "Logout");
    session_destroy();
    header('Location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.css" />

   
    <link rel="stylesheet" href="css/styleindex.css">
    <link rel="stylesheet" href="css/styleperfil.css">

    <title>Document</title>
</head>

<body>
    <header>
        <nav>
            <?php include "_navbar.php" ?>
        </nav>
    </header>

    <div class="container">

        <div class="row ">
            <div class="col">
                <form action="perfil.php" method="post" enctype="multipart/form-data">
                    <div class="row pt-5">
                        <div class="col-5">
                            <img src="<?php echo $_SESSION["img"] ?>" class="picture-src" id="wizardPicturePreview" alt="" width="100%">
                            <input type="file" class="btn btn-dark" id="wizard-picture" name="nuevaimagen">
                        </div>
                        <div class="col-7">
                            <ul class="list-group list-group-flush px-5">
                                <li class="list-group-item">Nombre: <input class="px-2 rounded" type="text" id="Usuario" name="Usuario" style="border: 0" readonly="true" value="<?php echo $_SESSION["user"] ?>"> </li>
                                <li class="list-group-item">Apellido: <input class="px-2 rounded" type="text" id="Apellido" name="Apellido" style="border: 0" readonly="true" value="<?php echo $_SESSION["apellido"] ?>"> </li>
                                <li class="list-group-item">Correo electrónico: <input class="px-2 rounded" type="text" id="Correo" name="Correo" style="border: 0" readonly="true" value="<?php echo $_SESSION["correo"] ?>"> </li>
                                <li class="list-group-item">Número de teléfono: <input class="px-2 rounded" type="text" id="Telefono" name="Telefono" style="border: 0" readonly="true" value="<?php echo $_SESSION["telefono"] ?>"> </li>
                                <li class="list-group-item">
                                    <a type="button" class="btn btn-outline-success " onclick="editarCampos()">Editar</a>
                                    <input type="submit" class="btn btn-outline-success " value="Guardar Cambios" name="Guardar" />
                                    <input type="submit" class="btn btn-outline-success" value="Consultar historial" name="Historial" />
                                    <input type="submit" class="btn btn-outline-success " value="Cerrar sesión" name="Cerrar" />

                                </li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>

        </div>




    </div>

    <?php if (isset($_POST["Historial"]) || isset($_POST["Boton_Fecha"])) {
        $historia = consultarhistoriausuario($_SESSION["id"]);
        if (isset($_POST["Boton_Fecha"])) {
           
            if(!empty($_POST["Fecha_Inicio"]) && !empty($_POST["Fecha_Final"])){
               
            $historia = consultarhistoriausuarioporfecha($_SESSION["id"], $_POST["Fecha_Inicio"], $_POST["Fecha_Final"]);
            }elseif(!empty($_POST["selectordetipo"])){
                
                $historia=consultarhistoriausuarioportipo($_SESSION["id"],$_POST["selectordetipo"]);

            }
        }

        echo " 
        <form action='perfil.php' method='post'>
        <input type='date' class='btn btn-dark '  name='Fecha_Inicio' />
        <input type='date' class='btn btn-dark '  name='Fecha_Final'/>
        <input type='submit' class='btn btn-dark ' value='Filtrar' name='Boton_Fecha' />
        <div class='col-4'>
        <select name='selectordetipo' class='form-select' aria-label='Default select example'>
        <option selected value=False >Busca por el tipo</option>
        <option value='Registro'>Registro</option>
        <option value='Login'>Login</option>
        <option value='Logout'>Logout</option>
        <option value='Modificación'>Modificación</option>
        <option value='Reserva'>Reserva</option>
        </select>
        </div>
        </form>
        <table class='table table-info table-striped'>
    <thead>
        <tr>
            <th scope='col'>#</th>
            <th scope='col'>Fecha</th>
            <th scope='col'>Tipo</th>
        </tr>
    </thead>
    <tbody>";
        for ($i = 0; $i < sizeof($historia); $i++) {
            echo
            "
            <tr>
                <th scope='row'>$i</th>
                <td>" . $historia[$i]['fecha'] . "</td>
                <td>" . $historia[$i]['tipo_operacion'] . "</td>
              
            </tr>";
        }
        echo "
    </tbody>
</table>";
    }
    ?>



</body>
<script src="js/jquery-3.6.0.min.js"></script>
<script>
    var editable = false;

    function editarCampos() {
        console.log("editando")
        if (editable == false) {
            $("#Usuario").prop('readonly', false);
            $("#Usuario").css('border', '1px solid black');
            $("#Correo").prop('readonly', false);
            $("#Correo").css('border', '1px solid black');
            $("#Telefono").prop('readonly', false);
            $("#Telefono").css('border', '1px solid black');
            $("#Apellido").prop('readonly', false);
            $("#Apellido").css('border', '1px solid black');
            editable = true;
        } else {
            $("#Usuario").prop('readonly', true);
            $("#Usuario").css('border', '0px solid black');
            $("#Correo").prop('readonly', true);
            $("#Correo").css('border', '0px solid black');
            $("#Telefono").prop('readonly', true);
            $("#Telefono").css('border', '0px solid black');
            $("#Apellido").prop('readonly', true);
            $("#Apellido").css('border', '0px solid black');
            editable = false;
        }
    }
</script>

</html>