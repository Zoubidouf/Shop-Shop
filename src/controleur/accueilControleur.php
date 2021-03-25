<?php
    function accueilControleur($twig){
        echo $twig->render('accueil.html.twig', array());
    }
    function contactControleur($twig, $db){
        $form = array();
        if (isset($_POST['btSumit'])){
            $inputNom = $_POST['inputNom'];
            $inputEmail = $_POST['inputEmail'];
            $inputMessage = $_POST['inputMessage'];
            $form['valide'] = true;
            $form['Nom'] = $inputNom;
            $form['Email'] = $inputEmail;
            $form['Message'] = $inputMessage;
            $contact = new Contact($db);
            $exec = $contact->insert($inputNom, $inputEmail, $inputMessage);
            }
        echo $twig->render('contact.html.twig', array('form'=>$form));
    }
    function mentionslegalsControleur($twig){
        echo $twig->render('mentionslegals.html.twig', array());
    }
    function aproposControleur($twig){
        echo $twig->render('apropos.html.twig', array());
    }
    function maintenanceControleur($twig){
        echo $twig->render('maintenance.html.twig', array());
    }
    function listecontactControleur($twig,$db){
        $form = array();
        $contact = new Contact($db);
        if (isset($_POST['btAjouter3'])){
            $Email = $_POST['Email'];
            $Nom = $_POST['Nom'];
            $Message = $_POST['Message'];
            $form['valide'] = true;
            $form['Email'] = $Email;
            $form['Nom'] = $Nom;
            $form['Message'] = $Message;
            $exec = $contact->insert($Nom, $Email, $Message);
        }
        $list = $contact -> select();    
        echo $twig->render('listecontact.html.twig', array('form'=>$form,'list'=>$list));
    }
    function inscrireControleur($twig,$db){
        var_dump($POST);
        $form = array();
        if(isset($_POST['btInscrire'])){
            $inputEmail = $_POST['inputEmail'];
            $inputPassword = $_POST['inputPassword'];
            $inputPassword2 = $_POST['inputPassword2'];
            $inputNom = $_POST['inputNom'];
            $inputPrenom =$_POST['inputPrenom'];
            $role = $_POST['role'];
            $form['valide'] = true;

            if ($inputPassword!=$inputPassword2){
                $form['valide'] = false;
                $form['message'] = 'Les mots de passe sont différents';
            }
            else{
                //egalite des mdp
                $utilisateur = new Utilisateur($db);
                $exec = $utilisateur->insert($inputEmail, password_hash($inputPassword, PASSWORD_DEFAULT), $role, $inputNom, $inputPrenom);
                if (!$exec){
                    $form['valide'] = false;
                    $form['message'] = 'Problème d\'insertion dans la table utilisateur ';
                }
            }
            $form['email'] = $inputEmail;
            $form['role'] = $role;
        }
        echo $twig->render('inscrire.html.twig', array('form'=>$form));
    }
    function connexionControleur($twig, $db){
        $form = array();
        
        if (isset($_POST['btConnecter'])){
            $form['valide'] = true;
            $inputEmail = $_POST['inputEmail'];
            $inputPassword = $_POST['inputPassword'];
            $utilisateur = new Utilisateur($db);
            $unUtilisateur = $utilisateur->connect($inputEmail);
            if ($unUtilisateur!=null){
                if(!password_verify($inputPassword,$unUtilisateur['mdp'])){
                $form['valide'] = false;
                $form['message'] = 'Login ou mot de passe incorrect';
                }
            else{
                $_SESSION['login'] = $inputEmail;
                $_SESSION['role'] = $unUtilisateur['idRole'];
                header("Location:index.php");
                }
            }
            else{
                $form['valide'] = false;
                $form['message'] = 'Login ou mot de passe incorrect';
                }
            }
            echo $twig->render('connexion.html.twig', array('form'=>$form));
           }
    function deconnexionControleur($twig, $db){
        session_unset();
        session_destroy();
        header("Location:index.php");
    }
?>