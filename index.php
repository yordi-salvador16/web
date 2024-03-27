

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Pacientes del DENTISTA</title>
    <style>
        /* Reset de estilos y configuración básica */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            text-align: center;
            justify-content: center; /* Centrar contenido horizontalmente */
        }

        /* Estilos para el formulario flotante */
        #formulario-flotante {
            display: none;
            position: fixed;
            width: 500px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Estilos para el mensaje de confirmación */
        #confirmacionMensaje {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #4CAF50;
            color: #fff;
            padding: 15px;
            border-radius: 5px;
            z-index: 1000;
        }

        /* Estilos para los botones */
        button {
            padding: 10px 20px;
            margin: 10px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: #fff;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }
        hr {
            border: 0;
            height: 1px;
            background-color: #ccc;
            margin: 20px auto; /* Margen superior e inferior de 20px, centrado horizontalmente */
            width: 35%; /* Ancho del 80% del contenedor */
        }
       
        .tarea {
            position: fixed;
            width: 550px;
            left: 400px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }
        .tarea h2 {
            margin: 0;
        }
        .tarea p {
            margin: 5px 0;
        }
        .options {
            display: flex;
        }
        .tareas{
            display: block;
        }
        .options button {
            margin-left: 10px;
            padding: 8px 12px;
            border: none;
            border-radius: 3px;
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
            
        }
        .options button:hover {
            background-color: #45a049;
        }
        .completado {
            background-color: #ff6347; /* Color rojo */
        }
        /* Estilos para tareas pendientes */
        .pendiente {
            background-color: #32CD32; /* Color verde */
        }
    </style>
        <script>
        function mostrarFormulario(tipo) {
            // Ruta del archivo PHP correspondiente al tipo de formulario
            var archivoPHP = tipo === 'curso' ? 'presentacion/form_curso.php' : 'presentacion/form_tarea.php';

            // Cargar el contenido del archivo PHP en el contenedor del formulario flotante
            var formularioFlotante = document.getElementById('formulario-flotante');
            formularioFlotante.innerHTML = '';

            // Crear una solicitud XMLHttpRequest para cargar el contenido del archivo PHP
            var xhr = new XMLHttpRequest();
            xhr.open('GET', archivoPHP, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    formularioFlotante.innerHTML = xhr.responseText;
                    formularioFlotante.style.display = 'block';
                }
            };
            xhr.send();
        }
        // Función para marcar una tarea como completada
// Función para marcar una tarea como completada
function marcarCompletado(id) {
    // Realizar una solicitud AJAX al backend para incrementar el contador de completado
    $.ajax({
        url: 'marcar_completado.php',
        method: 'POST',
        data: { tarea_id: id },
        success: function(response) {
            console.log(response); // Manejar la respuesta del backend si es necesario
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText); // Manejar errores si es necesario
        }
    });
}

// Función para desmarcar una tarea como completada
function desmarcarCompletado(id) {
    // Realizar una solicitud AJAX al backend para eliminar el número de completado
    $.ajax({
        url: 'desmarcar_completado.php',
        method: 'POST',
        data: { tarea_id: id },
        success: function(response) {
            console.log(response); // Manejar la respuesta del backend si es necesario
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText); // Manejar errores si es necesario
        }
    });
}

// Función para eliminar una tarea
function eliminarTarea(id) {
    // Aquí podrías enviar una solicitud AJAX para eliminar la tarea del backend
    console.log("Tarea eliminada: " + id);
}
//codigo script de otro proyect

    </script>
</head>
<body>
    
    <h1> GESTOR DE TAREAS</h1>

<button onclick="mostrarFormulario('curso')">Crear Curso</button>
    <button onclick="mostrarFormulario('tarea')">Crear Tarea</button>
    <hr>
    <div>
<h1> LISTA DE TAREAS</h1>
<?php
require_once 'negocios/llamar_tarea.php';
$negocios = new TareaNegocios();
$tareas = $negocios->obtenerTarea(); 
if (!empty($tareas)) {
    // Iterar sobre las tareas y mostrarlas
    foreach ($tareas as $tarea) {
        $estado = $tarea['completado'] ? 'completado' : 'pendiente';
        echo "<div class='tarea $estado'>";
        echo "<div class='tareas'>";
        echo "<h2>{$tarea['titulo']}</h2>";
        echo "<p> {$tarea['nombre']}</p>";
        echo "<p> {$tarea['created_at']}</p>";
        echo "<p>Estado: " . ($tarea['completado'] ? 'Completado' : 'Pendiente') . "</p>";
        echo "</div>";
        echo "<div class='options'>";
        echo "<button onclick='marcarCompletado({$tarea['id']})'> Completado</button>";
        echo "<button onclick='desmarcarCompletado({$tarea['id']})'>NoCompletado</button>";
        echo "<button onclick='eliminarTarea({$tarea['id']})'>Eliminar</button>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<p>No hay tareas disponibles.</p>";
}
?>
</div>
    <!-- Contenedor para el formulario flotante -->
    <div id="formulario-flotante"></div>
    <div>

    </div>

   
   
</body>
</html>
