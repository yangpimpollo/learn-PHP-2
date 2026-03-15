<?php 

class Person {
    protected $firstName;
    protected $lastName;

    public function __construct($firstName, $lastName) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function getFullName() { return "$this->firstName $this->lastName"; }

    public function getFirstName() { return $this->firstName; }
    public function setFirstName($firstName) { $this->firstName = $firstName; }
    public function getLastName() { return $this->lastName; }

    public function setLastName($lastName) { 
        if($lastName === 'Smith')  { throw new Exception("Smith no está permitido como apellido.."); }
        $this->lastName = $lastName; 
    }
}

$person1 = new Person('John', 'Doe');

#$firstName = $person1->firstName;
#$lastName = $person1->lastName;

#echo "Hello, ". $person1->getFullName() . "!";
$person1->setLastName('Smith');
#echo "Hello, ". $person1->getFullName() . "!";
?>