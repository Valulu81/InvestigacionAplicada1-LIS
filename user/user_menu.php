<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directorio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/directory.css">

</head>

<body>
    <!-- Directorio donde se mostraran los empleados para el lado del usuario, no se editan datos del empleado -->
    <header>
        <nav class="navbar fixed-top">
            <div class="container-fluid">
                <h1 class="navbar-brand ">Nexus Corp</h1>
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Avatar" width="40" height="40"
                    class="rounded-circle">
            </div>
        </nav>
    </header>

    <main class="row mx-1" style="padding-top: 70px; min-height: 100vh;">
        <!-- la sidebar solo se ve en computadoras, se oculta en cel -->
        <?php
        $page = $_GET['page'] ?? 'directorio';
        ?>
        <section class="sidebar d-none d-md-block col-md-2 text-white p-3">
            <ul class="nav flex-column mx-1 my-3">
                <li class="nav-item ">
                    <input type="radio" class="btn-check " name="menu" id="menu1" autocomplete="off"
                        <?php echo $page == 'directorio' ? 'checked' : ''; ?>>
                    <label class="btn menubtn w-100 " for="menu1">
                        <a href="?page=directorio" class="text-decoration-none text-white d-block">
                            <i class="bi bi-people me-2"></i> Directorio
                        </a>
                    </label>

                </li>
            </ul>

        </section>
        <!-- contenedor dinamico para la sidebar -->
        <?php // Detectar qué página cargar 
        switch ($page) {
            default:
                include 'directorio.php';
        } ?>

    </main>

    <!-- parte que no se mueve ed la parte inferior de la pag unico para telefonos -->
    <footer class="pie d-block d-md-none  text-center p-2 fixed-bottom py-3">
        <ul class="nav d-flex justify-content-center gap-3">
            <li class="nav-item">
                <input type="radio" class="btn-check" name="menu_footer" id="menu3" autocomplete="off"
                    <?php echo $page == 'directorio' ? 'checked' : ''; ?>>
                <label class="btn menubtn" for="menu3">
                    <a href="?page=directorio" class="text-decoration-none d-block">
                        <i class="bi bi-people me-2"></i> Directorio
                    </a>
                </label>
            </li>
        </ul>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
<!-- conexion con js -->
<script src="directory.js"></script>

</html>