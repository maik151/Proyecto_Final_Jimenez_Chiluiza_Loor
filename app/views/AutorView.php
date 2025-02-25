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
        <button class="btn btn-primary mb-3" onclick="abrirModalNuevoAutor()">Nuevo Autor</button>
        
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Nacionalidad</th>
                    <th>Género</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($autores as $autor): ?>
                    <tr>
                        <td><?= $autor['id_autor'] ?></td>
                        <td><?= $autor['nombre_autor'] ?></td>
                        <td><?= $autor['edad_autor'] ?></td>
                        <td><?= $autor['nacionalidad'] ?></td>
                        <td><?= $autor['genero'] ?></td>
                        <td>
                            <!-- Icono de Editar -->
                            <button class="btn btn-warning btn-sm" onclick="editarAutor(<?= htmlspecialchars(json_encode($autor)) ?>)">
                                <i class="fas fa-edit"></i> <!-- Font Awesome icon for edit -->
                            </button>
                            <!-- Icono de Eliminar -->
                            <button class="btn btn-danger btn-sm" onclick="eliminarAutor(<?= $autor['id_autor'] ?>)">
                                <i class="fas fa-trash-alt"></i> <!-- Font Awesome icon for delete -->
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
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
                    <input type="text" id="nombre_autor" class="form-control mb-2">
                    <label>Edad:</label>
                    <input type="number" id="edad_autor" class="form-control mb-2">
                    <label>Nacionalidad:</label>
                    <input type="text" id="nacionalidad" class="form-control mb-2">
                    <label>Género:</label>
                    <select id="genero" class="form-control mb-3">
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
            let nombre_autor = document.getElementById("nombre_autor").value.trim();
            let edad_autor = document.getElementById("edad_autor").value.trim();
            let nacionalidad = document.getElementById("nacionalidad").value.trim();
            let genero = document.getElementById("genero").value;

            // Validaciones
            if (nombre_autor === "") {
                alert("El nombre del autor no puede estar vacío.");
                return;
            }

            if (edad_autor === "" || isNaN(edad_autor) || parseInt(edad_autor) <= 0) {
                alert("La edad debe ser un número positivo.");
                return;
            }

            if (nacionalidad === "") {
                alert("La nacionalidad no puede estar vacía.");
                return;
            }

            let autor = {
                nombre_autor: nombre_autor,
                edad_autor: edad_autor,
                nacionalidad: nacionalidad,
                genero: genero
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
            if (confirm("Se eliminarán todos los libros registrados bajo este Autor. ¿Estás seguro de eliminar este Autor?")) {
                axios.delete(`http://localhost/Proyecto_Final_Jimenez_Chiluiza_Loor/public/autores/${id_autor}`)
                    .then(response => {
                        alert("Autor eliminado");
                        location.reload();
                    })
                    .catch(error => console.error(error));
            }
        }
    </script>
    <?php include __DIR__ . '/../../public/templates/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>