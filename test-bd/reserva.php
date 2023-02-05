<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test BD</title>
</head>

<body>
    <label for="">Sesion de : <?php session_start();
                                echo $_SESSION['nombre'];
                                echo ' con Rut : ';
                                echo $_SESSION['rut']; ?></label>
    <h1>Vista de horas Disponibles</h1>
    <form action="reserva.php" method="post">
        <label>Seleccione El dia de hora</label>
        <br>
        <input type="date" name="calendario" id="calendar">
        <button type="submit" name="btn">Ingresar</button>
    </form>
    <a href="cerrar_sesion.php" style="color:red">CERRAR SESION</a>

    <?php

    if (isset($_POST['btn'])) {
        $fecha = trim($_POST['calendario']);
        $date = explode("-", $fecha);
        $year = $date[0];
        $mes = $date[1];
        $dia = $date[2];
        $fecha = "$dia-$mes-$year";
        require 'DAO.php';
        $d = new DAO();
        $lista = $d->Listar_Turno($fecha);

        for ($i = 0; $i < count($lista); $i++) {

            $a = $lista[$i];
            $hora_inicial = $a->getHora_I();
            $hora_final = $a->getHora_F();
            $tiempo = $a->getTiempo();
            $rut = $a->getRut();
            $nombre = $d->ListarNombre($rut);
            echo "<div><h1>Doctor $nombre</h1>";
            while ($hora_inicial != $hora_final) {
                $hora = new DateTime($hora_inicial);
                $hora->modify('+' . $tiempo . ' minute'); //tiempo
                $result = $hora->format('H:i'); //->
                $ocupadas = $d->LimitarHora($fecha, $rut);
                $k=0;
                for ($j = 0; $j < count($ocupadas); $j++) {
                    $hora_ocupada = $ocupadas[$j];
                    if ($result == $hora_ocupada) {
                        $k = 1;
                    }
                }
                if ($k == 0) {
                    echo "<a href='confirmar.php?hora=$result&fecha=$fecha&rut=$rut'>$result</a>";
                    echo "<br>";
                }else{
                    echo "<label style='color:red'>HORA OCUPADA($result)</label>";
                    echo "<br>";
                }

                $hora_inicial = $result;
            }
            echo "</div>";
        }
    }
    ?>

</body>

</html>