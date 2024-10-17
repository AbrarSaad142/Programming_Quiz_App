function logout() {
    $.ajax({
        url: 'logout.php',
        method: 'POST',
        success: function() {
            window.location.href = 'index-page.html';
        },
        error: function() {
            alert('Logout failed. Please try again.');
        }
    });
}
