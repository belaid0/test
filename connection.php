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
if(isset ($_POST['ok']))
{
$mailconnect = htmlspecialchars($_POST['username']);
$mdpconnect = sha1($_POST['password']);
if(!empty($mailconnect) AND !empty($mdpconnect))
{
 $requser = $bdd->prepare("SELECT * FROM membre WHERE email = ? AND pswd = ?");
 $requser->execute(array($mailconnect, $mdpconnect));
 $userexist = $requser->rowCount();
 if($userexist == 1)
 {
$userinfo = $requser->fetch();
$_SESSION['id'] = $userinfo['id'];
$_SESSION['pseudo'] = $userinfo['pseudo'];
$_SESSION['email'] = $userinfo['email'];
header('Location: comptes.php?id='.$_SESSION['id']);
 }else
 {
 $ereur = "maivais mail ou mot de passe";
 }


}

}



?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>connection</title>
    <link rel="stylesheet" href="style.css">
    <style>
    

    
    
    </style>
</head>
<body>
<div id="container">
            <!-- zone de connexion -->
            
            <form action="" method="POST">
                <h1>Connexion</h1>
                
                <label><b>votre email</b></label>
                <input type="text" placeholder="Entrer le votre mail" name="username" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>

                <input type="submit" name='ok' value='LOGIN' >
                <h5 >  si vous n'avez pas de compte  inscrez-vous ..!</h5>
              <li>
                    <a href="inscrez.php"> creer un compte </a>
                </li>
                <?php
     if(isset($ereur)){
         echo $ereur;
     }
    
        ?>

           
</body>
</html>