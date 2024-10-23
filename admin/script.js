// เมื่อ modal จะถูกแสดง
var updateAdminModal = document.getElementById('updateAdminModal');
updateAdminModal.addEventListener('show.bs.modal', function (event) {
    // ปุ่มที่กดเปิด modal
    var button = event.relatedTarget;

    // ดึงข้อมูลจาก data-* attributes
    var id = button.getAttribute('data-id');
    var fullname = button.getAttribute('data-fullname');
    var username = button.getAttribute('data-username');

    // หา element ของ input fields ใน modal
    var modalFullname = updateAdminModal.querySelector('#update_fullname');
    var modalUsername = updateAdminModal.querySelector('#update_username');
    var modalId = updateAdminModal.querySelector('#update_admin_id');

    // ตั้งค่า value ให้ input fields
    modalFullname.value = fullname;
    modalUsername.value = username;
    modalId.value = id;
});

// JavaScript to check password match and empty fields
const newPasswordInput = document.getElementById('new_password');
const confirmPasswordInput = document.getElementById('confirm_password');
const updateButton = document.getElementById('updateAdminBtn');
const passwordError = document.getElementById('passwordMismatchError');

// Function to check if passwords match and are not empty
function checkPasswords() {
    const newPasswordValue = newPasswordInput.value.trim();
    const confirmPasswordValue = confirmPasswordInput.value.trim();

    if (newPasswordValue === confirmPasswordValue && newPasswordValue !== '' && confirmPasswordValue !== '') {
        passwordError.style.display = 'none'; // Hide error message
        updateButton.disabled = false; // Enable the button
    } else {
        passwordError.style.display = 'block'; // Show error message
        updateButton.disabled = true; // Disable the button
    }
}

// Add event listeners to both password fields
newPasswordInput.addEventListener('input', checkPasswords);
confirmPasswordInput.addEventListener('input', checkPasswords);

// Toggle visibility for current password
const toggleCurrentPassword = document.querySelector('#toggleCurrentPassword');
const currentPassword = document.querySelector('#current_password');

toggleCurrentPassword.addEventListener('click', function () {
    // Toggle the type attribute
    const type = currentPassword.getAttribute('type') === 'password' ? 'text' : 'password';
    currentPassword.setAttribute('type', type);
    // Toggle the eye icon
    this.classList.toggle('fa-eye-slash');
});

// Existing code for new password and confirm password toggles
const toggleNewPassword = document.querySelector('#toggleNewPassword');
const newPassword = document.querySelector('#new_password');

toggleNewPassword.addEventListener('click', function () {
    const type = newPassword.getAttribute('type') === 'password' ? 'text' : 'password';
    newPassword.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});

const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
const confirmPassword = document.querySelector('#confirm_password');

toggleConfirmPassword.addEventListener('click', function () {
    const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
    confirmPassword.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});