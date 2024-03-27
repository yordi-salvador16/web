

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Tarea</title>
    <style>
        /* Estilos para el contenedor del formulario */
        #form-tarea {
            max-width: 500px;
            margin: 0 auto;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: wheatblue;;
        }

        /* Estilos para los títulos */
        #form-tarea h2 {
            margin-top: 0;
            margin-bottom: 10px;
            text-align: center;
            justify-content: center;
        }

        /* Estilos para las etiquetas */
        #form-tarea label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        /* Estilos para los campos de entrada */
        #form-tarea input[type="text"],
        #form-tarea textarea,
        #form-tarea select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        /* Estilos para el botón */
        #form-tarea button[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        /* Estilos para el botón al pasar el ratón por encima */
        #formulario-tarea button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<h2>Crear Nueva Tarea</h2>
<form id="form-tarea" action="negocios/negocios_tarea.php" method="post">
    <label for="titulo">Título de la Tarea:</label><br>
    <input type="text" id="titulo" name="titulo" required><br><br>
    <label for="contenido">Contenido de la Tarea:</label><br>
    <textarea id="contenido" name="contenido" rows="4" required></textarea><br><br>
    <label for="curso_id">Curso:</label><br>
<select id="curso_id" name="curso_id" ><option value="">curso</option>
    <?php
require_once '../negocios/negocios_curso.php';

        
while($row=$cursos->fetch_assoc()){ ?>
<option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
<?php
}
    ?>

   
</select><br><br>

    <button type="submit" onclick="mostrarMensaje()">GUARDAR TAREA</button>
    
</form>
<script>
        function mostrarMensaje() {
            // Mostrar el mensaje flotante
            var mensaje = document.getElementById("confirmacionMensaje");
            mensaje.style.display = "block";

            // Ocultar el mensaje después de 3 segundos (puedes ajustar el tiempo según tus necesidades)
            setTimeout(function() {
                mensaje.style.display = "none";
            }, 120000);
        }

        
    </script>


</body>
</html>
