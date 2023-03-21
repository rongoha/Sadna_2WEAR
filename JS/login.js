function submitLoginForm(event) {
    event.preventDefault();
    const email = document.getElementById("inputEmail").value;
    const password = document.getElementById("inputPassword").value;
    console.log("Email:", email);
    console.log("Password:", password);
}

document.getElementById("login-form").addEventListener("submit", submitLoginForm);

$(document).ready(function () {
    // Show registration form when register link is clicked
    $('#register-link').click(function () {
        $('#login-form').addClass('d-none');
        $('#register-form').removeClass('d-none');
    });
    // Show login form when login link is clicked
    $('#login-link').click(function () {
        $('#register-form').addClass('d-none');
        $('#login-form').removeClass('d-none');
    });
    // Submit login form
    $('#login-form').submit(function (event) {
        event.preventDefault(); // Prevent form from submitting normally
        // Perform AJAX login request
        $.ajax({
            url: 'login.php',
            type: 'post',
            data: $('#login-form').serialize(),
            dataType: 'json',
            success: function (response) {
                // Handle successful login
                alert('Login successful!');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Handle login error
                alert('Login failed: ' + errorThrown);
            }
        });
        $('#register-form').submit(function (event) {
            console.log("dsfdsfsfds");
            event.preventDefault(); // Prevent form from submitting normally
            // Perform AJAX registration request
            $.ajax({
                url: 'register.php',
                type: 'post',
                data: $('#register-form').serialize(),
                dataType: 'json',
                success: function (response) {
                    // Handle successful registration
                    alert('Registration successful!');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Handle registration error
                    alert('Registration failed: ' + errorThrown);
                }
            });
        });
    });
});
