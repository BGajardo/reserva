<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    
</head>

<body style="background-color: antiquewhite;">
    <div class="container" style="background-color: white;border: 2px solid black;margin-top:10px;border-radius:10px;-webkit-box-shadow: 2px 10px 14px 0px rgba(0,0,0,0.75);
-moz-box-shadow: 2px 10px 14px 0px rgba(0,0,0,0.75);
box-shadow: 2px 10px 14px 0px rgba(0,0,0,0.75);">
        <center><h1>Inicio de Sesion</h1></center>
        <form class="form-control" action="index.php" method="post">
            <label class="form-label" for="">Rut Usuario</label>
            <input class="form-control" type="text" name="rut">
            <br>
            <label class="form-label" for="">Contraseña</label>
            <input class="form-control" type="text" name="clave">
            <br>
            <button class="btn btn-success" type="submit" name="btn">Ingresar</button>
        </form>
    </div>
    <?php
    
    if(isset($_GET['a'])){
    $a = $_GET['a'];
    if($a==1){
        echo "<center><h1>Se inserto correctamente su hora</h1></center>";
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
                $nombre = $a->get_Nombre();
                session_start();
                session_name('usuario');
                $_SESSION['rut'] = $rut;
                $_SESSION['nombre'] = $nombre;
                header("Location: menu.php");

            }
        }else{
            echo '<h1 style="color:red">Error de Datos</h1>';
        }
    }
    ?>
</body>

</html>