
<script>
function isIos() {
    var userAgent = navigator.userAgent || navigator.vendor || window.opera;
    
    // Windows Phone must come first because its UA also contains "Android"
    if (/windows phone/i.test(userAgent)) {
        return false;
    }
    
    if (/android/i.test(userAgent)) {
        return false;
    }
    
    // iOS detection from: http://stackoverflow.com/a/9039885/177710
    if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
        return true;
    }
    
    return false;
}

function loadContest(number) {
    if (isIos()) {
        window.location='?page=contestios&contest=' + number;
    } else {
        window.location='?page=contestandroid&contest=' + number;
    }
}

function openNav() {
    document.getElementById("myNav").style.width = "100%";
}

function closeNav() {
    document.getElementById("myNav").style.width = "0%";
}

</script>

<?php

    #Deltävling 1: Göteborg 4/2 2017
    #Deltävling 2: Malmö 11/2 2017
    #Deltävling 3: Växjö 18/2 2017
    #Deltävling 4: Skellefteå 25/2 2017
?>

<div class="row"><div class="col-12 linksheader">DELTÄVLINGAR</div></div>

<div class="row link-button"><button onClick="loadContest(1);" >1. GÖTEBORG</button></div>
<div class="row link-button"><button onClick="loadContest(2);" >2. MALMÖ</button></div>
<div class="row link-button"><button onClick="loadContest(3);" >3. VÄXJÖ</button></div>
<div class="row link-button"><button onClick="loadContest(4);" >4. SKELLEFTEÅ</button></div>
<div class="row link-button"><button onClick="loadContest(5);" >ANDRA CHANSEN</button></div>


<div id="myNav" class="overlay">

  <!-- Button to close the overlay navigation -->
  <div class="closebtn" onClick="closeNav()">&times;</div>

  <!-- Overlay content -->
  <div class="overlay-content">
    <div class="row"><div class="col-12 linksheader">Poängberäkning Deltävling</div></div>
    <br>
    <div class="row"><div class="col-12 center">FÖR VARJE BIDRAG FÅR MAN:</div></div>
    <br>
    <div class="row"><div class="col-12" style="padding: 3 3 3 10"><b>6 poäng</b> om du satte den i rätt grupp (direkt vidare/andra chansen/utslagen)</div></div>
    <div class="row"><div class="col-12" style="padding: 3 3 3 10"><b>3 poäng</b> om du satte den 1 steg ifrån rätt grupp (exempel: du satte direkt vidare men den hamnade i andra chansen)</div></div>
    <div class="row"><div class="col-12" style="padding: 3 3 30 10"><b>1 poäng</b> om du satte den 2 steg ifrån rätt grupp (exempel: du satte direkt vidare men den hamnade i utslagen)</div></div>

    <br>
    <div class="row"><div class="col-12 center">EXTRA:</div></div>
    <br>
    <div class="row"><div class="col-12" style="padding: 3 3 3 10"><b>2 poäng</b> om låt på plats 5 var rätt</div></div>
    <div class="row"><div class="col-12" style="padding: 3 3 3 10"><b>2 poäng</b> om låt på plats 6 var rätt</div></div>
    <div class="row"><div class="col-12" style="padding: 3 3 3 10"><b>4 poäng</b> om låt på plats 7 var rätt</div></div>

    <div class="row"><div class="col-12" style="padding: 3 3 3 10"><b>-5 poäng</b> om du satte låt på plats 7 som gick direkt vidare</div></div>

    <br><br>
    <div class="row"><div class="col-12 center">MAX poäng: 50</div></div>

    <div class="row"><div class="col-12 center">MIN poäng: 10</div></div>
  </div>

</div>

<div id="start-footer" onClick="openNav()">Så här funkar poängberäkningen</div>


