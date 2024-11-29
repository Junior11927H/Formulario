<?php
// Conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$database = "alumnos";
$conn = mysqli_connect($host, $user, $password, $database);

$host = "localhost";
$user = "root";
$password = "";
$database = "alumnos";
$conn = mysqli_connect($host, $user, $password, $database);

// Verificar la conexión
if (!$conn) {
	die("Conexión fallida: " . mysqli_connect_error());
}

// Guardar el registro y enviar datos por correo
if (isset($_POST["guardar"])) {
	$nombre = $_POST["nombre"];
	$edad = $_POST["edad"];
	$telefono = $_POST["telefono"];

	// Guardar los datos en la base de datos
	$sql = "INSERT INTO registros (nombre, edad, telefono) VALUES ('$nombre', '$edad', '$telefono')";
	if (mysqli_query($conn, $sql)) {
		echo "Registro guardado exitosamente";

		// Preparar el correo
		$to = "ociel_reyes@outlook.es";  // Reemplaza con el correo al que deseas enviar los datos
		$subject = "Nuevo registro guardado";
		$message = "Se ha guardado un nuevo registro con los siguientes datos:\n";
		$message .= "Nombre: $nombre\n";
		$message .= "Edad: $edad\n";
		$message .= "Teléfono: $telefono\n";
	} else {
		echo "Error al guardar el registro: " . mysqli_error($conn);
	}
}
// Verificar la conexión
if (!$conn) {
	die("Conexión fallida: " . mysqli_connect_error());
}

// Consultar el registro
if (isset($_POST["consultar"])) {
	$sql = "SELECT * FROM registros";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			echo "Nombre: " . $row["nombre"] . "<br>";
			echo "Edad: " . $row["edad"] . "<br>";
			echo "Teléfono: " . $row["telefono"] . "<br><br>";
		}
	} else {
		echo "No se encontraron registros";
	}
}

// Guardar el registro
if (isset($_POST["guardar"])) {
	$nombre = $_POST["nombre"];
	$edad = $_POST["edad"];
	$telefono = $_POST["telefono"];
	$sql = "INSERT INTO registros (nombre, edad, telefono) VALUES ('$nombre', '$edad', '$telefono')";
	if (mysqli_query($conn, $sql)) {
		echo "Registro guardado exitosamente";
	} else {
		echo "Error al guardar el registro: " . mysqli_error($conn);
	}
}

// Eliminar el registro
if (isset($_POST["eliminar"])) {
	$telefono = $_POST["telefono"];
	$sql = "DELETE FROM registros WHERE telefono='$telefono'";
	if (mysqli_query($conn, $sql)) {
		echo "Registro eliminado exitosamente";
	} else {
		echo "Error al eliminar el registro: " . mysqli_error($conn);
	}
}

// Cerrar la conexión
mysqli_close($conn);
?>