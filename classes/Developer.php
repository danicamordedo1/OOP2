<?php

require_once "Employee.php";

//Inheritance
class Developer extends Employee
{
     public function getJobTitle()
    {
        return "Developer";
    }
    public function performTask()
    {
        return "Developing and maintaining software applications.";
    }

    public function calculateSalary()
    {
        return $this->getSalary() + 3000;
    }
}