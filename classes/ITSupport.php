<?php

require_once "Employee.php";

//Inheritance
class ITSupport extends Employee
{
    public function getJobTitle()
    {
        return "IT Support";
    }
    
    //Polymorphism
    public function performTask()
    {
        return "Troubleshooting hardware and software problems.";
    }

    public function calculateSalary() //Method Overriding
    {
        return $this->getSalary() + 1500;
    }
}