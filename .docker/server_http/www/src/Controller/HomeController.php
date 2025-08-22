<?php
 
namespace App\Controller;

use Yoop\AbstractController;

class HomeController extends AbstractController
{
    public function print() 
    {  
        $user = $this->getUser();
        if($user) {
            if($user->getId()==3 || $user->getId()==8 || $user->getId()==2) {
                $flag = $this->getFlag();
            }
        }
        return $this->render('home', ['flag' => $flag??null]);
    }

    public function auth() 
    {
        // si authentifié on ne peut plus venir ici
        if($this->isAuthenticated()) return $this->redirectToRoute("/"); 
        return $this->render('auth');
    }

    public function authProcess() 
    {
        // si authentifié on ne peut plus venir ici
        if($this->isAuthenticated()) return $this->redirectToRoute("/"); 

        if(sizeof($_POST)) {
            // Pour éviter le bruteforce en attend 2 secondes par requete
            sleep(2);
            if(!empty($_POST['email']) && is_string($_POST['email']) &&
                !empty($_POST['password']) && is_string($_POST['password'])
            ) {
                $email = $_POST['email'];
                $hash = SHA1($_POST['password']);
                $pdo =  $this->getRepository('User')->getPDO();
                $statement = $pdo->prepare("SELECT id, email, firstname, lastname, password FROM users WHERE email='$email'");
                $statement->execute();
                $statement->setFetchMode(\PDO::FETCH_CLASS, 'App\Entity\User');
                $user = $statement->fetch();
                if($user) {
                    // On connecte que si l'utilisateur a le bon mot de passe
                    if($user->getPassword() == $hash) {
                        $this->connectUser($user);
                        return $this->redirectToRoute("/"); 
                    }
                }
            }
        } 
        return $this->render('auth', ["error" => "Echec d'authentification."]);        
    }

    public function deconnect() 
    {
        unset($_SESSION["user"]);
        $this->redirectToRoute("/"); 
    }    

}