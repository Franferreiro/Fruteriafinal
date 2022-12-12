<?php
require "BD_metodos.php";
require_once "autoload.php";
use Clase\huerto;

session_start();
$listaparcelas = listarparcelas();
$huerto;
$horas;
if(empty($_SESSION['id'])){
  header('Location: login.php');

}

if (isset($_POST['tipohuerto'])) {
  $parcelaselec = buscarparcelaportipo($_POST['tipohuerto']);
  $huerto = new huerto($parcelaselec[0]['Id'], $parcelaselec[0]['tipo'], $parcelaselec[0]['precio'], $parcelaselec[0]['metros'], $parcelaselec[0]['imagen'], $parcelaselec[0]['descripcion']);
}
if (isset($_POST['buscarhoras'])) {
$horas=comprobarhoras($_POST['fecha_reserva'],$huerto->Id);


}
if ((isset($_POST['hacerreserva'])) ) {
  if(!empty($_POST['fecha_reserva'])){
    if(!empty($_POST['horashuerto'])){
      insertarreserva($huerto->Id,$_POST['fecha_reserva'],$_POST['horashuerto'],$_SESSION['id']);
      insertarhistorico($_SESSION['id'],"Reserva");
      echo "<script>alert('Reserva procesada exitosamente');</script>";
    }else
    echo "<script>alert('Debes seleccionar una hora');</script>";
  }else
  echo "<script>alert('Debes seleccionar un dia');</script>";
  }
   
  

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />

  <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.css" />

  <link rel="stylesheet" href="css/styleindex.css">

  <link rel="stylesheet" href="css/styleperfil.css">
</head>

<body style="color:white">
  <header>
    <nav>
      <?php include "_navbar.php" ?>
    </nav>
  </header>

  <section id="about">

    <div class="about container">

      <div class="col-left">
        <div class="about-img">
          <img src="<?php if (isset($_POST['tipohuerto'])) {
                      echo $huerto->imagen;
                    } else echo 'img/tomatoes-5356__340.jpg' ?>" alt="img">
        </div>
      </div>
      <div class="col-right">
        <form action="reservas.php" method="post">
          <div class='col-6'>
            <div class="row">
              <div class='col-8'>


                <select name='tipohuerto' class='form-select' aria-label='Default select example'>

                  <?php
                  for ($i = 0; $i < sizeof($listaparcelas); $i++) {
                    echo "<option";
                    if(isset($_POST['tipohuerto'])){
                    if ($_POST['tipohuerto']==$listaparcelas[$i]['tipo']){ echo " selected";}
                    }
                   echo" value='" . $listaparcelas[$i]['tipo'] . "'>Huerto de " . $listaparcelas[$i]['tipo'] . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="col-4">
                <input type="submit" value="Buscar" class="btn btn-outline-success" name="buscartipo">
              </div>
            </div>

          </div>
          <div class="d-flex">
            <div class="col-4">

              <input type="date" name="fecha_reserva" value="<?php if (isset($_POST['fecha_reserva'])) echo $_POST['fecha_reserva']; ?>" style="width: 100%;">


            </div>
            <div class="col-2">
              <input type="submit" value="Horas disponibles" class="btn btn-outline-success" name="buscarhoras" style="margin-left:10px ;">

            </div>
            <div class="col-4">
              <select name='horashuerto' class='form-select' aria-label='Default select example'>
              <?php
              if(isset($_POST['buscarhoras'])){
                  for ($i = 18; $i <21; $i++) {
                    $bandera=false;
                   for($j=0;$j<sizeof($horas);$j++){
                    if(($horas[$j][0])==$i){
                      $bandera=true;
                    }
                   }
                   if(!$bandera){
                    echo "<option value='" . $i . "'>" . $i .":00". "</option>";
                   }else
                   echo "<option value='' >Reservado</option>";
                  }
                }
                  ?>

              </select>
            </div>
          </div>
       
        <h1 class="section-title"><?php if (isset($_POST['tipohuerto'])) {
                                    echo "Huerto de " . $huerto->tipo;
                                  } else echo 'Huerto de tomates' ?></h1>

        <p style="color:white"><?php if (isset($_POST['tipohuerto'])) {
                                  echo $huerto->descripcion;
                                } else echo 'Puede que sea su brillante color, su delicioso sabor o su sorprende versatilidad, pero lo cierto es que nuestros tomates son un alimento con mucho «sex appeal». Escoge una de nuestras variedades, la que más te guste. Nosotros te proporcionamos las herramientas y utensilios necesarios para la actividad.' ?>
        </p>
        <h2 style="color:black">Precio: <?php if (isset($_POST['tipohuerto'])) {
                                          echo $huerto->precio;
                                        } else echo '4' ?> €</h2>
        <h2 style="color:black">M²: <?php if (isset($_POST['tipohuerto'])) {
                                      echo $huerto->metros;
                                    } else echo '400' ?></h2>

        <input type="submit" value="Reservar" name="hacerreserva" class="cta"></input>
        </form>
  </section>
  </div>
  </div>



</body>

</html>

<?php

?>