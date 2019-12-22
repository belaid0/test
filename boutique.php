<?php

require_once('index.php');



try
{
 $db = new PDO('mysql:host=localhost;dbname=bon choix','root','root');

 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
}
catch(Exception $e){
   echo'erreur sourvenue';
   die();
}

$select = $db->prepare("SELECT * FROM produits WHERE 1");
$select->execute();

while($s=$select->fetch(PDO::FETCH_OBJ)){

?>
<br><div align="center">
<h2>nom :<?php  echo $s->title;       ?></h2>
<h5>description :<?php   echo $s->description;       ?></h5>
<h4> prix :<?php   echo $s->prix;       ?>Dinars</h4>
<!-- <input type="submit" value="ajouter au panier" name="panier"> -->
<a href="panier.php?action=ajout&amp;l=LIBELLEPRODUIT&amp;q=QUANTITEPRODUIT&amp;p=PRIXPRODUIT" onclick="window.open(this.href, '', 
'toolbar=no, location=no, directories=no, status=yes, scrollbars=yes, resizable=yes, copyhistory=no, width=600, height=350'); return false;">Ajouter au panier</a>

<br><br>
</div>

<?php
}


?>