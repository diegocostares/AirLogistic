<?php
ob_start();
session_start();
?>

<?php

$msg = '';

if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
    $username = $_POST['username'];
    $user_password = $_POST['password'];
    $_SESSION['valid'] = true;
    $_SESSION['timeout'] = time();
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];

    require(dirname(__FILE__, 3) . '/config/conection.php');
    $query = "SELECT u.tipo
        FROM usuarios as u
        WHERE u.username= '$username'
        AND u.contrasena='$user_password'
        ;";

    $result = $db2->prepare($query);
    $result->execute();
    $type = $result->fetchAll();
    $count = count($type);

    if ($count == 0) {
        header('Location: logout.php');;
    } else {
        $_SESSION['tipo'] = $type[0]['tipo'];
        if ($type[0]['tipo'] == 'Admin DGAC') {
            header('Location: admin.php');
        } elseif ($type[0]['tipo'] == 'pasajero') {
            header('Location: passenger.php');
        } else {
            header('Location: company.php');
        }
    }
}


?>
<?php include(dirname(__FILE__, 3) . '/views/templates/footer.php'); ?>