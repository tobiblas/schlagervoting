
<?php
    
    $contest = $_GET['contest'];
    if ($contest != 1 && $contest != 2 && $contest != 3 && $contest != 4) {
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
     array(new Artist("Adrijana","Amare"), new Artist("Boris René", "Her kiss"), new Artist("Nano", "Hold on"),new Artist("Charlotte Perrelli","Mitt liv"),new Artist("Dinah Nah","One more night"),new Artist("De vet du","Road trip"),new Artist("Ace Wilder","Wild child")),
     array(new Artist("Mariette","A million years"), new Artist("Benjamin Ingrosso","Good loving"), new Artist("Roger Pontare", "Himmel och hav"),new Artist("Lisa Ajax","I don't giva a"),new Artist("Etzia","Up"),new Artist("Dismissed","Hearts alined"),new Artist("Allyawan","Vart haru varit")),
     array(new Artist("Owe Thörnqvist","Boogieman blues"), new Artist("Bella & Filippa","Crucified"), new Artist("The Fooo Conspiracy", "Gotta thing"),new Artist("Jasmine Kara","Gravity"),new Artist("Robin Bengtsson","I can’t go on"),new Artist("Angton hagman","Kiss you goodbye"),new Artist("Krista Sigfrieds","Snurra min jord")),
     array(new Artist("Wiktoria Johansson","As I lay me down"), new Artist("Les Gordons","Bound to fall"), new Artist("Sara Varga & Juha Mulari", "Du får inte ändra på mig"),new Artist("Jon Henrik Fjellgren feat Aninia","En värld full av strider"),new Artist("Axel Schylström","När ingen ser"),new Artist("Alice Svensson","Running with lions"),new Artist("Loreen","Statements"))
     );
    
    $contestants = $artists[$contest];
    
    echo "<ol id='items' class='list-group'>";
    
    $i = 1;
    foreach ($contestants as $contestant) {
        $name = $contestant->getName();
        $song = $contestant->getSong();
        
        echo '<li class="row listitem">';
        echo '<div class="col-4"><img id="image' . $i . '" src="images/artists/' . ($contest+1) . '-' . $i . '.jpeg" width="100%"/></div>';
        echo '<div class="col-8 artistnsong">' . $i . '. ' . $song .'<br><div class="artist">' . $name . '</div></div>';
        echo '</li>';

        $i++;
    }

    echo "</ol>";

    echo '<div class="contest-sidebar">';

    $i = 1;
    foreach ($contestants as $contestant) {
            switch($i) {
                case 1 :
                    echo '<div id="final" class="sidebar-item final">Final</div>';
                    break;
                case 3 :
                    echo '<div id="second-chance" class="sidebar-item second-chance">2 Chans</div>';
                    break;
                case 5 :
                    echo '<div id="looser" class="sidebar-item looser">Utslagna</div>';
                    break;
            }

            $i++;
        }
        echo "</div>";

    
    #$query =  "select vote from votes where name='" . $username . "'";
    #$bidragarray = array();
    #$votes = "";
    #foreach ($dbh->query($query) as $row)
    #{
    #    $votes = $row[0];
    #}
    #$pieces = explode(";", $votes);
    #$i = 0;
    #foreach ($pieces as $piece) {
    #    $bidragarray[$i] = explode("-", $piece)[1];
    #    $i = $i+1;
    #}
?>

<script>

$(function  () {
  $("ol.list-group").sortable();
  });

/*var el = document.getElementById('items');
Sortable.create(el, {
                store: {
                /**
                 * Get the order of elements. Called once during initialization.
                 * @param   {Sortable}  sortable
                 * @returns {Array}
                 */
/*                get: function (sortable) {
                var order = localStorage.getItem(sortable.options.group);
                return order ? order.split('|') : [];
                },
                
                /**
                 * Save the order of elements. Called onEnd (when the item is dropped).
                 * @param {Sortable}  sortable
                 */
/*                set: function (sortable) {
                
                
                    var itemsInList = sortable.el.children;
                    var vote = "";
                    for (var i = 0; i < itemsInList.length; i++) {
                        var artistText = itemsInList[i].children[1].innerHTML;
                        vote += artistText.substring(0,1) + "-" + (i+1) + ";";
                    }
                saveList(vote, sortable, <?php echo $contest+1; ?>);
                }
                }
                })*/
</script>