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
        <button class="btn btn-primary mb-3" onclick="abrirModalNuevo()">Nuevo Libro</button>
        
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>ISBN</th>
                    <th>Género</th>
                    <th>Autor ID</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($libros as $libro): ?>
                    <tr>
                        <td><?= $libro['id_libro'] ?></td>
                        <td><?= $libro['titulo_libro'] ?></td>
                        <td><?= $libro['ISBN'] ?></td>
                        <td><?= $libro['genero_libro'] ?></td>
                        <td><?= $libro['id_autor'] ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="editarLibro(<?= htmlspecialchars(json_encode($libro)) ?>)">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="eliminarLibro(<?= $libro['id_libro'] ?>)">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
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
                    <input type="text" id="titulo_libro" class="form-control mb-3">
                    <label>ISBN:</label>
                    <input type="text" id="isbn" class="form-control mb-3">
                    <label>Autor ID:</label>
                    <input type="number" id="id_autor" class="form-control mb-3">
                    <label>Género:</label>
                    <input type="text" id="genero_libro" class="form-control mb-3">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" onclick="guardarLibro()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

<!-- Añadir Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<!-- Estilos personalizados -->
    <style>
        .table th, .table td {
            vertical-align: middle;
        }

        .table {
            font-size: 1rem;
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        .btn-sm {
            font-size: 0.875rem;
            padding: 0.375rem 0.75rem;
        }

        .btn-warning, .btn-danger {
            padding: 0.375rem 0.75rem;
            display: inline-flex;
            align-items: center;
        }

        .btn-warning .fas, .btn-danger .fas {
            margin-right: 0.5rem;
        }

        .modal-body input {
            margin-bottom: 1rem;
        }
    </style>

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
            let titulo_libro = document.getElementById("titulo_libro").value.trim();
            let isbn = document.getElementById("isbn").value.trim();
            let id_autor = document.getElementById("id_autor").value.trim();
            let genero_libro = document.getElementById("genero_libro").value.trim();

            // Validación de campos vacíos
            if (titulo_libro === "" || isbn === "" || id_autor === "" || genero_libro === "") {
                alert("Por favor, complete todos los campos.");
                return;
            }

            // Validación de ISBN (solo números)
            if (!/^\d{13}$/.test(isbn)) {
                alert("El ISBN debe ser un número de 13 dígitos.");
                return;
            }

            // Validación de ID de autor (debe ser un número positivo)
            if (isNaN(id_autor) || id_autor <= 0) {
                alert("Por favor, ingrese un ID de autor válido.");
                return;
            }

            let id_libro = document.getElementById("id_libro").value;
            let libro = {
                titulo_libro: titulo_libro,
                ISBN: isbn,
                id_autor: id_autor,
                genero_libro: genero_libro
            };

            let url = id_libro ? "/Proyecto_Final_Jimenez_Chiluiza_Loor/public/libros/" + id_libro : "/Proyecto_Final_Jimenez_Chiluiza_Loor/public/libros";
            let method = id_libro ? "PUT" : "POST";

            if (id_libro) libro.id_libro = id_libro;

            axios({
                method: method,
                url: url,
                data: JSON.stringify(libro),  // Convertimos el objeto a formato JSON
                headers: {
                    'Content-Type': 'application/json'  // Asegúrate de que el encabezado esté configurado correctamente
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
    <?php include __DIR__ . '/../../public/templates/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
