<?php
session_start();
require_once('../database/connection.php');
require_once('../classes/login.php');
require_once('../classes/user.php');

if (isset($_POST['sub'])) {
    $email = $_POST['email'];
    $password = $_POST['password']; 
    if (!empty($email) && !empty($password)) {
        $LO_GIN = new Login($email, $password);
        $result = $LO_GIN->authenticate();  
        if ($result && isset($result['message'])) {
            echo $result['message']; 
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/login.js" defer></script> <!-- Fichier JavaScript pour la gestion des actions -->
</head>
<body class="bg-gray-50">
    <section class="min-h-screen flex items-center justify-center">
        <div class="bg-white shadow-lg rounded-lg w-full max-w-lg p-6">
            <h2 class="text-2xl font-bold text-center mb-6">Se connecter</h2>
            <form method="POST" id="login-form" class="space-y-4" autocomplete="off">
                <!-- Email -->
                <div>
                    <label for="email" class="block text-gray-700 font-medium">Email</label>
                    <input type="email" id="email" name="email" class="w-full mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Entrez votre email">
                    <span id="email-error" class="text-red-500 text-sm"></span>
                </div>
                <!-- Mot de passe -->
                <div>
                    <label for="password" class="block text-gray-700 font-medium">Mot de passe</label>
                    <input type="password" id="password" name="password" class="w-full mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Entrez votre mot de passe">
                    <span id="password-error" class="text-red-500 text-sm"></span>
                </div>
                <!-- Bouton de connexion -->
                <div>
                    <button type="submit" name="sub" class="w-full py-2 bg-gradient-to-r from-red-600 to-orange-500 text-white font-bold rounded-lg hover:opacity-90">Se connecter</button>
                </div>
            </form>
            <!-- Message de succès -->
            <p id="success-message" class="text-green-500 text-center mt-4"></p>
            <!-- Lien pour créer un compte -->
            <p class="text-center mt-4 text-gray-600">Vous n'avez pas de compte ? 
                <a href="inscription.php" class="text-orange-500 font-bold hover:underline">Créer un compte</a>
            </p>
        </div>
    </section>
</body>
</html>
