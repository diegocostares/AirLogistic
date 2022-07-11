<?php
session_start();
// $msg = $_GET['msg']
?>

<?php
include(dirname(__FILE__, 3) . '/views/templates/header.php');
include(dirname(__FILE__, 3) . '/views/templates/navbar.php');
?>

<section class="hero is-fullheight">
    <!--"container"-->
    <div class="columns is-multiline is-centered is-mobile">
        <div class="column is-11 is-responsive register login">
            <div class="columns">
                <div class="column left">
                    <h1 class="title is-1"> AirLogistics</h1>
                    <h2 class="subtitle colored is-4">Por un viaje mas comodo.</h2>
                    <p>Inicia sesión para poder acceder a nuestra amplia variedad de vuelos.</p>
                </div>
                <div class="column right has-text-centered">
                    <h1 class="title is-4">Inicia sesión</h1>
                    <p class="description">Ingresa tu usuario y contraseña</p>

                    <!-- COMENZAMOS EL FORM -->

                    <form role="form" action="login_validation.php" method="post">
                        <?php
                        //echo $msg; 
                        ?>
                        <div class="field">
                            <div class="control">
                                <input class="input is-rounded is-medium" name="username" type="text"
                                    placeholder="Nombre de usuario" required autofocus>
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <input class="input is-rounded is-medium" name="password" type="password"
                                    placeholder="Contraseña">
                            </div>
                        </div>
                        <button name="login"
                            class="button is-block is-rounded is-primary is-fullwidth is-medium">Enviar</button>
                        <br />
                        <small><em>Recuerda no compartir tu contraseña.</em></small>
                    </form>


                </div>
            </div>
        </div>
        <br>
    </div>

    <br><br>
</section>

<?php include(dirname(__FILE__, 3) . '/views/templates/footer.php'); ?>