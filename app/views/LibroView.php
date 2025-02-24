<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../services/LibroService.php';

$database = new Database();
$conn = $database->conectar();
$libroService = new LibroService($conn);

$libros = $libroService->getAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Libros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
<?php include __DIR__ . '/../../public/templates/header.php'; ?>
    
<div class="container mt-4">
        <h2>Lista de Libros</h2>
        <button class="btn btn-primary" onclick="abrirModalNuevo()">Nuevo Libro</button>
        
        <table class="table mt-4">
            <tr><th>ID</th><th>Título</th><th>ISBN</th><th>Acciones</th></tr>
            <?php foreach ($libros as $libro): ?>
                <tr>
                    <td><?= $libro['id_libro'] ?></td>
                    <td><?= $libro['titulo_libro'] ?></td>
                    <td><?= $libro['ISBN'] ?></td>
                    <td>
                        <button class="btn btn-warning" onclick="editarLibro(<?= htmlspecialchars(json_encode($libro)) ?>)">Editar</button>
                        <button class="btn btn-danger" onclick="eliminarLibro(<?= $libro['id_libro'] ?>)">Eliminar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <!-- Modal de Creación/Edición de Libro -->
    <div class="modal fade" id="modalLibro" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar/Editar Libro</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_libro">
                    <label>Título:</label>
                    <input type="text" id="titulo_libro" class="form-control">
                    <label>ISBN:</label>
                    <input type="text" id="isbn" class="form-control">
                    <label>Autor ID:</label>
                    <input type="number" id="id_autor" class="form-control">
                    <label>Género:</label>
                    <input type="text" id="genero_libro" class="form-control">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" onclick="guardarLibro()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function abrirModalNuevo() {
            document.getElementById("id_libro").value = "";
            document.getElementById("titulo_libro").value = "";
            document.getElementById("isbn").value = "";
            document.getElementById("id_autor").value = "";
            document.getElementById("genero_libro").value = "";
            new bootstrap.Modal(document.getElementById("modalLibro")).show();
        }

        function editarLibro(libro) {
            document.getElementById("id_libro").value = libro.id_libro;
            document.getElementById("titulo_libro").value = libro.titulo_libro;
            document.getElementById("isbn").value = libro.ISBN;
            document.getElementById("id_autor").value = libro.id_autor;
            document.getElementById("genero_libro").value = libro.genero_libro;
            new bootstrap.Modal(document.getElementById("modalLibro")).show();
        }

        function guardarLibro() {
            let id_libro = document.getElementById("id_libro").value;
            let libro = {
                titulo_libro: document.getElementById("titulo_libro").value,
                ISBN: document.getElementById("isbn").value,
                id_autor: document.getElementById("id_autor").value,
                genero_libro: document.getElementById("genero_libro").value
            };

            let url = id_libro ? "/Proyecto_Final_Jimenez_Chiluiza_Loor/public/libros/editar" : "/Proyecto_Final_Jimenez_Chiluiza_Loor/public/libros";
            let method = id_libro ? "PUT" : "POST";

            if (id_libro) libro.id_libro = id_libro;

            axios({
                method: method,
                url: url,
                data: libro, // Pasar los datos directamente como objeto (axios lo convierte a JSON)
                headers: {
                    'Content-Type': 'application/json'  // Asegurarte de que el encabezado esté configurado correctamente
                }
            })
            .then(response => {
                alert("Libro guardado exitosamente");
                location.reload();
            })
            .catch(error => console.error(error));
        }

        function eliminarLibro(id_libro) {
            if (confirm("¿Estás seguro de eliminar este libro?")) {
                axios.delete(`http://localhost/Proyecto_Final_Jimenez_Chiluiza_Loor/public/libros/${id_libro}`)
                    .then(response => {
                        alert("Libro eliminado");
                        location.reload();
                    })
                    .catch(error => console.error(error));
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
