
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
    <div class="col-4"><img src="images/eclipse-jpg.jpeg" width="100%"/></div>
    <div class="col-8 artistnsong">1. RUNAWAYS<br><div class="artist">ECLIPSE</div></div>
</div>

<div class="row">
    <div class="col-4" ><img src="images/dollystyle-jpg.jpeg" width="100%"/></div>
    <div class="col-8 artistnsong">2. ROLLERCOASTER<br><div class="artist">DOLLY STYLE</div></div>
</div>

<div class="row">
<div class="col-4"><img src="images/martinstenmarck-jpg.jpeg" width="100%"/></div>
<div class="col-8 artistnsong">3. DU TAR MIG TILLBAKS<br><div class="artist">MARTIN STENMARCK</div></div>
</div>

<div class="row">
<div class="col-4" id="bidrag1"><img src="images/lindabengtzing-jpg.jpeg" width="100%"/></div>
<div class="col-8 artistnsong">4. KILLER GIRL<br><div class="artist">LINDA BENGTZING</div></div>
</div>

<div class="row">
<div class="col-4" id="bidrag1"><img src="images/frans-jpg.jpeg" width="100%"/></div>
<div class="col-8 artistnsong">5. IF I WERE SORRY<br><div class="artist">FRANS</div></div>
</div>

<div class="row">
<div class="col-4" id="bidrag1"><img src="images/panetoz-jpg.jpeg" width="100%"/></div>
<div class="col-8 artistnsong">6. HÅLL OM MIG HÅRT<br><div class="artist">PANETOZ</div></div>
</div>

<div class="row">
<div class="col-4" id="bidrag1"><img src="images/mollysanden-jpg.jpeg" width="100%"/></div>
<div class="col-8 artistnsong">7. YOUNIVERSE<br><div class="artist">MOLLY SANDÉN</div></div>
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
