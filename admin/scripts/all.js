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

// ให้ข้อความ Alert หายไปหลังจาก 2 วินาที
setTimeout(() => {
    const alert = document.getElementById('session-alert');
    if (alert) {
        alert.classList.remove('show'); // ลบคลาส 'show' เพื่อซ่อน Alert
    }
}, 2000);