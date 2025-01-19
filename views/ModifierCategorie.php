<?php
require_once('../database/connection.php');
require_once('../classes/ModifierCategorie.php');

$dbConnection = new DatabaseConnection();
$pdo = $dbConnection->getPDO();
$Categorie = new ModifierCategorie();
$Categorie->setPDO($pdo);
?>

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

                <a href="ValidationEnseignants.php" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg mb-1">
                    <i class="fas fa-user-check mr-3"></i> Validation Enseignants
                </a>
                <a href="GestionUtilisateurs.php" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg mb-1">
                    <i class="fas fa-users mr-3"></i> Gestion Utilisateurs
                </a>
                <a href="GestionContenus.php" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg mb-1">
                    <i class="fas fa-folder mr-3"></i> Gestion Contenus
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-chart-line mr-3"></i> Statistiques
                </a>
            </nav>
        </aside>
        
        <!-- Main Section -->
        <section class="pt-24 pb-12 md:pt-32 md:pb-20 ml-64 w-full"> 
            <div class="container mx-auto px-6">
                <?php $Categorie->render(); ?>
            </div>
        </section>
    </div>
</body>
</html>