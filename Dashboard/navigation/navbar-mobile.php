<?php 
$permiso_data = $_SESSION["fk_permiso"];

?>
<header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="/Dashboard/index.php">
                    <img src="images/icon/logo.png" alt="CoolAdmin" />
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-bx">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
                <li class="has-sub">
                    <a class="js-arrow" href="/Dashboard/index.php">
                        <i class="fas fa-tachometer-alt"></i>Panel Principal</a>
                </li>
                <?php
                if($permiso_data === 1 || $permiso_data ===2){
                ?>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-copy"></i>Conductores</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="/Dashboard/conductor-create.php">Crear Conductores</a>
                        </li>
                        <li>
                            <a href="/Dashboard/conductor-list.php">Lista de Conductores</a>
                        </li>
                    </ul>
                </li>
                <?php  							
						}
				
				?>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-copy"></i>Ruta</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="/Dashboard/ruta-create.php">Crear Rutas</a>
                        </li>
                        <li>
                            <a href="/Dashboard/ruta-list.php">Lista de Rutas</a>
                        </li>
                    </ul>
                </li>
                <?php

                    if($permiso_data === 1 || $permiso_data === 2){
                            

                ?>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-copy"></i>Vehiculos</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="/Dashboard/create-vehiculo.php">Crear Vehiculos</a>
                        </li>
                        <li>
                            <a href="/Dashboard/vehiculo-list.php">Lista de Vehiculos</a>
                        </li>
                    </ul>
                </li>
                <?php  							
						}
				
				?>
                <?php

                    if($permiso_data === 1){
                            

                    ?>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-copy"></i>Empresas</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="/Dashboard/empresa-create.php">Crear Empresa</a>
                        </li>
                        <li>
                            <a href="/Dashboard/empresa-list.php">Lista de Empresa</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-copy"></i>Usuarios</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="/Dashboard/empresa-create.php">Crear Usuario</a>
                        </li>
                        <li>
                            <a href="/Dashboard/empresa-list.php">Lista de Usuario</a>
                        </li>
                    </ul>
                </li>
                <?php  							
						}
				
				?>
                <li class="has-sub">
                    <a class="js-arrow" href="/Dashboard/ventas.php">
                        <i class="fas fa-tachometer-alt"></i>Ventas</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
