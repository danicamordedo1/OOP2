<?php

require_once "Employee.php";

//Inheritance
class NetworkAdministrator extends Employee
{
    public function getJobTitle()
    {
        return "Network Administrator";
    }
    public function performTask()
    {
        return "Managing networks, servers, and system connectivity.";
    }

    public function calculateSalary()
    {
        return $this->getSalary() + 2500;
    }
}