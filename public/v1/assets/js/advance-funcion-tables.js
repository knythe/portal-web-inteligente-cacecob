/*funcion de busqueda en tabla roles*/
document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("searchInput");
    const table = document.getElementById("rolesTable");
    const rows = table.querySelectorAll("tbody tr");

    input.addEventListener("keyup", function () {
        const query = input.value.toLowerCase();

        rows.forEach((row) => {
            const name =
                row.querySelector("td:nth-child(1)")?.innerText.toLowerCase() ||
                "";
            const description =
                row.querySelector("td:nth-child(2)")?.innerText.toLowerCase() ||
                "";
            const date =
                row.querySelector("td:nth-child(3)")?.innerText.toLowerCase() ||
                "";

            const match =
                name.includes(query) ||
                description.includes(query) ||
                date.includes(query);

            row.style.display = match ? "" : "none";
        });
    });
});
/*funcion de filtrado en tabla roles*/
document.addEventListener("DOMContentLoaded", function () {
    const checkboxes = document.querySelectorAll(".role-filter");
    const tableRows = document.querySelectorAll("#rolesTable tbody tr");

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", function () {
            const checkedRoles = Array.from(checkboxes)
                .filter((cb) => cb.checked)
                .map((cb) => cb.value.toLowerCase());

            tableRows.forEach((row) => {
                const name =
                    row
                        .querySelector("td:nth-child(1) .font-semibold")
                        ?.innerText.toLowerCase() || "";

                const shouldShow =
                    checkedRoles.length === 0 || checkedRoles.includes(name);
                row.style.display = shouldShow ? "" : "none";
            });
        });
    });
});
/*funcion de busqueda en tabla users*/
document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("searchInput");
    const table = document.getElementById("usersTable"); // sigue usando el mismo ID
    const rows = table.querySelectorAll("tbody tr");

    input.addEventListener("keyup", function () {
        const query = input.value.toLowerCase();

        rows.forEach((row) => {
            const name =
                row
                    .querySelector("td:nth-child(1) .font-semibold")
                    ?.innerText.toLowerCase() || "";
            const email =
                row
                    .querySelector("td:nth-child(1) .text-xs")
                    ?.innerText.toLowerCase() || "";
            const role =
                row.querySelector("td:nth-child(2)")?.innerText.toLowerCase() ||
                "";
            const status =
                row
                    .querySelector("td:nth-child(3) span")
                    ?.innerText.toLowerCase() || "";
            const date =
                row.querySelector("td:nth-child(4)")?.innerText.toLowerCase() ||
                "";

            const match =
                name.includes(query) ||
                email.includes(query) ||
                role.includes(query) ||
                status.includes(query) ||
                date.includes(query);

            row.style.display = match ? "" : "none";
        });
    });
});
/*funcion de filtrado en tabla users*/
document.addEventListener("DOMContentLoaded", function () {
    // Mostrar/ocultar el dropdown manualmente
    const dropdownBtn = document.getElementById("filterDropdownButton");
    const dropdown = document.getElementById("filterDropdown");

    dropdownBtn.addEventListener("click", () => {
        dropdown.classList.toggle("hidden");
    });

    // Filtro por estado
    const checkboxes = document.querySelectorAll(".user-filter");
    const tableRows = document.querySelectorAll("#usersTable tbody tr");

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", function () {
            const checkedStates = Array.from(checkboxes)
                .filter((cb) => cb.checked)
                .map((cb) => cb.value); // valores: "1" o "0"

            tableRows.forEach((row) => {
                const estadoSpan = row.querySelector("td:nth-child(3) span");
                const estadoTexto =
                    estadoSpan?.innerText.trim().toLowerCase() || "";
                const estadoValor = estadoTexto === "active" ? "1" : "0";

                const shouldShow =
                    checkedStates.length === 0 ||
                    checkedStates.includes(estadoValor);
                row.style.display = shouldShow ? "" : "none";
            });
        });
    });
});
/* ===== Búsqueda en tabla de categorías ===== */
document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("searchInput"); // tu <input>
    const table = document.getElementById("categoriasTable"); // nueva tabla
    const rows = table.querySelectorAll("tbody tr");

    input.addEventListener("keyup", function () {
        const query = input.value.toLowerCase();

        rows.forEach((row) => {
            const name =
                row
                    .querySelector("td:nth-child(1) .font-semibold")
                    ?.innerText.toLowerCase() || "";
            const desc =
                row.querySelector("td:nth-child(2)")?.innerText.toLowerCase() ||
                "";
            const state =
                row
                    .querySelector("td:nth-child(3) span")
                    ?.innerText.toLowerCase() || "";
            const date =
                row.querySelector("td:nth-child(4)")?.innerText.toLowerCase() ||
                "";

            const match =
                name.includes(query) ||
                desc.includes(query) ||
                state.includes(query) ||
                date.includes(query);

            row.style.display = match ? "" : "none";
        });
    });
});
/*funcion de filtrado en tabla categegorias*/
document.addEventListener("DOMContentLoaded", function () {
    // Mostrar/ocultar el dropdown manualmente
    const dropdownBtn = document.getElementById("filterDropdownButton");
    const dropdown = document.getElementById("filterDropdown");

    dropdownBtn.addEventListener("click", () => {
        dropdown.classList.toggle("hidden");
    });

    // Filtro por estado
    const checkboxes = document.querySelectorAll(".categoria-filter");
    const tableRows = document.querySelectorAll("#categoriasTable tbody tr");

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", function () {
            const checkedStates = Array.from(checkboxes)
                .filter((cb) => cb.checked)
                .map((cb) => cb.value); // valores: "1" o "0"

            tableRows.forEach((row) => {
                const estadoSpan = row.querySelector("td:nth-child(3) span");
                const estadoTexto =
                    estadoSpan?.innerText.trim().toLowerCase() || "";
                const estadoValor = estadoTexto === "active" ? "1" : "0";

                const shouldShow =
                    checkedStates.length === 0 ||
                    checkedStates.includes(estadoValor);
                row.style.display = shouldShow ? "" : "none";
            });
        });
    });
});
/* ==== Búsqueda en tabla de servicios ==== */
document.addEventListener("DOMContentLoaded", () => {
    const input = document.getElementById("searchInput"); // campo <input>
    const table = document.getElementById("serviciosTable"); // tu tabla
    const rows = table.querySelectorAll("tbody tr");

    input.addEventListener("keyup", () => {
        const query = input.value.toLowerCase();

        rows.forEach((row) => {
            /* --- columnas y atributo data-categoria --- */
            const titulo =
                row.querySelector("td:nth-child(1)")?.innerText.toLowerCase() ||
                "";
            const precio =
                row.querySelector("td:nth-child(2)")?.innerText.toLowerCase() ||
                "";
            const oferta =
                row.querySelector("td:nth-child(3)")?.innerText.toLowerCase() ||
                "";
            const modalidad =
                row.querySelector("td:nth-child(4)")?.innerText.toLowerCase() ||
                "";
            const horas =
                row.querySelector("td:nth-child(5)")?.innerText.toLowerCase() ||
                "";
            const fecha =
                row.querySelector("td:nth-child(6)")?.innerText.toLowerCase() ||
                "";
            const estado =
                row
                    .querySelector("td:nth-child(7) span")
                    ?.innerText.toLowerCase() || "";
            const categoria = (row.dataset.categoria || "").toLowerCase(); // si agregaste data-categoria

            /* --- coincide con la búsqueda? --- */
            const match =
                titulo.includes(query) ||
                precio.includes(query) ||
                oferta.includes(query) ||
                modalidad.includes(query) ||
                horas.includes(query) ||
                fecha.includes(query) ||
                estado.includes(query) ||
                categoria.includes(query);

            row.style.display = match ? "" : "none";
        });
    });
});
/*funcion de filtrado en tabla servicios*/
document.addEventListener("DOMContentLoaded", () => {
    /* ===== 1. Mostrar/ocultar el dropdown ===== */
    const dropdownBtn = document.getElementById("filterDropdownButton");
    const dropdown = document.getElementById("filterDropdown");
    dropdownBtn?.addEventListener("click", () =>
        dropdown.classList.toggle("hidden")
    );

    /* ===== 2. Elementos del filtro ===== */
    const catChecks = document.querySelectorAll(".categoria-filter"); // check de categorías
    const stateChecks = document.querySelectorAll(".servicio-filter"); // check de estado
    const rows = document.querySelectorAll("#serviciosTable tbody tr");

    /* ===== 3. Función que aplica ambos filtros ===== */
    function applyFilters() {
        const selectedCats = Array.from(catChecks)
            .filter((cb) => cb.checked)
            .map((cb) => cb.value.toLowerCase());

        const selectedStates = Array.from(stateChecks)
            .filter((cb) => cb.checked)
            .map((cb) => cb.value); // "1" o "0"

        rows.forEach((row) => {
            /* --- categoría de la fila (data-categoria) --- */
            const cat = (row.dataset.categoria || "").toLowerCase();

            /* --- estado de la fila (span en la 7ª columna) --- */
            const estadoSpan = row.querySelector("td:nth-child(7) span");
            const estadoTexto =
                estadoSpan?.innerText.trim().toLowerCase() || "";
            const estadoValor = estadoTexto === "active" ? "1" : "0";

            /* --- lógica: pasar ambos filtros --- */
            const catOK =
                selectedCats.length === 0 || selectedCats.includes(cat);
            const stateOK =
                selectedStates.length === 0 ||
                selectedStates.includes(estadoValor);

            row.style.display = catOK && stateOK ? "" : "none";
        });
    }

    /* ===== 4. Listeners ===== */
    catChecks.forEach((cb) => cb.addEventListener("change", applyFilters));
    stateChecks.forEach((cb) => cb.addEventListener("change", applyFilters));
});
/* ==== Búsqueda en tabla de clientes ==== */
document.addEventListener("DOMContentLoaded", () => {
    const input = document.getElementById("searchInput"); // <input>
    const table = document.getElementById("clientesTable"); // tu tabla
    const rows = table.querySelectorAll("tbody tr");

    input.addEventListener("keyup", () => {
        const query = input.value.toLowerCase();

        rows.forEach((row) => {
            /* --- columnas relevantes --- */
            const nombre =
                row
                    .querySelector("td:nth-child(1) .font-semibold")
                    ?.innerText.toLowerCase() || "";
            const email =
                row
                    .querySelector("td:nth-child(1) .text-xs")
                    ?.innerText.toLowerCase() || "";
            const dni =
                row.querySelector("td:nth-child(2)")?.innerText.toLowerCase() ||
                "";
            const telefono =
                row.querySelector("td:nth-child(3)")?.innerText.toLowerCase() ||
                "";
            const cargo =
                row.querySelector("td:nth-child(4)")?.innerText.toLowerCase() ||
                "";
            const estado =
                row
                    .querySelector("td:nth-child(5) span")
                    ?.innerText.toLowerCase() || "";
            const fecha =
                row.querySelector("td:nth-child(6)")?.innerText.toLowerCase() ||
                "";

            /* --- ¿hay coincidencia con la búsqueda? --- */
            const match =
                nombre.includes(query) ||
                email.includes(query) ||
                dni.includes(query) ||
                telefono.includes(query) ||
                cargo.includes(query) ||
                estado.includes(query) ||
                fecha.includes(query);

            row.style.display = match ? "" : "none";
        });
    });
});
/*funcion de filtrado en tabla clientes*/
/* ==== Filtrado por estado en tabla #clientesTable ==== */
document.addEventListener('DOMContentLoaded', () => {

    /* 1. Mostrar / ocultar el dropdown */
    const dropdownBtn = document.getElementById('filterDropdownButton');
    const dropdown    = document.getElementById('filterDropdown');
    dropdownBtn?.addEventListener('click', () => dropdown.classList.toggle('hidden'));

    /* 2. Chequeos y filas */
    const checkboxes = document.querySelectorAll('.cliente-filter');   // <input value="1|2|3|4">
    const rows       = document.querySelectorAll('#clientesTable tbody tr');

    /* 3. Aplica filtro cuando cambia cualquier checkbox */
    checkboxes.forEach(cb => cb.addEventListener('change', filtrar));
    function filtrar () {
        const seleccionados = Array.from(checkboxes)
                                    .filter(c => c.checked)
                                    .map(c => c.value);          // ["1", "3"] ...

        rows.forEach(row => {
            /* --- valor del estado en la fila --- */
            // a) Si agregaste data-estado en <tr>
            let valorEstado = row.dataset.estado;

            // b) O léelo del botón .estado-badge
            if (!valorEstado) {
                const badge = row.querySelector('.estado-badge');
                valorEstado = badge ? badge.dataset.estado : '';
            }

            /* --- decide mostrar / ocultar --- */
            const mostrar = seleccionados.length === 0 || seleccionados.includes(valorEstado);
            row.style.display = mostrar ? '' : 'none';
        });
    }

    /* 4. Si cambias el estado vía AJAX, actualiza data-estado para que el filtro siga funcionando */
    document.addEventListener('estadoActualizado', e => {
        const { idCliente, nuevoEstado } = e.detail;          // emitido desde tu script de cambio
        const fila = document.querySelector(`#clientesTable tr[data-id='${idCliente}']`);
        if (fila) fila.dataset.estado = nuevoEstado;
        filtrar();  // re-aplica filtro por si la fila quedó oculta/visible
    });
});
