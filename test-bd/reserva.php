<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>Test BD</title>
</head>

<body style="background-color: antiquewhite;">
    <div class="container" style="background-color: white;border: 2px solid black;margin-top:10px;border-radius:10px;-webkit-box-shadow: 2px 10px 14px 0px rgba(0,0,0,0.75);
-moz-box-shadow: 2px 10px 14px 0px rgba(0,0,0,0.75);
box-shadow: 2px 10px 14px 0px rgba(0,0,0,0.75);">
        <div class="row" style="margin-top:10px;padding:10px;">
            <div class="col-md-3"><label for="">Sesion de : <u><?php session_start();
                                                            echo $_SESSION['nombre'];echo'</u>';
                                                            echo ' con Rut : <u>';
                                                            echo $_SESSION['rut'];echo'</u>'; ?></label></div>
            <div class="col-md-6"></div>
            <a class="col-md-3 btn btn-danger"  href="cerrar_sesion.php">CERRAR SESION</a>
            <div class="col-md-9"></div>
            <a class="col-md-3 btn btn-warning" style="margin-top: 10px;" href="menu.php">VOLVER</a>

        </div>

        <center>
            <h1>Vista de horas Disponibles</h1>
        </center>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form action="reserva.php"  method="post">
                    <label class="form-label">Seleccione El dia de hora</label>
                    <br>
                    <input style="border: 1px solid black" class="form-control" type="date" name="calendario" id="calendar">
                    <br>
                    <button class="btn btn-success" type="submit" name="btn">Ingresar</button>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>

       
        <br><br>






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
            echo "<div class='container'><div class='row'>";
            for ($i = 0; $i < count($lista); $i++) {

                $a = $lista[$i];
                $hora_inicial = $a->getHora_I();
                $hora_final = $a->getHora_F();
                $tiempo = $a->getTiempo();
                $rut = $a->getRut();
                $nombre = $d->ListarNombre($rut);










                echo "<div class='card col-md-3 text-bg-light' style='border:1px solid black;border-radius:10px;overflow-x: hidden; overflow-y: auto; height: 500px;-webkit-box-shadow: 2px 10px 14px 0px rgba(0,0,0,0.75);
                -moz-box-shadow: 2px 10px 14px 0px rgba(0,0,0,0.75);
                box-shadow: 2px 10px 14px 0px rgba(0,0,0,0.75);'><img src='vet.jpg' class='card-img-top' style='margin-top:20px;border: 1px solid black;border-radius:10px' alt='foto_doc'><div class='card-body'><h5 class='card-title'>Doctor $nombre</h5>";
                while ($hora_inicial != $hora_final) {
                    $hora = new DateTime($hora_inicial);
                    $hora->modify('+' . $tiempo . ' minute'); //tiempo
                    $result = $hora->format('H:i'); //->
                    $ocupadas = $d->LimitarHora($fecha, $rut);
                    $k = 0;
                    for ($j = 0; $j < count($ocupadas); $j++) {
                        $hora_ocupada = $ocupadas[$j];
                        if ($result == $hora_ocupada) {
                            $k = 1;
                        }
                    }
                    echo '<ul class="list-group list-group-flush">';
                    if ($k == 0) {
                        echo '<li class="list-group-item" style="border-radius:10px;margin-bottom:5px;border:2px solid #b5d7f9">';
                        echo "<a href='confirmar.php?hora=$result&fecha=$fecha&rut=$rut'>$result</a></li>";
                        echo "<br>";
                    } else {
                        echo '<li class="list-group-item" style="border-radius:10px;margin-bottom:5px;border:2px solid red">';
                        echo "<label style='color:red'>HORA OCUPADA($result)</label></li>";
                        echo "<br>";
                    }

                    $hora_inicial = $result;
                }
                echo "</ul></div></div><div class='col-md-1'></div>";
            }
            echo '</div></div>';
        }
        ?>
    </div>
</body>

</html>