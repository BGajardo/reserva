<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Especialidad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>

<body style="background-color: antiquewhite;">
    <div class="container" style="background-color: white;border: 2px solid black;margin-top:10px;border-radius:10px;-webkit-box-shadow: 2px 10px 14px 0px rgba(0,0,0,0.75);
-moz-box-shadow: 2px 10px 14px 0px rgba(0,0,0,0.75);
box-shadow: 2px 10px 14px 0px rgba(0,0,0,0.75);">
        <center>
            <h1>Seleccione la Especialidad</h1>
        </center>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form action="categoria.php" method="post">
                    <select class="form-control" name="cbo_especialidad">
                        <?php
                        # Rescate de Especialidad
                        require "DAO.php";
                        $d = new DAO;
                        $lista = $d->ListarEspecialidad();
                        for ($i = 0; $i < count($lista); $i++) {
                            $a = $lista[$i];
                            $id = $a->getId();
                            $especialidad = $a->getEspecialidad();
                            echo "<option value='$id'>$especialidad</option>";
                        }
                        ?>
                    </select>
                    <button style="margin-top: 5px;margin-bottom: 5px;" type="submit" name="btn_buscar" class="btn btn-success">Buscar</button>
                    <a class="btn btn-warning" style="margin-top:5px;margin-bottom: 5px;" href="menu.php">VOLVER</a>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>


        <?php
        if (isset($_POST['btn_buscar'])) {
            $esp = $_POST['cbo_especialidad'];
            $lista_turno = $d->Listar_Turno_Especialidad($esp);
            echo "<div class='row'>";
            for ($i = 0; $i < count($lista_turno); $i++) {
                $s = $lista_turno[$i];
                $fecha = $s->getDia();
                $hora_inicial = $s->getHora_I();
                $hora_final = $s->getHora_F();
                $tiempo = $s->getTiempo();
                $rut = $s->getRut();
                $nombre = $d->ListarNombre($rut);

                echo "<div class='card col-md-3 text-bg-light' style='border:1px solid black;border-radius:10px;overflow-x: hidden; overflow-y: auto; height: 500px;-webkit-box-shadow: 2px 10px 14px 0px rgba(0,0,0,0.75);
                -moz-box-shadow: 2px 10px 14px 0px rgba(0,0,0,0.75);
                box-shadow: 2px 10px 14px 0px rgba(0,0,0,0.75);margin-top:10px'><img src='vet.jpg' class='card-img-top' style='margin-top:20px;border: 1px solid black;border-radius:10px' alt='foto_doc'><div class='card-body'><h5 class='card-title'>Doctor $nombre</h5><h6 class='card-title'>Fecha: $fecha</h6>";
                while ($hora_inicial != $hora_final) {
                    $hora = new DateTime($hora_inicial);
                    $hora->modify('+' . $tiempo . ' minute'); //tiempo
                    $result = $hora->format('H:i'); // Podria guardar en una lista todas las horas para despues consultar si existe en caso de modificacion de url
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
            echo '</div>';
        }

        ?>
    </div>
</body>

</html>