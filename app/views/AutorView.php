<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../services/AutorService.php';

$database = new Database();
$conn = $database->conectar();
$autorService = new AutorService($conn);

$autores = $autorService->getAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Autores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
<?php include __DIR__ . '/../../public/templates/header.php'; ?>
    
    <div class="container mt-4">
        <h2>Lista de Autores</h2>
        <button class="btn btn-primary" onclick="abrirModalNuevoAutor()">Nuevo Autor</button>
        
        <table class="table mt-4">
            <tr><th>ID</th><th>Nombre</th><th>Edad</th><th>Acciones</th></tr>
            <?php foreach ($autores as $autor): ?>
                <tr>
                    <td><?= $autor['id_autor'] ?></td>
                    <td><?= $autor['nombre_autor'] ?></td>
                    <td><?= $autor['edad_autor'] ?></td>
                    <td>
                        <button class="btn btn-warning" onclick="editarAutor(<?= htmlspecialchars(json_encode($autor)) ?>)">Editar</button>
                        <button class="btn btn-danger" onclick="eliminarAutor(<?= $autor['id_autor'] ?>)">Eliminar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <!-- Modal de Creación/Edición de Autor -->
    <div class="modal fade" id="modalAutor" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar/Editar Autor</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_autor">
                    <label>Nombre:</label>
                    <input type="text" id="nombre_autor" class="form-control">
                    <label>Edad:</label>
                    <input type="number" id="edad_autor" class="form-control">
                    <label>Nacionalidad:</label>
                    <input type="text" id="nacionalidad" class="form-control">
                    <label>Género:</label>
                    <select id="genero" class="form-control">
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" onclick="guardarAutor()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function abrirModalNuevoAutor() {
            document.getElementById("id_autor").value = "";
            document.getElementById("nombre_autor").value = "";
            document.getElementById("edad_autor").value = "";
            document.getElementById("nacionalidad").value = "";
            document.getElementById("genero").value = "Masculino";
            new bootstrap.Modal(document.getElementById("modalAutor")).show();
        }

        function editarAutor(autor) {
            document.getElementById("id_autor").value = autor.id_autor;
            document.getElementById("nombre_autor").value = autor.nombre_autor;
            document.getElementById("edad_autor").value = autor.edad_autor;
            document.getElementById("nacionalidad").value = autor.nacionalidad;
            document.getElementById("genero").value = autor.genero;
            new bootstrap.Modal(document.getElementById("modalAutor")).show();
        }

        function guardarAutor() {
            let id_autor = document.getElementById("id_autor").value;
            let autor = {
                nombre_autor: document.getElementById("nombre_autor").value,
                edad_autor: document.getElementById("edad_autor").value,
                nacionalidad: document.getElementById("nacionalidad").value,
                genero: document.getElementById("genero").value
            };

            let url = id_autor ? "/Proyecto_Final_Jimenez_Chiluiza_Loor/public/autores/" + id_autor : "/Proyecto_Final_Jimenez_Chiluiza_Loor/public/autores";
            let method = id_autor ? "PUT" : "POST";

            if (id_autor) autor.id_autor = id_autor;

            axios({
                method: method,
                url: url,
                data: JSON.stringify(autor),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                alert("Autor guardado exitosamente");
                location.reload();
            })
            .catch(error => console.error(error));
        }

        function eliminarAutor(id_autor) {
            if (confirm("Se eliminaran todos los libros registrados bajo este Autor. ¿Estás seguro de eliminar este Autor?")) {
                axios.delete(`http://localhost/Proyecto_Final_Jimenez_Chiluiza_Loor/public/autores/${id_autor}`)
                    .then(response => {
                        alert("Autor eliminado");
                        location.reload();
                    })
                    .catch(error => console.error(error));
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>