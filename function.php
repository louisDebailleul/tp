<?php 
session_start();
/*verifie le post de la connection */
function verifPost($POST){
    if(empty($POST['nom'])||empty($POST['password'])){
        return false;
    }else{
        return true;
    }
}
/*verifie le poste de l'inscription */
function verifInscription($POST){
    if(!empty($POST['nom'])||!empty($POST['password'])||!empty($POST['passwordVerif'])){
        $password = $POST['password'];
        $passwordVerif = $POST['passwordVerif'];
        if($password == $passwordVerif ){
            return true;
        }else{
            return false;  
        }
    }else{
        return false;
    }
}
/*verifie si le mot de passe et le nom coresponde au .csv */
function verifLogin($lesPersonnes, $laPersone){
    foreach ($lesPersonnes as $unePersonne){
        if($laPersone == $unePersonne ){
            return true;
        }
    }
    return false;
}


/*recupère toute les perspnnes et leur mot de passe */
function recupPersonnes($fichier){
    $csv = fopen($fichier, "a+");
    $lesPersonnes = fgetcsv($csv,10000, ".");
    fclose($csv);
    return $lesPersonnes;
 }
/*recupère juste les nom des personne en les separent de leur mot de passe */
function lesNoms($fichier){
    $monfichier = fopen($fichier, 'a+');
    $LesPersonnes = fgetcsv($monfichier,10000,".");
    $LesNomMotPass = implode('|',$LesPersonnes);
    $TLesNomMotPass = explode('|',$LesNomMotPass);
    $Tnom = array();
      $cb = count($TLesNomMotPass );
    var_dump($cb);
    $j = 0;
    for($i = 0; $i < $cb; $i= $i+2){
      $Tnom[$j] = $TLesNomMotPass[$i];
      $j++;
    }
    fclose($monfichier);
    return $Tnom;
}
/*ajoute une personne au .csv */
function ajouterUnepersonne ($fichier,$ajouter){
    $monfichier = fopen($fichier, 'a+');
    fputs($monfichier, $ajouter);
    fclose($monfichier);
}
?>