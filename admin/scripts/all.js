// JavaScript for Validation
document.addEventListener('DOMContentLoaded', function () {
    console.log('DOM fully loaded and parsed');
    (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
});

document.addEventListener("DOMContentLoaded", function () {
    fetch('session_message.php')
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                Swal.fire({
                    toast: true,
                    icon: data.icon,
                    title: data.message,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });
            }
        })
        .catch(error => console.error('เกิดข้อผิดพลาด!:', error));
});
