<?php
include("conexion.php");
$con = conectar();

$nombreDes = $_POST['nombreDes'];
$descripcionproducto = $_POST['descripcionproducto'];
$fecha_elaboracion = $_POST['fecha_elaboracion'];
$fecha_caducidad = $_POST['fecha_caducidad'];
$cantidad = $_POST['cantidad'];

$sql = "INSERT INTO desparasexternosgatos (nombreDes, descripcionproducto, fecha_elaboracion, fecha_caducidad, cantidad) VALUES ('$nombreDes', '$descripcionproducto', '$fecha_elaboracion', '$fecha_caducidad', '$cantidad')";
$query = mysqli_query($con, $sql);
if ($query) {
  header("Location: M_externoGATOS.php ");
}else{
  echo 'no esta llamando'. mysqli_error($con);
}
?>



