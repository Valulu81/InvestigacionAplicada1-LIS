<!-- Modal para editar usuarios -->
<div class="modal fade" id="editModal<?php echo $u['id']; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-transparent border-0 shadow-none">
            <div class="modal-body p-0">
                <div class="perfil card p-3 text-white">
                    <form class="edit-user-form" data-id="<?php echo $u['id']; ?>">

                        <div class="text-center mb-4">
                            <h2 class="mt-3">Panel de Edición</h2>
                            <h5 class="text-secondary">Usuario seleccionado para la edicion de campos</h5>
                        </div>
                        <hr>

                        <!-- datos del empleado o admin -->
                        <div class="text-center">
                            <div class="mb-3">
                                <label class="form-label fw-bold">
                                    <i class="bi bi-person-fill me-2"></i>Nombre Completo
                                </label>
                                <input type="text" name="name" class="form-control text-center mx-auto"
                                    style="max-width: 400px;"
                                    value="<?php echo htmlspecialchars($u['name']); ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">
                                    <i class="bi bi-envelope-fill me-2"></i>Correo Electrónico
                                </label>
                                <input type="email" name="email" class="form-control text-center mx-auto"
                                    style="max-width: 400px;"
                                    value="<?php echo htmlspecialchars($u['email']); ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">
                                    <i class="bi bi-briefcase-fill me-2"></i>Rol asignado
                                </label>
                                <input type="text" name="role" class="form-control text-center mx-auto"
                                    style="max-width: 400px;"
                                    value="<?php echo htmlspecialchars($u['role']); ?>">
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-outline-morado px-4 rounded-pill">
                                <i class="bi bi-pencil-fill me-2"></i> Editar Perfil
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>