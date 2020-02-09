<html>
<head>
<title>Schlager</title>
<link rel="stylesheet" href="styles.css?<?php echo time(); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">

<script>

function updateSongs() {
  var songs = [];
  songs[0] = ["Melodi 1", "Melodi 2", "Melodi 3", "Melodi 4", "Melodi 5", "Melodi 6", "Melodi 7"];
  songs[1] = ["Melodi 1", "Melodi 2", "Melodi 3", "Melodi 4", "Melodi 5", "Melodi 6", "Melodi 7"];
  songs[2] = ["Melodi 1", "Melodi 2", "Melodi 3", "Melodi 4", "Melodi 5", "Melodi 6", "Melodi 7"];
  songs[3] = ["Melodi 1", "Melodi 2", "Melodi 3", "Melodi 4", "Melodi 5", "Melodi 6", "Melodi 7"];
  songs[4] = ["Melodi 1", "Melodi 2", "Melodi 3", "Melodi 4", "Melodi 5", "Melodi 6", "Melodi 7", "Melodi 8"];
  songs[5] = ["Melodi 1", "Melodi 2", "Melodi 3", "Melodi 4", "Melodi 5", "Melodi 6", "Melodi 7", "Melodi 8", "Melodi 9", "Melodi 10", "Melodi 11", "Melodi 12"];

  <?php
  include("db.php");
  $query = "select artist, title, contestnumber, startnumber from song order by startnumber;";
  foreach ($dbh->query($query) as $row)
  {
      $artist = $row[0];
      $song = $row[1];
      $contestnumber = $row[2]-1;
      $startnumber = $row[3]-1;
      echo "songs[" . ($contestnumber) . "][" . $startnumber . "] = '" . $song . " - " . $artist . "';\n";
  }

  ?>
  var contestnumber = getContestNumber();
  document.getElementById('melodi1').innerHTML = songs[contestnumber-1][0];
  document.getElementById('melodi2').innerHTML = songs[contestnumber-1][1];
  document.getElementById('melodi3').innerHTML = songs[contestnumber-1][2];
  document.getElementById('melodi4').innerHTML = songs[contestnumber-1][3];
  document.getElementById('melodi5').innerHTML = songs[contestnumber-1][4];
  document.getElementById('melodi6').innerHTML = songs[contestnumber-1][5];
  document.getElementById('melodi7').innerHTML = songs[contestnumber-1][6];
  if (contestnumber == 5 || contestnumber == 6) {
    document.getElementById('melodi8').innerHTML = songs[contestnumber-1][7];
  }
  if (contestnumber == 6) {
    document.getElementById('melodi9').innerHTML = songs[contestnumber-1][8];
    document.getElementById('melodi10').innerHTML = songs[contestnumber-1][9];
    document.getElementById('melodi11').innerHTML = songs[contestnumber-1][10];
    document.getElementById('melodi12').innerHTML = songs[contestnumber-1][11];
  }
  updateSelectors(contestnumber);
  var numberofcontestants = getNumberOfSongs(contestnumber);
  if (numberofcontestants == 12) {
    show('row' + 8);
    show('row' + 9);
    show('row' + 10);
    show('row' + 11);
    show('row' + 12);
  } else if (numberofcontestants == 7) {
      hide('row' + 8);
      hide('row' + 9);
      hide('row' + 10);
      hide('row' + 11);
      hide('row' + 12);
  } else if (numberofcontestants == 8) {
      show('row' + 8);
      hide('row' + 9);
      hide('row' + 10);
      hide('row' + 11);
      hide('row' + 12);
  }
}

function updateSelectors(contestnumber) {
  if (contestnumber <=4 ) {
    setOptionsToText(document.getElementById('bidrag1'));
    setOptionsToText(document.getElementById('bidrag2'));
    setOptionsToText(document.getElementById('bidrag3'));
    setOptionsToText(document.getElementById('bidrag4'));
    setOptionsToText(document.getElementById('bidrag5'));
    setOptionsToText(document.getElementById('bidrag6'));
    setOptionsToText(document.getElementById('bidrag7'));
  }
  if (contestnumber == 5 || contestnumber == 6) {
    setOptionsToNumbers(document.getElementById('bidrag1'));
    setOptionsToNumbers(document.getElementById('bidrag2'));
    setOptionsToNumbers(document.getElementById('bidrag3'));
    setOptionsToNumbers(document.getElementById('bidrag4'));
    setOptionsToNumbers(document.getElementById('bidrag5'));
    setOptionsToNumbers(document.getElementById('bidrag6'));
    setOptionsToNumbers(document.getElementById('bidrag7'));
    setOptionsToNumbers(document.getElementById('bidrag8'));
    setOptionsToNumbers(document.getElementById('bidrag9'));
    setOptionsToNumbers(document.getElementById('bidrag10'));
    setOptionsToNumbers(document.getElementById('bidrag11'));
    setOptionsToNumbers(document.getElementById('bidrag12'));
  }
}

function setOptionsToNumbers(selector) {
  for (var i = 0; i < selector.options.length; ++i) {
    selector.options[i].innerHTML= "" + (i+1);
  }
  for (var i = 0; i < selector.options.length; ++i) {
    selector.options[i].style.display = 'block';
  }
}

function setOptionsToText(selector) {
  for (var i = 0; i < selector.options.length; ++i) {
    if (i == 0) {
      selector.options[i].innerHTML=  "Direkt vidare";
    } else if (i == 2) {
      selector.options[i].innerHTML=  "Andra chansen";
    } else if (i == 5) {
      selector.options[i].innerHTML=  "Direkt ut";
    } else if (i == 4) {
      selector.options[i].innerHTML=  "5";
    } else {
      selector.options[i].style.display = 'none';
    }
  }
}

function hide(id) {
  document.getElementById(id).style.display = 'none';
}

function show(id) {
  document.getElementById(id).style.display = 'block';
}


function getContestNumber() {
  var sel = document.getElementById('contestselector');
  var contestnumber = -1;
  for ( var i = 0, len = sel.options.length; i < len; i++ ) {
      if ( sel.options[i].selected === true ) {
        contestnumber = i + 1;
          break;
      }
  }
  return contestnumber;
}

function getNumberOfSongs(contestnumber) {
  var numberofcontestants = 12;
  if (contestnumber >= 1 && contestnumber <= 4) {
    numberofcontestants = 7;
  } else if (contestnumber == 5) {
    numberofcontestants = 8;
  }
  return numberofcontestants;
}

function saveresult()
{
    var contestnumber = getContestNumber();
    var numberofcontestants = getNumberOfSongs(contestnumber);

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4) {
            if ( xmlHttp.status != 200) {
                alert("Failed to save data!");
            } else {
                alert("Sparat!");
            }
            //alert (xmlHttp.responseText);
            window.location.href = window.location.href;
        }
    }

    var result = "";
    var sum = 0;
    var direktUtUsed = false;
    for (var i = 0; i < numberofcontestants; i++) {
        var placement = document.getElementById("bidrag" + (i+1)).value;
        if (contestnumber <= 4 && (parseInt(placement) == 6 || parseInt(placement) == 7)) {
          if (direktUtUsed) {
            placement = "7";
          } else {
            direktUtUsed = true;
            placement = "6";
          }
        }
        sum += parseInt(placement);
        result += (i+1) + "-" + placement + ";";
    }
    if (contestnumber == 6 && sum != 78) {
      alert("Använd varje placering en gång!");
      return;
    }
    var query = "saveresult.php?contestnumber=" + contestnumber+ "&result=" + result;
    alert(query);
    xmlHttp.open("GET", query, true); // true for asynchronous
    xmlHttp.send(null);
}

function setVoteEnabled(enabled)
{

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4) {
            if ( xmlHttp.status != 200) {
                alert("Failed to save data!");
            }
            //alert (xmlHttp.responseText);
            window.location.href = window.location.href;
        }
    }

    var query = "togglestate.php?state=" + enabled;
    xmlHttp.open("GET", query, true); // true for asynchronous
    xmlHttp.send(null);
}
</script>


</head>
<body onload="updateSongs()">

<div class="row">
<div class="col-12">
<img src="images/header_melodifestivalen2.jpg" id="img1" />
</div>
</div>


<?php

    $query = "select count(*) from result;";
    $numberOfResultsStmt = $dbh->query($query);
    $contestsWithResult = (int) $numberOfResultsStmt->fetch()[0];
?>
    <br>
    <div class="row">
      <div class="col-6">
        <div id="pickcontesttext">Välj tävling du vill hantera:&nbsp;</div>
      </div>
      <div class="col-6"><select id='contestselector' class='selector' onchange="updateSongs()">
        <?php
        for ($i = 0; $i < 6; $i++) {

            echo "<option value='".($i+1)."' " . ($contestsWithResult == $i ? "selected='selected'" : "") . ">".($i+1)."</option>";
        }
        ?>
    </select></div></div>
    <br>

<?php
    $bidrag = 12;
for ($j = 0; $j < $bidrag; $j++) {
echo "<div class='row' id='row".($j+1)."'><div class='col-6'><div class='melodi' id='melodi" . ($j+1) ."'></div></div><div class='col-6'><select id='bidrag".($j+1)."' class='selector'>";
    for ($i = 0; $i < $bidrag; $i++) {
        $displayValue = "";
        if ($i == 0 || $i == 1) {
          $displayValue = "Direkt vidare / " . ($i+1);
        } else if ($i == 2 || $i == 3) {
          $displayValue = "Andra chansen / " . ($i+1);
        } else if ($i == 5 || $i == 6) {
          $displayValue = "Direkt ut / " . ($i+1);
        } else {
          $displayValue = ($i+1);
        }
        echo "<option value='".($i+1)."' >" . $displayValue ."</option>";
    }
echo "</select></div></div>";
}
?>
<div class='row'><div class='col-12'><br>
<button id="savebutton" name="sdfjksd" <?php echo "onclick='saveresult()'"; ?> >SPARA</button>
</div></div>

<div class="row">
<?php
    #create table State (enabled TEXT);
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

?>
<hr>
<div class="row">
  <div class='col-6'>
  <?php
      if ($voteOn) {
          echo "<button id='togglebutton' name='sdfjksd' onclick='setVoteEnabled(false)'>Slå AV röstning</button>";
      } else {
          echo "<button id='togglebutton' name='sdfjksd' onclick='setVoteEnabled(true)'>Slå PÅ röstning</button>";
      }
  ?>
  </div>
  <div class='col-6'>
    <div id="toggletext">Röstning är <?php if ($voteOn) { echo "PÅ"; } else { echo "AV";}?></div>
  </div>
</div>
<hr>


</body>
</html>
