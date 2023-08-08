<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VETERINARIA PET'S KINDOM</title>
    <link rel="icon" href="IMG/img1.ico">
    <link rel="stylesheet" href="css/actual.css">
</head>
<body>
    

<?php
include("conexion.php");
$con = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y validar los datos del formulario
    $nombreDes = $_POST['nombreDes'];
    $nuevaDescripcion = $_POST['nuevaDescripcion'];
    $nuevaFechaElaboracion = $_POST['nuevaFechaElaboracion'];
    $nuevaFechaCaducidad = $_POST['nuevaFechaCaducidad'];
    $nuevaCantidad = $_POST['nuevaCantidad'];

    // Realizar la actualización en la base de datos
    $sql_actualizar = "UPDATE desparainternogatos SET descripcionproducto=?, fecha_elaboracion=?, fecha_caducidad=?, cantidad=? WHERE nombreDes=?";
    $stmt = mysqli_prepare($con, $sql_actualizar);
    if (!$stmt) {
        die("Error al preparar la consulta: " . mysqli_error($con));
    }

    mysqli_stmt_bind_param($stmt, "sssss", $nuevaDescripcion, $nuevaFechaElaboracion, $nuevaFechaCaducidad, $nuevaCantidad, $nombreDes);

    if (mysqli_stmt_execute($stmt)) {
        // Redireccionar al usuario nuevamente a la página "M_Pdesexterno.php" después de actualizar
        header("Location: M_internoGATOS.PHP");
        exit;
    } else {
        // Error al actualizar el registro
        die("Error al ejecutar la consulta: " . mysqli_error($con));
    }
    mysqli_stmt_close($stmt);
} elseif (isset($_GET["nombreDes"])) {
    $nombreDes = $_GET["nombreDes"];
    // Obtener los datos actuales del producto de la base de datos
    $sql_select = "SELECT * FROM desparainternogatos WHERE nombreDes=?";
    $stmt_select = mysqli_prepare($con, $sql_select);
    mysqli_stmt_bind_param($stmt_select, "s", $nombreDes);
    mysqli_stmt_execute($stmt_select);
    $resultado = mysqli_stmt_get_result($stmt_select);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $registro = mysqli_fetch_assoc($resultado);
        $descripcionActual = $registro['descripcionproducto'];
        $fechaElaboracionActual = $registro['fecha_elaboracion'];
        $fechaCaducidadActual = $registro['fecha_caducidad'];
        $cantidadActual = $registro['cantidad'];
    
        // Mostrar el formulario de actualización
        echo "<form method='post' action='ACTUALIZARinternoGATOS.php'>";
        echo "<div class='wrapper'>";
        echo "<img src='IMG/atras.jpg' alt='' class='fondo'>";
        echo "<div class='row'><br>";
        echo "<h1 class='registro'>ACTUALIZAR<br> PRODUCTOS</h1><br>";
        echo "<input type='hidden' name='nombreDes' value='" . $nombreDes . "'>";
        echo "Nombre del producto: <br><input type='text' class='mio'  name='nombreDes' value='" . $nombreDes . "'><br>";
        echo "Descripción: <br><input type='text' class='mio' name='nuevaDescripcion' value='" . $descripcionActual . "'><br>";
        echo "Fecha de Elaboración: <br><input type='date' class='mio' name='nuevaFechaElaboracion' value='" . $fechaElaboracionActual . "'><br>";
        echo "Fecha de Caducidad: <br><input type='date' class='mio' name='nuevaFechaCaducidad' value='" . $fechaCaducidadActual . "'><br>";
        echo "Cantidad: <br><input type='text' class='mio'  name='nuevaCantidad' value='" . $cantidadActual . "'><br>";
        echo "<input type='submit' class='boton' value='Actualizar'>";
        echo "</div>";
        echo "</div>";
        echo "</form>";
    } else {
        echo "No se encontraron datos para el producto.";
    }
    
    mysqli_stmt_close($stmt_select);
} else {
    header("Location:M_internoGATOS.PHP");
    exit;
}
?>

</body>
</html>









