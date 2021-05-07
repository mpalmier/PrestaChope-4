<?php
include_once('DAO/ProduitDAO.php');
include_once('DTO/ProduitDTO.php');
class ControllerProduit
{
    public static function includeView()
    {
        include_once("produit.php");
    }

    public static function afficherCategorie()
    {
        $produit=new ProduitDTO();
        $produit=ProduitDAO::getProduitByCategorie($_GET['id']);
        foreach ($produit as $pt)
        {
            echo '<br>
                <a href="index.php?page=details&id='.$pt->getId().'">'.$pt->getNom().'</a>
                <img src="'.$pt->getPhoto().'">';

        }

    }
}


