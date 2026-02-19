<!-- aqui empieza el contenidoo, lleva la busqueda filtros y ya los empleados -->
<section class="directorio col-12 col-md-10 p-3">
    <form class="d-flex my-3" role="search" onsubmit="return buscar();"> <input id="filtrar" class="form-control me-2 " type="search" placeholder="Busca nombre, rol o departamento" aria-label="Search"> </form>
    <!-- aqui va el filtro de roles de empleados :D -->
    <div class="filtros mb-3 d-flex flex-wrap gap-2">
        <input type="radio" class="btn-check" name="role" id="role1" autocomplete="off" checked>
        <label class="btn filtrobtn" for="role1">Todos los empleados</label>

        <input type="radio" class="btn-check" name="role" id="role2" autocomplete="off">
        <label class="btn  filtrobtn" for="role2">Ingeniería</label>

        <input type="radio" class="btn-check" name="role" id="role3" autocomplete="off">
        <label class="btn  filtrobtn" for="role3">Marketing</label>
    </div>

    <!-- aqui con php se muestran los empleados -->
    <div class="empleados">
        <div class="empleado card mb-3">
            <div class="row g-0">
                <div class="col-4 d-flex justify-content-center align-items-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Avatar"
                        class="img-fluid rounded-circle p-2 avatar-img">
                </div>
                <div class="col-8">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-2">
                            <h5 class="card-title mb-0">John Doe</h5>
                            <button type="button" class="trabajo btn  btn-outline ms-auto rounded-pill" disabled>
                                INGENIERIA
                            </button>
                        </div>

                        <p class="card-text my-1">Senior Product Designer</p>
                        <p class="card-text d-md-none my-0"><i class="bi bi-envelope-fill me-2"></i> j.doe@gmail.com</p>
                    </div>
                </div>
            </div>

            <!-- esta es parte namas de compu -->
            <div class="d-none d-md-block mb-3 px-3">
                <div class="mx-4">
                    <p class="card-text my-0"><i class="bi bi-building-fill me-3"></i> Design Department</p>
                    <p class="card-text my-0"><i class="bi bi-envelope-fill me-3"></i> j.doe@gmail.com</p>
                </div>
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
</section>