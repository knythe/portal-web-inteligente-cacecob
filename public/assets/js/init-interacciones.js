/*accede a la interaccion "favorito" del servicio*/
document.addEventListener("DOMContentLoaded", function () {
    const btn = document.getElementById("btn-favorito");
    const texto = btn.querySelector("#btn-texto");

    btn.addEventListener("click", function (e) {
        e.preventDefault();

        fetch("{{ route('interacciones.favoritos') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
            body: JSON.stringify({
                servicio_id: btn.dataset.servicio,
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.estado === "marcado") {
                    texto.textContent = "Ya no me interesa";
                } else if (data.estado === "quitado") {
                    texto.textContent = "Me interesa";
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    });
});
