<?php
include("conexion.php");
$con = conectar();

if(isset($_GET['nombreDes'])) {
  $nombreDes = mysqli_real_escape_string($con, $_GET['nombreDes']);
  
  $sql = "DELETE FROM analgesiosgatos WHERE nombreDes = '$nombreDes'";
  $query = mysqli_query($con, $sql);
  
  if($query) {
    header("Location:M_analgesicosGATOS.php");
    exit();
  } else {
    echo "Error en la consulta:Pdesexterno.php " . mysqli_error($con);
  }
} else {
  echo "No se proporcionó un nombre válido.";
}
?>
