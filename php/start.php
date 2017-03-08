
<script>


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
<div class="row link-button"><button onClick="loadContest(6);" >FINAL</button></div>

<div id="myNav" class="overlay">

  <!-- Button to close the overlay navigation -->
  <div class="closebtn" onClick="closeNav()">&times;</div>

  <!-- Overlay content -->
  <div class="overlay-content">
    <div class="row"><div class="col-12 linksheader">Deltävling 1-4</div></div>
    <div class="row"><div class="col-12 center">MAX poäng: 50</div></div>
    <div class="row"><div class="col-12 center">MIN poäng: 10</div></div>

    <div class="row"><div class="col-12 linksheader">Andra chansen</div></div>
    <div class="row"><div class="col-12 center">MAX poäng: 24</div></div>
    <div class="row"><div class="col-12 center">MIN poäng: 0</div></div>

    <div class="row"><div class="col-12 linksheader">FINAL</div></div>
    <div class="row"><div class="col-12 center">MAX poäng: 144</div></div>
    <div class="row"><div class="col-12 center">MIN poäng: 72</div></div>
<br>
    <div class="row"><div class="col-12 center">FÖR VARJE BIDRAG I FINALEN FÅR MAN:</div></div>
<div class="row"><div class="col-12" style="padding: 3 3 3 10"><b>12 poäng</b> minus antal steg ifrån rätt position den kom på. Exempel:</div></div>
    <div class="row"><div class="col-12" style="padding: 3 3 3 10">Ace Wilder kom på plats 5. Bo gissade på att hon skulle komma på plats 7. Bo får då 12 - 2 poäng -> <b>10 poäng</b> för detta bidrag. Samma princip tillämpas för alla bidragen och summeras.</div></div>
  </div>

</div>

<div id="start-footer" onClick="openNav()">Så här funkar poängberäkningen</div>


