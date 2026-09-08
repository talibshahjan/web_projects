<?php

// class and object

class Student
{
    function sayHello()
    {
        echo "Hello! I am a student.<br><br>";
    }
}

$studentA = new Student();
$studentA->sayHello();


//class with constructor and multiple object

class Student
{
    public $name;
    public $studentId;
    public $department;

    function __construct($name, $studentId, $department)
    {
        $this->name = $name;
        $this->studentId = $studentId;
        $this->department = $department;
    }

    function showInfo()
    {
        echo "Name: " . $this->name . "<br>";
        echo "Student ID: " . $this->studentId . "<br>";
        echo "Department: " . $this->department . "<br><br><br>";
    }
}

$student1 = new Student(
    "talibshah",
    1001,
    "Is"
);

$student1->showInfo();

$student2 = new Student(
    "fardin",
    1002,
    "Is"
);

$student2->showInfo();


//access modifires

class BankAccount
{
    public $ownername;
    private $balance;

    function __construct($ownername, $balance)
    {
        $this->ownerName = $ownername;
        $this->balance = $balance;
    }

    function showBalance()
    {
        echo "Balance: " . $this->balance . "<br><br>";
    }
}

$account1 = new BankAccount(
    "Ahmad",
    5000
);

echo "Owner: " . $account1->ownerName . "<br>";
$account1->showBalance();

/*
The following line would NOT work because $balance is private:

echo $account1->balance;

private properties can only be accessed inside the same class.
*/


// ============================================================
// Inheritance
// ============================================================

class Person
{
    public $name;

    function __construct($name)
    {
        $this->name = $name;
    }

    function introduce()
    {
        echo "My name is " . $this->name . "<br>";
    }
}

class StudentPerson extends Person
{
    function study()
    {
        echo $this->name . " is studying.<br><br>";
    }
}

$student3 = new StudentPerson("Ahmad");

$student3->introduce();
$student3->study();



class Vehicle
{
    protected $brand;

    function __construct($brand)
    {
        $this->brand = $brand;
    }

    function start()
    {
        echo "The vehicle is starting<br>";
    }
}

class Car extends Vehicle
{
    function showBrand()
    {
        echo "Car brand: " . $this->brand;
    }
}

$car1 = new Car("mercedes benze");
$car1->start();
$car1->showBrand();

?>
