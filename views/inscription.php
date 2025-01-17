<?php
require_once('../database/connection.php');
require_once('../classes/inscription.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $passworde = $_POST['passworde'];
    $rolee = $_POST['rolee'];

    $isValid = true;
    $response = [];

    if (empty($nom)) {
        $errors['nom'] = "Le champ nom est obligatoire.";
    }
    if (empty($prenom)) {
        $errors['prenom'] = "Le champ prénom est obligatoire.";
    }
    if (empty($email)) {
        $errors['email'] = "Le champ email est obligatoire.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Le format de l'email est invalide.";
    }
    if (empty($passworde)) {
        $errors['passworde'] = "Le champ mot de passe est obligatoire.";
    }
    if (empty($rolee)) {
        $errors['rolee'] = "Le champ rôle est obligatoire.";
    }

    if (!empty($errors)) {
        return ['success' => false, 'errors' => $errors];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pdo = (new DatabaseConnection())->getPDO();
        $inscrire = new Inscription($nom, $prenom, $email, $passworde, $rolee);
        if ($inscrire->inscrire()) {
            header('Location:login.php');
            exit; 
        } else {
            $response['errors']['general_error'] = "Erreur lors de l'inscription. Veuillez réessayer.";
        }
    }
    

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/inscription.js" defer></script>
</head>
<body class="bg-gray-50">
    <section class="min-h-screen flex items-center justify-center">
        <div class="bg-white shadow-lg rounded-lg w-full max-w-lg p-6">
            <h2 class="text-2xl font-bold text-center mb-6">Créer un compte</h2>
            <form id="inscription-form" class="space-y-4" autocomplete="off">
                <!-- Nom -->
                <div>
    <label for="nom" class="block text-gray-700 font-medium">Nom</label>
    <input type="text" id="nom" name="nom" class="w-full mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Entrez votre nom">
    <span id="nom-error" class="text-red-500 text-sm"></span>
</div>
<div>
    <label for="prenom" class="block text-gray-700 font-medium">Prénom</label>
    <input type="text" id="prenom" name="prenom" class="w-full mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Entrez votre prénom">
    <span id="prenom-error" class="text-red-500 text-sm"></span>
</div>
<div>
    <label for="email" class="block text-gray-700 font-medium">Email</label>
    <input type="email" id="email" name="email" class="w-full mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Entrez votre email">
    <span id="email-error" class="text-red-500 text-sm"></span>
</div>
<div>
    <label for="passworde" class="block text-gray-700 font-medium">Mot de passe</label>
    <input type="password" id="passworde" name="passworde" class="w-full mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Entrez un mot de passe sécurisé">
    <span id="password-error" class="text-red-500 text-sm"></span>
</div>
<div>
    <label for="rolee" class="block text-gray-700 font-medium">Rôle</label>
    <select id="rolee" name="rolee" class="w-full mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
        <option value="" disabled selected>Choisissez votre rôle</option>
        <option value="Etudiant">Étudiant</option>
        <option value="Enseignant">Enseignant</option>
    </select>
    <span id="role-error" class="text-red-500 text-sm"></span>
</div>

                <div>
                    <button type="submit" name="submit"class="w-full py-2 bg-gradient-to-r from-red-600 to-orange-500 text-white font-bold rounded-lg hover:opacity-90">S'inscrire</button>
                </div>
            </form>
            <p id="success-message" class="text-green-500 text-center mt-4"></p>
        </div>
    </section>
</body>
</html>
