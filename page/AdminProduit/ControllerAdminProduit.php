<?php
 class ControllerAdminProduit{
    public static function testPhoto(){
        if (isset($_POST['submit'])){
            $maxSize=100000;
            $validExt=array('.jpg','.jpeg','.gif','.png');
            if($_FILES['upload_file']['error'] >0){
                echo"Une erreur est survenue lors du transfet";
                die;
            }
            $fileSize=$_FILES['upload_file']['size'];
            if ($fileSize>$maxSize){
                return false;
            }
            $fileName=$_FILES['upload_file']['name'];
            $fileExt=".".strtolower(substr(strrchr($fileName,'.'),1));


            if (!in_array($fileExt,$validExt)){
                echo "Le fichier n'est pas une image";
                return false;
            }

            $tmpname=$_FILES['upload_file']["tmp_name"];
            $NomUnique=md5(uniqid(rand(),true));
            $fileName="assets/photoproduits/".$NomUnique.$fileExt;
            $result=move_uploaded_file($tmpname,$fileName);
            if ($result){
                return $fileName;
            }
        }
    }



    public static function publierProduit($photo){
            if(isset($_POST['nom']) && isset($_POST['stock']) && isset($_POST['prix'])) {
                $produitDTO = new ProduitDTO();
                $produitDTO->setNom($_POST['nom']);
                $produitDTO->setStock($_POST['stock']);
                $produitDTO->setPrix($_POST['prix']);
                $produitDTO->setPhoto($photo);
                $produitDTO->setIdCategorie($_POST['menu_destination']);
               return $produitDTO;
            }
        }


    public static function afficherCategorie(){
        $categorie=new CategorieDTO();
        $categorie=CategorieDAO::getCategorie();
        foreach ($categorie as $cat)
        {
            echo '<option name="idcategorie"  value="'.$cat->getId().'">'.$cat->getNom().'</option>';
        }

    }

    public static function afficherListeProduits()
    {
        $produit = ProduitDAO::getProduit();

        if (!empty($produit)) {
            echo "<h1>Modifier le produit</h1>".'<br>';
        foreach ($produit as $produits) {
            echo "Nom du produit : " . $produits->getNom() . "<form method=post action='index.php?page=ModifierProduit&id=" . $produits->getId() . "' enctype='multipart/form-data' > <input type='text' name='nom'>";
            echo "<p> Image du produit : </p><input type='file' name='upload_file'>";

            echo "Prix du produit : " . $produits->getPrix() . "<input type='text' name='prix'>";
            echo "Stock restant : " . $produits->getStock() . "<input type='text' name='stock'> <input type='submit' name='submit' value='Modifier'></form>";
            echo "<a href='index.php?page=supprimerProduit&id=" . $produits->getId() . "'>Supprimer</a>" ;

        }
    }

    }

    public static function redirectUser(){
            header("location:index.php?page=AdminProduit");
    }





}
