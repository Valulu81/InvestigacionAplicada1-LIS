<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? null;
    $role = $_POST['role'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    if (!$name || !$role || !$email || !$password) {
        die("Por favor completa todos los campos.");
    }

    // Registro
    $url = "http://127.0.0.1:8000/api/registro";
    $data = [
        "name" => $name,
        "role" => strtolower($role), // admin o empleado
        "email" => $email,
        "password" => $password
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);

    if (isset($result['status']) && $result['status'] === 'exito') {
        // Login automático
        $loginUrl = "http://127.0.0.1:8000/api/login";
        $loginData = ["email" => $email, "password" => $password];

        $ch = curl_init($loginUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($loginData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $loginResponse = curl_exec($ch);
        curl_close($ch);

        $loginResult = json_decode($loginResponse, true);

        if (isset($loginResult['token'])) {
            $_SESSION['token'] = $loginResult['token'];

            // Obtener datos del usuario autenticado
            $userUrl = "http://127.0.0.1:8000/api/usuarios/" . $result['user']['id'];
            $ch = curl_init($userUrl);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Authorization: Bearer " . $_SESSION['token']
            ]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $userResponse = curl_exec($ch);
            curl_close($ch);

            $_SESSION['user'] = json_decode($userResponse, true);

            // Redirigir según rol
            if ($_SESSION['user']['role'] === 'admin') {
                header("Location: admin/admin_menu.php");
            } else {
                header("Location: user/user_menu.php");
            }
            exit;
        } else {
            die("Error al iniciar sesión después del registro: " . json_encode($loginResult));
        }
    } else {
        die("Error al registrar usuario: " . json_encode($result));
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Nexus Corp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/login.css">
</head>

<body class="login-body d-flex align-items-center justify-content-center">

    <div class="login-card card p-4 text-white">
        <div class="text-center mb-4">
            <i class="bi bi-building-fill fs-1 text-morado"></i>
            <h2 class="mt-2">Nexus Corp</h2>
            <p class="text-secondary">Employee Management Portal</p>
        </div>

        <h4 class="text-center mb-3">Bienvenido a Nexus Corp</h4>
        <p class="text-center text-secondary">Ingresa tu informacion a continuación para formar parte de nosotros: </p>

        <form action="signin.php" method="POST">

            <div class="mb-3">
                <label for="name" class="form-label">Nombre Completo</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nombre completo" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Rol</label>
                <input type="text" class="form-control" id="role" name="role" placeholder="Rol asignado" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="name@company.com" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>

                </div>
            </div>

            <button type="submit" class="btn btn-morado w-100 mt-3">Registrarse</button>
        </form>

        <div class="mt-4 text-center">
            <a href="#" class="text-secondary text-decoration-none">Contactar soporte IT</a>
            <div class="mt-2">
                <a href="#" class="text-secondary text-decoration-none me-3">Política de privacidad</a>
                <a href="#" class="text-secondary text-decoration-none">Términos de servicio</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>