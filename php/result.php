<html>
<head>
<title>Schlager</title>
<link rel="stylesheet" href="styles.css?<?php echo date_default_timezone_set('l jS \of F Y h:i:s A'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">

</head>

<script>
function loadFinalResult() {
    window.location='?page=finalresult';
}
</script>

<body>



<?php

    include("result_helper.php");

    $token = $_COOKIE["melloToken2"];
    $query = "select name from users where mellotoken='" . $token . "'";
    $name = "";
    foreach ($dbh->query($query) as $row)
    {
        $name = $row[0];
    }

    function calculateResultForContest($contest, $dbh, $name) {

        $contestName = "Deltävling " . $contest;
        if ($contest == 5) {
            $contestName = "Andra chansen";
        }
        if ($contest == 6) {
            $contestName = "Final";
        }
        echo '<div class="row"><div class="col-12 resultheader center">' . $contestName . '</div></div>';


        $correctResultArray = getCorrectResultArray($contest, $dbh);
        #correct result array: [låtnummer]-->Result(placering,bucket)

        if (sizeof($correctResultArray) == 0) {
            echo "<div class='row'><div class='col-12 resultitem'>Inget resultat än</div></div><br><br><br>";
        }
        else {
            $query = "select name, fbid, vote from users,uservotes where id=userid and contestnumber=" . $contest;
            $resultArray = array();

            #loop through all users that has voted in a specific contest.

            #echo "<br>";

            foreach ($dbh->query($query) as $row) {
                $username = $row[0];
                $fbid = $row[1];
                $vote = $row[2];
                $score = 0;
                $votes = explode(";", $vote);
                $numberOfSongs = sizeof($votes) -1;

                foreach ($votes as $oneVote) {
                    if ($oneVote != "") {
                        $song = explode("-", $oneVote)[0];
                        $place = explode("-", $oneVote)[1];
                        $scoreForThisItem = 0;
                        /*if ($contest <= 4) {
                            $bucketDiff = abs($correctResultArray[$song]->getBucket() - getBucketFromPlace((int)$place, 1));
                            #6 poäng om du satte den i rätt grupp (direkt vidare/andra chansen/utslagen)
                            #3 poäng om du satte den 1 steg ifrån rätt grupp (exempel: du satte direkt vidare men den hamnade i andra chansen)
                            #1 poäng om du satte den 2 steg ifrån rätt grupp (exempel: du satte direkt vidare men den hamnade i utslagen)
                            if ($bucketDiff == 2) {
                                $scoreForThisItem += 1;
                            } else if ($bucketDiff == 1) {
                                $scoreForThisItem += 3;
                            } else  {
                                $scoreForThisItem += 6;
                            }
                            #2 poäng om låt på plats 5 var rätt
                            if ($place == 5 && $correctResultArray[$song]->getPlace() == 5) {
                                $scoreForThisItem += 2;
                            }
                            #2 poäng om låt på plats 6 var rätt
                            #if ($place == 6 && $correctResultArray[$song]->getPlace() == 6) {
                            #    $scoreForThisItem += 2;
                            #}
                            #4 poäng om låt på plats 7 var rätt
                            #if ($place == 7 && $correctResultArray[$song]->getPlace() == 7) {
                            #    $scoreForThisItem += 4;
                            #}
                            #-5 poäng om du satte låt på plats 7 eller 6 som gick direkt vidare
                            if (($place == 7 || $place == 6) && $correctResultArray[$song]->getBucket() == 1) {
                                $scoreForThisItem -= 5;
                            }
                        } else*/ if ($contest == 5) {

                            $bucketDiff = abs($correctResultArray[$song]->getBucket() - getBucketFromPlace((int)$place, 5));

                            if ($bucketDiff == 1) {
                                $scoreForThisItem += 0;
                            } else  {
                                $scoreForThisItem += 3;
                            }
                        } else if ($contest <= 4 || $contest == 6) {

                            $scoreForThisItem = $numberOfSongs - abs($place - $correctResultArray[$song]->getPlace());

                        }
                        $score = $score + $scoreForThisItem;
                    }
                }
                $key = $username;

                $resultArray[$key] = $score;
            }
            arsort($resultArray);
            $previousValue = -1;
            $i = 0;
            foreach ($resultArray as $key => $value) {
                if ($previousValue != $value) {
                    $i++;
                }
                $previousValue = $value;
                $imageurl = "images/kermit.jpg";
                $nameAndFbid = explode("#:#", $key);
                if (strlen($nameAndFbid[1]) > 1) {
                    $imageurl = "http://graph.facebook.com/" . $nameAndFbid[1] . "/picture?width=100&height=100";
                    $key = $nameAndFbid[0];
                }

                if ($key == $name) {
                    echo "<a href='?page=comparison&contest=" . $contest . "&u2=" . $key . "'><table><tr class='resultitemself'><td style='text-align:center; min-width:25px;' ><div class='resulttext'>" . $i . "</div></td><td><img style='width:65px' src='" . $imageurl . "'></td><td  style='width: 60%; padding-left: 10px;' ><div class='resulttext'>" . $key . "</div></td><td style='width: 50%; text-align:right; padding-right:10px;'><div class='resulttext'>" . $value . "p</div></td></tr></table></a>";
                } else {
                    echo "<a href='?page=comparison&contest=" . $contest . "&u2=" . $key . "'><table><tr><td style='text-align:center; min-width:25px;'>" . $i . "</td><td><img style='width:65px' src='" . $imageurl . "'></td><td style='width: 60%; padding-left: 10px;'>" . $key . "</td><td style='width: 50%; text-align:right; padding-right:10px;'>" . $value . "p</td></tr></table></a>";
                }
            }
            echo "<br><br><br>";
        }
    }

    echo "<br><br>";

    $topListArray = array();
    $query = "select name, fbid from users";

    #echo "<div class='row link-button'><button onClick='loadFinalResult();' >KLICKA HÄR FÖR SUMMERAT RESULTAT</button></div><br><br>";

    calculateResultForContest(6, $dbh, $name);
    calculateResultForContest(5, $dbh, $name);
    calculateResultForContest(4, $dbh, $name);
    calculateResultForContest(3, $dbh, $name);
    calculateResultForContest(2, $dbh, $name);
    calculateResultForContest(1, $dbh, $name);
    ?>

</body>
</html>
