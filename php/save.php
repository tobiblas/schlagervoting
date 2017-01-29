<?php
    include("db.php");
    
    $query =  "select enabled from State";
    $enabled = "";
    foreach ($dbh->query($query) as $row)
    {
        $enabled = $row[0];
    }
    $voteOn = true;
    if ($enabled == 'false') {
        $voteOn = false;
    }
    
    if ($voteOn) {
        $token = $_GET['token'];
        $vote = $_GET['vote'];
        $contestnumber = $_GET['contestnumber'];
        
        $query = "select id from users where mellotoken='" . $token . "'";
        $id = "";
        foreach ($dbh->query($query) as $row)
        {
            $id = $row[0];
        }
        $query = "delete from uservotes where contestnumber=" . $contestnumber . " and userid='".$id."';";
        $dbh->query($query);
        
        $query =  "insert into uservotes values (" . $id . "," .$contestnumber . ",'" . $vote . "');";
        $dbh->query($query);
    } else {
        #bad reuest.
        echo "CLOSED";
    }
    
    
?>