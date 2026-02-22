<?php
session_start();

// token validado, si no pa login
if (!isset($_SESSION['token'])) {
    header("Location: ../login.php");
    exit;
}

// obtiene api
$url = "http://127.0.0.1:8000/api/usuarios";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer " . $_SESSION['token'],
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

$usuarios = json_decode($response, true);
?>

<!-- aqui empieza el contenidoo, lleva la busqueda filtros y ya los empleados -->
<section class="directorio col-12 col-md-10 p-3">
    <form class="d-flex my-3" role="search" onsubmit="return buscar();">
        <input id="filtrar" class="form-control me-2" type="search"
            placeholder="Busca nombre, rol o departamento" aria-label="Search">
    </form>

    <div class="empleados d-flex flex-wrap gap-3 ms-2">
        <?php if (isset($usuarios['Message'])): ?>
            <p><?php echo $usuarios['Message']; ?></p>
        <?php else: ?>
            <?php foreach ($usuarios as $u): ?>
                <div class="">
                    <div class="empleado card mb-3 text-white">
                        <div class="d-flex">
                            <div class="p-2 d-flex justify-content-center align-items-center">
                                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                                    alt="Avatar" class="img-fluid rounded-circle avatar-img">
                            </div>
                            <div class="flex-grow-1">
                                <div class="card-body">
                                    <h5 class="card-title mb-0"><?php echo htmlspecialchars($u['name']); ?></h5>
                                    <p class="card-text my-1"><?php echo htmlspecialchars($u['role']); ?></p>
                                    <p class="card-text my-0">
                                        <i class="bi bi-envelope-fill me-2"></i>
                                        <?php echo htmlspecialchars($u['email']); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- esta es parte namas de compu, es decorativo solamente -->
                        <div class="d-none d-md-block mb-3 px-3">
                            <hr>
                            <div class="d-flex justify-content-center gap-3">
                                <button class="btn btn-outline-opciones px-4 rounded" type="button">
                                    <i class="bi bi-envelope-fill me-2"></i> Email
                                </button>
                                <button class="btn btn-outline-opciones px-4 rounded" type="button">
                                    <i class="bi bi-telephone-fill me-2"></i> Call
                                </button>
                            </div>
                        </div>


                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <script>
        window.sessionToken = "<?php echo $_SESSION['token']; ?>";
    </script>
    <script src="../js/directory.js"></script>
</section>