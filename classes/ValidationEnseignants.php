<?php
require_once('../database/connection.php');

class ValidationEnseignants {
    protected $pdo;

    public function setPDO($pdo) {
        $this->pdo = $pdo;
    }


    public function validation() {
        $stmtSelect = $this->pdo->prepare("SELECT * FROM user WHERE rolee = 'Enseignant' AND status_inscri = 'en attent'");
        $stmtSelect->execute();
        $enseignants = $stmtSelect->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($enseignants)) {
            echo "<div class='overflow-x-auto'>";
            echo "<table class='table-auto w-full border-collapse border border-gray-300 text-left'>";
            echo "<thead class='bg-gray-100'>";
            echo "<tr>
                    <th class='border border-gray-300 px-4 py-2'>ID</th>
                    <th class='border border-gray-300 px-4 py-2'>Nom</th>
                    <th class='border border-gray-300 px-4 py-2'>Prénom</th>
                    <th class='border border-gray-300 px-4 py-2'>Email</th>
                    <th class='border border-gray-300 px-4 py-2'>Actions</th>
                  </tr>";
            echo "</thead>";
            echo "<tbody>";
        
            foreach ($enseignants as $enseignant) {
                echo "<tr class='hover:bg-gray-50'>";
                echo "<td class='border border-gray-300 px-4 py-2'>{$enseignant['ID']}</td>";
                echo "<td class='border border-gray-300 px-4 py-2'>{$enseignant['nom']}</td>";
                echo "<td class='border border-gray-300 px-4 py-2'>{$enseignant['prenom']}</td>";
                echo "<td class='border border-gray-300 px-4 py-2'>{$enseignant['email']}</td>";
                echo "<td class='border border-gray-300 px-4 py-2 flex space-x-2'>";
                // Formulaire pour accepter
                echo "<form method='post' class='inline-block'>
                        <input type='hidden' name='enseignant_id' value='{$enseignant['ID']}'>
                        <button type='submit' name='action' value='confirm' class='bg-green-500 text-white p-2 rounded hover:bg-green-600'>
                            <svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' viewBox='0 0 20 20' fill='currentColor'>
                                <path fill-rule='evenodd' d='M16.707 5.293a1 1 0 010 1.414L8.414 15l-4.121-4.12a1 1 0 111.414-1.415L8.414 13.17l7.293-7.293a1 1 0 011.414 0z' clip-rule='evenodd' />
                            </svg>
                        </button>
                      </form>";
                // Formulaire pour rejeter
                echo "<form method='post' class='inline-block'>
                        <input type='hidden' name='enseignant_id' value='{$enseignant['ID']}'>
                        <button type='submit' name='action' value='reject' class='bg-red-500 text-white p-2 rounded hover:bg-red-600'>
                            <svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' viewBox='0 0 20 20' fill='currentColor'>
                                <path fill-rule='evenodd' d='M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 10-1.414-1.414L10 9.586 7.707 7.293a1 1 0 00-1.414 1.414L8.586 11l-2.293 2.293a1 1 0 001.414 1.414L10 12.414l2.293 2.293a1 1 0 001.414-1.414L11.414 11l2.293-2.293z' clip-rule='evenodd' />
                            </svg>
                        </button>
                      </form>";
                echo "</td>";
                echo "</tr>";
            }
        
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        } else {
            echo "<p class='text-center text-gray-600'>Aucun enseignant trouvé.</p>";
        }
        
      
    }

    public function handlePost() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enseignant_id'], $_POST['action'])) {
            $enseignantId = $_POST['enseignant_id'];
            $action = $_POST['action'];

            if ($action === 'confirm') {
                $stmtUpdate = $this->pdo->prepare("UPDATE user SET status_inscri = 'ok' WHERE ID = ?");
                $stmtUpdate->execute([$enseignantId]);
                echo "L'enseignant avec l'ID $enseignantId a été confirmé.";
            } elseif ($action === 'reject') {
                $stmtUpdate = $this->pdo->prepare("UPDATE user SET status_inscri = 'no' WHERE ID = ?");
                $stmtUpdate->execute([$enseignantId]);
                echo "L'enseignant avec l'ID $enseignantId a été rejeté.";
            }
        }
    }
}
?>
