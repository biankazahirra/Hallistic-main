// Fungsi untuk menampilkan pesan kesalahan
function displayErrorMessage(message) {
    var errorMessage = document.getElementById('error-msg');
    errorMessage.innerHTML = message;
    errorMessage.style.display = 'block';
}

// Fungsi untuk mengirimkan data formulir login ke server
function submitLoginForm() {
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    // Kirim data formulir ke server menggunakan AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'login.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.status === 'error') {
                    displayErrorMessage(response.message);
                } else {
                    // Redirect ke halaman beranda jika login berhasil
                    window.location.href = 'home1.html';
                }
            } else {
                displayErrorMessage('Server error. Please try again later.');
            }
        }
    };
    xhr.send('email=' + email + '&password=' + password);
}

// Event listener untuk tombol submit
document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Mencegah formulir untuk melakukan submit biasa
    submitLoginForm(); // Panggil fungsi untuk mengirimkan data formulir
});
