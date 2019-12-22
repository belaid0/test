<?php session_start();
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
?>
<!-- CSS -->
<link rel="stylesheet" href="../style/style.css" type="text/css"/>

<!-- actions -->
<h1>Binvenue, <?php echo $_SESSION['username']?></h1>
<a href ="?action=add">Ajouter un produit</a><br>
<a href ="?action=modifiersupprimer">Modifier ou supprimer un produit</a><br>
<a href ="admuser.php">Gerer les utilisateur</a><br><br>

<!-- controle php ajouter un produit-->
<?php
if(isset($_SESSION['username']))
{
    if(isset($_GET['action']))
    {
        if($_GET['action']=='add')
        {
?>
        <!-- Formulaire pour ajouter un produit-->
        <form action="" method="POST" enctype="multipart/form-data">
            <h5>Nom du produit</h5><input type="text" name="title" require>
            <h5>Description du produit</h5><textarea name="description" require></textarea>
            <h5>Prix</h5><input type="text" name="prix" require></br>
           
            <input type="submit" name="submit">
        </form>

<?php       
        // ajout d'un produit a la BDD
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
        }
        elseif($_GET['action']=='modifiersupprimer')
        {
            $select = $db->prepare("SELECT * FROM produits ");
            $select->execute();
            while($s=$select->fetch(PDO::FETCH_OBJ ))
            {
                echo $s->title.'</br>';
?>
                <a href="?action=modifier&amp;id=<?php echo $s->id; ?>">Modifier</a>
                <a href="?action=supprimer&amp;id=<?php echo $s->id; ?>">supprimer</a></br>
<?php
            }
        }
        elseif($_GET['action']=='modifier')
        {

            $id=$_GET['id'];
            $select = $db->prepare("SELECT * FROM produits WHERE id=$id");
            $select->execute();
            $info = $select->fetch(PDO::FETCH_OBJ);
?>

            <form action="" method="POST">
            <h5>Nom du produit</h5><input type="text" name="title" value="<?php echo $info->title; ?>">
            <h5>Description du produit</h5><textarea name="description" ><?php echo $info->description;?></textarea>
            <h5>Prix</h5><input type="text" name="prix"value="<?php echo $info->prix;?>"></br>
            <button name="submit">Modifier</button>
        </form>

<?php
        if(isset($_POST['submit']))
            {
                $title=$_POST['title'];
                $description=$_POST['description'];
                $prix=$_POST['prix'];
                $update=$db->prepare("UPDATE produits SET title='$title', description='$description', prix='$prix' WHERE id=$id");
                $update->execute();
                header('Location: modif_prod.php');
                echo'votre produits a étais modifier avec succé';                
            }

        }
        elseif ($_GET['action']=='supprimer')
        {
            $id=$_GET['id'];
            $delet = $db->prepare("DELETE FROM produits where id=$id");
            $delet->execute();
            echo"votre produit a été supprimer";
        }
        else
        {
            die('une erreur s\'est produite');
        }
    }
    else
    {

    }
}
else
{
    header('location:../index.php');
}
?>



