<html>
<head>
<title>Schlager</title>
<link rel="stylesheet" href="styles.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">

</head>

<body>

<?php
    
    include("db.php");
    
    $contest = $_REQUEST["contest"];
    $user2Name = $_REQUEST["u2"];
    $userNameMe = "";
    $fbidMe = "";
    $fbidOther = "";
    $voteMe = "";
    $voteOther = "";
    
    $token = $_COOKIE["melloToken"];

    $queryGetMe = "select name, fbid, vote from users,uservotes where mellotoken='" . $token . "' and contestnumber=" . $contest . " and users.id=uservotes.userid";
    $queryGetOther = "select name, fbid, vote from users,uservotes where name='" . $user2Name . "' and contestnumber=" . $contest . " and users.id=uservotes.userid";
    
    foreach ($dbh->query($queryGetMe) as $row)
    {
        $userNameMe = $row[0];
        $fbidMe = $row[1];
        $voteMe = $row[2];
    }
    foreach ($dbh->query($queryGetOther) as $row)
    {
        $fbidOther = $row[1];
        $voteOther = $row[2];
    }
    ?>

<div id="container">

<div id="leftPlayer">
<?php
    $imageurl = "images/kermit.jpg";
    if (strlen($fbidMe) > 1) {
        $imageurl = "http://graph.facebook.com/" . $fbidMe . "/picture?width=100&height=100";
    }
?>
<img class="comparisonArtist" src=<?php echo "'" . $imageurl . "'";?> style="width: 100%"/>
<div class="comparisonUsername"><?php echo $userNameMe;?></div>

<?php
    
    $voteArray = array();
    foreach (explode(";", $voteMe) as $vote) {
        if ($vote != "") {
            $songNPlace = explode("-", $vote);
            $voteArray[intval($songNPlace[1])] = $songNPlace[0];
        }
    }
    for ($x = 1; $x <= 7; $x++) {
        echo '<img class="comparisonArtist" src="images/artists/' . $contest . '-' . $voteArray[$x] . '.jpeg" style="width: 100%"/>';
    }
?>

</div>

<div id="rightPlayer">

<?php
    $imageurl = "images/kermit.jpg";
    if (strlen($fbidOther) > 1) {
        $imageurl = "http://graph.facebook.com/" . $fbidOther . "/picture?width=100&height=100";
    }
    ?>
<img class="comparisonArtist" src=<?php echo "'" . $imageurl . "'";?> style="width: 100%"/>

<div class="comparisonUsername"><?php echo $user2Name;?></div>

<?php
    $voteArray = array();
    foreach (explode(";", $voteOther) as $vote) {
        if ($vote != "") {
            $songNPlace = explode("-", $vote);
            $voteArray[intval($songNPlace[1])] = $songNPlace[0];
        }
    }
    for ($x = 1; $x <= 7; $x++) {
        echo '<img class="comparisonArtist" src="images/artists/' . $contest . '-' . $voteArray[$x] . '.jpeg" style="width: 100%"/>';
    }
    ?>

</div>

</div>

</body>
</html>
