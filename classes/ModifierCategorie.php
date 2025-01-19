<?php
class ModifierCategorie {
    private $pdo;

    public function setPDO($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllCategories() {
        $stmt = $this->pdo->prepare("SELECT * FROM categorie");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM categorie WHERE ID = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateCategory($ID, $nom) {
        $stmt = $this->pdo->prepare("UPDATE categorie SET nom = ? WHERE ID = ?");
        $stmt->bindParam(1, $nom, PDO::PARAM_STR);
        $stmt->bindParam(2, $ID, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function render() {
        if (!isset($_POST['edit']) && !isset($_POST['update'])) {
            $categories = $this->getAllCategories();
            echo '<h1 class="text-2xl font-bold text-center my-6">Liste des catégories</h1>';
            echo '<table class="table-auto border-collapse border border-gray-300 mx-auto w-full max-w-5xl text-center">'; 
            echo '<thead class="bg-gray-100">';
            echo '<tr><th class="border border-gray-300 px-6 py-3">ID</th><th class="border border-gray-300 px-6 py-3">Nom de catégorie</th><th class="border border-gray-300 px-6 py-3">Modifier</th></tr>';
            echo '</thead>';
            echo '<tbody>';
            foreach ($categories as $category) {
                echo '<tr class="hover:bg-gray-50">';
                echo '<td class="border border-gray-300 px-6 py-3">' . htmlspecialchars($category['ID']) . '</td>';
                echo '<td class="border border-gray-300 px-6 py-3">' . htmlspecialchars($category['nom']) . '</td>';
                echo '<td class="border border-gray-300 px-6 py-3">';
                echo '<form method="POST" style="display: inline;">';
                echo '<input type="hidden" name="category_id" value="' . htmlspecialchars($category['ID']) . '">';
                echo '<button type="submit" name="edit" class="px-6 py-3 bg-gradient-to-r from-red-600 to-orange-500 text-white rounded shadow-md hover:opacity-90 transition">
                        Modifier
                      </button>';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        }
    
        if (isset($_POST['edit'])) {
            if (isset($_POST['category_id'])) {
                $category = $this->getCategoryById($_POST['category_id']);
                if ($category) {
                    echo '<h1 class="text-2xl font-bold text-center my-6">Modifier la catégorie</h1>';
                    echo '<form method="POST" class="w-1/2 mx-auto bg-white p-6 rounded shadow-md">';
                    echo '<input type="hidden" name="category_id" value="' . htmlspecialchars($category['ID']) . '">';
                    echo '<div class="mb-4">';
                    echo '<label for="category_name" class="block text-gray-700 font-bold mb-2">Nom de catégorie:</label>';
                    echo '<input type="text" id="category_name" name="category_name" value="' . htmlspecialchars($category['nom']) . '" 
                           class="w-full px-4 py-2 border border-gray-300 rounded" required>';
                    echo '</div>';
                    echo '<button type="submit" name="update" class="px-6 py-3 bg-gradient-to-r from-red-600 to-orange-500 text-white rounded shadow-md hover:opacity-90 transition">
                            Mettre à jour
                          </button>';
                    echo '</form>';
                } else {
                    echo '<p class="text-red-500 text-center mt-6">Catégorie non existante.</p>';
                }
            } else {
                echo '<p class="text-red-500 text-center mt-6">Erreur dans l\'ID.</p>';
            }
        }
    
        if (isset($_POST['update'])) {
            if (!empty($_POST['category_id']) && !empty($_POST['category_name'])) {
                $ID = (int)$_POST['category_id'];
                $nom = htmlspecialchars(trim($_POST['category_name']));
                $this->updateCategory($ID, $nom);
                echo '<p class="text-green-500 text-center mt-6">Modification effectuée avec succès.</p>';
                header("Refresh: 2; url=" . $_SERVER['PHP_SELF']); 
            } else {
                echo '<p class="text-red-500 text-center mt-6">Veuillez entrer le nom de la catégorie.</p>';
            }
        }
    }
    
}
?>
