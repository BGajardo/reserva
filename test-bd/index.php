<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <h1>Inicio de Sesion</h1>
        <form action="index.php" method="post">
            <label for="">Rut Usuario</label>
            <input type="text" name="rut">
            <br>
            <label for="">Contraseña</label>
            <input type="text" name="clave">
            <br>
            <button type="submit" name="btn">Ingresar</button>
        </form>
    </div>
    <?php
    
    if(isset($_GET['a'])){
    $a = $_GET['a'];
    if($a==1){
        echo "<h1>Se inserto correctamente su hora</h1>";
    }}

    if (isset($_POST['btn'])) {
        $rut = trim($_POST['rut']);
        $clave = trim($_POST['clave']);
        require 'DAO.php';
        $d = new DAO();
        $lista = $d->BuscarUsuario($rut,$clave);
        if(!empty($lista)){
            for ($i = 0; $i < count($lista); $i++) {
            
                $a = $lista[$i];
                $rut = $a->getRut();
                $nombre = $a->getNombre();
                session_start();
                session_name('usuario');
                $_SESSION['rut'] = $rut;
                $_SESSION['nombre'] = $nombre;
                header("Location: reserva.php");

            }
        }else{
            echo '<h1 style="color:red">Error de Datos</h1>';
        }
    }
    ?>
</body>

</html>