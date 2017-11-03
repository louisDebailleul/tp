<?php 
require "function.php";
$erreur="";

/*verif du post return true ou false*/

if(!empty($_POST['Valider'])){
    $test = verifPost($_POST);
    if($test == true){
        $fichier = "personne.csv";
        $LesPersonnes = recupPersonnes($fichier);
        $nom = $_POST['nom'];
        $password = $_POST['password'];
        $laPersonne = "$nom|$password";
        $verifLogin = verifLogin($LesPersonnes, $laPersonne);
        if($verifLogin == true){
            $_SESSION['nom'] = $nom;
            $_SESSION['password'] = $password;
              header('Location: http://localhost:8000/connecter.php');
              exit();
        }else{
            $erreur = "<span>Le mot de passe ou le login n'est pas bon.</span>";
        }
    }else{
        $erreur = "<span>Il manque des informations.</span>";
    }
}

 

?>
<center>
    <?= $erreur ?>
    <form action="/" method="POST">
        <span>Votre Nom</span><br>
        <input type="text" name="nom"><br>
        <span>Votre mot de passe</span><br>
        <input type="password" name="password"><br>
        <button type="submit" name="Valider" value="1">Valider</button>
    </form>
</center>