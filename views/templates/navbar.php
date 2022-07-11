<nav class="navbar is-fixed-top navbarcolor" role="navigation" aria-label="main navigation">
    <header class="navbar-header navbar-style" id="navbar-header">
        <a href="<?php echo $HOME; ?>" class="brand-link is-size-3">
            <?php echo "<img class='image' src='$logo' width='112' height='28'>"; ?>
        </a>
        <button class="navbar-menu-mobile open is-size-3 is-hidden-desktop" id="navbar-menu-mobile">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </button>
    </header>

    <ul class="navbar-container" id="navbar-container">
        <div class="navbar-end">
            <!-- SI NO ESTA LOGEADO -->
            <?php if (!isset($_SESSION['username'])) { ?>
            <li class="navbar-item">
                <a data-scroll href="<?php echo $HOME; ?>" class="navbar-a">
                    <span class="icon is-small"><i class="fa fa-home"></i> </span>
                    <span> Inicio</span>
                </a>
            </li>

            <li class="navbar-item">
                <a data-scroll href="<?php echo $HOME; ?>views/users/usuarios_importados.php" class="navbar-a">Importar
                    usuarios</a>
            </li>
            <li class="navbar-item">
                <div class="button is-primary is-outlined is-rounded">
                    <a id='boton_login' href="<?php echo $HOME; ?>views/users/login.php" class="button-login">Iniciar
                        sesión</a>
                </div>
            </li>
            <!-- SI ESTA LOGEADO -->
            <?php } else { 
            if ($_SESSION['tipo'] == 'Admin DGAC') { ?>
            <li class="navbar-item">
                <a data-scroll href="<?php echo $HOME; ?>views/users/admin.php" class="navbar-a">
                    <span class="icon is-small"><i class="fa fa-home"></i> </span>
                    <span> Inicio</span>
                </a>
            </li>
            <?php } elseif ($_SESSION['tipo'] == 'pasajero') { ?>
            <li class="navbar-item">
                <a data-scroll href="<?php echo $HOME; ?>views/users/passenger.php" class="navbar-a">
                    <span class="icon is-small"><i class="fa fa-home"></i> </span>
                    <span> Inicio</span>
                </a>
            </li>
            <?php } else { ?>
            <li class="navbar-item">
                <a data-scroll href="<?php echo $HOME; ?>views/users/company.php" class="navbar-a">
                    <span class="icon is-small"><i class="fa fa-home"></i> </span>
                    <span> Inicio</span>
                </a>
            </li>

            <?php } ?>
            <li class="navbar-item">
                <div class="button is-primary is-outlined is-rounded">
                    <?php if ($_SERVER['PHP_SELF'] == '/~grupo47/index.php' || $_SERVER['PHP_SELF'] == '/~grupo47' || $_SERVER['PHP_SELF'] == '/~grupo47/') { ?>
                    <form role="form" action="views/users/logout.php" method="post">
                        <?php 
                    } else { ?>
                        <form role="form" action="logout.php" method="post">
                            <?php } ?>
                            <button id='boton_login' type="submit" class="not_style"><a class="button-login">Cerrar
                                    sesión</a></button>
                        </form>
                </div>
            </li>
            <?php } ?>
        </div>
    </ul>
</nav>