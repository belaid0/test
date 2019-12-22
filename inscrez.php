<?php
if(isset($_POST['submit']))
{
    $pseudo=$_POST['pseudo'];
    $email=$_POST['email'];
    $mdp = sha1($_POST['mdp']);
    $mdp2 = sha1($_POST['mdp2']);


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
    $reqmail = $bdd->prepare("SELECT * FROM membre WHERE email = ?");
    $reqmail->execute(array($email));
    $exist = $reqmail->rowCount();
    if($exist === 0)
    {

        if($mdp == $mdp2)
        {
            $insert = $bdd->prepare("INSERT INTO membre VALUES(NULL,'$pseudo','$mdp','$email')");
            $insert->execute();
            echo 'votre compte a ete bien creer';
            ?>
            <li>
                <a href="connection.php">connection</a>
            </li>
            <?php   
        }else{
            $eror = "les mot de passe ne corespont pas !";
        }
         

    }else{
        $eror = "email exist deja !";
    }
    
  
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>inscription</title>
</head>
<body>
    <div align="center">
        <h2>inscription</h2>
        <br><br>
        <form action="" method="POST" >
         <table>
         <tr>
                <td>
                        <label for="pseudo">pseudo </label>
                     </td>
                  
                     <td>
                           <input type="text" placeholder="votre pseudo" name="pseudo">
                      </td>
         </tr> 
         <tr>
                <td>
                        <label for="mail">mail </label>
                     </td>
                  
                     <td>
                           <input type="email" placeholder="votre mail" name="email">
                      </td>
         </tr> 
         <tr>
                <td>
                        <label for="mdp">mot de passe </label>
                     </td>
                  
                     <td>
                           <input type="text" placeholder="votre mdp" name="mdp">
                      </td>
         </tr> 
         <tr>
                <td>
                        <label for="mdp2">confirmer mdp </label>
                     </td>
                  
                     <td>
                           <input type="text" placeholder="confirmer votre mdp" name="mdp2">
                      </td>
         </tr> 
         <tr>
           <td></td>
           <td align="center">
               <br>
                <input type="submit" value="je m'inscrer" name="submit">
           </td>

         </tr>
         </table>
           
           
      
        </form>
        <?php
     if(isset($eror)){
         echo $eror;
     }
    
        ?>


    </div>
</body>
</html>