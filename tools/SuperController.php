<?php

class SuperController
{
    public static function callPage($page)
    {
        include_once('tools/DatabaseLinker.php');

        switch($page)
        {
            case "interdit" :
                include_once("page/interdiction/ControllerInterdiction.php");
                $instanceController = new ControllerInterdiction();
                if ($instanceController->isConnected()==false) {
                    $instanceController->includeView();
                }
                else {
                    header("location:index.php?page=accueil");
                }
                break;

            case "produit" :
                $instanceController = new ControllerProduit();
                $instanceController->includeView();
                break;


            case "accueil":
                include_once ("page/Accueil/ControllerAccueil.php");
                $instanceController=new ControllerAccueil();
                $instanceController->insertView();
                break;

            case "connexion" :
                include_once('DAO/UserDAO.php');
                include_once('DTO/UserDTO.php');
                include_once("page/connexion/ControllerConnexion.php");


                $instanceController = new ControllerConnexion();
                $instanceController->includeView();

                if(!empty($_POST['username']) && !empty($_POST['password']))
                {
                    if ($instanceController->authenticate($_POST['username'], $_POST['password']))
                    {
                        $instanceController->redirectUser();
                    }
                    else
                    {
                        $instanceController->redirectUserFalse();
                    }
                }
                break;

            case "inscription" :
                include_once('DAO/UserDAO.php');
                include_once('DTO/UserDTO.php');
                include_once("page/inscription/ControllerInscription.php");

                $instanceController = new ControllerInscription();
                $instanceController->includeView();
                break;

            case "admin":
        }
    }
}
