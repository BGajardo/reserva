<?php
$hora = $_GET["hora"];
$fecha = $_GET["fecha"];
$rut_doc = $_GET["rut_doc"];
$rut = $_GET["rut"];
require 'DAO.php';
$d = new DAO();
$mensaje = $d->GenerarReserva($fecha, $hora, $rut, $rut_doc);
header("Location: index.php?a=1");
