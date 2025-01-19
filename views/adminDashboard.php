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
        <main class="ml-64 flex-1">
            <!-- Top Bar -->
            <header class="bg-white border-b border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold">Tableau de bord Administrateur</h2>
                </div>
            </header>

            <!-- Content Area -->
            <div class="p-6">
                <!-- Validation des Enseignants -->
                <div id="validateTeachersView" class="space-y-6 hidden">
                    <h3 class="text-2xl font-bold">Validation des Comptes Enseignants</h3>
                    <div id="teacherRequests" class="space-y-4">
                        <!-- Requests will be dynamically inserted here -->
                    </div>
                </div>

                <!-- Gestion des Utilisateurs -->
                <div id="manageUsersView" class="space-y-6 hidden">
                    <h3 class="text-2xl font-bold">Gestion des Utilisateurs</h3>
                    <div id="userList" class="space-y-4">
                        <!-- User management list -->
                    </div>
                </div>

                <!-- Gestion des Contenus -->
                <div id="manageContentView" class="space-y-6 hidden">
                    <h3 class="text-2xl font-bold">Gestion des Contenus</h3>
                    <form id="addTagsForm" class="space-y-4">
                        <div>
                            <label for="tagsInput" class="block text-sm font-medium">Ajouter des Tags</label>
                            <textarea id="tagsInput" rows="3" class="w-full border rounded-lg px-4 py-2" placeholder="Ex: Développement, Design, Marketing"></textarea>
                        </div>
                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-red-600 to-orange-500 text-white rounded-lg hover:opacity-90">
                            Ajouter Tags
                        </button>
                    </form>
                </div>

                <!-- Statistiques -->
                <div id="statsView" class="space-y-6 hidden">
                    <h3 class="text-2xl font-bold">Statistiques Globales</h3>
                    <p class="text-lg">Nombre total de cours : <span id="totalCourses">0</span></p>
                    <p class="text-lg">Répartition par catégorie :</p>
                    <div id="categoryStats" class="space-y-2">
                        <!-- Categories will be dynamically inserted here -->
                    </div>
                    <p class="text-lg">Cours avec le plus d'étudiants : <span id="topCourse">N/A</span></p>
                    <p class="text-lg">Top 3 Enseignants :</p>
                    <ul id="topTeachers" class="list-disc ml-6">
                        <!-- Top teachers will be dynamically inserted here -->
                    </ul>
                </div>
            </div>
        </main>
    </div>

    <script src="adminDashboard.js"></script>
</body>
</html>