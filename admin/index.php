<?php

session_start();
$user='belaid';
$pswd='root';


if(isset($_POST['submit'])) {

$username = $_POST['username'];
$password = $_POST['password'];

if($username&&$password){
if($username==$user&&$password==$pswd){

$_SESSION['username']=$username;
header('Location: admin.php');


}else{
    echo'identifiant eronnes';
}

}else{
    echo'remplir tous les champs !..';
}



}



?>







<style>
    body{
        background: burlywood;
    }
    
    </style>

<h1>admistrateur -connection</h1>
<form action="" method="post">

      <h3>pseudo</h3><input type="text" name="username"><br>
      <h3>password</h3><input type="password" name="password"><br>
      <input type="submit" name="submit">


</form>