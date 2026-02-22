<?php
session_start();

// Verificar token
if (!isset($_SESSION['token'])) {
    header("Location: ../login.php");
    exit;
}

// Consumir API de usuarios
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

    <div class="employee-table p-0 container-fluid m-0">
        <div class="table-responsive p-0">
            <table class="table table-striped table-dark align-middle">
                <thead>
                    <tr>
                        <th>Empleado</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($usuarios['Message'])): ?>
                        <tr>
                            <td colspan="4"><?php echo $usuarios['Message']; ?></td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($usuarios as $u): ?>
                            <tr data-id="<?php echo $u['id']; ?>">
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                                            alt="Avatar"
                                            class="rounded-circle avatar-img"
                                            style="width:40px; height:40px;">
                                        <strong><?php echo htmlspecialchars($u['name']); ?></strong>
                                    </div>
                                </td>
                                <td><?php echo htmlspecialchars($u['email']); ?></td>
                                <td><?php echo htmlspecialchars($u['role']); ?></td>
                                <td>
                                    <button class="btn btn-sm "
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal<?php echo $u['id']; ?>">
                                        <i class="bi bi-pencil-fill text-success"></i>
                                    </button>
                                    <button class="btn btn-sm eliminar-btn"
                                        data-id="<?php echo $u['id']; ?>">
                                        <i class="bi bi-trash-fill text-danger"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php include 'edit.php'; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>