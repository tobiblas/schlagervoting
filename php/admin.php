<html>
<head>
<title>Schlager</title>
<link rel="stylesheet" href="styles.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">

<script>
function saveresult(contestnumber)
{
    var numberofcontestants = 12;
    
    if (contestnumber == -1) {
        alert("missing contestnumber!");
        return;
    }
    
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
    
    var result = "";
    for (var i = 0; i < numberofcontestants; i++) {
        result += (i+1) + "-" + document.getElementById("bidrag" + (i+1)).value + ";";
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
<body>

<div class="row">
<div class="col-12">
<img src="images/header_melodifestivalen2.jpg" id="img1" />
</div>
</div>


<?php
    
    include("db.php");
    
    $bidrag = 12; #CHANGE THIS WHEN FINAL OR ANDRA CHANSEN
    $contestnumber = $_GET['contestnumber'];
    if ($contestnumber == null || $contestnumber == "") {
        echo "MISSING CONTESTNUMBER!";
    }
   
    echo "skicka med parameter 'contestnumber=X'. Sen bidrag x kom på plats nummer...<br>";
for ($j = 0; $j < $bidrag; $j++) {
echo "<div class='row'><div class='col-12'><select id='bidrag".($j+1)."' class='selector'>";
    for ($i = 0; $i < $bidrag; $i++) {
        echo "<option value='".($i+1)."' >".($i+1)."</option>";
    }
echo "</select></div></div>";
}
?>
<div class='row'><div class='col-12'><br>
<button id="nameinputbutton" name="sdfjksd" <?php echo "onclick='saveresult(" . $contestnumber . ")'"; ?> >OK</button>
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
<div class="col-12">Röstning är <?php if ($voteOn) { echo "PÅ"; } else { echo "AV";}?></div>
</div>

<br>
<?php
    if ($voteOn) {
        echo "<button id='nameinputbutton' name='sdfjksd' onclick='setVoteEnabled(false)'>TOGGLE</button>";
    } else {
        echo "<button id='nameinputbutton' name='sdfjksd' onclick='setVoteEnabled(true)'>TOGGLE</button>";
    }
?>


</body>
</html>
