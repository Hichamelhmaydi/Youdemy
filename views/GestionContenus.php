<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrateur - EduPlatform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-gray-200 fixed h-full">
            <div class="p-4 border-b">
                <h1 class="text-2xl font-bold bg-gradient-to-r from-red-600 to-orange-500 bg-clip-text text-transparent">
                    Youdemy
                </h1>
            </div>

            <nav class="p-4">
                <div class="mb-8">
                    <div class="flex items-center mb-4">
                        <img src="/api/placeholder/40/40" alt="Profile" class="w-10 h-10 rounded-full">
                        <div class="ml-3">
                            <p class="font-semibold">Admin User</p>
                            <p class="text-sm text-gray-500">Administrateur</p>
                        </div>
                    </div>
                </div>

                <a href="ValidationEnseignants.php" id="validateTeachersBtn" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg mb-1">
                    <i class="fas fa-user-check mr-3"></i>
                    Validation Enseignants
                </a>
                <a href="GestionUtilisateurs.php" id="manageUsersBtn" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg mb-1">
                    <i class="fas fa-users mr-3"></i>
                    Gestion Utilisateurs
                </a>
                <a href="GestionContenus.php" id="manageContentBtn" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg mb-1">
                    <i class="fas fa-folder mr-3"></i>
                    Gestion Contenus
                </a>
                <a href="Statistiques.php" id="statsBtn" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-chart-line mr-3"></i>
                    Statistiques
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="ml-64 flex-1 flex items-center justify-center">
            <div class="p-6 space-y-6 text-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Choisissez une action</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Gestion des Catégories -->
                    <a href="AjouterCategorie.php" class="px-6 py-4 bg-gradient-to-r from-red-600 to-orange-500 text-white rounded-lg shadow-md hover:opacity-90 transition">
                        <i class="fas fa-plus-circle mr-2"></i>
                        Ajouter une Catégorie
                    </a>
                    <a href="ModifierCategorie.php" class="px-6 py-4 bg-gradient-to-r from-red-600 to-orange-500 text-white rounded-lg shadow-md hover:opacity-90 transition">
                        <i class="fas fa-edit mr-2"></i>
                        Modifier une Catégorie
                    </a>
                    <a href="SupprimerCategorie.php" class="px-6 py-4 bg-gradient-to-r from-red-600 to-orange-500 text-white rounded-lg shadow-md hover:opacity-90 transition">
                        <i class="fas fa-trash mr-2"></i>
                        Supprimer une Catégorie
                    </a>

                    <!-- Gestion des Tags -->
                    <a href="AjouterTag.php" class="px-6 py-4 bg-gradient-to-r from-red-600 to-orange-500 text-white rounded-lg shadow-md hover:opacity-90 transition">
                        <i class="fas fa-plus-circle mr-2"></i>
                        Ajouter un Tag
                    </a>
                    <a href="ModifierTag.php" class="px-6 py-4 bg-gradient-to-r from-red-600 to-orange-500 text-white rounded-lg shadow-md hover:opacity-90 transition">
                        <i class="fas fa-edit mr-2"></i>
                        Modifier un Tag
                    </a>
                    <a href="SupprimerTag.php" class="px-6 py-4 bg-gradient-to-r from-red-600 to-orange-500 text-white rounded-lg shadow-md hover:opacity-90 transition">
                        <i class="fas fa-trash mr-2"></i>
                        Supprimer un Tag
                    </a>
                </div>

                <!-- Bouton supplémentaire -->
                <div class="mt-6">
                    <a href="SupprimerCours.php" class="px-6 py-4 bg-gradient-to-r from-red-600 to-orange-500 text-white rounded-lg shadow-md hover:opacity-90 transition">
                        <i class="fas fa-trash mr-2"></i>
                        Supprimer un Cours
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
