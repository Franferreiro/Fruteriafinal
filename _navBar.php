

<section id="header">
    <div class="header container">
      <div class="nav-bar">
        <div>
          <a class="navbar-brand" href=""
            ><img
              src="./img/logogranjaa.png"
              alt="Logo"
              class="me-2"
              style="width: 70px"
          /></a>
        </div>
        <div class="brand">
          <a href="index.php#hero">
            <h1><span>G</span>ran <span>J</span>uca</h1>
          </a>
        </div>
        <div class="nav-list">
          <div class="hamburger">
            <div class="bar"></div>
          </div>
          <ul>
            <li><a href="index.php#hero" data-after="Inicio">Inicio</a></li>
            <li><a href="index.php#services" data-after="Reservas">Reservar</a></li>
            <li><a href="index.php#projects" data-after="Productos">Productos</a></li>
            <li><a href="index.php#about" data-after="Acerca de">Acerca de</a></li>
            <li><a href="index.php#contact" data-after="Contacto">Contacto</a></li>
            
            <?php
             if(!empty($_SESSION)){
              if (($_SESSION["rol"]==1)) {
                echo "<li><a href='administrar.php' data-after='Contacto'>Admin</a></li>";
              } 
            }
            if (isset($_SESSION["img"])) {
              echo "<li><a href='perfil.php' data-after='Contacto'> <img class='imgnav' src='". $_SESSION['img'] ."' ></a></li>";
            } else {
              echo ' <li><a href="login.php" data-after="Contacto">Login</a></li>';
            }
           
            ?>
          </ul>
        </div>
      </div>
    </div>
  </section>

