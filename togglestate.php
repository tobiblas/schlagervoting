<?php
    include("db.php");
    
    $newstate = $_GET['state'];
    
    $query = "delete from state;";
    $dbh->query($query);
    
    $state = 'false';
    if ($newstate == 'true') {
        $state = 'true';
    }
    
    $query =  "insert into state values ('" . $state . "');";
    $dbh->query($query);
?>