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

    <div class="employee-table p-0 container-fluid m-0">
        <div class="table-responsive p-0">
        <table>
            <thead>
                <tr>
                    <th>EMPLOYEE</th>
                    <th>ROLE</th>
                    <th>AGE</th>
                    <!-- lo ocultamos para pantallas mas pequeñas -->
                    <th >JOIN DATE</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="employee-info">
                            <strong>Alex Rivera</strong><br>
                            <span class="email">alex.r@company.com</span>
                        </div>
                    </td>
                    <td><span class="tag backend">Ingeniero</span></td>
                    <td>32</td>
                    <td >Jun 12, 2021</td>
                    <td>
                        <button class="edit"><i class="bi bi-pencil-fill"></i></button>
                        <button class="delete"><i class="bi bi-trash-fill"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="employee-info">
                            <strong>Sarah Chen</strong><br>
                            <span class="email">sarah.c@company.com</span>
                        </div>
                    </td>
                    <td><span class="tag design">Arquitecto</span></td>
                    <td>28</td>
                    <td >Mar 05, 2022</td>
                    <td>
                        <button class="edit"><i class="bi bi-pencil-fill"></i></button>
                        <button class="delete"><i class="bi bi-trash-fill"></i></button>
                    </td>
                </tr>
                <!-- Más filas aquí -->
            </tbody>
        </table>
        </div>
    </div>

</section>