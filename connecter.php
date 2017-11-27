<?php require "function.php"; 

if(!empty($_POST['deconnection'])){
    session_destroy();
     header('Location: http://localhost:8000');
     exit();
}

if(empty($_SESSION['nom'])){
     header('Location: http://localhost:8000');
     exit();
}

$fichier = "personne.csv";
$erreur="";
$lesPersonnes = lesNoms($fichier);

if(!empty($_POST['Valider'])){
    $test = verifInscription($_POST);
    var_dump($test);
    if($test == true){
        echo"je pass";
        $nom = $_POST['nom'];
        $password = $_POST['password'];
        $ajouter = ".$nom|$password";
        ajouterUnepersonne($fichier,$ajouter);
        $succer = "l'utilisateur a bien etait ajouter.";
    }else{
        $erreur = "<span>Il manque des informations ou les mot de passe ne corresponde pas .</span>";
    }
}
?>

<center>
    <h1>Bonjour <?= $_SESSION['nom'] ?></h1>
    <?= $erreur ?>
    <?= $succer ?>
    <h2>Ajouté une personne.</h2>
    <form action="#" method="POST">
        <span>Votre Nom</span><br>
        <input type="text" name="nom"><br>
        <span>Votre mot de passe</span><br>
        <input type="password" name="password"><br>
        <span>Verif mot de passe</span><br>
        <input type="password" name="passwordVerif"><br>
        <button type="submit" name="Valider" value="1">Valider</button>
    </form>
       <form method="POST">
          <button name="deconnection" value="1">Deconnection</button>
       </form>
        <h3>Les personnes</h3>
         <ul>
<?php foreach($lesPersonnes as $unePersonnes){ 
        echo"<li>$unePersonnes</li>";
}?>
        </ul>     
</center>