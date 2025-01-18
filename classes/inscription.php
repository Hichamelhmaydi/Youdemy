<?php
require_once('user.php');
require_once('../database/connection.php');

class Inscription extends User {
    protected $pdo;

    public function setPDO($pdo) {
        $this->pdo = $pdo;
    }

    public function __construct($nom, $prenom, $email, $passworde, $rolee) {
        parent::__construct($nom, $prenom, $email, $passworde, $rolee);
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

            $status_inscri = ($this->rolee == "Etudiant") ? 'ok' : 'en attent';

            $stmt = $this->pdo->prepare("INSERT INTO user (nom, prenom, email, passworde, rolee, status_inscri) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bindParam(1, $this->nom, PDO::PARAM_STR);
            $stmt->bindParam(2, $this->prenom, PDO::PARAM_STR);
            $stmt->bindParam(3, $this->email, PDO::PARAM_STR);
            $stmt->bindParam(4, $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(5, $this->rolee, PDO::PARAM_STR);
            $stmt->bindParam(6, $status_inscri, PDO::PARAM_STR);
            $stmt->execute();
            header('location:../views/login.php');
        } catch (PDOException $e) {
            file_put_contents('pdo_errors.log', $e->getMessage(), FILE_APPEND);
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

    $dbConnection = new DatabaseConnection();
    $pdo = $dbConnection->getPDO();

    $inscription = new Inscription($nom, $prenom, $email, $passworde, $rolee);
    $inscription->setPDO($pdo);

    $result = $inscription->inscrire();

    echo json_encode($result);
    exit;
}
?>
