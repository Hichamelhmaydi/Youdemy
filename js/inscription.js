$(document).ready(function () {
    $('#inscription-form').submit(function (e) {
        e.preventDefault();

        $('.text-red-500').text('');
        $('#success-message').text('');

        $.ajax({
            url: 'inscription.php', 
            type: 'POST',
            data: $(this).serialize(), 
            dataType: 'json', 
            success: function (response) {
                if (response.success) {
                    $('#success-message').text(response.message);
                    $('#inscription-form')[0].reset();

                    if (response.redirect) {
                        window.location.href = response.redirect;
                    }
                } else if (response.errors) {
                    $('#nom-error').text(response.errors.nom);
                    $('#prenom-error').text(response.errors.prenom);
                    $('#email-error').text(response.errors.email);
                    $('#password-error').text(response.errors.passworde);
                    $('#role-error').text(response.errors.rolee);
                } else {
                    alert(response.message);
                }
            },
            error: function () {
                alert("Une erreur s'est produite lors de la soumission du formulaire.");
            }
        });
    });
});
