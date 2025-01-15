<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <section class="min-h-screen flex items-center justify-center">
        <div class="bg-white shadow-lg rounded-lg w-full max-w-lg p-6">
            <h2 class="text-2xl font-bold text-center mb-6">Créer un compte</h2>
            <form  method="POST" class="space-y-4">
                <!-- Nom -->
                <div>
                    <label for="nom" class="block text-gray-700 font-medium">Nom</label>
                    <input type="text" id="nom" name="nom" class="w-full mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Entrez votre nom" required>
                </div>
                <!-- Prénom -->
                <div>
                    <label for="prenom" class="block text-gray-700 font-medium">Prénom</label>
                    <input type="text" id="prenom" name="prenom" class="w-full mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Entrez votre prénom" required>
                </div>
                <!-- Email -->
                <div>
                    <label for="email" class="block text-gray-700 font-medium">Email</label>
                    <input type="email" id="email" name="email" class="w-full mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Entrez votre email" required>
                </div>
                <!-- Mot de passe -->
                <div>
                    <label for="passworde" class="block text-gray-700 font-medium">Mot de passe</label>
                    <input type="password" id="passworde" name="passworde" class="w-full mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Entrez un mot de passe sécurisé" required>
                </div>
                <!-- Rôle -->
                <div>
                    <label for="rolee" class="block text-gray-700 font-medium">Rôle</label>
                    <select id="rolee" name="rolee" class="w-full mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                        <option value="" disabled selected>Choisissez votre rôle</option>
                        <option value="Etudiant">Étudiant</option>
                        <option value="Enseignant">Enseignant</option>
                    </select>
                </div>
                <!-- Bouton d'inscription -->
                <div>
                    <button type="submit" class="w-full py-2 bg-gradient-to-r from-red-600 to-orange-500 text-white font-bold rounded-lg hover:opacity-90">S'inscrire</button>
                </div>
            </form>
            <p class="text-gray-600 text-center mt-4">
                Déjà un compte ? <a href="connexion.php" class="text-orange-500 font-medium hover:underline">Se connecter</a>
            </p>
        </div>
    </section>
</body>
</html>
