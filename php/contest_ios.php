
<?php

    $contest = $_GET['contest'];
    if ($contest != 1 && $contest != 2 && $contest != 3 && $contest != 4 && $contest != 5 && $contest != 6) {
        echo "ERROR! Invalid contestnumber";
        die();
    }

    $contest -=1;

    class Artist
    {
        public $song = '';
        public $name = '';

        function getSong()
        { return $this->song; }

        function getName()
        { return $this->name; }

        public function __construct($name='', $song='')
        {
            $this->song = $song;
            $this->name = $name;
        }
    }

    $artists = array
    (
      array(new Artist("Sigrid Bernson", "Patrick Swayze"),
            new Artist("John Lundvik","My Turn"),
            new Artist("Renaida","All The Feels"),
            new Artist("Edward Blom","Livet på en pinne"),
            new Artist("Kikki Danielsson","Osby Tennessee"),
            new Artist("Kamferdrops","Solen lever kvar hos dig"),
            new Artist("Benjamin Ingrosso", "Dance You Off")),
      array(new Artist("Samir & Viktor","Shuffla"),
            new Artist("Ida Redig", "Allting som vi sa"),
            new Artist("Jonas Gardell","Det finns en väg"),
            new Artist("Margaret","In My Cabana"),
            new Artist("Stiko Per Larsson","Titta vi flyger"),
            new Artist("Mimi Werner","Songburning"),
            new Artist("LIAMOO","Last Breath")),
      array(new Artist("Martin Almgren","A Bitter Lullaby"),
            new Artist("Barbi Escobar","Stark"),
            new Artist("Moncho","Cuba Libre"),
            new Artist("Jessica Andersson","Party Voice"),
            new Artist("Kalle Moraeus & Orsa Spelmän","Min dröm"),
            new Artist("Dotter","Cry"),
            new Artist("Mendez", "Everyday")),
      array(new Artist("Emmi Christensson","Icarus"),
            new Artist("Elias Abbas","Mitt paradis"),
            new Artist("Felicia Olsson","Break That Chain"),
            new Artist("Rolandz","Fuldans"),
            new Artist("Olivia Eliasson","Never Learn"),
            new Artist("FELIX SANDMAN", "Every Single Day"),
            new Artist("Mariette","For You")),
      array(new Artist("Margaret","Duell 1 - In My Cabana"),
            new Artist("Moncho","Duell 1 - Cuba Libre"),
            new Artist("Renaida","Duell 2 - All The Feels"),
            new Artist("Olivia Eliasson","Duell 2 - Never Learn"),
            new Artist("Felix Sandman", "Duell 3 - Every Single Day"),
            new Artist("Mimi Werner","Duell 3 - Songburning"),
            new Artist("Sigrid Bernson", "Duell 4 - Patrick Swayze"),
            new Artist("Mendez", "Duell 4 - Everyday")),
      array(new Artist("Mendez", "Everyday"),
            new Artist("Renaida","All The Feels"),
            new Artist("Martin Almgren","A Bitter Lullaby"),
            new Artist("John Lundvik","My Turn"),
            new Artist("Jessica Andersson","Party Voice"),
            new Artist("LIAMOO","Last Breath"),
            new Artist("Samir & Viktor","Shuffla"),
            new Artist("Mariette","For You"),
            new Artist("Felix Sandman", "Every Single Day"),
            new Artist("Margaret","In My Cabana"),
            new Artist("Benjamin Ingrosso", "Dance You Off"),
            new Artist("Rolandz","Fuldans"))
      );

    $contestants = $artists[$contest];

    echo "<ol id='items' class='list-group'>";

    $i = 1;
    foreach ($contestants as $contestant) {
        $name = $contestant->getName();
        $song = $contestant->getSong();

        echo '<li class="row listitem" id="item' . $i . '" >';
        echo '<div class="col-4"><img id="image' . $i . '" src="images/artists/' . ($contest+1) . '-' . $i . '.jpeg?d=D" width="100%"/></div>';
        echo '<div class="col-8 artistnsong">' . $i . '. ' . $song .'<br><div class="artist">' . $name . '</div></div>';
        echo '</li>';

        $i++;
    }

    echo "</ol>";

    echo '<div class="contest-sidebar">';

    $i = 1;
    foreach ($contestants as $contestant) {
        if ($contest == (5-1)) {
            # Andra chansen
            switch($i) {
                case 1 :
                    echo '<div id="second-chance-final" class="sidebar-item second-chance final">F<br>i<br>n<br>a<br>l</div>';
                    break;
                case 5 :
                    echo '<div id="second-chance-looser" class="sidebar-item second-chance looser">U<br>t<br>s<br>l<br>a<br>g<br>n<br>a</div>';
                    break;
            }
        } else if ($contest < (5-1)) {
            switch($i) {
                case 1 :
                    echo '<div id="final" class="sidebar-item final">F<br>i<br>n<br>a<br>l</div>';
                    break;
                case 3 :
                    echo '<div id="second-chance" class="sidebar-item second-chance">2<br>C<br>h<br>a<br>n<br>s</div>';
                    break;
                case 5 :
                    echo '<div id="looser" class="sidebar-item looser">U<br>t<br>s<br>l<br>a<br>g<br>n<br>a</div>';
                    break;
            }
        } else if ($contest == 5) {
            switch($i) {
                case 1 :
                    echo '<div id="grand-final" class="sidebar-item final"><br>S<br>C<br>O<br>L<br>L<br>A<br><br>H<br>Ä<br>R<br></div>';
                    break;
            }
        }

        $i++;
    }
    echo "</div>";
?>

<script>

function getSavedList(contestnumber)
{

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4) {
            if ( xmlHttp.status == 200) {
                var resp = xmlHttp.responseText.trim();
                if (resp.length > 0) {
                    itemNumbers = resp.split(";");
                    var a = document.getElementById('items');
                    for (var i = 0; i < a.childNodes.length; ++i) {
                        document.getElementById('items').appendChild(document.getElementById('item' + itemNumbers[i]));
                    }
                }
            } else {
                alert("Something went wrong. Please try again.");
            }
        }
    }

    var query = "getlist.php?token=" + getCookie("melloToken2") + "&contestnumber=" + contestnumber;
    //alert (query);
    xmlHttp.open("GET", query, true); // true for asynchronous
    xmlHttp.send(null);
}

getSavedList(<?php echo ($contest+1); ?>);


$(function  () {
  $("ol.list-group").sortable({

                              onDrop: function ($item, container, _super) {



                              setTimeout(
                                         function() {
                                         var container = document.getElementById('items');
                                         var itemsInList = container.children;
                                         var vote = "";
                                         var saveData = "";
                                         for (var i = 0; i < itemsInList.length; i++) {
                                         var artistText = itemsInList[i].children[1].innerHTML;
                                         vote += artistText.substr(0, artistText.indexOf('.')) + "-" + (i+1) + ";";
                                         saveData += artistText.substring(0,1) + ";";
                                         }
                                         saveList(vote, container, <?php echo $contest+1; ?>, true, saveData);

                                         }, 100);



                              _super($item, container);
                              }
                              });
  });

</script>
