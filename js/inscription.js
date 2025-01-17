$(document).ready(function () {
    $('#inscription-form').submit(function (e) {
        e.preventDefault();

        // Réinitialisation des messages d'erreur
        $('.text-red-500').text('');
        $('#success-message').text('');

        $.ajax({
            url: 'inscription.php', // Le fichier PHP qui gère l'inscription
            type: 'POST',
            data: $(this).serialize(), // Sérialiser le formulaire
            dataType: 'json', // Type de réponse attendu
            success: function (response) {
                if (response.success) {
                    // Affichage du message de succès
                    $('#success-message').text(response.message);
                    $('#inscription-form')[0].reset();

                    // Si une redirection est spécifiée dans la réponse
                    if (response.redirect) {
                        // Effectuer la redirection côté client
                        window.location.href = response.redirect;
                    }
                } else if (response.errors) {
                    // Affichage des erreurs côté formulaire
                    $('#nom-error').text(response.errors.nom);
                    $('#prenom-error').text(response.errors.prenom);
                    $('#email-error').text(response.errors.email);
                    $('#password-error').text(response.errors.passworde);
                    $('#role-error').text(response.errors.rolee);
                } else {
                    // Affichage d'un message d'erreur générique
                    alert(response.message);
                }
            },
            error: function () {
                alert("Une erreur s'est produite lors de la soumission du formulaire.");
            }
        });
    });
});
