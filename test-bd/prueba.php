<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Vista de horas Disponibles</h1>
    <form action="prueba.php" method="post">
    <label>Seleccione Hora</label>
    <br>
    <input type="time" name="time" id="time">
    <button type="submit"  name="btn">Ingresar</button>
    </form>

    <?php
    if(isset($_POST['btn'])){ 
        $time = trim($_POST['time']);
        $date = new DateTime($time);
       
        $date->modify('+15 minute');
       
        echo $date->format('H:i:s');
    }
    ?>
</body>
</html>