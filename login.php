<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Nexus Corp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body class="login-body d-flex align-items-center justify-content-center">

    <div class="login-card card p-4 text-white">
        <div class="text-center mb-4">
            <i class="bi bi-building-fill fs-1 text-morado"></i>
            <h2 class="mt-2">Nexus Corp</h2>
            <p class="text-secondary">Employee Management Portal</p>
        </div>

        <h4 class="text-center mb-3">Bienvenido de nuevo</h4>
        <p class="text-center text-secondary">Ingresa tus credenciales para continuar</p>

        <form>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" placeholder="name@company.com">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" placeholder="••••••••">
                    
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember">
                    <label class="form-check-label" for="remember">Recordarme</label>
                </div>
                <a href="#" class="text-morado text-decoration-none">¿Olvidaste tu contraseña?</a>
            </div>

            <button type="submit" class="btn btn-morado w-100">Iniciar sesión</button>
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