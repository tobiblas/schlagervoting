
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

<div class="row link-button"><button onClick="loadContest(1);" >1. LINKÖPING</button></div>
<div class="row link-button"><button onClick="loadContest(2);" >2. GÖTEBORG</button></div>
<div class="row link-button"><button onClick="loadContest(3);" >3. LULEÅ</button></div>
<div class="row link-button"><button onClick="loadContest(4);" >4. MALMÖ</button></div>
<!--<div class="row link-button"><button onClick="loadContest(5);" >ANDRA CHANSEN</button></div>
<div class="row link-button"><button onClick="loadContest(6);" >FINAL</button></div>-->

<?php require 'rules.php';?>

<div id="start-footer" onClick="openNav()">Så här funkar poängberäkningen</div>
