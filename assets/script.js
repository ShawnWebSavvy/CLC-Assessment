$(document).ready(function() {
    
    $('#register-form').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: 'register.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#message').html(response);
            }
        });
    });

    $('#login-form').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: 'login.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#message').html(response);
            }
        });
    });

    $('#vote-form').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: 'vote.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#message').html(response);
            }
        });
    });
});