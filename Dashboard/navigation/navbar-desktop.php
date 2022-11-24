<?php 
$permiso_data = $_SESSION["fk_permiso"];

?>
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="images/icon/logo.png" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class=" has-sub">
                    <a class="js-arrow" href="/index.php">
                        <i class="fas fa-tachometer-alt"></i>Panel Principal</a>
                </li>
                <?php

                    if($permiso_data === 1 || $permiso_data ===2){

                ?>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-copy"></i>Conductores</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="/conductor-create.php">Crear Conductor</a>
                        </li>
                        <li>
			                <a href="/conductor-list.php">Lista de Conductores</a>
                        </li>
                    </ul>
                </li>
                <?php  							
						}
				
				?>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-copy"></i>Rutas</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="/ruta-create.php">Crear Ruta</a>
                        </li>
                        <li>
                            <a href="/ruta-list.php">Lista de Rutas</a>
                        </li>
                    </ul>
                </li>
                <?php

                    if($permiso_data === 1 || $permiso_data ===2){
                            

                ?>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-copy"></i>Vehiculos</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="/vehiculo-create.php">Crear Vehiculo</a>
                        </li>
                        <li>
                            <a href="/vehiculo-list.php">Lista de Vehiculos</a>
                        </li>
                    </ul>
                </li>

                <?php
                    }
						if($permiso_data === 1){
								

					?>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-copy"></i>Empresas</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="/empresa-create.php">Crear Empresa</a>
                        </li>
                        <li>
                            <a href="/empresa-list.php">Lista de Empresas</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-copy"></i>Usuarios</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="/usuario-create.php">Crear Usuario</a>
                        </li>
                        <li>
                            <a href="/usuario-list.php">Lista de Usuarios</a>
                        </li>
                    </ul>
                </li>
                <?php  							
						}
				
				?>
                <li>
                    <a href="/ventas.php">
                        <i class="fas fa-chart-bar"></i>Ventas</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
