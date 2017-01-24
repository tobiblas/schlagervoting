<?php
    include("db.php");
    
    $token = $_GET['melloToken'];
    $name = "nisse";
        
    $sql ="select name from users where mellotoken='" . $token . "';";
    
    foreach ($dbh->query($sql) as $row)
    {
        $name = $row[0];
    }
    echo $name;

?>