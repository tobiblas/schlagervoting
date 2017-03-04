
<?php
    
    $contest = $_GET['contest'];
    if ($contest != 1 && $contest != 2 && $contest != 3 && $contest != 4 && $contest != 5) {
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
     array(new Artist("Boris René", "Her kiss"),
           new Artist("Adrijana","Amare"),
           new Artist("Dinah Nah","One more night"),
           new Artist("De vet du","Road trip"),
           new Artist("Charlotte Perrelli","Mitt liv"),
           new Artist("Ace Wilder","Wild child"),
           new Artist("Nano", "Hold on")),
     array(new Artist("Mariette","A million years"),
           new Artist("Roger Pontare", "Himmel och hav"),
           new Artist("Etzia","Up"),
           new Artist("Allyawan","Vart haru varit"),
           new Artist("Dismissed","Hearts alined"),
           new Artist("Lisa Ajax","I don't giva a"),
           new Artist("Benjamin Ingrosso","Good loving")),
     array(new Artist("Robin Bengtsson","I can’t go on"),
           new Artist("Krista Sigfrieds","Snurra min jord"),
           new Artist("Angton hagman","Kiss you goodbye"),
           new Artist("Jasmine Kara","Gravity"),
           new Artist("Owe Thörnqvist","Boogieman blues"),
           new Artist("Bella & Filippa","Crucified"),
           new Artist("The Fooo Conspiracy", "Gotta thing about you")),
     array(new Artist("Jon Henrik Fjellgren feat Aninia","En värld full av strider"),
           new Artist("Alice Svensson","Running with lions"),
           new Artist("Les Gordons","Bound to fall"),
           new Artist("Wiktoria Johansson","As I lay me down"),
           new Artist("Axel Schylström","När ingen ser"),
           new Artist("Sara Varga & Juha Mulari", "Du får inte ändra på mig"),
           new Artist("Loreen","Statements")),
     array(new Artist("FO&O", "Gotta thing about you"),
           new Artist("De vet du","Road trip"),
           new Artist("Axel Schylström","När ingen ser"),
           new Artist("Lisa Ajax","I don't giva a"),
           new Artist("Boris René", "Her kiss"),
           new Artist("Dismissed","Hearts alined"),
           new Artist("Anton hagman","Kiss you goodbye"),
           new Artist("Loreen","Statements"))
     );
    
    $contestants = $artists[$contest];
    
    echo "<ol id='items' class='list-group'>";
    
    $i = 1;
    foreach ($contestants as $contestant) {
        $name = $contestant->getName();
        $song = $contestant->getSong();
        
        echo '<li class="row listitem" id="item' . $i . '" >';
        echo '<div class="col-4"><img id="image' . $i . '" src="images/artists/' . ($contest+1) . '-' . $i . '.jpeg" width="100%"/></div>';
        echo '<div class="col-8 artistnsong">' . $i . '. ' . $song .'<br><div class="artist">' . $name . '</div></div>';
        echo '</li>';

        $i++;
    }

    echo "</ol>";

    echo '<div class="contest-sidebar">';

    $i = 1;
    foreach ($contestants as $contestant) {
        if ($contest == (5-1)) {
            switch($i) {
                case 1 :
                    echo '<div id="final2" class="sidebar-item final">F<br>i<br>n<br>a<br>l</div>';
                    break;
                case 5 :
                    echo '<div id="looser2" class="sidebar-item looser">U<br>t<br>s<br>l<br>a<br>g<br>n<br>a</div>';
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
                                         vote += artistText.substring(0,1) + "-" + (i+1) + ";";
                                         saveData += artistText.substring(0,1) + ";";
                                         }
                                         saveList(vote, container, <?php echo $contest+1; ?>, true, saveData);
                                         
                                         }, 100);
                              
                              
                              
                              _super($item, container);
                              }
                              });
  });

</script>