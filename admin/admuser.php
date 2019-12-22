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
<a href ="?action=admuser">utilisateur</a><br><br>
<?php
if(isset($_SESSION['username']))
{
    if(isset($_GET['action']))
    {
        if($_GET['action']=='admuser')
        {
            $select = $db->prepare("SELECT * FROM membre WHERE 1 ");
            $select->execute();
            while($s=$select->fetch(PDO::FETCH_OBJ ))
            {
                echo $s->pseudo;
                ?>
               
                <a href="?action=delete&amp;id=<?php echo $s->id; ?>">---X</a></br>
<?php
            }
        }
            
            if($_GET['action']=='delete'){
                $id=$_GET['id'];
                $delet = $db->prepare("DELETE FROM membre where id=$id");
                $delet->execute();
            echo"utilisateur a été supprimer";
            }
            }
         }  
        
?>