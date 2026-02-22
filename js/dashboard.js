console.log("Cargando dashboard.js");

document.addEventListener("DOMContentLoaded", () => {
    if (window.dashboardApplied) return;
    window.dashboardApplied = true;

    // Filtra usuarios
    const inputFiltro = document.getElementById("filtrarD");
    function filtrarDash() {
        const valor = inputFiltro.value.toLowerCase();
        const rows = document.querySelectorAll("#usersTable tbody tr");

        rows.forEach(row => {
            const nombre = row.querySelector("td:nth-child(1)").textContent.toLowerCase();
            const email = row.querySelector("td:nth-child(2)").textContent.toLowerCase();
            const rol = row.querySelector("td:nth-child(3)").textContent.toLowerCase();

            if (nombre.includes(valor) || email.includes(valor) || rol.includes(valor)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }
    inputFiltro.addEventListener("input", filtrarDash);
    inputFiltro.closest("form").addEventListener("submit", e => {
        e.preventDefault();
        filtrarDash();
    });

    // Elimina usuarios
    document.querySelectorAll(".eliminar-btn").forEach(btn => {
        btn.addEventListener("click", async () => {
            const row = btn.closest("tr");
            const userId = row.getAttribute("data-id");
            if (!confirm("¿Seguro que deseas eliminar este usuario?")) return;

            try {
                const response = await fetch(`http://127.0.0.1:8000/api/usuarios/${userId}`, {
                    method: "DELETE",
                    headers: {
                        "Authorization": "Bearer " + window.sessionToken,
                        "Accept": "application/json"
                    }
                });

                const text = await response.text();
                let data;
                try { data = JSON.parse(text); } catch { data = { Message: text }; }

                if (response.ok && (data.Message || data.status === "exito")) {
                    row.remove();
                    alert("Usuario eliminado correctamente");
                } else {
                    alert("Error al eliminar: " + JSON.stringify(data));
                }
            } catch (err) {
                console.error("Error en la petición:", err);
                alert("Error en la conexión con el servidor");
            }
        });
    });

    // edita usuarios (falta cambiarlo porque no funciona, no lee los datos del form)
    document.querySelectorAll(".edit-user-form").forEach(form => {
        form.addEventListener("submit", async e => {
            e.preventDefault();
            e.stopPropagation();
            
            // estos datos no se leen
            const id = form.dataset.id;
            const nameField = form.querySelector("[name='name']");
            const emailField = form.querySelector("[name='email']");
            const roleField = form.querySelector("[name='role']");

            if (!nameField || !emailField || !roleField) {
                alert("El formulario no tiene todos los campos requeridos");
                return;
            }

            const data = {
                name: nameField.value,
                email: emailField.value,
                role: roleField.value
            };

            try {
                const response = await fetch(`http://127.0.0.1:8000/api/usuarios/${id}`, {
                    method: "PATCH",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "Authorization": "Bearer " + window.sessionToken
                    },
                    body: JSON.stringify(data)
                });

                if (!response.ok) {
                    alert("Error al actualizar: " + response.status);
                    return;
                }

                const result = await response.json();
                if (result.status === "exito") {
                    alert("Usuario actualizado correctamente");
                    bootstrap.Modal.getInstance(form.closest(".modal")).hide();

                    // Actualizar fila en la tabla
                    const row = document.querySelector(`#usersTable tr[data-id='${id}']`);
                    if (row) {
                        row.querySelector("td:nth-child(1) strong").textContent = data.name;
                        row.querySelector("td:nth-child(2)").textContent = data.email;
                        row.querySelector("td:nth-child(3)").textContent = data.role;
                    }
                } else {
                    alert("Error al actualizar: " + JSON.stringify(result));
                }
            } catch (err) {
                console.error("Error de conexión:", err);
                alert("Error de conexión con el servidor");
            }
        });
    });
});
