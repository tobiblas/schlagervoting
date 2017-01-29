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
    
    class Result
    {
        public $place = 0;
        public $bucket = 0;
        
        function getPlace()
        { return $this->place; }
        
        function getBucket()
        { return $this->bucket; }
        
        public function __construct($place=0, $bucket=0)
        {
            $this->place = $place;
            $this->bucket = $bucket;
        }
    }
    
    function getBucketFromPlace($place, $contestNumber) {
        if ($contestNumber <= 4) {
            if ($place == 1 || $place == 2) {
                return 1;
            } else if ($place == 3 || $place == 4) {
                return 2;
            } else {
                return 3;
            }
        } else {
            return -1;
        }
    }
    
    $token = $_REQUEST["token"];
    #todo highlighta dig själv
    
    function calculateResultForContest($contest, $dbh) {
        
        $contestName = "Deltävling " . $contest;
        if ($contest == 5) {
            $contestName = "Andra chansen";
        }
        if ($contest == 6) {
            $contestName = "Final";
        }
        echo '<div class="row"><div class="col-12 resultheader center">' . $contestName . '</div></div>';
    
        $correctResult = "";
        $query = "select * from result where contestnumber=" . $contest;
        foreach ($dbh->query($query) as $row) {
            $correctResult = $row[1]; //example: 1-3;2-4;3-5;4-3;5-7;6-1;7-2;
        }
        $correctResultArray = array();
        $i = 0;
        foreach (explode(";", $correctResult) as $result) {
            if ($result != "") {
                $songNPlace = explode("-", $result);
                $correctResultArray[$songNPlace[0]] = new Result(intval($songNPlace[1]), getBucketFromPlace(intval($songNPlace[1]), $contest));
            }
            $i = $i+1;
        }
    
        #correct result array: [låtnummer]-->Result(placering,bucket)
    
        if (sizeof($correctResultArray) == 0) {
            echo "<div class='row'><div class='col-12 resultitem'>Inget resultat än</div></div><br>";
        }
        else {
            $query = "select name, fbid, vote from users,uservotes where id=userid and contestnumber=" . $contest;
            $resultArray = array();
        
            #loop through all users that has voted in a specific contest.
        
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
                        if ($contest <= 4) {
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
                            if ($place == 6 && $correctResultArray[$song]->getPlace() == 6) {
                                $scoreForThisItem += 2;
                            }
                        #4 poäng om låt på plats 7 var rätt
                            if ($place == 7 && $correctResultArray[$song]->getPlace() == 7) {
                                $scoreForThisItem += 4;
                            }
                        #-5 poäng om du satte låt på plats 7 som gick direkt vidare
                            if ($place == 7 && $correctResultArray[$song]->getBucket() == 1) {
                                $scoreForThisItem -= 5;
                            }
                        } else if ($contest <= 6) {
                            $scoreForThisItem = $numberOfSongs - abs($place - $correctResultArray[$song]);
                        }
                        $score = $score + $scoreForThisItem;
                    }
                }
                $resultArray[$username] = $score;
            }
            arsort($resultArray);
            $previousValue = -1;
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
    }
    
    calculateResultForContest(1, $dbh);
    calculateResultForContest(2, $dbh);
    calculateResultForContest(3, $dbh);
    calculateResultForContest(4, $dbh);
    calculateResultForContest(5, $dbh);
    calculateResultForContest(6, $dbh);
    ?>

</body>
</html>
