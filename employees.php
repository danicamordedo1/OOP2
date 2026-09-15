<?php

require_once "classes/Employee.php";
require_once "classes/Developer.php";
require_once "classes/NetworkAdministrator.php";
require_once "classes/ITSupport.php";

$file = "employees.json";

if (!file_exists($file)) {
    file_put_contents($file, json_encode([], JSON_PRETTY_PRINT));
}

$jsonData = file_get_contents($file);

$employeeData = json_decode($jsonData, true);

if (!is_array($employeeData)) {
    $employeeData = [];
}

$employees = [];

foreach ($employeeData as $data) {

    switch ($data["type"]) {

        case "Developer":

            $employees[] = new Developer(
                $data["employeeId"],
                $data["name"],
                $data["email"],
                $data["salary"]
            );

            break;


        case "Network Administrator":

            $employees[] = new NetworkAdministrator(
                $data["employeeId"],
                $data["name"],
                $data["email"],
                $data["salary"]
            );

            break;


        case "IT Support":

            $employees[] = new ITSupport(
                $data["employeeId"],
                $data["name"],
                $data["email"],
                $data["salary"]
            );

            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Employees</title>

    <link rel="stylesheet" href="style.css">

</head>


<body>


    <header>

        <div class="logo">
            IT Department
        </div>


        <nav>

            <a href="index.php">
                Home
            </a>

            <a href="add_employee.php">
                Add Employee
            </a>

            <a href="employees.php">
                Employees
            </a>

        </nav>

    </header>



    <main class="container">

        <section class="employee-section">


            <div class="page-header">

                <div>

                    <h1>
                        Employee List
                    </h1>

                    <p>
                        View all employees currently stored in the system.
                    </p>

                </div>


                <a href="add_employee.php" class="btn primary">

                    + Add Employee

                </a>

            </div>



            <?php if (empty($employees)): ?>


                <div class="empty-state">

                    <h2>
                        No Employees Found
                    </h2>

                    <p>
                        There are currently no employees in the system.
                    </p>

                    <a href="add_employee.php" class="btn primary">

                        Add First Employee

                    </a>

                </div>


            <?php else: ?>


                <div class="employee-grid">


                    <?php foreach ($employees as $employee): ?>


                        <div class="employee-card">


                            <div class="employee-top">


                                <div class="employee-icon">
                                    👤
                                </div>


                                <div>

                                    <h2>

                                        <?php

                                        echo htmlspecialchars(
                                            $employee->getName()
                                        );

                                        ?>

                                    </h2>


                                    <span class="employee-id">

                                        <?php

                                        echo htmlspecialchars(
                                            $employee->getEmployeeId()
                                        );

                                        ?>

                                    </span>


                                    <span class="job-title">

                                        <?php
                                        echo htmlspecialchars(
                                            $employee->getJobTitle()
                                        );
                                        ?>

                                    </span>

                                </div>


                            </div>



                            <div class="employee-info">


                                <p>

                                    <strong>
                                        Email:
                                    </strong>

                                    <?php

                                    echo htmlspecialchars(
                                        $employee->getEmail()
                                    );

                                    ?>

                                </p>



                                <p>

                                    <strong>
                                        Basic Salary:
                                    </strong>

                                    ₱<?php

                                    echo number_format(
                                        $employee->getSalary(),
                                        2
                                    );

                                    ?>

                                </p>



                                <p>

                                    <strong>
                                        Calculated Salary:
                                    </strong>

                                    ₱<?php

                                    echo number_format(
                                        $employee->calculateSalary(),
                                        2
                                    );

                                    ?>

                                </p>


                            </div>



                            <div class="task-box">


                                <strong>
                                    Assigned Task
                                </strong>




                                <p>

                                    <?php

                                    echo htmlspecialchars(
                                        $employee->performTask()
                                    );

                                    ?>

                                </p>


                            </div>


                        </div>


                    <?php endforeach; ?>


                </div>


            <?php endif; ?>


        </section>

    </main>



    <footer>

        <p>
            © 2026 IT Department Employee Management System
        </p>

    </footer>


</body>

</html>