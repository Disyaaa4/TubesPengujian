/**
 * Toggle Password Visibility
 * Menampilkan/menyembunyikan password input
 */
function togglePasswordVisibility() {
    const passwordInput = document.getElementById('passwordInput');
    const eyeIcon = document.getElementById('eyeIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        // Ubah icon menjadi eye-off
        eyeIcon.classList.add('opacity-50');
    } else {
        passwordInput.type = 'password';
        // Ubah icon kembali menjadi eye
        eyeIcon.classList.remove('opacity-50');
    }
}

/**
 * Form validation
 */
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            const username = document.querySelector('input[name="username"]');
            const password = document.querySelector('input[name="password"]');
            
            // Validasi basic
            if (!username.value.trim()) {
                e.preventDefault();
                alert('Username tidak boleh kosong');
                return false;
            }
            
            if (!password.value.trim()) {
                e.preventDefault();
                alert('Password tidak boleh kosong');
                return false;
            }
            
            if (password.value.length < 6) {
                e.preventDefault();
                alert('Password minimal 6 karakter');
                return false;
            }
        });
    }
});
