<?php

class Employee
{
    //Encapsulation
    protected $employeeId;
    protected $name;
    protected $email;
    private $salary;

    //Constructor
    public function __construct($employeeId, $name, $email, $salary)
    {
        $this->employeeId = $employeeId;
        $this->name = $name;
        $this->email = $email;
        $this->salary = $salary;
    }

    public function getEmployeeId()
    {
        return $this->employeeId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSalary()
    {
        return $this->salary;
    }

    public function performTask()
    {
        return "Employee is performing a task.";
    }

    public function calculateSalary()
    {
        return $this->salary;
    }
}