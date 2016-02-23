<?php
    include("db.php");
    
    $contestnumber = $_GET['contestnumber'];
    $result = $_GET['result'];

    $query = "delete from result where contestnumber=" . $contestnumber . ";";
    $dbh->query($query);
    
    $query =  "insert into result values (" . $contestnumber . ",'" . $result . "');";
    $dbh->query($query);
?>