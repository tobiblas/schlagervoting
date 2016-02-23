<html>
<head>
<title>Schlager</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">


<link rel="stylesheet" href="styles.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">

<script src="http://rubaxa.github.io/Sortable/Sortable.js"></script>

<?php
    #CREATE TABLE VOTES(NAME TEXT NOT NULL, CONTESTNUMBER INT, VOTE TEXT NOT NULL);
    include("db.php");
    

    
    #$count = $dbh->query($query) as $entry;
    #echo $count;
    #$query =  "SELECT * FROM VOTES";
    #insert into votes ('tobias',2,'3;4;5;4;2');
    #foreach ($dbh->query($query) as $row)
    #{
    #    echo $row[2];
    #}
    
    if (!isset($_COOKIE["schlagername7"])) {
        $name_set = false;
    } else {
        $name_set = true;
        $username = $_COOKIE["schlagername7"];
    }
?>

<script>

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}

function saveList(vote, sortable)
{
    var contestnumber = 3;

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4) {
            if ( xmlHttp.status == 200 && xmlHttp.responseText.trim() == 'CLOSED') {
                alert("Voting is closed. Shop opens again in one week!");
                window.location.href = window.location.href;
            } else if ( xmlHttp.status != 200) {
                alert("Something went wrong. Please try again.");
                window.location.href = window.location.href;
            } else {
                var order = sortable.toArray();
                localStorage.setItem(sortable.options.group, order.join('|'));
            }
            //alert ();
        }
    }
    
    var query = "save.php?name=" + getCookie("schlagername7") + "&vote=" + vote + "&contestnumber=" + contestnumber;
    xmlHttp.open("GET", query, true); // true for asynchronous
    xmlHttp.send(null);
}

function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();
}

function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

function eraseCookie(name) {
    createCookie(name,"",-1);
}

function checkName() {
    var name = getCookie("schlagername7");
    if (name.trim() == "") {
        eraseCookie("schlagername7");
        alert ("Du har inte satt något namn. Du blir nu tilldelad namnet JagHarIngetNamn.");
        document.cookie="schlagername7=" + "JagHarIngetNamm";
        window.location.href = window.location.href;
    }
}

function nameEntered() {
    var name = document.getElementById("nameinput").value;
    if (name == null || name.trim() == "") {
        alert("Ogiltigt namn");
    } else {
        document.cookie="schlagername7=" + name.trim();
        //save("1-1;2-2;3-3;4-4;5-5;6-6;7-7;");
        window.location.href = window.location.href;
    }
}

</script>


</head>

<body onload="checkName();">


<div class="row">
    <div class="col-12">
        <img src="images/header_melodifestivalen2.jpg" id="img1" />
    </div>
    <div id="result" style="position: absolute;width: 100%;text-align: right;top: 10; right: 10; z-index:100;">
        <a href="result.php" style="color: white;">RESULTAT</a>
    </div>
    <div id="result" style="position: absolute;width: 100%;text-align: center;top: 10; z-index:99;">
<?php echo $username; ?>
    </div>
</div>


<?php
    if ($name_set) {
        include("bidrag.php");
    } else {
        include("enter_name.php");
    }
?>


</body>
</html>
