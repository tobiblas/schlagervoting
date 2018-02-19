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

    function getCorrectResultArray($contest, $dbh) {
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
      return $correctResultArray;
    }

?>
