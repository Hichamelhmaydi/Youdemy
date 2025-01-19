<?php
require_once('../database/connection.php');
class Statistiques{
    protected $pdo;

    public function setPDO($pdo) {
        $this->pdo = $pdo;
    }
    public function usersStatistiqyes (){
        $stmtUsers=$this->pdo->prepare('SELECT COUNT(*) FROM user');
        $stmtUsers->execute();
        $userCount = $stmtUsers->fetchColumn();
            echo '<div class="container mx-auto px-6 mt-10">';
            echo '<div class="bg-white shadow-lg rounded-lg p-8 text-center">';
            echo '<h2 class="text-2xl font-bold text-yellow-500 mb-6">Statistiques des Utilisateurs</h2>';
            if ($userCount >= 0) {
                echo '<div class="text-center">';
                echo '<p class="text-lg font-semibold text-gray-700">Nombre total des utilisateurs</p>';
                echo '<span class="text-4xl font-bold text-green-600 mt-4">' . htmlspecialchars($userCount) . '</span>';
                echo '</div>';
            } else {
                echo '<p class="text-red-500">Erreur lors de la récupération des données.</p>';
            }
            echo '</div>';
            echo '</div>';
        }

        public function studentStatistiqyes (){
            $stmtUsers=$this->pdo->prepare('SELECT COUNT(*) FROM user WHERE rolee="Etudiant";');
            $stmtUsers->execute();
            $studentCount = $stmtUsers->fetchColumn();
                echo '<div class="container mx-auto px-6 mt-10">';
                echo '<div class="bg-white shadow-lg rounded-lg p-8 text-center">';
                echo '<h2 class="text-2xl font-bold text-yellow-500 mb-6">Statistiques des Utilisateurs</h2>';
                if ($studentCount >= 0) {
                    echo '<div class="text-center">';
                    echo '<p class="text-lg font-semibold text-gray-700">Nombre total des Etudiants</p>';
                    echo '<span class="text-4xl font-bold text-green-600 mt-4">' . htmlspecialchars($studentCount) . '</span>';
                    echo '</div>';
                } else {
                    echo '<p class="text-red-500">Erreur lors de la récupération des données.</p>';
                }
                echo '</div>';
                echo '</div>';
            }

            public function EnseignantStatistiqyes (){
                $stmtUsers=$this->pdo->prepare('SELECT COUNT(*) FROM user WHERE rolee="Enseignant";');
                $stmtUsers->execute();
                $EnseignantCount = $stmtUsers->fetchColumn();
                    echo '<div class="container mx-auto px-6 mt-10">';
                    echo '<div class="bg-white shadow-lg rounded-lg p-8 text-center">';
                    echo '<h2 class="text-2xl font-bold text-yellow-500 mb-6">Statistiques des Enseignant</h2>';
                    if ($EnseignantCount >= 0) {
                        echo '<div class="text-center">';
                        echo '<p class="text-lg font-semibold text-gray-700">Nombre total des Enseignant</p>';
                        echo '<span class="text-4xl font-bold text-green-600 mt-4">' . htmlspecialchars($EnseignantCount) . '</span>';
                        echo '</div>';
                    } else {
                        echo '<p class="text-red-500">Erreur lors de la récupération des données.</p>';
                    }
                    echo '</div>';
                    echo '</div>';
                }

                public function CoursStatistiqyes (){
                    $stmtUsers=$this->pdo->prepare('SELECT COUNT(*) FROM cours;');
                    $stmtUsers->execute();
                    $CourstCount = $stmtUsers->fetchColumn();
                        echo '<div class="container mx-auto px-6 mt-10">';
                        echo '<div class="bg-white shadow-lg rounded-lg p-8 text-center">';
                        echo '<h2 class="text-2xl font-bold text-yellow-500 mb-6">Statistiques des Cours</h2>';
                        if ($CourstCount >= 0) {
                            echo '<div class="text-center">';
                            echo '<p class="text-lg font-semibold text-gray-700">Nombre total des Enseignant</p>';
                            echo '<span class="text-4xl font-bold text-green-600 mt-4">' . htmlspecialchars($CourstCount) . '</span>';
                            echo '</div>';
                        } else {
                            echo '<p class="text-red-500">Erreur lors de la récupération des données.</p>';
                        }
                        echo '</div>';
                        echo '</div>';
                    }

}
?>