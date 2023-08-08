<?php
include('conexion.php');
$con = conectar();
$usuarios=$_POST['usuario'];
$passwords=$_POST['password'];



$consulta="SELECT*FROM usuarios where usuario='$usuarios' and password='$passwords'";
$resultado=mysqli_query($con,$consulta);

$filas=mysqli_num_rows($resultado);

if($filas){
  
    header("location:home.php");

}else{
    ?>
    <?php
    include("index.php");

  ?>
  <h1 class="bad">ERROR DE AUTENTIFICACION</h1>
  <?php
}
mysqli_free_result($resultado);
mysqli_close($conexion);
