<?php 

abstract class Unit {
    protected $falive = true;
    protected $name;

    public function __construct($name) { $this->name = $name; }
    

    abstract public function move($direction);

    public function atack($opponent) { echo $this->name . " is attacking " . $opponent . "\n"; }
    
}

class Soldier extends Unit {
    
    public function move($direction) {
            echo $this->name . " is moving " . $direction . "\n";
    }
    public function atack($opponent) {
        echo $this->name . " is attacking " . $opponent . " with a sword\n";
    }


}

$fulano = new Soldier( "Fulano");
$fulano->atack("enemies"); 

echo "helllllooooooooooooooooooooooo"
?>