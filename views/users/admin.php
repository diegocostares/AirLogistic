<?php session_start(); ?>
<?php
include(dirname(__FILE__, 3) . '/views/templates/header.php');
include(dirname(__FILE__, 3) . '/views/templates/navbar.php');
?>

<?php if (!isset($_SESSION['username'])) { 
                header("Location: {$HOME}");}?>

<section class="hero is-fullheight">
    <div class="columns is-multiline is-centered is-mobile">
        <div class="column is-11 is-responsive register login">
            <div class="columns">
                <div class="row">
                    <div class="column left">
                        <h1 class="title is-1"> Bienvenide Administrador!</h1>
                        <h2 class="subtitle colored is-4">Es hora de aceptar o rechazar propuestas.</h2>
                        <h3 class="subtitle colored is-4">¿Quieres filtrar las propuestas?</h3>
                        <form role="form" action="" method="post">
                            <div class="field">
                                <div class="control">
                                    <input class="input is-rounded is-medium" name="fecha1" type="date"
                                        placeholder="01/01/2000" required autofocus>
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input class="input is-rounded is-medium" name="fecha2" type="date"
                                        placeholder="31/12/2050">
                                </div>
                            </div>
                            <button name="filtrar"
                                class="button is-centered is-fullwidth  is-primary is-rounded  is-medium">Filtrar</button>

                        </form>
                        <form role="form" action="" method="post">
                            <button name="reset"
                                class="button is-centered is-fullwidth is-rounded  is-medium">Resetear</button>
                        </form>
                    </div>
                    <div class="column right has-text-centered">

                    </div>
                </div>
                <div class="row is responsive">
                    <div class="column is-mobile is-centered">
                        <form role="form" action="" method="post">
                            <div class="box has-text-centered is-half is-responsive is-centered"
                                style="box-shadow: None">
                                <button name="aceptar" class="button is-centered is-rounded is-medium"
                                    onclick="return confirm('Estás segure de aceptar estas propuestas?')">Aceptar</button>
                                <button name="rechazar" style="background-color: #EF5734; color:white"
                                    onclick="return confirm('Estás segure de rechazar estas propuestas?')"
                                    class="button is-centered is-rounded is-medium">Rechazar</button>
                            </div>
                            <?php include(dirname(__FILE__, 3) . '/queries/propuestas.php') ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <br>
    </div>

    <br><br>
</section>

<?php include(dirname(__FILE__, 3) . '/views/templates/footer.php'); ?>