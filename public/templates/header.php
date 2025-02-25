<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de Libros y Autores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://kit.fontawesome.com/c13ee7e503.js" crossorigin="anonymous"></script>

    <style>
        .navbar {
            padding: 10px 20px;
        }
        .navbar-brand {
            font-size: 20px;
            font-weight: bold;
            margin-left: 0;
        }
        .nav-item {
            margin: 0 15px;
        }
        .nav-link {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 14px;
            color: #fff !important;
            transition: 0.3s;
        }
        .nav-link i {
            font-size: 24px;
            margin-bottom: 5px;
        }
        .nav-link:hover {
            color: #17a2b8 !important;
        }
    </style>
</head>
<body>

<header>
    <div class="px-3 py-2 text-bg-dark border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <a href="index.php" class="d-flex align-items-center my-2 my-lg-0 text-white text-decoration-none">
                    <i class="fa-brands fa-digital-ocean fa-3x me-2"></i>
                    
                </a>

                <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                    <li>
                        <a href="index.php" class="nav-link text-white">
                            <i class="fa-regular fa-building fa-2x me-2"></i>
                            Inicio
                        </a>
                    </li>
                    <li>
                        <a href="LibroView.php" class="nav-link text-white">
                            <i class="fa-solid fa-book fa-2x me-2"></i>
                            Gestión de Libros
                        </a>
                    </li>
                    <li>
                        <a href="AutorView.php" class="nav-link text-white">
                        <i class="fa-solid fa-user-tie fa-2x me-2"></i>
                            Gestión de Autores
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    
</header>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>