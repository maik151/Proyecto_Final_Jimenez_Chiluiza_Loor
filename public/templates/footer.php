<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Footer</title>
</head>
<body>
<div class="container">
  <footer class="footer-container py-3 my-4">
    <ul class="footer-nav nav justify-content-center border-bottom pb-3 mb-3">
      <li class="footer-item nav-item"><a href="index.php" class="footer-link nav-link px-2">Inicio</a></li>
      <li class="footer-item nav-item"><a href="LibroView.php" class="footer-link nav-link px-2">Gestión de Libros</a></li>
      <li class="footer-item nav-item"><a href="AutorView.php" class="footer-link nav-link px-2">Gestión de Autores</a></li>
    </ul>
    <p class="text-center footer-text">© 2024 Sistema de Gestión de Libros</p>
  </footer>
</div>

<style>
  .footer-container {
    background-color:rgb(255, 255, 255); /* Color de fondo suave */
    padding-top: 15px;
    padding-bottom: 15px;
  }

  .footer-nav {
    border-color: #dee2e6; /* Color del borde */
  }

  .footer-item {
    margin: 0 10px;
  }

  .footer-link {
    color: rgb(104, 104, 104) !important;
    text-decoration: none;
    transition: color 0.3s ease-in-out;
  }

  .footer-link:hover {
    color: #007bff !important; /* Color azul Bootstrap */
  }

  .footer-text {
    color: rgb(104, 104, 104);
  }
</style>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>