<?php
session_start();
try
{
$bdd = new PDO('mysql:host=localhost;dbname=bon choix','root','root');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exeption $e)
{
echo'une erreur est survenu';
die();
}
if(isset($_GET['id']) AND $_GET['id'] > 0)
{
$getid = intval($_GET['id']);
$requser = $bdd->prepare('SELECT * FROM membre WHERE id = ?');
$requser->execute(array($getid));
$userinfo = $requser->fetch();


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>profil</title>
</head>
<body>
    <div align="center">
    <h1>bienvenue <?php echo $userinfo['pseudo']; ?> </h1>
    <h1> email : <?php echo $userinfo['email']; ?></h1>
   <?php
 if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id'] )
 {
?>
<a href="ajouter.php">ajouter un produit   </a><br>

<a href="deconnection.php" >  se deconnecter</a>
<?php
 
}

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
                    echo"votre produit a été ajouter avec succé!";        
                    }
                else
                {
                echo'Veillez remplir tous les champs';
                }       
            }

   ?>
    </div>
    <br><br>
</body>
</html>
<?php

}else{

}
?>


