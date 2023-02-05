<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmacion de Hora</title>
</head>
<body>
    <?php
    session_start();
    $hora = $_GET["hora"];
    $fecha = $_GET["fecha"];
    $rut_doc = $_GET["rut"];
    $nombre2 = $_SESSION['nombre'];
    $rut = $_SESSION['rut'];
    ?>
    <h1>Confirmacion de Hora Solicitada por <?php echo $rut?></h1>
    <h2>Para el Doctor <?php
     require 'DAO.php';
     $d = new DAO();
     $nombre = $d->ListarNombre($rut_doc);
     echo "$nombre de rut $rut_doc";
    ?></h2>
    <?php
    echo "<label>Don $nombre2</label><p>Esta seguro que desea confirmar la hora del dia $fecha a las $hora hrs.</p>";
    
    
    echo "<a class='button' href='ok.php?hora=$hora&fecha=$fecha&rut_doc=$rut_doc&rut=$rut'>CONFIRMAR</a>";
    ?>
    <button type="button" name="si">Confirmar</button>
    <button type="button" name="no">Cancelar</button>
   
    <?php
    
    if (isset($_POST['si'])) {
        $mensaje = $d->GenerarReserva($fecha,$hora,$rut,$rut_doc);
        echo "$mensaje";
    }

    if (isset($_POST['no'])) {
        header("Location: reserva.php");
    }
    
    ?>
</body>
</html>