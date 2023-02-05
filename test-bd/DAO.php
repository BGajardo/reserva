<?php
require("Turno.php");
require("Usuaria.php");
class DAO
{
  private $mi;

  private function conexion()
  {
    $this->mi = new mysqli("localhost", "root", "", "prueba");
    if ($this->mi->connect_errno) {
      die("Error al establecer la conexion a la BD -> prueba");
    }
  }

  private function desconexion()
  {
    $this->mi->close();
  }

  public function Listar_Turno($dia)
  {
    $this->conexion();
    $lista = array();
    $sql = "select * from turno where dia='$dia'; ";
    $st = $this->mi->query($sql);
    while ($rs = mysqli_fetch_array($st)) {
      $id = $rs["id"];
      $hora_i  = $rs['hora_inicio'];
      $hora_s   = $rs['hora_salida'];
      $tiempo   = $rs['tiempo_turno'];
      $rut  = $rs['rut_doctor'];
      $t   = new Turno($id, $dia, $hora_i, $hora_s, $tiempo, $rut);
      $lista[] = $t;
    }
    $this->desconexion();
    return $lista;
  }

  public function ListarNombre($rut)
  {
    $sql = "Select nombre from doctor WHERE rut = '$rut'";
    $this->conexion();
    $st = $this->mi->query($sql);
    $valor = mysqli_fetch_array($st);
    $this->desconexion();
    return $valor[0];
  }


  public function BuscarUsuario($rut, $pwd)
  {
    $sql = "Select * from Usuario where rut='$rut' && clave='$pwd'";
    $this->conexion();
    $lista = array();
    $st = $this->mi->query($sql);
    while ($rs = mysqli_fetch_array($st)) {
      $rut  = $rs['rut'];
      $nombre = $rs['nombre'];
      $clave = $rs['clave'];
      $t = new Usuaria($rut, $nombre, $clave);
      $lista[] = $t;
    }
    $this->desconexion();
    return $lista;
  }

  public function GenerarReserva($dia, $hora, $rut, $rut_doc)
  {
    $this->conexion();
    $sql = "INSERT INTO RESERVA VALUES (null,'$dia','$hora','$rut','$rut_doc');";
    $st = $this->mi->query($sql);
    $this->desconexion();
    $mensaje = "Hora Registrada Correctamente";

    return $mensaje;
  }

  public function LimitarHora($fecha, $rut_doc)
  {
    $this->conexion();
    $sql = "SELECT r.hora FROM reserva r where r.fecha = '$fecha' and r.rut_doctor = '$rut_doc' ORDER BY r.hora ASC;";
    $lista = array();
    $st = $this->mi->query($sql);
    while ($rs = mysqli_fetch_array($st)) {
      $hora  = $rs['hora'];
      $lista[] = $hora;
    }
    $this->desconexion();
    return $lista;
  
  }
}
