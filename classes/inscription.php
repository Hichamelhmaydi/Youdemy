<?php
require_once('user.php');
require_once('../database/connection.php');

class Inscription extends User {
    protected $pdo;

    public function __construct($nom, $prenom, $email, $passworde, $rolee) {
        parent::__construct($nom, $prenom, $email, $passworde, $rolee);
        $this->pdo = (new DatabaseConnection())->getPDO(); 
    }

    public function inscrire() {
        $errors = [];

        if (empty($this->nom)) {
            $errors['nom'] = "Le champ nom est obligatoire.";
        }
        if (empty($this->prenom)) {
            $errors['prenom'] = "Le champ prénom est obligatoire.";
        }
        if (empty($this->email)) {
            $errors['email'] = "Le champ email est obligatoire.";
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Le format de l'email est invalide.";
        }
        if (empty($this->passworde)) {
            $errors['passworde'] = "Le champ mot de passe est obligatoire.";
        }
        if (empty($this->rolee)) {
            $errors['rolee'] = "Le champ rôle est obligatoire.";
        }

        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        try {
            $hashedPassword = password_hash($this->passworde, PASSWORD_BCRYPT);
        
            $statusInscri = ($this->rolee == "Etudiant") ? 'ok' : 'en attent';
        
            $stmt = $this->pdo->prepare("INSERT INTO user (nom, prenom, email, passworde, rolee, status_inscri) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bindParam(1, $this->nom, PDO::PARAM_STR);
            $stmt->bindParam(2, $this->prenom, PDO::PARAM_STR);
            $stmt->bindParam(3, $this->email, PDO::PARAM_STR);
            $stmt->bindParam(4, $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(5, $this->rolee, PDO::PARAM_STR);
            $stmt->bindParam(6, $statusInscri, PDO::PARAM_STR); 
            $stmt->execute();
        
            return ['success' => true, 'message' => "Inscription réussie."];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => "Erreur lors de l'insertion des données : " . $e->getMessage()];
        }
        
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $email = $_POST['email'] ?? '';
    $passworde = $_POST['passworde'] ?? '';
    $rolee = $_POST['rolee'] ?? '';

    $inscription = new Inscription($nom, $prenom, $email, $passworde, $rolee);
    $result = $inscription->inscrire();

    echo json_encode($result);
    exit;
}
?>
