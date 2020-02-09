
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
      array(new Artist("The Mamas", "Move"),
            new Artist("Suzi P","Moves"),
            new Artist("Robin Bengtsson","Take a chance"),
            new Artist("Malou Prytz","Ballerina"),
            new Artist("OVÖ","Inga problem"),
            new Artist("Sonja Aldén","Sluta aldrig gå"),
            new Artist("Felix Sandman", "Boys with emotions")),
      array(new Artist("Klara Hammarström","Nobody"),
            new Artist("Jan Johansen", "Miraklernas tid"),
            new Artist("Dotter","Bulletproof"),
            new Artist("Méndez feat. Alvaro Estrella","Vamos Amigos"),
            new Artist("Linda Bengtzing","Alla mina sorger"),
            new Artist("Paul Rey","Talking in My Sleep"),
            new Artist("Anna Bergendahl","Kingdom Come")),
      array(new Artist("Mariette","Shout it out"),
            new Artist("Albin Johnsén","Livet börjar nu"),
            new Artist("Drängarna","Piga & dräng"),
            new Artist("Amanda Aasa","Late"),
            new Artist("Anis Don Demina","Vem e som oss"),
            new Artist("Faith Kakembo","Crying rivers"),
            new Artist("Mohombi","Winners")),
      array(new Artist("Frida Öhrn","We are one"),
            new Artist("William Stridh","Molnljus"),
            new Artist("Nanne Grönvall","Carpool karaoke"),
            new Artist("Victor Crone","Troubled waters"),
            new Artist("Ellen & Simon","Surface"),
            new Artist("Jakob Karlberg","Om du tror att jag saknar dig"),
            new Artist("Hanna Ferm","Brave")),
      array(new Artist("","Duell 1 - "),
            new Artist("","Duell 1 - "),
            new Artist("","Duell 2 - "),
            new Artist("","Duell 2 - "),
            new Artist("", "Duell 3 - "),
            new Artist("","Duell 3 - "),
            new Artist("", "Duell 4 - "),
            new Artist("", "Duell 4 - ")),
      array(new Artist("Jon Henrik Fjällgren", "Norrsken"),
            new Artist("Lisa Ajax","Torn"),
            new Artist("Mohombi","Hello"),
            new Artist("Lina Hedlund","Victorious"),
            new Artist("Bishara","On my own"),
            new Artist("Anna Bergendahl","Ashes to ashes"),
            new Artist("Nano","Chasing rivers"),
            new Artist("Hanna Ferm & Liamoo", "Hold you"),
            new Artist("Malou Prytz","I do me"),
            new Artist("John Lundvik", "Too late for love"),
            new Artist("Wiktoria","Not with me"),
            new Artist("Arvingarna","I do"))
      );

    $contestants = $artists[$contest];

    include("db.php");

    $query = "select count(*) from song where contestnumber =" . ($contest+1) .";";
    $numberOfResultsStmt = $dbh->query($query);
    $songs = (int) $numberOfResultsStmt->fetch()[0];
    if ($songs == 0) {
      $index = 1;
      foreach ($contestants as $contestant) {
          $name = $contestant->getName();
          $song = $contestant->getSong();
          $q = "insert into song values (" . ($contest+1) . ", " . $index . ",'" . $name . "','" . $song . "');";
          $index += 1;
          $dbh->query($q);
        }
    }

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
