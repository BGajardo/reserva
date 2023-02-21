<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>Menu</title>
</head>

<body style="background-color: antiquewhite;">
    <div class="container" style="background-color: white;border: 2px solid black;margin-top:10px;border-radius:10px;-webkit-box-shadow: 2px 10px 14px 0px rgba(0,0,0,0.75);
-moz-box-shadow: 2px 10px 14px 0px rgba(0,0,0,0.75);
box-shadow: 2px 10px 14px 0px rgba(0,0,0,0.75);">
        <div class="row" >
            <center><h1>Seleccione una Opcion de Busqueda</h1></center>
            <div class="col-md-1"></div>
            <a style="margin-top: 10px;margin-bottom:10px" class="btn btn-success col-md-10" href="reserva.php">Seleccion por Fecha</a>
            <div class="col-md-1"></div>
            <div class="col-md-1"></div>

            <a style="margin-bottom:10px" class="btn btn-primary col-md-10" href="categoria.php">Seleccion por Especialidad</a>
            <div class="col-md-1"></div>
            <div class="col-md-2"></div>
            <a class="col-md-8 btn btn-danger" style="margin-bottom: 10px;"  href="cerrar_sesion.php">CERRAR SESION</a>
            <div class="col-md-2"></div>
        </div>
    </div>
</body>

</html>