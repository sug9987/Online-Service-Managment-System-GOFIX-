function togglePassword(fieldId, eyeIconId) {
    let field = document.getElementById(fieldId);
    let eyeIcon = document.getElementById(eyeIconId);
    
    if (field.type === "password") {
        field.type = "text";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
    } else {
        field.type = "password";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
    }
}
