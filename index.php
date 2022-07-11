<?php session_start(); ?>

<?php include('views/templates/header.php'); ?>

<!-- NAVBAR -->
<?php include('views/templates/navbar.php'); ?>

<!-- CONTENIDO -->
<br><br><br><br>
<div class="cuerpo-container ">
    <section class="paralax">
        <!-- <img src="../assets/fondo.png" id="fondo"> -->
        <img src="./assets/nubes.png" id="skys">
        <img src="./assets/edificios.png" id="edicios">
        <h2 id="text">AirLogistics</h2>
        <!-- <img src="../assets/calle.png" id="calle"> -->
        <img src="./assets/avion_1.png" id="avion_1">
        <img src="./assets/avion_2.png" id="avion_2">
    </section>
    <div class="sec" id="sec">
        <h2>Bienvenide a AirLogistics</h2>
        <p style="color: white"> En AirLogistics creemos en la <b><i>experiencia de volar</i></b>, es por eso que te invitamos a sumarte y
            disfrutar de nuestro servicio. Una vez efectuado tu vuelo tendrás la oportunidad de <b>calificarlo</b>, lo
            que nos permite entregarte siempre la mejor atención. <br><br>

            ¡A 10000 metros (sobre el nivel del mar) y más allá! </p>
    </div>

</div>

<!-- FOOTER -->
<?php include('views/templates/footer.php'); ?>