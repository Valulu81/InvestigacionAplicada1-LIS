console.log("Cargando directory.js");

document.addEventListener("DOMContentLoaded", () => {
    // filtrar usuarios
    const inputFiltro = document.getElementById("filtrar");

    function buscar() {
        const valor = inputFiltro.value.toLowerCase();
        const cards = document.querySelectorAll(".empleado");

        cards.forEach(card => {
            const nombre = card.querySelector(".card-title").textContent.toLowerCase();
            const email = card.querySelector(".card-text").textContent.toLowerCase();
            const rol = card.querySelector(".card-text:nth-child(3)").textContent.toLowerCase();

            if (nombre.includes(valor) || email.includes(valor) || rol.includes(valor)) {
                card.style.display = "";
            } else {
                card.style.display = "none";
            }
        });
    }

    inputFiltro.addEventListener("input", buscar);

    const form = inputFiltro.closest("form");
    if (form) {
        form.addEventListener("submit", e => {
            e.preventDefault();
            buscar();
        });
    }

    // eliminar usuarios
    document.querySelectorAll(".eliminar-btn").forEach(btn => {
        btn.addEventListener("click", async () => {
            const userId = btn.getAttribute("data-id");
            if (!confirm("¿Seguro que deseas eliminar este usuario?")) return;

            console.log("Enviando DELETE con id:", userId);

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

                console.log("Respuesta de API:", data);

                if (response.ok && (data.Message || data.status === "exito")) {
                    btn.closest(".empleado")?.remove();
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

    // editarlos
    document.querySelectorAll(".edit-user-form").forEach(form => {
        form.addEventListener("submit", async e => {
            e.preventDefault();
            e.stopPropagation();

            const id = form.dataset.id;
            const nameField = form.querySelector("[name='name']");
            const emailField = form.querySelector("[name='email']");
            const roleField = form.querySelector("[name='role']");

            if (!nameField || !emailField || !roleField) {
                console.error("Faltan campos en el formulario con id:", id);
                alert("El formulario no tiene todos los campos requeridos");
                return;
            }

            const data = {
                name: nameField.value,
                email: emailField.value,
                role: roleField.value
            };

            console.log("Enviando PATCH con id:", id, "y data:", data);

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
                    const errorText = await response.text();
                    console.error("Error HTTP:", response.status, errorText);
                    alert("Error al actualizar: " + response.status);
                    return;
                }

                const result = await response.json();
                console.log("Respuesta de API:", result);

                if (result.status === "exito") {
                    alert("Usuario actualizado correctamente");
                    bootstrap.Modal.getInstance(form.closest(".modal")).hide();
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
