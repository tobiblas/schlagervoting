
<?php

    class Artist
    {
        public $song = '';
        public $name = '';
        
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
    
    #Deltävling 1: Göteborg 4/2 2017
    #Deltävling 2: Malmö 11/2 2017
    #Deltävling 3: Växjö 18/2 2017
    #Deltävling 4: Skellefteå 25/2 2017

    
    
    
?>


<div class="row"><div class="col-12 linksheader">DELTÄVLINGAR</div></div>

<div class="row link-button"><button><a href="?contest=1" >1. GÖTEBORG</a></button></div>
<div class="row link-button"><button><a href="?contest=2">2. MALMÖ</a></button></div>
<div class="row link-button"><button><a href="?contest=3">3. VÄXJÖ</a></button></div>
<div class="row link-button"><button><a href="?contest=4">4. SKELLEFTEÅ</a></button></div>



