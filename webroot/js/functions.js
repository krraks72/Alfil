function toggleMenu() {
    document.getElementById("menuContent").classList.toggle("active");
}

document.addEventListener("DOMContentLoaded", function () {

    const menuContent = document.getElementById("menuContent");
    const menuToggle = document.getElementById("menuToggle");

    /* ============================
       CONTROL DE CLICKS EN MENÚ
    ============================ */
    if (menuContent) {

        menuContent.addEventListener("click", function (e) {

            /* CLICK EN DROPDOWN (NO CERRAR) */
            if (e.target.classList.contains("dropdown-toggle")) {
                e.preventDefault();

                // activar visualmente el dropdown
                document.querySelectorAll('.dropdown').forEach(d => d.classList.remove('active'));
                e.target.closest('.dropdown').classList.add('active');

                return; // 🚫 no cerrar menú
            }

            /* CLICK EN OPCIÓN FINAL (DECIDE SI CIERRA) */
            if (e.target.tagName === "A") {
                // 👉 si NO quieres que cierre aquí, comenta la siguiente línea
                // menuContent.classList.remove("active");
            }
        });
    }

    /* ============================
       CERRAR AL HACER CLICK FUERA
    ============================ */
    document.addEventListener("click", function (e) {
        if (
            menuContent &&
            menuContent.classList.contains("active") &&
            !menuContent.contains(e.target) &&
            !e.target.closest(".menu-toggle")
        ) {
            menuContent.classList.remove("active");
        }
    });

    document.querySelectorAll('.tecla').forEach(btn => {
        btn.addEventListener('click', () => {
            const campo = document.getElementById('campoDocumento');
            campo.value += btn.dataset.num || '';
        });
    });

    const borrarBtn = document.getElementById('borrar');
    if (borrarBtn) {
        borrarBtn.addEventListener('click', () => {
            const campo = document.getElementById('campoDocumento');
            campo.value = campo.value.slice(0, -1);
        });
    }

});

/*
function toggleMenu() {
    const menu = document.getElementById("menuContent");
    if (menu) {
        menu.classList.toggle("active");
    }
}*/