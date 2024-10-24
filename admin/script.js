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
        passwordError.textContent = 'Current password is required.';
        passwordError.style.display = 'block';
        return;
    }

    // Checking if new password is at least 6 characters long
    if (newPassword.length < 6) {
        passwordError.textContent = 'New password must be at least 6 characters long.';
        passwordError.style.display = 'block';
        return;
    }

    // Checking if new password and confirm password match
    if (newPassword !== confirmPassword) {
        passwordError.textContent = 'Passwords do not match.';
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

// Password visibility toggling
function toggleVisibility(toggleElement, inputElement) {
    toggleElement.addEventListener('click', function () {
        const type = inputElement.getAttribute('type') === 'password' ? 'text' : 'password';
        inputElement.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
}

toggleVisibility(document.querySelector('#toggleCurrentPassword'), currentPasswordInput);
toggleVisibility(document.querySelector('#toggleNewPassword'), newPasswordInput);
toggleVisibility(document.querySelector('#toggleConfirmPassword'), confirmPasswordInput);

// Setup for the "Change Password" Modal
var changePasswordAdminModal = document.getElementById('changePasswordAdminModal');

// เมื่อ modal ถูกแสดง (เปิด)
changePasswordAdminModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var id = button.getAttribute('data-id');
    var modalId = changePasswordAdminModal.querySelector('#change_password_admin_id');

    // Set the admin ID to the hidden input field
    modalId.value = id;
});

// เมื่อ modal ถูกปิด
changePasswordAdminModal.addEventListener('hidden.bs.modal', function () {
    // Reset the form when the modal is closed
    changePasswordAdminModal.querySelector('form').reset();

    // Optionally, reset password error message and button state
    passwordError.style.display = 'none'; // Hide error message
    changePasswordButton.disabled = true; // Disable the button
});
