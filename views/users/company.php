<?php session_start(); ?>
<?php
include(dirname(__FILE__, 3).'/views/templates/header.php');
include(dirname(__FILE__, 3) . '/views/templates/navbar.php');

?><?php if (!isset($_SESSION['username'])) { 
    header("Location: {$HOME}");}?>

<section class="hero is-fullheight">
    <div class="columns is-multiline is-centered is-mobile">
        <div class="column is-11 is-responsive register login">
            <div class="columns is-centered">
                <div class="row is-centered">
                    <div class="columns is-mobile">
                        <div class="column is-responsive is-centered">
                            <h1 class="title is-1"> Bienvenide <?php echo $_SESSION['username'] ?>!</h1>
                            <h2 class="subtitle colored is-4">Aquí puedes ver los vuelos aprobados y rechazados para tu
                                compañia.
                            </h2>
                        </div>
                    </div>

                    <form role="form is-centered" action="" method="post">
                        <div class="columns is-mobile is-centered">
                            <div class="buttons">
                                <button name="aceptado" value="aceptado"
                                    class="button is-centered is-medium is-primary is-rounded">Vuelos
                                    Aprobados</button>
                                <button name="rechazado" value="rechazado"
                                    class="button is-centered is-medium is-primary is-rounded">Vuelos
                                    Rechazados</button>
                            </div>
                        </div>
                    </form>

                    <?php  if (isset($_POST['aceptado']) or isset($_POST['rechazado'])) {
                        if (isset($_POST['aceptado'])){
                            $estado = $_POST['aceptado'];
                        }elseif (isset($_POST['rechazado'])){
                            $estado = $_POST['rechazado'];
                        };
                        ?>
                    <div class="columns is-fullwidth is-mobile">
                        <div class="column is-fullwidth is-responsive is-centered">
                            <h1 class="title is-2"> Vuelos <?php echo  $estado ?>s</h1>
                            <form role="form" action="" method="post">
                                <?php include(dirname(__FILE__, 3) . '/queries/vuelos_aprobados.php') ?>
                            </form>
                        </div>
                    </div>
                    <?php } ?>

                    <div class="columns is-fullwidth is-mobile">
                        <div class="column is-fullwidth is-responsive is-centered">
                            <form role="form" action="" method="post">
                                <?php include(dirname(__FILE__, 3) . '/queries/tasa_aprobacion.php') ?>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

</section>

<br><br>

<?php include(dirname(__FILE__, 3) . '/views/templates/footer.php'); ?>