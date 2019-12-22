<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>addproduct</title>
</head>
<body>
<form action="" method="POST" enctype="multipart/form-data">
            <h5>Nom du produit</h5><input type="text" name="title" require>
            <h5>Description du produit</h5><textarea name="description" require></textarea>
            <h5>Prix</h5><input type="text" name="prix" require></br>
           
            <input type="submit" name="submit">
        </form>
        <?php
        if(isset($_POST['submit']))
            {   
                // recuperer donnees insséreés
                $title=$_POST['title'];
                $description=$_POST['description'];
                $prix=$_POST['prix'];
               
             
               

                if($title&&$description&&$prix){
                    try
                    {
                    $db = new PDO('mysql:host=localhost;dbname=bon choix','root','root');
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    }
                    catch(Exeption $e)
                    {
                    echo'une erreur est survenu';
                    die();
                    }
                    $insert = $db->prepare("INSERT INTO produits VALUES(NULL,'$title','$description','$prix')");
                    $insert->execute();
                    header('Location: produit-ajouter.php');
                    }
                else
                {
                echo'Veillez remplir tous les champs';
                }       
            }
            ?>

</body>
</html>