document.addEventListener('alpine:init', () => {
    Alpine.data('formProgressBar', (formId) => ({
        progress: 0,

        init() {
            this.calculateProgress();

            // Écouter les changements dans le formulaire
            const form = document.getElementById(formId);
            if (form) {
                form.addEventListener('input', () => {
                    this.calculateProgress();
                });
                form.addEventListener('change', () => {
                    this.calculateProgress();
                });
            }
        },

        calculateProgress() {
            const form = document.getElementById(formId);
            if (!form) return;

            // Récupérer tous les champs requis
            const requiredFields = form.querySelectorAll('[required]');
            let totalRequired = 0;
            let filledRequired = 0;

            // Grouper par name pour éviter les doublons (radios/checkboxes)
            const uniqueFields = new Set();

            requiredFields.forEach(field => {
                const fieldName = field.name;

                if (!uniqueFields.has(fieldName)) {
                    uniqueFields.add(fieldName);
                    totalRequired++;

                    // Vérifier si le champ est rempli
                    if (field.type === 'checkbox' || field.type === 'radio') {
                        // Pour checkbox/radio, vérifier si au moins un est coché
                        const checked = form.querySelector(`[name="${fieldName}"]:checked`);
                        if (checked) filledRequired++;
                    } else {
                        // Pour les autres inputs (text, email, textarea, etc.)
                        if (field.value.trim() !== '') filledRequired++;
                    }
                }
            });

            // Calculer le pourcentage
            this.progress = totalRequired > 0
                ? Math.round((filledRequired / totalRequired) * 100)
                : 0;
        }
    }));
});
