// Main JavaScript file for CommunityLink application

document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap components
    initializeBootstrapComponents();
    
    // Initialize flash message auto-hide
    initializeFlashMessages();
    
    // Initialize form validations
    initializeFormValidations();
    
    // Initialize image preview for file uploads
    initializeImagePreviews();
});

/**
 * Initialize Bootstrap components like tooltips, popovers, etc.
 */
function initializeBootstrapComponents() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Initialize popovers
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="popover"]'));
    popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
}

/**
 * Initialize flash messages to auto-hide after a few seconds
 */
function initializeFlashMessages() {
    var flashMessages = document.querySelectorAll('.alert-dismissible');
    
    flashMessages.forEach(function(message) {
        // Auto-hide flash messages after 5 seconds
        setTimeout(function() {
            // Create a fade-out effect
            message.style.opacity = '1';
            (function fadeOut() {
                if ((message.style.opacity -= 0.1) < 0) {
                    message.style.display = 'none';
                } else {
                    setTimeout(fadeOut, 50);
                }
            })();
        }, 5000);
    });
}

/**
 * Initialize client-side form validations
 */
function initializeFormValidations() {
    var forms = document.querySelectorAll('.needs-validation');
    
    // Loop over forms and prevent submission if they're invalid
    Array.prototype.slice.call(forms).forEach(function(form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            form.classList.add('was-validated');
        }, false);
    });
}

/**
 * Initialize image previews for file upload inputs
 */
function initializeImagePreviews() {
    var fileInputs = document.querySelectorAll('input[type="file"]');
    
    fileInputs.forEach(function(input) {
        input.addEventListener('change', function(e) {
            var file = e.target.files[0];
            var previewId = input.getAttribute('data-preview');
            
            if (previewId && file) {
                var preview = document.getElementById(previewId);
                if (preview) {
                    var reader = new FileReader();
                    
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    };
                    
                    reader.readAsDataURL(file);
                }
            }
        });
    });
}

/**
 * Toggle password visibility in password fields
 */
function togglePasswordVisibility(inputId) {
    var passwordInput = document.getElementById(inputId);
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
    } else {
        passwordInput.type = 'password';
    }
}

/**
 * Confirm deletion with a custom confirmation dialog
 */
function confirmDelete(event, message) {
    if (!confirm(message || 'Are you sure you want to delete this item?')) {
        event.preventDefault();
        return false;
    }
    return true;
}

/**
 * Format date inputs to datetime-local format
 */
function formatDateTimeLocal(dateString) {
    if (!dateString) return '';
    
    var date = new Date(dateString);
    var year = date.getFullYear();
    var month = (date.getMonth() + 1).toString().padStart(2, '0');
    var day = date.getDate().toString().padStart(2, '0');
    var hours = date.getHours().toString().padStart(2, '0');
    var minutes = date.getMinutes().toString().padStart(2, '0');
    
    return `${year}-${month}-${day}T${hours}:${minutes}`;
}