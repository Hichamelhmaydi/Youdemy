<?php
require_once('../database/connection.php');

class User {
    protected $nom;
    protected $prenom;
    protected $email;
    protected $passworde;
    protected $rolee;

    public function __construct($nom, $prenom, $email, $passworde, $rolee) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->passworde = $passworde;
        $this->rolee = $rolee;
    }

    // getters
    public function setNom($nom) { $this->nom = $nom; }
    public function setPrenom($prenom) { $this->prenom = $prenom; }
    public function setEmail($email) { $this->email = $email; }
    public function setPassworde($passworde) { $this->passworde = $passworde; }
    public function setRolee($rolee) { $this->rolee = $rolee; }

    // getters
    public function getNom() { return $this->nom; }
    public function getPrenom() { return $this->prenom; }
    public function getEmail() { return $this->email; }
    public function getPassworde() { return $this->passworde; }
    public function getRolee() { return $this->rolee; }
}
?>
