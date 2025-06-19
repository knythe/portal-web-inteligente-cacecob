/* ajax cambio de estate en user*/
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".toggle-estado").forEach(function (checkbox) {
        checkbox.addEventListener("change", function () {
            const userId = this.dataset.id;
            const estado = this.checked ? 1 : 0;

            fetch(`/v1/usuarios/${userId}/toggle-estado`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({ estado }),
            })
                .then((response) => response.json())
                .then((data) => {
                    const td = document.querySelector(
                        `.estado-usuario[data-id="${userId}"]`
                    );
                    if (!td) return;

                    if (data.estado == 1) {
                        td.innerHTML = `
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                            Active
                        </span>
                    `;
                    } else {
                        td.innerHTML = `
                        <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                            Inactive
                        </span>
                    `;
                    }
                })
                .catch((error) => {
                    console.error("Error al actualizar estado:", error);
                });
        });
    });
});

/* ajax cambio de estate en category*/
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".toggle-estado").forEach(function (checkbox) {
        checkbox.addEventListener("change", function () {
            const categoriaId = this.dataset.id;
            const estado = this.checked ? 1 : 0;

            fetch(`/v1/categorias/${categoriaId}/toggle-estado`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({ estado }),
            })
                .then((response) => response.json())
                .then((data) => {
                    const td = document.querySelector(
                        `.estado-categoria[data-id="${categoriaId}"]`
                    );
                    if (!td) return;

                    if (data.estado == 1) {
                        td.innerHTML = `
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                            Active
                        </span>
                    `;
                    } else {
                        td.innerHTML = `
                        <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                            Inactive
                        </span>
                    `;
                    }
                })
                .catch((error) => {
                    console.error("Error al actualizar estado:", error);
                });
        });
    });
});

/* ajax cambio de estate en servicio*/
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".toggle-estado").forEach(function (checkbox) {
        checkbox.addEventListener("change", function () {
            const servicioId = this.dataset.id;
            const estado = this.checked ? 1 : 0;

            fetch(`/v1/servicios/${servicioId}/toggle-estado`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({ estado }),
            })
                .then((response) => response.json())
                .then((data) => {
                    const td = document.querySelector(
                        `.estado-servicio[data-id="${servicioId}"]`
                    );
                    if (!td) return;

                    if (data.estado == 1) {
                        td.innerHTML = `
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                            Active
                        </span>
                    `;
                    } else {
                        td.innerHTML = `
                        <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                            Inactive
                        </span>
                    `;
                    }
                })
                .catch((error) => {
                    console.error("Error al actualizar estado:", error);
                });
        });
    });
});

/*Define un componente Alpine.js que controla la apertura y cierre de un modal de confirmación para 
eliminar un rol, guarda el id del rol que se quiere eliminar.*/
function deleteRoleModal() {
    return {
        isModalOpen: false,
        roleIdToDelete: null,
        openModal(id) {
            this.roleIdToDelete = id;
            this.isModalOpen = true;
        },
        closeModal() {
            this.isModalOpen = false;
            this.roleIdToDelete = null;
        },
    };
}
