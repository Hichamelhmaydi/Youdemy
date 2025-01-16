<?php
require_once('user.php');
require_once('../database/connection.php');

class Inscription extends User {
    public function __construct($pdo, $nom, $prenom, $email, $passworde, $rolee) {
        parent::__construct($pdo, $nom, $prenom, $email, $passworde, $rolee);
    }

    public function inscrire(){
        $stmt = $this->pdo->prepare("INSERT INTO user (nom, prenom, email, passworde, rolee)  VALUES (?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $this->nom, PDO::PARAM_STR);
        $stmt->bindParam(2, $this->prenom, PDO::PARAM_STR);
        $stmt->bindParam(3, $this->email, PDO::PARAM_STR);
        $stmt->bindParam(4, $this->passworde, PDO::PARAM_STR);
        $stmt->bindParam(5, $this->rolee, PDO::PARAM_STR);

    }
   
}
?>
