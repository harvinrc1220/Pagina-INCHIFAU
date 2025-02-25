<?php
//Conexion a la base de datos
$servidor ="localhost";//direccion del servidor de la base de datos 
$usuario_de_la_base_de_datos = "root";//Nombre de usuario de la base de datos
$password_de_la_base_de_datos="";//Contraseña de la base de datos
$nombre_de_la_base_de_datos = "prematricula";//Nombre de la base de datos

$conexion = new mysqli($servidor, $usuario_de_la_base_de_datos,$password_de_la_base_de_datos,$nombre_de_la_base_de_datos);
//crear una nueva conexion

//verificamos la contraseña
if($conexion->connect_error){
    die("Error en la conexion:".$conexion->connect_error);//mostrar error si la contraseña falla
}

//obtener los datos del formulario
$nombre = $_POST['nombre'];//obtener el id del producto del formulario
$EDAD = $_POST['EDAD'];//obtener el nombre del producto del formulario
$genero = $_POST['genero'];//obtener la categoria del producto del formulario
$carrera = $_POST['carrera'];//obtener el precio del producto del formulario
$escuela = $_POST['escuela'];//obtener la existencia del producto del formulario

//subir la imagen
$target_dir = "partidas/";//carpetas donde se guardaran las imagenes subidas
$target_file1 =$target_dir.basename($_FILES["partida"]["name"]);//ruta de destino del archivo de imagen que se ingresa
move_uploaded_file($_FILES["partida"]["tmp_name"],$target_file1);//mover el archivo de imagen al directorio de destino

$target_dir = "constancias/";
$target_file2 =$target_dir.basename($_FILES["constancia"]["name"]);
move_uploaded_file($_FILES["constancia"]["tmp_name"],$target_file2);

$target_dir = "certificados/";
$target_file3 =$target_dir.basename($_FILES["certificado"]["name"]);
move_uploaded_file($_FILES["certificado"]["tmp_name"],$target_file3);

//insertar los datos en la tabla de productos
//los nombres en el insert son todos los campos de la tabla que deben tener el mismo nombre
//y los values son las variables que contienen los datos a ingresar

$sql = "INSERT INTO documentos (nombre,EDAD,genero,carrera,partida,constancia,certificado,escuela) VALUES('$nombre','$EDAD','$genero','$carrera','$target_file1','$target_file2','$target_file3','$escuela')";//consulta SQL para insertar los datos
//ejecutar la consulta

if($conexion->query($sql)===TRUE){
//mostrar mensaje si la contraseña es exitosa
}else{
    echo"Error:" .$sql. "<br>" .$conexion->error;//mostrar error si la contraseña falla
}
$conexion->close();//cerrar la conexion con la base de datos

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

  <style>

form {
    background-color: #ffffff; /* Fondo blanco para el formulario */
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    max-width: 400px; /* Ancho máximo del formulario */
    margin: auto; /* Centrar el formulario */
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #0000ff; /* Color azul para las etiquetas */
}

input[type="text"],
input[type="number"],
input[type="file"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #0000ff; /* Borde azul */
    border-radius: 4px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #0000ff; /* Color azul para el botón */
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s; /* Transición suave para el hover */
}

input[type="submit"]:hover {
    background-color: #0000cc; /* Color azul más oscuro al pasar el mouse */
}

  </style>

</head>
<body> 
    
    <header>
        <!--RC07-->
<div class="container">
  <div class="left">
    <select onchange="location.href=this.value">
      <option value="Prematricula.html">Pre-matricula</option>
      <option value="Secciones.html">Secciones</option>
      <option value="Actividades.html">Actividades</option>
      <option value="Index.html">Inicio</option>
      <option value="ayuda.html">Ayuda</option>
    </select>
  </div>
  <div class="center">
    <h1 style="color: white;">INCHIFAU</h1>
  </div>
  <div class="right">
    <img src="img/logo.png" alt="Logo" width="65px" height="50px">
  </div>
</div>








      </header>
      <main>
        <br>
        <center><h1>Formulario de Pre-Matrícula</h1></center><br>
    <center><form action="Prematricula.php" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="EDAD">Edad:</label>
        <input type="number" id="EDAD" name="EDAD" required><br><br>

        <label for="genero">Género:</label>
        <input type="text" id="genero" name="genero" required><br><br>

        <label for="carrera">Bachillerato: </label>
        <input type="text" id="carrera" name="carrera" required><br><br>

        <label for="partida">Partida de nacimiento: </label>
        <input type="file" id="partida" name="partida" required><br><br>

        <label for="constancia">Constancia de conducta: </label>
        <input type="file" id="constancia" name="constancia" required><br><br>

        <label for="certificado">Certificado de 9° Grado: </label>
        <input type="file" id="certificado" name="certificado" required><br><br>

        <label for="escuela">Escuela de procedencia</label>
        <input type="text" id="escuela" name="escuela" required><br><br>

        <input type="submit" value="Registrar">

    </form></center>
    <br>

      </main>
      <footer>

        <div class="containerf">
          <div class="left">
            <div class="md">
              <h2 style="color: white;">Teléfono</h2>
              <br>
  <p style="color: white;">2665-0789</p>
  <br>
  <h2 style="color: white;">Ubicación</h2>
              <br>
  <a href="https://www.google.com/maps/place/Instituto+Nacional+de+Chinameca/@13.5158417,-88.347759,17z/data=!3m1!4b1!4m6!3m5!1s0x8f7b32c1faf7c733:0xa461c11b4fd915d9!8m2!3d13.5158417!4d-88.347759!16s%2Fg%2F1hc3lh58z?hl=es-US&entry=ttu"><p style="color: white;">11 calle oriente N°21 Barrio Dolores, Chinameca, San Miguel</p></a>
</div>
          </div>
          <div class="center">
            <img src="img/logo.png" alt="Logo" width="138px" height="110px">
          </div>
          <div class="right1">
            <h2 style="color: white;">Instagram</h2>
              <br>
  <a href="https://www.instagram.com/inchifau_oficial/?igsh=OXNxa3plZm4zY2h1"><p style="color: white;">@inchifau_oficial</p></a>
  <br>
  <h2 style="color: white;">Facebook</h2>
              <br>
              <a href="https://www.facebook.com/inchinameca/?locale=es_LA"><p style="color: white;">Instituto Nacional de Chinameca</p></a>
          </div>
        </div>

      </footer>

</body>
</html>

