<footer class="footerpropio">
    <div class="grupo-1">
        <div class="box.is-transparent is-centered">
            <figure>
                <a href="<?php echo $HOME;?>" class="image">
                    <br>
                    <?php echo "<img class='image' src='$logo' width='400px'>"; ?>
                </a>
            </figure>
        </div>
        <div class="box.is-transparent is-centered">
            <h2>SOBRE NOSOTROS</h2>
            <p><a class="has-text-white" href="https://github.com/diegocostares">Diego Costa</a></p>
            <p><a class="has-text-white" href="https://github.com/marcosfernandezr">Marcos Fernández</a></p>
            <p><a class="has-text-white" href="https://github.com/Dafnemami">Dafne Arriagada</a></p>
            <p><a class="has-text-white" href="https://github.com/aerotecnia99">Valentina Campaña</a></p>
        </div>
        <div class="box.is-transparent">
            <figure>
                <a href="https://www.uc.cl" style='width: 300px;'>
                    <br>
                    <?php echo "<img class='image' src='$logoUC'"; ?>
                </a>
            </figure>
        </div>
    </div>
    <div class="grupo-2">
        <small>&copy; 2022 <b>UC</b> - Todos los Derechos Reservados.</small>
    </div>
</footer>


<!-- AGREGAMOS EL main.js-->
<?php echo "<script src='$js'></script>"; ?>
<!-- CERRAMOS TODO LO QUE QUEDA-->
</body>

</html>