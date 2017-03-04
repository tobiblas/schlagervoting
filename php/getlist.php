<?php
    
    include("db.php");
    
    $contest = $_REQUEST["contestnumber"];
    $voteMe = "";
    $token = $_COOKIE["melloToken2"];

    $queryGetMe = "select vote from users,uservotes where mellotoken='" . $token . "' and contestnumber=" . $contest . " and users.id=uservotes.userid";
   
    foreach ($dbh->query($queryGetMe) as $row)
    {
        $voteMe = $row[0];
    }
    
    $voteArray = array();
    foreach (explode(";", $voteMe) as $vote) {
        if ($vote != "") {
            $songNPlace = explode("-", $vote);
            $voteArray[intval($songNPlace[1])] = $songNPlace[0];
        }
    }
    $savedVote = "";
    for ($x = 1; $x <= 8; $x++) {
        if ($voteArray[$x] != null) {
            $savedVote = $savedVote . $voteArray[$x] . ";";
        }
    }
    echo $savedVote;
?>