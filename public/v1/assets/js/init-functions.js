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

/*funcion para mostrar graficos dashboard*/
document.addEventListener("DOMContentLoaded", function () {
    // === BARRAS ===
    if (document.getElementById("clientesSemanaChart")) {
        new Chart(document.getElementById("clientesSemanaChart"), {
            type: "bar",
            data: {
                labels: window.labelsSemana,
                datasets: [
                    {
                        label: "Total clients",
                        data: window.clientesPorDia,
                        backgroundColor: "#14b8a6",
                        borderColor: "#0f766e",
                        borderWidth: 1,
                    },
                ],
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 },
                    },
                },
            },
        });
    }

    // === LÍNEAS ===
    if (document.getElementById("clientesLineChart")) {
        new Chart(document.getElementById("clientesLineChart"), {
            type: "line",
            data: {
                labels: window.labelsMeses,
                datasets: [
                    {
                        label: "Contactados",
                        data: window.interesadosData,
                        borderColor: "#14b8a6",
                        backgroundColor: "rgba(20, 184, 166, 0.2)",
                        tension: 0.4,
                    },
                    {
                        label: "No interesados",
                        data: window.noInteresadosData,
                        borderColor: "#7c3aed",
                        backgroundColor: "rgba(124, 58, 237, 0.2)",
                        tension: 0.4,
                    },
                ],
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 },
                    },
                },
            },
        });
    }
});

/* funcion para descargar grafico en imagen png*/
function descargarGrafico(canvasId, filename) {
    const canvas = document.getElementById(canvasId);
    const enlace = document.createElement("a");
    enlace.href = canvas.toDataURL("image/png");
    enlace.download = `${filename}.png`;
    enlace.click();
}
/*funcion para cambiar estado del cliente*/
document.addEventListener('DOMContentLoaded', () => {
    const estados = {
        1: {
            texto: 'Visitante',
            clases: 'px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100',
        },
        2: {
            texto: 'Interesado',
            clases: 'px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600',
        },
        3: {
            texto: 'No interesado',
            clases: 'px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700',
        },
        4: {
            texto: 'Contacto',
            clases: 'px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:text-gray-100 dark:bg-gray-700',
        }
    };

    // Toggle dropdown de cambio de estado
    document.querySelectorAll('.estado-badge').forEach(badge => {
        badge.addEventListener('click', () => {
            // Cierra cualquier otro dropdown abierto
            document.querySelectorAll('.estado-options').forEach(opt => opt.classList.add('hidden'));
            badge.nextElementSibling.classList.toggle('hidden');
        });
    });

    // Evento de selección de nuevo estado
    document.querySelectorAll('.estado-options button').forEach(btn => {
        btn.addEventListener('click', () => {
            const idCliente = btn.dataset.id;
            const nuevoEstado = btn.dataset.estado;
            const fila = btn.closest('tr');
            const badge = fila.querySelector('.estado-badge');
            const opciones = fila.querySelector('.estado-options');

            // Opcional: petición AJAX para guardar en backend
            fetch(`/v1/clientes/${idCliente}/estado`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ estado: nuevoEstado })
            })
            .then(res => res.json())
            .then(() => {
                // Actualiza visualmente
                badge.textContent = estados[nuevoEstado].texto;
                badge.className = `estado-badge ${estados[nuevoEstado].clases}`;
                badge.dataset.estado = nuevoEstado;
                fila.dataset.estado = nuevoEstado;
                opciones.classList.add('hidden');

                // Opcional: dispara evento para filtro
                const evento = new CustomEvent('estadoActualizado', {
                    detail: { idCliente, nuevoEstado }
                });
                document.dispatchEvent(evento);
            });
        });
    });

    // Cierre global al hacer clic fuera
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.estado-badge') && !e.target.closest('.estado-options')) {
            document.querySelectorAll('.estado-options').forEach(opt => opt.classList.add('hidden'));
        }
    });
});

