<?php
require_once('../database/connection.php');


class AjouterCategorie {
    protected $pdo;
    private $nom;

    public function setPDO($pdo) {
        $this->pdo = $pdo;
    }

    public function setValeus($nom) {
        $this->nom = htmlspecialchars($nom);  
    }


  public function affichageCategorie() {
    $stmtselect = $this->pdo->prepare('SELECT * FROM categorie');
    $stmtselect->execute();
    $result = $stmtselect->fetchAll(PDO::FETCH_ASSOC);

    echo '<div class="container mx-auto px-6 mt-10">';
    echo '<div class="bg-white shadow-lg rounded-lg p-8 text-center">';
    echo '<h2 class="text-2xl font-bold text-yellow-500 mb-6">Liste des Catégories</h2>';

    if (!empty($result)) {
        echo '<table class="w-full table-auto border-collapse border border-gray-200">';
        echo '<thead class="bg-gray-100">';
        echo '<tr>';
        echo '<th class="border border-gray-300 px-4 py-2 text-gray-700">ID</th>';
        echo '<th class="border border-gray-300 px-4 py-2 text-gray-700">Nom de la Catégorie</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        foreach ($result as $categorie) {
            echo '<tr class="hover:bg-gray-100">';
            echo '<td class="border border-gray-300 px-4 py-2">' . htmlspecialchars($categorie['ID']) . '</td>';
            echo '<td class="border border-gray-300 px-4 py-2">' . htmlspecialchars($categorie['nom']) . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p class="text-red-500">Aucune catégorie disponible.</p>';
    }

    echo '</div>';
    echo '</div>';
}

    

    public function AddCategorie() {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM categorie WHERE nom = ?");
        $stmt->bindParam(1, $this->nom, PDO::PARAM_STR);
        $stmt->execute();
        $nom_caexists = $stmt->fetchColumn();
        
        if ($nom_caexists > 0) {
            echo "<div id='message' style='color: red; background-color: #f8d7da; padding: 10px; border-radius: 5px;'>
                    Ce nom déjà existant
                  </div>";
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO categorie (nom) VALUES (?)");
            $stmt->bindParam(1, $this->nom, PDO::PARAM_STR);
            $stmt->execute();
            echo "<div id='message' style='color: green; background-color: #d4edda; padding: 10px; border-radius: 5px;'>
                    Catégorie ajoutée avec succès
                  </div>";
        }
    
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