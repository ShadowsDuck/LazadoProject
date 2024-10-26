// "Update Admin" Modal Setup
var updateAdminModal = document.getElementById('updateAdminModal');
updateAdminModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;

    var id = button.getAttribute('data-id');
    var fullname = button.getAttribute('data-fullname');
    var username = button.getAttribute('data-username');

    var modalFullname = updateAdminModal.querySelector('#update_fullname');
    var modalUsername = updateAdminModal.querySelector('#update_username');
    var modalId = updateAdminModal.querySelector('#update_admin_id');

    modalFullname.value = fullname;
    modalUsername.value = username;
    modalId.value = id;

    // Enable the update button in case it was disabled previously
    document.getElementById('updateAdminBtn').disabled = false;
});

// "Change Password" Modal Setup
const adminPasswordInput = document.getElementById('admin_password');
const currentPasswordInput = document.getElementById('current_password');
const newPasswordInput = document.getElementById('new_password');
const confirmPasswordInput = document.getElementById('confirm_password');
const changePasswordButton = document.getElementById('changePasswordBtn');
const passwordError = document.getElementById('passwordMismatchError');

// Function to validate passwords for the "Change Password" form
function validateChangePassword() {
    const currentPassword = currentPasswordInput.value.trim();
    const newPassword = newPasswordInput.value.trim();
    const confirmPassword = confirmPasswordInput.value.trim();

    // Resetting error message and button state
    passwordError.style.display = 'none';
    changePasswordButton.disabled = true; // Disable by default

    // Checking if current password is empty
    if (!currentPassword) {
        passwordError.textContent = 'จำเป็นต้องใส่รหัสผ่านปัจจุบัน';
        passwordError.style.display = 'block';
        return;
    }

    // Checking if new password is at least 6 characters long
    if (newPassword.length < 6) {
        passwordError.textContent = 'รหัสผ่านใหม่ต้องมีความยาวอย่างน้อย 6 ตัวอักษร';
        passwordError.style.display = 'block';
        return;
    }

    // Checking if new password and confirm password match
    if (newPassword !== confirmPassword) {
        passwordError.textContent = 'รหัสผ่านไม่ตรงกัน';
        passwordError.style.display = 'block';
        return;
    }

    // If everything is correct, enable the change password button
    changePasswordButton.disabled = false;
}

// Attach the event listeners for validating passwords
currentPasswordInput.addEventListener('input', validateChangePassword);
newPasswordInput.addEventListener('input', validateChangePassword);
confirmPasswordInput.addEventListener('input', validateChangePassword);

// เปิด-ปิด การดูรหัสผ่าน
function toggleVisibility(toggleElement, inputElement) {
    toggleElement.addEventListener('click', function () {
        const type = inputElement.getAttribute('type') === 'password' ? 'text' : 'password';
        inputElement.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
}

toggleVisibility(document.querySelector('#toggleAdminPassword'), adminPasswordInput);
toggleVisibility(document.querySelector('#toggleCurrentPassword'), currentPasswordInput);
toggleVisibility(document.querySelector('#toggleNewPassword'), newPasswordInput);
toggleVisibility(document.querySelector('#toggleConfirmPassword'), confirmPasswordInput);

// เมื่อ Modal Admin ถูกปิดค่าทุกอย่างใน Modal จะ Reset
var addAdminModal = document.getElementById('addAdminModal');
addAdminModal.addEventListener('hidden.bs.modal', function () {
    addAdminModal.querySelector('form').reset();

    const adminPasswordInput = document.getElementById('admin_password');
    const toggleAdminPassword = document.querySelector('#toggleAdminPassword');
    adminPasswordInput.setAttribute('type', 'password');
    toggleAdminPassword.classList.remove('fa-eye-slash');
});

// เมื่อ Modal Change Password ถูกปิดค่าทุกอย่างใน Modal จะ Reset
var changePasswordAdminModal = document.getElementById('changePasswordAdminModal');

changePasswordAdminModal.addEventListener('hidden.bs.modal', function () {
    changePasswordAdminModal.querySelector('form').reset();

    const currentPasswordInput = document.getElementById('current_password');
    const newPasswordInput = document.getElementById('new_password');
    const confirmPasswordInput = document.getElementById('confirm_password');

    currentPasswordInput.setAttribute('type', 'password');
    newPasswordInput.setAttribute('type', 'password');
    confirmPasswordInput.setAttribute('type', 'password');

    document.querySelector('#toggleCurrentPassword').classList.remove('fa-eye-slash');
    document.querySelector('#toggleNewPassword').classList.remove('fa-eye-slash');
    document.querySelector('#toggleConfirmPassword').classList.remove('fa-eye-slash');

    passwordError.style.display = 'none';
    changePasswordButton.disabled = true;
});
