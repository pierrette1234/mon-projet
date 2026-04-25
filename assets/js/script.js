// Validation des formulaires
document.addEventListener('DOMContentLoaded', function() {
    // Validation du formulaire d'ajout
    const addForm = document.getElementById('addForm');
    if (addForm) {
        addForm.addEventListener('submit', function(e) {
            if (!validateAddForm()) {
                e.preventDefault();
            }
        });
    }

    // Validation du formulaire de modification
    const updateForm = document.getElementById('updateForm');
    if (updateForm) {
        updateForm.addEventListener('submit', function(e) {
            if (!validateUpdateForm()) {
                e.preventDefault();
            }
        });
    }

    // Confirmation de suppression
    const deleteLinks = document.querySelectorAll('.delete-link');
    deleteLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?')) {
                e.preventDefault();
            }
        });
    });
});

function validateAddForm() {
    const nom = document.getElementById('nom');
    const prenom = document.getElementById('prenom');
    const filiere = document.getElementById('filiere_id');
    
    let isValid = true;
    
    // Réinitialiser les messages d'erreur
    clearErrors();
    
    // Validation du nom
    if (!nom.value.trim()) {
        showError(nom, 'Le nom est requis');
        isValid = false;
    }
    
    // Validation du prénom
    if (!prenom.value.trim()) {
        showError(prenom, 'Le prénom est requis');
        isValid = false;
    }
    
    // Validation de la filière
    if (!filiere.value) {
        showError(filiere, 'Veuillez sélectionner une filière');
        isValid = false;
    }
    
    return isValid;
}

function validateUpdateForm() {
    const nom = document.getElementById('nom');
    const prenom = document.getElementById('prenom');
    const filiere = document.getElementById('filiere_id');
    
    let isValid = true;
    
    // Réinitialiser les messages d'erreur
    clearErrors();
    
    // Validation du nom
    if (!nom.value.trim()) {
        showError(nom, 'Le nom est requis');
        isValid = false;
    }
    
    // Validation du prénom
    if (!prenom.value.trim()) {
        showError(prenom, 'Le prénom est requis');
        isValid = false;
    }
    
    // Validation de la filière
    if (!filiere.value) {
        showError(filiere, 'Veuillez sélectionner une filière');
        isValid = false;
    }
    
    return isValid;
}

function showError(input, message) {
    // Créer l'élément d'erreur
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message';
    errorDiv.style.color = '#f5365c';
    errorDiv.style.fontSize = '14px';
    errorDiv.style.marginTop = '5px';
    errorDiv.textContent = message;
    
    // Ajouter après l'input
    input.parentNode.appendChild(errorDiv);
    
    // Ajouter une classe d'erreur à l'input
    input.style.borderColor = '#f5365c';
}

function clearErrors() {
    // Supprimer tous les messages d'erreur
    const errorMessages = document.querySelectorAll('.error-message');
    errorMessages.forEach(error => error.remove());
    
    // Réinitialiser les bordures
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.style.borderColor = '#e1e5eb';
    });
}

// Fonction pour afficher les messages de succès/erreur
function showMessage(type, message) {
    const messageDiv = document.createElement('div');
    messageDiv.className = `message ${type}`;
    messageDiv.textContent = message;
    
    // Insérer au début du conteneur
    const container = document.querySelector('.container');
    if (container) {
        container.insertBefore(messageDiv, container.firstChild);
        
        // Supprimer après 5 secondes
        setTimeout(() => {
            messageDiv.remove();
        }, 5000);
    }
}