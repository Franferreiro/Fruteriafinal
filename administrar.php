<?php
require "BD_metodos.php";
require_once "autoload.php";

use Clase\huerto;

session_start();

$listaparcelas = listarparcelas();
$reservas_pendientes = reservaspendientes();
$huertoamodificar;
$id;
$tipo;
$precio;
$metros;
$imagen;
$descripcion;

if (isset($_POST['añadirhuerto'])) {
    añadirrhuerto($_POST['tipohuertoañadir'], $_POST['preciohuertoañadir'], $_POST['metroshuertoañadir'], $_POST['imagenhuertoañadir'], $_POST['descripcionhuertoañadir']);
}

if (isset($_POST['borrarhuerto'])) {
    borrarrhuerto($_POST['huertoseleccionado']);
}
if (isset($_POST['huertoseleccionado']) && isset($_POST['modificarhuerto'])) {
    $huertoporid = buscarparcelaporid($_POST['huertoseleccionado']);
    $huertoamodificar = new huerto($huertoporid[0]['Id'], $huertoporid[0]['tipo'], $huertoporid[0]['precio'], $huertoporid[0]['metros'], $huertoporid[0]['imagen'], $huertoporid[0]['descripcion']);
}


if (isset($_POST["aceptarReserva"])) {
    echo "Aceptando";
    $reservas_seleccionadas = check_seleccionados($reservas_pendientes, "pendiente");
    modificar_estado_reserva_lista_seleccionados($reservas_seleccionadas,"Aceptados");

}
if (isset($_POST["denegarReserva"])) {
    echo "Aceptando";
    $reservas_seleccionadas = check_seleccionados($reservas_pendientes, "pendiente");
    modificar_estado_reserva_lista_seleccionados($reservas_seleccionadas,"Denegada");
}
if (isset($_POST['guardarcambios'])){
    modificarhuerto($_POST['idhuertomodificar'],$_POST['tipohuertomodificar'], $_POST['preciohuertomodificar'],$_POST['metroshuertomodificar'], $_POST['imagenhuertomodificar'], $_POST['descripcionhuertomodificar']);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.css" />
    <link rel="stylesheet" href="css/styleindex.css">
    <link rel="stylesheet" href="css/styleperfil.css">
</head>

<body>
    <header>
        <nav>
            <?php include "_navbar.php" ?>
        </nav>
    </header>
    <form action="" style="width:100% ;" method="post">
        <div class="container d-flex flex-column">
            <div class="row" style="width:100% ;">
                <div class="col-8 m-auto p-5">
                    <?php if (isset($_POST['huertoseleccionado']) && isset($_POST['modificarhuerto'])) {
                        echo "
                    <div class='col-6 m-auto mb-3 '>
                    <input type='text' class='fs-2 form-control' name='tipohuertomodificar' placeholder='Tipo de huerto' value=' $huertoamodificar->tipo '>
                    <input type='text' class='fs-2 form-control' name='idhuertomodificar' placeholder='Tipo de huerto' value=' $huertoamodificar->Id ' hidden>
        
                </div>
                <div class='col-6 m-auto mb-3'>
                    <input type='text' class='fs-2 form-control' name='preciohuertomodificar' placeholder='Precio' value=' $huertoamodificar->precio '>
                </div>
                <div class='col-6 m-auto mb-3 '>
                    <input type='text' class='fs-2 form-control' name='metroshuertomodificar' placeholder='Metros cuadrados' value=' $huertoamodificar->metros '>
                </div>
                <div class='col-6 m-auto mb-3 '>
                    <input type='text' class='fs-2 form-control' name='imagenhuertomodificar' placeholder='Imagen' value=' $huertoamodificar->imagen '>
                </div>
                <div class='col-8 m-auto mb-3'>
                    <div class='input-group'>
                        <span class='fs-2 input-group-text'>Descripción</span>
                        <textarea class='fs-2 form-control' name='descripcionhuertomodificar' aria-label='With textarea'>$huertoamodificar->descripcion</textarea>
                    </div>
                </div>
                <button type='submit' name='guardarcambios' class='btn btn-success px-4' style='font-size: 20px;'>
                Guardar cambios
            </button>
                    
                    ";
                    } else {
                        echo "
                    <table class='table table-success table-striped '>
                    <thead>
                        <tr>

                            <th scope='col'>Id</th>
                            <th scope='col'>Tipo</th>
                            <th scope='col'>Precio</th>
                            <th scope='col'>Metros</th>
                            <th scope='col'>Descripción</th>
                            <th scope='col'>Seleccionar</th>
                        </tr>
                    </thead>
                    <tbody>

                    ";
                        for ($i = 0; $i < count($listaparcelas); $i++) {

                            echo "  <tr>
                     
                        <td>" . $listaparcelas[$i]["Id"] . "</td>
                        <td>" . $listaparcelas[$i]["tipo"] . "</td>
                        <td>" . $listaparcelas[$i]["precio"] . "</td>
                        <td>" . $listaparcelas[$i]["metros"] . "</td>
                        <td>" . $listaparcelas[$i]["descripcion"] . "</td>
                        <td> <input type='radio' name='huertoseleccionado' value='" . $listaparcelas[$i]["Id"] . "'></td>
                    </tr>";
                        }
                        echo "
                            </tbody>
                            </table>";
                    }


                    ?>


                </div>
            </div>

            <div class="row" style="width:100% ;">

                <div class="col-6 p-5 m-auto d-flex justify-content-around">

                    <button type="submit" class="btn btn-success px-4" name="modificarhuerto" style="font-size: 20px;">Modificar</button>
                    <!-- Button trigger modal -->

                    <button type="button" class="btn btn-success px-4" data-bs-toggle="modal" data-bs-target="#anadirModal" style="font-size: 20px;">
                        Añadir
                    </button>
                    <button type="submit" name="borrarhuerto" class="btn btn-success px-4" style="font-size: 20px;">
                        Borrar
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="anadirModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog " style="max-width: 1200px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="col-6 m-auto mb-3 ">
                                        <input type="text" class="fs-2 form-control" name="tipohuertoañadir" placeholder="Tipo de huerto">

                                    </div>
                                    <div class="col-6 m-auto mb-3">
                                        <input type="text" class="fs-2 form-control" name="preciohuertoañadir" placeholder="Precio">
                                    </div>
                                    <div class="col-6 m-auto mb-3 ">
                                        <input type="text" class="fs-2 form-control" name="metroshuertoañadir" placeholder="Metros cuadrados">
                                    </div>
                                    <div class="col-6 m-auto mb-3 ">
                                        <input type="text" class="fs-2 form-control" name="imagenhuertoañadir" placeholder="Imagen">
                                    </div>
                                    <div class="col-8 m-auto mb-3">
                                        <div class="input-group">
                                            <span class="fs-2 input-group-text">Descripción</span>
                                            <textarea class="fs-2 form-control" name="descripcionhuertoañadir" aria-label="With textarea"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="fs-2 btn btn-secondary mx-3" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="fs-2 btn btn-primary mx-3" name="añadirhuerto">Guuuardar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row" style="width:100% ;">
                    <div class="col-8 m-auto p-5">

                        <table class="table table-success table-striped ">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Id_parcela</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Hora</th>
                                    <th scope="col">Usuario</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">*</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($i = 0; $i < count($reservas_pendientes); $i++) {

                                    echo "  <tr>
                                    <td>" . ($i + 1) . "</td>
                                <td>" . $reservas_pendientes[$i]["Id"] . "</td>
                                <td>" . $reservas_pendientes[$i]["Id_parcela"] . "</td>
                                <td>" . $reservas_pendientes[$i]["fecha"] . "</td>
                                <td>" . $reservas_pendientes[$i]["hora"] . ":00</td>
                                <td>" . $reservas_pendientes[$i]["Id_usuario"] . "</td>
                                <td>" . $reservas_pendientes[$i]["estado"] . "</td>
                                <td> <input type='checkbox' name='pendiente$i'></td>
                            </tr>";
                                }
                                ?>


                            </tbody>
                        </table>
                    </div>
                    <div class="col-2 m-auto d-flex flex-column">
                        <button type="submit" name="aceptarReserva" class="btn btn-success my-5 px-2" style="font-size: 20px;">
                            Aceptar
                        </button>
                        <button type="submit" name="denegarReserva" class="btn btn-success px-4" style="font-size: 20px;">
                            Denegar
                        </button>
                    </div>
                </div>
            </div>
    </form>







</body>
<!-- Separate Popper and Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<!--Jquery-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

</html>