<?php
require_once('../database/connection.php');
require_once('../classes/AjouterTag.php');

$dbConnection = new DatabaseConnection();
$pdo = $dbConnection->getPDO();

$addTag = new AjouterTag();
$addTag->setPDO($pdo);

if (isset($_POST['submit'])) {
    if (isset($_POST['categorieName']) && !empty($_POST['categorieName'])) {
        $nom = $_POST['categorieName'];
        $addTag->setValeus($nom);
        $addTag->AddTag();
    } else {
        echo "<div id='message' style='color: red; background-color: #f8d7da; padding: 10px; border-radius: 5px;'>Veuillez entrer un nom de catégorie.</div>";
        echo "<script>
                setTimeout(() => {
                    const message = document.getElementById('message');
                    if (message) {
                        message.style.display = 'none';
                    }
                }, 3000); 
              </script>";
    }
}
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
                <a href="ValidationEnseignants.php" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg mb-1">
                    <i class="fas fa-user-check mr-3"></i> Validation Enseignants
                </a>
                <a href="GestionUtilisateurs.php" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg mb-1">
                    <i class="fas fa-users mr-3"></i> Gestion Utilisateurs
                </a>
                <a href="GestionContenus.php" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg mb-1">
                    <i class="fas fa-folder mr-3"></i> Gestion Contenus
                </a>
            </nav>
        </aside>

        <!-- Main Section -->
        <section class="pt-24 pb-12 md:pt-32 md:pb-20 ml-64">
            <div class="container mx-auto px-6">
                <div class="bg-white shadow-lg rounded-lg p-8 text-center max-w-xl mx-auto">
                    <h2 class="text-3xl font-bold text-yellow-500 mb-6 mt-6">Ajouter Tag</h2>
                    <form action="AjouterTag.php" method="POST" class="space-y-4">
                        <label class="block text-sm font-medium">Nom de la Tag</label>
                        <input type="text"  name="categorieName" class="w-full border rounded-lg px-4 py-2" required placeholder="Entrez le nom de la Tag">
                        <button type="submit" name="submit" class="px-6 py-3 bg-gradient-to-r from-red-600 to-orange-500 text-white rounded-lg hover:opacity-90">
                            Ajouter tag
                        </button><br>
                    </form>
                </div>
            </div>
            <?php $addTag->affichageTag(); ?>
        </section>
    </div>
</body>
</html>
