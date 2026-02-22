<?php
session_start();

// mismo que en dashboard, valida token y si no pa login
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

<section class="directorio col-12 col-md-10 p-3">
    <form class="d-flex my-3" role="search" onsubmit="return buscar();">
        <input id="filtrar" class="form-control me-2" type="search"
            placeholder="Busca nombre, rol o departamento" aria-label="Search">
    </form>

    <div class="empleados d-flex flex-wrap gap-3 ">
        <?php if (isset($usuarios['Message'])): ?>
            <p><?php echo $usuarios['Message']; ?></p>
        <?php else: ?>
            <?php foreach ($usuarios as $u): ?>
                <div class="">
                    <div class="empleado card mb-3 text-white" >
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

                        <div class="d-none d-md-block px-3">
                            <hr>
                            <div class="d-flex justify-content-center gap-3 mb-3">
                                <!-- mismo boton para editar y el otro para eliminar-->
                                <button class="btn btn-outline-success px-4 rounded"
                                    type="button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal<?php echo $u['id']; ?>">
                                    <i class="bi bi-pencil-fill me-2"></i> Editar
                                </button>
                                <button class="btn btn-danger  px-4 rounded eliminar-btn"
                                    type="button"
                                    data-id="<?php echo $u['id']; ?>">
                                    <i class="bi bi-trash-fill me-2"></i> Eliminar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- aqui ta el modal -->
                <?php include 'edit.php'; ?> 
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <script>
        window.sessionToken = "<?php echo $_SESSION['token']; ?>";
    </script>
    <script src="../js/directory.js"></script>
</section>