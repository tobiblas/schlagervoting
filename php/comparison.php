<html>
<head>
<title>Schlager</title>
<link rel="stylesheet" href="styles.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">

</head>

<body>

<?php

    include("result_helper.php");

    function addResultIcon($contest, $correctResultArray, $voteArray, $x, $correct) {
        if ($contest <= 4) {
            $bucketDiff = abs($correctResultArray[$voteArray[$x]]->getBucket() - getBucketFromPlace((int)$x, 1));
            if ($bucketDiff == 0) {
                $place = $correctResultArray[$voteArray[$x]]->getPlace();
                if ($place == 5 || $place == 6 || $place == 7) {
                    if ( ((int)$x) == $place) {
                        echo '<img class="comparisonThumbsup" src="images/thumbsup2.png"/>';
                    } else {
                        echo '<img class="comparisonThumbsup" src="images/thumbsdown.png"/>';
                    }
                } else {
                    echo '<img class="comparisonThumbsup" src="images/thumbsup2.png"/>';
                }
            } else {
                echo '<img class="comparisonThumbsup" src="images/thumbsdown.png"/>';
            }
        } else if ($contest == 5) {

        } else if ($contest == 6) {
            $place = $correctResultArray[$voteArray[$x]]->getPlace();
            $score = 12 - abs ($x - $place);
            if ( ((int)$x) == $place) {
                echo '<img class="comparisonThumbsup" src="images/thumbsup2.png"/>';
            } else {
                echo '<img class="comparisonThumbsup" src="images/thumbsdown.png"/>';
            }
        }
    }

    $contest = $_REQUEST["contest"];
    $user2Name = $_REQUEST["u2"];
    $userNameMe = "";
    $fbidMe = "";
    $fbidOther = "";
    $voteMe = "";
    $voteOther = "";
    $correctVote = "";

    $token = $_COOKIE["melloToken2"];

    $queryGetMe = "select name, fbid, vote from users,uservotes where mellotoken='" . $token . "' and contestnumber=" . $contest . " and users.id=uservotes.userid";
    $queryGetOther = "select name, fbid, vote from users,uservotes where name='" . $user2Name . "' and contestnumber=" . $contest . " and users.id=uservotes.userid";
    $queryGetCorrect = "select vote from result where contestnumber=" . $contest;

    foreach ($dbh->query($queryGetCorrect) as $row)
    {
        $correctVote = $row[0];
    }
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
<img class="comparisonUser" src=<?php echo "'" . $imageurl . "'";?> style="width: 100%"/>
<div class="comparisonUsername"><?php echo $userNameMe;?></div>

<?php
    $correctResultArray = getCorrectResultArray($contest, $dbh);
    #correct result array: [låtnummer]-->Result(placering,bucket)

    $voteArray = array();
    foreach (explode(";", $voteMe) as $vote) {
        if ($vote != "") {
            $songNPlace = explode("-", $vote);
            $voteArray[intval($songNPlace[1])] = $songNPlace[0];
        }
    }
    $max = 7;
    if ($contest == 5) {
        $max = 8;
    }
    if ($contest == 6) {
        $max = 12;
    }

    for ($x = 1; $x <= $max; $x++) {
      echo '<div class="comparisonArtistContainer">';
      echo '<img class="comparisonArtist" src="images/artists/' . $contest . '-' . $voteArray[$x] . '.jpeg"/>';
      addResultIcon($contest, $correctResultArray, $voteArray, $x, FALSE);
      echo '</div>';
      if ( ($contest <= 4 && ($x == 2 || $x == 4)) || $contest == 5 && $x == 4) {
          echo '<br>';
      }
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
<img class="comparisonUser" src=<?php echo "'" . $imageurl . "'";?> style="width: 100%"/>

<div class="comparisonUsername"><?php echo $user2Name;?></div>

<?php
    $voteArray = array();
    foreach (explode(";", $voteOther) as $vote) {
        if ($vote != "") {
            $songNPlace = explode("-", $vote);
            $voteArray[intval($songNPlace[1])] = $songNPlace[0];
        }
    }
    for ($x = 1; $x <= $max; $x++) {
        echo '<div class="comparisonArtistContainer">';
        echo '<img class="comparisonArtist" src="images/artists/' . $contest . '-' . $voteArray[$x] . '.jpeg"/>';
        addResultIcon($contest, $correctResultArray, $voteArray, $x, FALSE);
        echo '</div>';
        if ( ($contest <= 4 && ($x == 2 || $x == 4)) || $contest == 5 && $x == 4) {
            echo '<br>';
        }
    }
    ?>

</div>


<div id="correctPlayer">

<?php
    $imageurl = "images/thumbsupSquare.png";
    ?>
<img class="comparisonUser" src=<?php echo "'" . $imageurl . "'";?> style="width: 100%"/>

<div class="comparisonUsername"><?php echo "Facit";?></div>

<?php

#$correctVote = "1-1;2-7;3-4;4-2;5-5;6-6;7-3;";
    $voteArray = array();
    $index = 0;
    foreach (explode(";", $correctVote) as $vote) {
        if ($vote != "") {
            $songNPlace = explode("-", $vote);
            $voteArray[intval($songNPlace[1])] = $songNPlace[0];
        }
        $index++;
        if ($index >= $max) {
          break;
        }
    }
    for ($x = 1; $x <= $max; $x++) {
        echo '<div class="comparisonArtistContainer">';
        echo '<img class="comparisonArtist" src="images/artists/' . $contest . '-' . $voteArray[$x] . '.jpeg"/>';
        addResultIcon($contest, $correctResultArray, $voteArray, $x, TRUE);
        echo '</div>';
        if ( ($contest <= 4 && ($x == 2 || $x == 4)) || $contest == 5 && $x == 4) {
            echo '<br>';
        }
    }
    ?>

</div>

</div>

</body>
</html>
