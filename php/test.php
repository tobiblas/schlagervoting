<?php
    include("db.php");


    $query = "select count(*) from result;";

    $numberOfResultsStmt = $dbh->query($query);
    $contestsWithResult = (int) $numberOfResultsStmt->fetch()[0];

    echo $contestsWithResult;
?>
