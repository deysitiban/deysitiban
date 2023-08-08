<?php
include("conexion.php");
$con = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreDes = $_POST["nombreDes"];
    $descripcionproducto = $_POST["descripcionproducto"];
    $fecha_elaboracion = $_POST["fecha_elaboracion"];
    $fecha_caducidad = $_POST["fecha_caducidad"];
    $cantidad = $_POST["cantidad"];

    $sql = "INSERT INTO desparasexternosgatos (nombreDes,descripcionproducto, fecha_elaboracion, fecha_caducidad, cantidad) VALUES ('$nombreDes', '$descripcionproducto', '$fecha_elaboracion', '$fecha_caducidad', '$cantidad')";
    mysqli_query($con, $sql);

    header("Location: M_externoGATOS.php");
    exit();
}

$sql = "SELECT * FROM productos";
$query = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VETERINARIA PET'S KINDOM</title>
    <link rel="icon" href="IMG/img1.ico">
   <link rel="stylesheet" href="css/gato.css">
   <link rel="stylesheet" href="css/tablagatito.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        .caducado {
            background-color: red;
            color: white;
        }
        .vigente {
            background-color: green;
            color: white;
        }
        .proximo {
            background-color: yellow;
        }

    </style>
</head>
<body>
<div class="wapper">
    
    <div class="row">
<body id="body">
    <header>
      <h4 class="tema"> Veterinaria Pets Kingdom</h4>   
    </header>

    <div class="menu__side" id="menu_side"> <br>
    <br>
<h4 class="clasi">Menu de gatitos</h4>
        <div class="options__menu">

        <a href="M_externoGATOS.php">
    <div class="option">
    <i class="fas fa-cat"></i>
        <h4>Externos</h4>
    </div>
</a>

            <a href="M_internoGATOS.PHP" class="selected" id="desparacitantes_internos_link">
                <div class="option">
                <i class="fas fa-cat"></i>
                    <h4>Internos</h4>
                </div>
            </a>

            <a href="M_antivioticosGATOS.php" class="selected" id="antivioticos_link">
                <div class="option">
                <i class="fas fa-cat"></i>
                    <h4>Antibióticos</h4>
                </div>
            </a>

           <!-- <a href="M_antiflamatorioGATOS.php" class="selected" id="antiflamatorio_link">
                <div class="option">
                <i class="fas fa-cat"></i>
                    <h4>Antiflamatorios</h4>
                </div>
            </a>-->

            <a href="M_analgesicosGATOS.php" class="selected" id="analgesicos_link">
                <div class="option">
                <i class="fas fa-cat"></i>
                    <h4>Analgésicos</h4>
                </div>
            </a>

            <a href="M_vitaminasGATOS.php" class="selected" id="vitaminas_link">
                <div class="option">
                <i class="fas fa-cat"></i>
                    <h4>Vitaminas y protectores</h4>
                </div>
            </a>
            <a href="home.php" class="selected" >
                <div class="option">
                <i class="fas fa-sign-out-alt"></i>
                    <h4>Salir</h4>
                </div>
            </a>

        </div>

    </div>
<div class="Caja">
            <div class="formulario">
                <form action="INSERTARexternoGATOS.php" method="post">
                    <h3 class="registro">REGISTRO</h3>
                    <label for="nombreDes">Nombre</label><br>
                    <input type="text" class="mio" name="nombreDes"><br>
                    <label for="descripcionproducto">Descripcion</label><br>
                    <input type="text" class="mio" name="descripcionproducto"><br>
                    <label for="fecha_elaboracion">Elaboración</label><br>
                    <input type="date" class="mio" name="fecha_elaboracion" required><br>
                    <label for="fecha_caducidad">Caducidad</label><br>
                    <input type="date" class="mio" name="fecha_caducidad" required><br>
                    <label for="cantidad">Cantidad</label><br>
                  <input type="text" class="mio" name="cantidad"><br>
                    <input type="submit" class="boton" value="Agregar">
                </form>
            </div>
<div class="tablas">
<div class="busqueda">
<form action="BUSCARexternosGATOS.php" method="post">
<label for="nombreDes"><i class="fas fa-search"></i></label>
    <input type="text" class="mio" name="nombreDes" placeholder="Nombre del producto" required>
    <input type="submit" class="boton" value="Buscar">
</form>
            </div>
           
          <h1 class="des" >DESPARACITANTES EXTERNOS</h1>  
            <div class="table-container">
              
            <table class="table">
             
                <thead class="sticky-header"  >
                    <tr  class="inicio">
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Elaboración</th>
                        <th>Caducidad</th>
                        <th>Dias</th>
                        <th>Estado</th>
                        <th>Cantidad</th>
                        <th>Opciones</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnx = mysqli_connect("localhost", "root", "", "infromacion");
                    $sql = "SELECT nombreDes, descripcionproducto,fecha_elaboracion, fecha_caducidad, cantidad FROM desparasexternosgatos ORDER BY fecha_caducidad DESC";
                    $rta = mysqli_query($cnx, $sql);

                    if ($rta) {
                        while ($row = mysqli_fetch_array($rta)) {
                            $now = time();
                            $elaborationDate = strtotime($row['fecha_elaboracion']);
                            $expirationDate = strtotime($row['fecha_caducidad']);
                            $timeRemaining = $expirationDate - $elaborationDate;
                            $daysRemaining = round($timeRemaining / (60 * 60 * 24));
                            $estado = ($daysRemaining <= 0) ? "Caducado" : (($daysRemaining <= 2) ? "proximo" : "Vigente");
                            $estadoClass = ($daysRemaining <= 0) ? "caducado" : (($daysRemaining <= 2) ? "proximo" : "vigente");

                            $opciones = "<td><a href='ELIMINARexternoGATOS.php?nombreDes=" . $row['nombreDes'] . "' class='btn btn-danger'><i class='fas fa-trash'></i> </a>  ";
                            $opciones .= "<a href='ACTUALIZARexternoGATOS.php?nombreDes=" . $row['nombreDes'] . "' class='btn btn-danger'><i class='fas fa-edit'></i> </a></td>";
                            

                            echo "<tr>";
                            echo "<td>" . $row['nombreDes'] . "</td>";
                            echo "<td>" . $row['descripcionproducto'] . "</td>";
                            echo "<td>" . $row['fecha_elaboracion'] . "</td>";
                            echo "<td>" . $row['fecha_caducidad'] . "</td>";
                            echo "<td id='countdown-" . $row['nombreDes'] . "'>" . $daysRemaining . " días</td>";
                            echo "<td class='" . $estadoClass . "'>" . $estado . "</td>";
                            echo "<td>" . $row['cantidad'] . "</td>";
                            echo $opciones;
                            echo "</tr>";
                        }
                    } else {
                        echo "Error en la consulta: " . mysqli_error($cnx);
                    }

                    mysqli_close($cnx);
                    ?>
                </tbody>
            </table>
            
            </div>
            </div>
        </div>
</body>
</html>