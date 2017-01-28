<html>
<head>
<title>Schlager</title>
<link rel="stylesheet" href="styles.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">





</head>

<body>

<div class="row"><div class="col-12 resultheader" style="text-align:center;">Deltävling 4</div></div>

<?php
    #CREATE TABLE VOTES(NAME TEXT NOT NULL, CONTESTNUMBER INT, VOTE TEXT NOT NULL);
    include("db.php");
    
    $token = $_REQUEST["token"];
    $contest = $_REQUEST["contest"];
    
    
    $correctResult = "";
    $query = "select * from result where contestnumber=" + $contest;
    foreach ($dbh->query($query) as $row) {
        $correctResult = $row[1]; //example: 1-3;2-4;3-5;4-3;5-7;6-1;7-2;
    }
    $correctResultArray = array();
    $i = 0;
    foreach (explode(";", $correctResult) as $result) {
        if ($result != "") {
            $songNPlace = explode("-", $result);
            $correctResultArray[$songNPlace[0]] = $songNPlace[1];
        }
        $i = $i+1;
    }
    
    if (sizeof($correctResultArray) == 0) {
        echo "<div class='row'><div class='col-12 resultitem'>Inget resultat än</div></div><br>";
    }
    else {
        $query = "select name,vote from votes where contestnumber=4;";
        $resultArray = array();
        foreach ($dbh->query($query) as $row) {
            $username = $row[0];
            $vote = $row[1];
            $score = 0;
            $votes = explode(";", $vote);
            $numberOfSongs = sizeof($votes) -1;
            
            foreach ($votes as $oneVote) {
                if ($oneVote != "") {
                    $song = explode("-", $oneVote)[0];
                    $place = explode("-", $oneVote)[1];
                    $scoreForThisItem = $numberOfSongs - abs($place - $correctResultArray[$song]);
                    $score = $score + $scoreForThisItem;
                }
            }
            $resultArray[$username] = $score;
        }
        arsort($resultArray);
        $preciousValue = -1;
        $i = 0;
        foreach ($resultArray as $key => $value) {
            if ($previousValue != $value) {
                $i++;
            }
            $previousValue = $value;
            if ($key == $user) {
                echo "<div class='row'><div class='col-12 resultitemself'>" . $i . ". " . $key . " " . $value . "p</div></div>";
            } else {
                echo "<div class='row'><div class='col-12 resultitem'>" . $i . ". " . $key . " " . $value . "p</div></div>";
            }
            
        }
        echo "<br>";
    }
    
    ?>


<div class="row"><div class="col-12 resultheader" style="text-align:center;">Deltävling 3</div></div>

<?php
    #CREATE TABLE VOTES(NAME TEXT NOT NULL, CONTESTNUMBER INT, VOTE TEXT NOT NULL);
    include("db.php");
    
    $user = $_COOKIE["schlagername7"];
    
    $correctResult = "";
    $query = "select * from result where contestnumber=3";
    foreach ($dbh->query($query) as $row) {
        $correctResult = $row[1];
    }
    $correctResultArray = array();
    $i = 0;
    foreach (explode(";", $correctResult) as $result) {
        if ($result != "") {
            $songNPlace = explode("-", $result);
            $correctResultArray[$songNPlace[0]] = $songNPlace[1];
        }
        $i = $i+1;
    }
    
    if (sizeof($correctResultArray) == 0) {
        echo "<div class='row'><div class='col-12 resultitem'>Inget resultat än</div></div><br>";
    }
    else {
        $query = "select name,vote from votes where contestnumber=3;";
        $resultArray = array();
        foreach ($dbh->query($query) as $row) {
            $username = $row[0];
            $vote = $row[1];
            $score = 0;
            $votes = explode(";", $vote);
            $numberOfSongs = sizeof($votes) -1;
            
            foreach ($votes as $oneVote) {
                if ($oneVote != "") {
                    $song = explode("-", $oneVote)[0];
                    $place = explode("-", $oneVote)[1];
                    $scoreForThisItem = $numberOfSongs - abs($place - $correctResultArray[$song]);
                    $score = $score + $scoreForThisItem;
                }
            }
            $resultArray[$username] = $score;
        }
        arsort($resultArray);
        $preciousValue = -1;
        $i = 0;
        foreach ($resultArray as $key => $value) {
            if ($previousValue != $value) {
                $i++;
            }
            $previousValue = $value;
            if ($key == $user) {
                echo "<div class='row'><div class='col-12 resultitemself'>" . $i . ". " . $key . " " . $value . "p</div></div>";
            } else {
                echo "<div class='row'><div class='col-12 resultitem'>" . $i . ". " . $key . " " . $value . "p</div></div>";
            }
            
        }
        echo "<br>";
    }
    
    ?>




<div class="row"><div class="col-12 resultheader" style="text-align:center;">Deltävling 2</div></div>

<?php
    #CREATE TABLE VOTES(NAME TEXT NOT NULL, CONTESTNUMBER INT, VOTE TEXT NOT NULL);
    include("db.php");
    
    $user = $_COOKIE["schlagername7"];
    
    $correctResult = "";
    $query = "select * from result where contestnumber=2";
    foreach ($dbh->query($query) as $row) {
        $correctResult = $row[1];
    }
    $correctResultArray = array();
    $i = 0;
    foreach (explode(";", $correctResult) as $result) {
        if ($result != "") {
            $songNPlace = explode("-", $result);
            $correctResultArray[$songNPlace[0]] = $songNPlace[1];
        }
        $i = $i+1;
    }
    
    if (sizeof($correctResultArray) == 0) {
        echo "<div class='row'><div class='col-12 resultitem'>Inget resultat än</div></div><br>";
    }
    else {
        $query = "select name,vote from votes where contestnumber=2;";
        $resultArray = array();
        foreach ($dbh->query($query) as $row) {
            $username = $row[0];
            $vote = $row[1];
            $score = 0;
            $votes = explode(";", $vote);
            $numberOfSongs = sizeof($votes) -1;
            
            foreach ($votes as $oneVote) {
                if ($oneVote != "") {
                    $song = explode("-", $oneVote)[0];
                    $place = explode("-", $oneVote)[1];
                    $scoreForThisItem = $numberOfSongs - abs($place - $correctResultArray[$song]);
                    $score = $score + $scoreForThisItem;
                }
            }
            $resultArray[$username] = $score;
        }
        arsort($resultArray);
        $preciousValue = -1;
        $i = 0;
        foreach ($resultArray as $key => $value) {
            if ($previousValue != $value) {
                $i++;
            }
            $previousValue = $value;
            if ($key == $user) {
                echo "<div class='row'><div class='col-12 resultitemself'>" . $i . ". " . $key . " " . $value . "p</div></div>";
            } else {
                echo "<div class='row'><div class='col-12 resultitem'>" . $i . ". " . $key . " " . $value . "p</div></div>";
            }
            
        }
        echo "<br>";
    }
    
?>

<div class="row"><div class="col-12 resultheader" style="text-align:center;">Deltävling 1</div></div>
<div class="row"><div class="col-12 <?php if ($user == 'Johannes') {echo 'resultitemself"';} else {echo 'resultitem"';}?> >1. Johannes 34p</div></div>
<div class="row"><div class="col-12 <?php if ($user == 'Urban') {echo 'resultitemself"';} else {echo 'resultitem"';}?> >1. Urban 34p</div></div>
<div class="row"><div class="col-12 <?php if ($user == 'Julia') {echo 'resultitemself"';} else {echo 'resultitem"';}?> >2. Julia 32p</div></div>
<div class="row"><div class="col-12 <?php if ($user == 'JOHANNA') {echo 'resultitemself"';} else {echo 'resultitem"';}?> >2. JOHANNA 32p</div></div>
<div class="row"><div class="col-12 <?php if ($user == 'Adam') {echo 'resultitemself"';} else {echo 'resultitem"';}?> >3. Adam 30p</div></div>
<div class="row"><div class="col-12 <?php if ($user == 'Fredrik') {echo 'resultitemself"';} else {echo 'resultitem"';}?> >4. Fredrik 28p</div></div>
<div class="row"><div class="col-12 <?php if ($user == 'Alexandra') {echo 'resultitemself"';} else {echo 'resultitem"';}?> >5. Alexandra 27p</div></div>
<div class="row"><div class="col-12 <?php if ($user == 'Tobias') {echo 'resultitemself"';} else {echo 'resultitem"';}?> >6. Tobias 26p</div></div>
<div class="row"><div class="col-12 <?php if ($user == 'Dessi') {echo 'resultitemself"';} else {echo 'resultitem"';}?> >7. Dessi 25p</div></div>



</body>
</html>
