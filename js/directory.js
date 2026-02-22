function buscar() {
    const valor = document.getElementById('filtrar').value;
    alert("Buscando: " + valor);
    // Aquí puedes hacer fetch/AJAX o redirigir return false; // evita recargar la página
}

// para eliminar usuario directorio
document.addEventListener("DOMContentLoaded", () => {
    const botonesEliminar = document.querySelectorAll(".eliminar-btn");

    botonesEliminar.forEach(btn => {
        btn.addEventListener("click", () => {
            const userId = btn.getAttribute("data-id");

            if (!confirm("¿Seguro que deseas eliminar este usuario?")) return;

            fetch(`http://127.0.0.1:8000/api/usuarios/${userId}`, {
                method: "DELETE",
                headers: {
                    "Authorization": "Bearer " + window.sessionToken, // token desde PHP
                    "Content-Type": "application/json"
                }
            })
                .then(res => res.json())
                .then(data => {
                    if (data.Message || data.status === "exito") {
                        // Eliminar la card del DOM
                        btn.closest(".empleado").remove();
                        alert("Usuario eliminado correctamente");
                    } else {
                        alert("Error al eliminar: " + JSON.stringify(data));
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert("Error en la petición");
                });
        });
    });
});

// para dashboard
document.addEventListener("DOMContentLoaded", () => {
    // Eliminar usuario
    document.querySelectorAll(".delete").forEach(btn => {
        btn.addEventListen0er("click", () => {
            const row = btn.closest("tr");
            const userId = row.getAttribute("data-id");

            if (!confirm("¿Seguro que deseas eliminar este usuario?")) return;

            fetch(`http://127.0.0.1:8000/api/usuarios/${userId}`, {
                method: "DELETE",
                headers: {
                    "Authorization": "Bearer " + window.sessionToken,
                    "Content-Type": "application/json"
                }
            })
                .then(res => res.json())
                .then(data => {
                    if (data.Message || data.status === "exito") {
                        row.remove();
                        alert("Usuario eliminado correctamente");
                    } else {
                        alert("Error al eliminar: " + JSON.stringify(data));
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert("Error en la petición");
                });
        });
    });

    // Editar usuario → llenar modal
    document.querySelectorAll(".edit").forEach(btn => {
        btn.addEventListener("click", () => {
            const name = btn.getAttribute("data-name");
            const email = btn.getAttribute("data-email");
            const role = btn.getAttribute("data-role");

            // Llenar inputs del modal edit.php
            document.querySelector("#editModal input[name='name']").value = name;
            document.querySelector("#editModal input[name='email']").value = email;
            document.querySelector("#editModal input[name='role']").value = role;
        });
    });
});
