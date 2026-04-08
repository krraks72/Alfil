
document.addEventListener('DOMContentLoaded', function () {

    function toggleField(checkboxId, fieldIds) {
        const checkbox = document.getElementById(checkboxId);

        if (!checkbox) {
            console.warn('No existe el checkbox:', checkboxId);
            return;
        }

        const fields = fieldIds
            .map(id => {
                const el = document.getElementById(id);
                //if (!el) console.warn('No existe el campo:', id);
                return el;
            })
            .filter(Boolean);

        function toggle() {
            if (checkbox.checked) {
                fields.forEach(f => f.disabled = false);
            } else {
                fields.forEach(f => {
                    f.disabled = true;
                    f.value = '';
                });
            }
        }

        toggle();
        checkbox.addEventListener('change', toggle);
    }

    // Prioridad
    toggleField('prioritaria', ['prioridade-id']); // 👈 corregido

    // Género
    toggleField('valida-genero', ['genero-id']);

    // Edad
    toggleField('valida-edad', ['edad-inicial', 'edad-final']);
});