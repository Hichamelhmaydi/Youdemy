<?php 
session_start();
require_once('../database/connection.php');

class GestionUtilisateurs {
    protected $pdo;

    public function setPDO($pdo) {
        $this->pdo = $pdo;
    }

    public function afficheruser() {
        try {
            $stmtSelect = $this->pdo->prepare("SELECT * FROM user");
            $stmtSelect->execute();
            $users = $stmtSelect->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($users)) {
                echo "<div class='overflow-x-auto'>";
                echo "<table class='table-auto w-full border-collapse border border-gray-300 text-left'>";
                echo "<thead class='bg-gray-100'>";
                echo "<tr>
                        <th class='border border-gray-300 px-4 py-2'>ID</th>
                        <th class='border border-gray-300 px-4 py-2'>Nom</th>
                        <th class='border border-gray-300 px-4 py-2'>Prénom</th>
                        <th class='border border-gray-300 px-4 py-2'>Email</th>
                        <th class='border border-gray-300 px-4 py-2'>Role</th>
                        <th class='border border-gray-300 px-4 py-2'>Actions</th>
                      </tr>";
                echo "</thead>";
                echo "<tbody>";

                foreach ($users as $user) {
                    echo "<tr class='hover:bg-gray-50'>";
                    echo "<td class='border border-gray-300 px-4 py-2'>{$user['ID']}</td>";
                    echo "<td class='border border-gray-300 px-4 py-2'>{$user['nom']}</td>";
                    echo "<td class='border border-gray-300 px-4 py-2'>{$user['prenom']}</td>";
                    echo "<td class='border border-gray-300 px-4 py-2'>{$user['email']}</td>";
                    echo "<td class='border border-gray-300 px-4 py-2'>{$user['rolee']}</td>";
                    echo "<td class='border border-gray-300 px-4 py-2 flex space-x-2'>";

                    echo "<form method='post' class='inline-block'>
                            <input type='hidden' name='user' value='{$user['ID']}'>
                            <button type='submit' name='statut' value='active' class='bg-green-500 text-white p-2 rounded hover:bg-green-600'>
                                Activer
                            </button>
                          </form>";

                    echo "<form method='post' class='inline-block'>
                            <input type='hidden' name='user' value='{$user['ID']}'>
                            <button type='submit' name='statut' value='suspended' class='bg-yellow-500 text-white p-2 rounded hover:bg-yellow-600'>
                                Suspendre
                            </button>
                          </form>";

                    echo "<form method='post' class='inline-block'>
                            <input type='hidden' name='user' value='{$user['ID']}'>
                            <button type='submit' name='statut' value='pending' class='bg-gray-500 text-white p-2 rounded hover:bg-gray-600'>
                                Suppression
                            </button>
                          </form>";

                    echo "</td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            } else {
                echo "<p class='text-center text-gray-600'>Aucun utilisateur trouvé.</p>";
            }
        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage();
        }
    }

    public function updateStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user'], $_POST['statut'])) {
            $userId = $_POST['user'];
            $nouveauStatut = $_POST['statut'];
            try {
                $stmtUpdate = $this->pdo->prepare("UPDATE user SET statut = :statut WHERE ID = :id");
                $stmtUpdate->execute([':statut' => $nouveauStatut, ':id' => $userId]);
                echo "Le statut a été mis à jour avec succès.";
            } catch (PDOException $e) {
                echo "Erreur lors de la mise à jour du statut : " . $e->getMessage();
            }
        }
    }
        
}
?>
