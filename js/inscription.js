$.ajax({
    url: '', 
    type: 'POST',
    data: formData,
    dataType: 'json',
    success: function (response) {
        console.log(response); 
        if (response.success) {
            $('#success-message').text(response.message).fadeIn().delay(3000).fadeOut();
            $('#inscription-form')[0].reset();
        } else {
            $('#success-message').hide();
            if (response.errors) {
                $.each(response.errors, function (field, error) {
                    $(`#${field}-error`).text(error);
                });
            } else {
                alert(response.message || "Une erreur est survenue.");
            }
        }
    },
    error: function (xhr, status, error) {
        console.error("Erreur AJAX:", error);
        alert("Une erreur s'est produite. Veuillez réessayer.");
    }
});
