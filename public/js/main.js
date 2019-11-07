(function () {
    const form = document.querySelector('.needs-validation');
        
    if (!form) return;

    form.addEventListener('submit', validateForm);

    function validateForm(event) {
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        
        form.classList.add('was-validated');
    }
})();