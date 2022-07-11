<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Grupo 74 y 47">
    <title>AirLogistics</title>
    <!-- AGREGAMOS BULMA -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <!-- AGREGAMOS FONT AWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/15181efa86.js" crossorigin="anonymous"></script>
    <!--Para que las consultas.php pueda importarlo-->
    <?php
    // Definimos el path del archivo a importar
    $HOME = "https://" . $_SERVER['SERVER_NAME'] . "/~grupo47/";
    if ($_SERVER['PHP_SELF'] == '/~grupo47/index.php' || $_SERVER['PHP_SELF'] == '/~grupo47' || $_SERVER['PHP_SELF'] == '/~grupo47/') {
        $style = "./styles/style.css";
        $footer = "./styles/footer.css";
        $navbar = "./styles/navbar.css";
        $home = "./styles/home.css";
        $logo = "./assets/logo2.png";
        $logoUC = "./assets/logo-uc-04.svg";
        $js = "./js/main.js";
        $logout = "views/users/logout.js";
    } else {
        $style = "../../styles/style.css";
        $footer = "../../styles/footer.css";
        $navbar = "../../styles/navbar.css";
        $home = "../../styles/home.css";
        $logo = "../../assets/logo2.png";
        $logoUC = "../../assets/logo-uc-04.svg";
        $js = "../../js/main.js";
        $logout = "../../views/users/logout.php";
    }
    // Creamos el elemento de html que haga referencia a ese path
    print "<link rel='stylesheet' href='$style'>";
    print "<link rel='stylesheet' href='$footer'>";
    print "<link rel='stylesheet' href='$navbar'>";
    print "<link rel='stylesheet' href='$home'>";
    // <link rel="shortcut icon" href="./assets/logo.png">
    print "<link rel='shortcut icon' href='$logo'>";
    ?>

</head>

<body>
    <!-- SIEMPRE SE TIENE QUE CERRAR con el  </body></html>-->