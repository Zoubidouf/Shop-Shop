<?php
    
function getPage($db){
    var_dump($_GET);
    $lesPages['accueil'] = "accueilControleur";
    $lesPages['contact'] = "contactControleur";
    $lesPages['mentionslegals'] = "mentionslegalsControleur";
    $lesPages['apropos'] = "aproposControleur";
    $lesPages['inscrire'] = "inscrireControleur";
    $lesPages['connexion'] = "connexionControleur";
    $lesPages['maintenance'] = "maintenanceControleur";
    $lesPages['deconnexion'] = "deconnexionControleur";
    $lesPages['listecontact'] = "listecontactControleur";
    $lesPages['utilisateurMofif'] = "utilisateurControleur";

if ($db!=null){
    if (isset($_GET['page'])){
        $page = $_GET['page'];
    }
    else{
        $page = 'accueil';
    }
    if(isset($lesPages[$page])){
        $contenu = $lesPages[$page];
    }
    else{
        $contenu = $lesPages['accueil'];
    }
}else{
    $contenu = $lesPages['maintenance'];
}

return $contenu; 
}
?>