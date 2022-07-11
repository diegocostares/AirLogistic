<?php
include(dirname(__FILE__, 3).'/views/templates/header.php');
include(dirname(__FILE__, 3) . '/views/templates/navbar.php');
?>


<section class="hero is-fullheight">
    <div class="columns is-multiline is-centered is-mobile">
        <div class="column is-11 is-responsive register login">
            <div class="columns is-centered">
                <div class="row is-centered">
                    <div class="columns is-mobile">
                        <div class="column is-responsive is-centered">
                            <div class="has-text-centered has-text-left-tablet">
                                <br>
                                <h1 class="title is-1"> Usuarios Importados</h1>
                                <h2 class="subtitle colored is-4">Aquí puedes ver un resumen de todo lo ocurrido durante
                                    el importe de usuarios.</h2>
                                <h3 class="subtitle colored is-4"></h3>
                            </div>
                        </div>
                    </div>

                    <form role="form is-centered" action="" method="post">
                        <div class="columns is-mobile is-centered">
                            <div class="buttons">
                                <button name="volver_inicio"
                                    class="button is-centered is-fullwidth is-rounded  is-medium">
                                    <a data-scroll href="<?php echo $HOME; ?>"> Volver a Inicio </a>
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="columns is-fullwidth is-mobile">
                        <div class="column is-fullwidth is-responsive is-centered">
                            <h1 class="title is-2"> Tabla de contraseñas</h1>
                            <form role="form" action="" method="post">
                                <!-- Mostramos tabla con usuarios importados -->
                                <?php include(dirname(__FILE__, 3) . '/queries/importar_usuarios.php') ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<br><br>


<?php include(dirname(__FILE__, 3) . '/views/templates/footer.php'); ?>