<html>
<head>
<title>Schlager</title>
<link rel="stylesheet" href="styles.css?<?php echo date_default_timezone_set('l jS \of F Y h:i:s A'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">

</head>

<body>

<?php

    include("db.php");

    class User
    {
        public $name = NULL;
        public $fbid = NULL;
        public $score1 = -1;
        public $score2 = -1;
        public $score3 = -1;
        public $score4 = -1;
        public $score5 = -1;
        public $score6 = -1;

        static function cmp_obj($a, $b)
        {
            $al = $a->score1 + $a->score2 +$a->score3 +$a->score4 +$a->score5 +$a->score6 ;
            $bl = $b->score1 + $b->score2 +$b->score3 +$b->score4 +$b->score5 +$b->score6 ;
            if ($al == $bl) {
                return 0;
            }
            return ($al > $bl) ? -1 : +1;
        }

        function getScore()
        { return $this->score1 + $this->score2 +$this->score3 +$this->score4 +$this->score5 +$this->score6 ; }

        function getFbId()
        { return $this->fbid; }
        function getName()
        { return $this->name; }

        public function __construct($fbid=NULL,$name="")
        {
            $this->fbid = $fbid;
            $this->name = $name;
        }
    }

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
        } else if ($contestNumber == 5) {
            if ($place == 1 || $place == 2 || $place == 3 || $place == 4) {
                return 1;
            } else if ($place == 5 || $place == 6 || $place == 7 || $place == 8) {
                return 2;
            }
        } else {
            return -1;
        }
    }



    $token = $_COOKIE["melloToken2"];
    $query = "select name from users where mellotoken='" . $token . "'";
    $name = "";
    foreach ($dbh->query($query) as $row)
    {
        $name = $row[0];
    }

    function calculateResultForAllContests($dbh, $name) {

        $topListArray = array();

        $query = "select name, fbid from users";

        foreach ($dbh->query($query) as $row) {
            $topListArray[$row[0]] = new User($row[1], $row[0]);
        }
        #print_r($topListArray);

        #return $topListArray;

        $contestName = "Summerat slutresultat";

        echo '<div class="row"><div class="col-12 resultheader center">' . $contestName . '</div></div>';

        for ($contest = 1; $contest < 7; $contest++) {

            $correctResult = "";

            $query = "select * from result where contestnumber=" . $contest;
            #echo $query;
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
                continue;
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
                                #if ($place == 6 && $correctResultArray[$song]->getPlace() == 6) {
                                #    $scoreForThisItem += 2;
                                #}
                                #4 poäng om låt på plats 7 var rätt
                                #if ($place == 7 && $correctResultArray[$song]->getPlace() == 7) {
                                #      $scoreForThisItem += 4;
                                #}
                                #-5 poäng om du satte låt på plats 7 eller 6 som gick direkt vidare
                                if (($place == 7 || $place == 6) && $correctResultArray[$song]->getBucket() == 1) {
                                    $scoreForThisItem -= 5;
                                }
                            } else if ($contest == 5) {

                                $bucketDiff = abs($correctResultArray[$song]->getBucket() - getBucketFromPlace((int)$place, 5));

                                if ($bucketDiff == 1) {
                                    $scoreForThisItem += 0;
                                } else  {
                                    $scoreForThisItem += 3;
                                }
                            } else if ($contest == 6) {

                                $scoreForThisItem = $numberOfSongs - abs($place - $correctResultArray[$song]->getPlace());

                            }
                            $score = $score + $scoreForThisItem;
                        }
                    }
                    #echo "score is " . $score . " for " . $username . " contest " . $contest . "<br>";

                    if ($contest == 1) {
                        $topListArray[$username]->score1 = $score;
                    } else if ($contest == 2) {
                        $topListArray[$username]->score2 = $score;
                    } else if ($contest == 3) {
                        $topListArray[$username]->score3 = $score;
                    } else if ($contest == 4) {
                        $topListArray[$username]->score4 = $score;
                    } else if ($contest == 5) {
                        $topListArray[$username]->score5 = $score;
                    } else if ($contest == 6) {
                        $topListArray[$username]->score6 = $score;
                    }
                }
            }
        }
        return $topListArray;
    }

    echo "<br><div class='center'>Missar man en tävling får man hälften av maxpoängen för denna tävling (gäller ej finalen)<div><br><br>";

    $topListArray = calculateResultForAllContests($dbh, $name);

    $query = "select count(*) from result;";
    $numberOfResultsStmt = $dbh->query($query);
    $contestsWithResult = (int) $numberOfResultsStmt->fetch()[0];
    foreach ($topListArray as $key => $value) {
        for ($i = 1; $i < 7; $i++) {
            if ($i == 1) {
                if ($value->score1 == -1) {
                  if ($i > $contestsWithResult) {
                    $value->score1 = 0;
                  } else {
                    $value->score1 = 25;
                  }
                }
            } else if ($i == 2) {
                if ($value->score2 == -1) {
                  if ($i > $contestsWithResult) {
                    $value->score2 = 0;
                  } else {
                    $value->score2 = 25;
                  }
                }
            } else if ($i == 3) {
              if ($value->score3 == -1) {
                if ($i > $contestsWithResult) {
                  $value->score3 = 0;
                } else {
                  $value->score3 = 25;
                }
              }
            } else if ($i == 4) {
              if ($value->score4 == -1) {
                if ($i > $contestsWithResult) {
                  $value->score4 = 0;
                } else {
                  $value->score4 = 25;
                }
              }
            } else if ($i == 5) {
              if ($value->score5 == -1) {
                if ($i > $contestsWithResult) {
                  $value->score5 = 0;
                } else {
                  $value->score5 = 6;
                }
              }
            } else if ($i == 6) {
                if ($value->score6 == -1) { $value->score6 = 0;}
            }
        }
    }

    usort($topListArray, array("User", "cmp_obj"));

    $previousValue = -1;
    $i = 0;

    foreach ($topListArray as $key => $value) {
        if ($previousValue != $value->getScore()) {
            $i++;
        }
        $previousValue = $value->getScore();

        $imageurl = "images/kermit.jpg";

        if ($value->getFbId() != NULL) {
            $imageurl = "http://graph.facebook.com/" . $value->getFbId() . "/picture?width=100&height=100";
        }

        if ($value->getName() == $name) {
            echo "<table><tr><td class='resultitemself' style='text-align:center; min-width:25px;' >" . $i . "</td><td class='resultitemself'><img style='width:65px' src='" . $imageurl . "'></td><td  style='width: 60%; padding-left: 10px;' class='resultitemself'>" . $value->getName() . "</td><td class='resultitemself' style='width: 50%; text-align:right; padding-right:10px;'>" . $value->getScore() . "p</td></tr></table>";
        } else {
            echo "<table><tr><td style='text-align:center; min-width:25px;'>" . $i . "</td><td><img style='width:65px' src='" . $imageurl . "'></td><td style='width: 60%; padding-left: 10px;'>" . $value->getName() . "</td><td style='width: 50%; text-align:right; padding-right:10px;'>" . $value->getScore() . "p</td></tr></table>";
        }
    }
    echo "<br><br><br>";




    ?>

</body>
</html>
