<?php
class SupprimerTag {
    private $pdo;

    public function setPDO($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllTags() {
        $stmt = $this->pdo->prepare("SELECT * FROM tag");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTagyById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM tag WHERE ID = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteTag($ID) {
        $stmt = $this->pdo->prepare("DELETE FROM tag WHERE ID = ?");
        $stmt->bindParam(1, $ID, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function delet() {
        // Vérifier si l'utilisateur a cliqué sur "Supprimer"
        if (isset($_POST['delete'])) {
            if (isset($_POST['category_id'])) {
                $this->deleteTag($_POST['category_id']);
                echo '<p class="text-green-500 text-center mt-6">tag supprimée avec succès.</p>';
                header("Refresh: 2; url=" . $_SERVER['PHP_SELF']);  // Actualiser la page après la suppression
            } else {
                echo '<p class="text-red-500 text-center mt-6">Erreur lors de la suppression de le tag.</p>';
            }
        }

        // Affichage des catégories
        $tags = $this->getAllTags();
        echo '<h1 class="text-2xl font-bold text-center my-6">Liste des tags</h1>';
        echo '<table class="table-auto border-collapse border border-gray-300 mx-auto w-full max-w-5xl text-center">';
        echo '<thead class="bg-gray-100">';
        echo '<tr><th class="border border-gray-300 px-6 py-3">ID</th><th class="border border-gray-300 px-6 py-3">Nom de tag</th><th class="border border-gray-300 px-6 py-3">Supprimer</th></tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($tags as $tag) {
            echo '<tr class="hover:bg-gray-50">';
            echo '<td class="border border-gray-300 px-6 py-3">' . htmlspecialchars($tag['ID']) . '</td>';
            echo '<td class="border border-gray-300 px-6 py-3">' . htmlspecialchars($tag['nom']) . '</td>';
            echo '<td class="border border-gray-300 px-6 py-3">';
            echo '<form method="POST" style="display: inline;">';
            echo '<input type="hidden" name="category_id" value="' . htmlspecialchars($tag['ID']) . '">';
            echo '<button type="submit" name="delete" class="px-6 py-3 bg-gradient-to-r from-red-600 to-orange-500 text-white rounded shadow-md hover:opacity-90 transition">
                    Supprimer
                  </button>';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }
}
?>
