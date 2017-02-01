
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
