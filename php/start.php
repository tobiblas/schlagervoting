
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

    #Deltävling 1: Karlstad 3/2 2018
    #Deltävling 2: Göteborg 10/2 2018
    #Deltävling 3: Malmö 17/2 2018
    #Deltävling 4: Örnsköldsvik 24/2 2018
?>

<div class="row"><div class="col-12 linksheader">DELTÄVLINGAR</div></div>

<div class="row link-button"><button onClick="loadContest(1);" >1. KARLSTAD</button></div>
<div class="row link-button"><button onClick="loadContest(2);" >2. GÖTEBORG</button></div>
<div class="row link-button"><button onClick="loadContest(3);" >3. MALMÖ</button></div>
<div class="row link-button"><button onClick="loadContest(4);" >4. ÖRNSKÖLDSVIK</button></div>
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
<div class="row"><div class="col-12 linksheader">Poängberäkning Final</div></div>
<br>
<div class="row"><div class="col-12 center">FÖR VARJE BIDRAG I FINALEN FÅR MAN:</div></div>
<div class="row"><div class="col-12" style="padding: 3 3 3 10"><b>12 poäng</b> minus antal steg ifrån rätt position den kom på. Exempel:</div></div>
<div class="row"><div class="col-12" style="padding: 3 3 3 10">Ace Wilder kom på plats 5. Bo gissade på att hon skulle komma på plats 7. Bo får då 12 - 2 poäng -> <b>10 poäng</b> för detta bidrag. Samma princip tillämpas för alla bidragen och summeras.</div></div>


   <div class="row"><div class="col-12 linksheader">Poängberäkning Deltävling 1-4</div></div>
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
    <!--<div class="row"><div class="col-12 center">FÖR VARJE BIDRAG I FINALEN FÅR MAN:</div></div>
<div class="row"><div class="col-12" style="padding: 3 3 3 10"><b>12 poäng</b> minus antal steg ifrån rätt position den kom på. Exempel:</div></div>
    <div class="row"><div class="col-12" style="padding: 3 3 3 10">Ace Wilder kom på plats 5. Bo gissade på att hon skulle komma på plats 7. Bo får då 12 - 2 poäng -> <b>10 poäng</b> för detta bidrag. Samma princip tillämpas för alla bidragen och summeras.</div></div>
-->
  </div>

</div>

<div id="start-footer" onClick="openNav()">Så här funkar poängberäkningen</div>
