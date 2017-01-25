
<?php
    $query =  "select vote from votes where name='" . $username . "'";
    $bidragarray = array();
    $votes = "";
    foreach ($dbh->query($query) as $row)
    {
        $votes = $row[0];
    }
    $pieces = explode(";", $votes);
    $i = 0;
    foreach ($pieces as $piece) {
        $bidragarray[$i] = explode("-", $piece)[1];
        $i = $i+1;
    }
    #http://www.svt.se/melodifestivalen/artister/
?>

<div id="items" class="list-group" style="width: 90%">

<div class="row">
<div class="col-4" id="bidrag1"><img src="images/panetoz-jpg.jpeg" width="100%"/></div>
<div class="col-8 artistnsong">1. HÅLL OM MIG HÅRT<br><div class="artist">PANETOZ</div></div>
</div>

<div class="row">
    <div class="col-4"><img src="images/lisaajax-jpg.jpeg" width="100%"/></div>
    <div class="col-8 artistnsong">2. MY HEART WANTS ME DEAD<br><div class="artist">LISA AJAX</div></div>
</div>

<div class="row">
    <div class="col-4" ><img src="images/davidlindgren-jpg.jpeg" width="100%"/></div>
    <div class="col-8 artistnsong">3. WE ARE YOUR TOMORROW<br><div class="artist">DAVID LINDGREN</div></div>
</div>

<div class="row">
<div class="col-4"><img src="images/saraha-jpg.jpeg" width="100%"/></div>
<div class="col-8 artistnsong">4. KIZUNGUZUNGU<br><div class="artist">SARAHA</div></div>
</div>

<div class="row">
<div class="col-4" id="bidrag1"><img src="images/oscarzia-jpg.jpeg" width="100%"/></div>
<div class="col-8 artistnsong">5. HUMAN<br><div class="artist">OSCAR ZIA</div></div>
</div>

<div class="row">
<div class="col-4" id="bidrag1"><img src="images/acewilder-jpg.jpeg" width="100%"/></div>
<div class="col-8 artistnsong">6. DONT WORRY<br><div class="artist">ACE WILDER</div></div>
</div>

<div class="row">
<div class="col-4" id="bidrag1"><img src="images/robinbengtsson-jpg.jpeg" width="100%"/></div>
<div class="col-8 artistnsong">7. <br>CONSTELLATION PRIZE<div class="artist">ROBIN BENGTSSON</div></div>
</div>

<div class="row">
<div class="col-4" id="bidrag1"><img src="images/mollysanden-jpg.jpeg" width="100%"/></div>
<div class="col-8 artistnsong">8. YOUNIVERSE<br><div class="artist">MOLLY SANDÉN</div></div>
</div>

<div class="row">
<div class="col-4" id="bidrag1"><img src="images/borisrene-jpg.jpeg" width="100%"/></div>
<div class="col-8 artistnsong">9. PUT YOUR LOVE ON ME<br><div class="artist">BORIS RENÉ</div></div>
</div>

<div class="row">
<div class="col-4" id="bidrag1"><img src="images/frans-jpg.jpeg" width="100%"/></div>
<div class="col-8 artistnsong">10. IF I WERE SORRY<br><div class="artist">FRANS</div></div>
</div>

<div class="row">
<div class="col-4" id="bidrag1"><img src="images/wiktoria-jpg.jpeg" width="100%"/></div>
<div class="col-8 artistnsong">11. SAVE ME<br><div class="artist">WIKTORIA</div></div>
</div>

<div class="row">
<div class="col-4" id="bidrag1"><img src="images/samir-viktor-jpg.jpeg" width="100%"/></div>
<div class="col-8 artistnsong">12. BADA NAKNA<br><div class="artist">SAMIR OCH VIKTOR</div></div>
</div>

</div>

<script>

var el = document.getElementById('items');
Sortable.create(el, {
                store: {
                /**
                 * Get the order of elements. Called once during initialization.
                 * @param   {Sortable}  sortable
                 * @returns {Array}
                 */
                get: function (sortable) {
                var order = localStorage.getItem(sortable.options.group);
                return order ? order.split('|') : [];
                },
                
                /**
                 * Save the order of elements. Called onEnd (when the item is dropped).
                 * @param {Sortable}  sortable
                 */
                set: function (sortable) {
                
                
                    var itemsInList = sortable.el.children;
                    var vote = "";
                    for (var i = 0; i < itemsInList.length; i++) {
                        var artistText = itemsInList[i].children[1].innerHTML;
                        vote += artistText.substring(0,1) + "-" + (i+1) + ";";
                    }
                    saveList(vote, sortable);
                }
                }
                })
</script>
