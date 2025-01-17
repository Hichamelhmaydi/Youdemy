<?php
require_once('user.php');
require_once('../database/connection.php');

class Login extends User {
    protected $pdo;

    public function __construct($email, $passworde) {
        $db = new DatabaseConnection();
        $this->pdo = $db->getPDO();
        $this->email = $email;
        $this->passworde = $passworde;
    }

    public function authenticate() {
        try {
            $stmtUser = $this->pdo->prepare("SELECT * FROM user WHERE email = ?");
            $stmtUser->bindParam(1, $this->email, PDO::PARAM_STR);
            $stmtUser->execute();
            $user = $stmtUser->fetch(PDO::FETCH_ASSOC);
    
            $stmtAdmin = $this->pdo->prepare("SELECT * FROM admin WHERE email = ?");
            $stmtAdmin->bindParam(1, $this->email, PDO::PARAM_STR);
            $stmtAdmin->execute();
            $admin = $stmtAdmin->fetch(PDO::FETCH_ASSOC);
    
            if ($admin) {
                if ($this->passworde === $admin['passworde']) { 
                    $_SESSION['admin'] = [
                        'email' => $admin['email']
                    ];
                    header("Location: ../views/adminDashboard.php");
                    exit;
                } else {
                    echo "Erreur: Mot de passe incorrect pour l'administrateur.";
                    return;
                }
            } else {
                echo "Erreur: Administrateur introuvable.";
            }
            
            
    
            if ($user) {
                if (password_verify($this->passworde, $user['passworde'])) {
                    $_SESSION['user'] = [
                        'nom' => $user['nom'],
                        'prenom' => $user['prenom'],
                        'email' => $user['email'],
                        'rolee' => $user['rolee']
                    ];
                    if ($user['rolee'] === "Etudiant") {
                        header('Location: ../views/etudientDashboard.html');
                        exit; 
                    } elseif ($user['rolee'] === 'Enseignant') {
                        header('Location: ../views/Enseignant.html');
                        exit;
                    }
                } else {
                    return [
                        'success' => false,
                        'message' => 'Mot de passe incorrect.'
                    ];
                }
            }
    
            return [
                'success' => false,
                'message' => 'Utilisateur introuvable.'
            ];
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Erreur de connexion : ' . $e->getMessage()
            ];
        }
    }
    
}


?>