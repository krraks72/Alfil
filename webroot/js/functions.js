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

    const borrarBtn = document.getElementById('borrar');
    const campoDocumento = document.getElementById('campoDocumento');

    if (borrarBtn && campoDocumento) {
        borrarBtn.addEventListener('click', () => {
            if (campoDocumento.value.length > 0) {
                campoDocumento.value = campoDocumento.value.slice(0, -1);
            }
        });
    } else {
        console.warn('El botón borrar o el campo documento no se encontraron en el DOM.');
    }

});

function toggleMenu() {
    const menu = document.getElementById("menuContent");
    if (menu) {
        menu.classList.toggle("active");
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const teclaOk = document.querySelector('.tecla-ok');
    const formDocumento = document.getElementById('formDocumento');

    if (teclaOk && formDocumento) {
        teclaOk.addEventListener('click', function () {
            formDocumento.submit();
        });
    } else {
        console.warn('El botón OK o el formulario no se encontraron en el DOM.');
    }

    const teclas = document.querySelectorAll('.tecla');
    if (teclas.length > 0 && campoDocumento) {
        teclas.forEach(btn => {
            btn.addEventListener('click', () => {
                campoDocumento.value += btn.dataset.num || '';
            });
        });
    } else {
        console.warn('No se encontraron botones de teclado numérico o el campo documento no está en el DOM.');
    }
});
