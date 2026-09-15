<?php

require_once "classes/Employee.php";
require_once "classes/Developer.php";
require_once "classes/NetworkAdministrator.php";
require_once "classes/ITSupport.php";

$message = "";
$error = "";

$file = "employees.json";

// Create JSON file if it doesn't exist
if (!file_exists($file)) {
    file_put_contents($file, json_encode([], JSON_PRETTY_PRINT));
}


// HANDLE FORM SUBMISSION
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $employeeId = trim($_POST["employeeId"] ?? "");
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $type = $_POST["type"] ?? "";
    $salary = trim($_POST["salary"] ?? "");


    // VALIDATION
    if (
        empty($employeeId) ||
        empty($name) ||
        empty($email) ||
        empty($type) ||
        empty($salary)
    ) {

        $error = "Please complete all fields.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Please enter a valid email address.";

    } elseif (!is_numeric($salary) || $salary <= 0) {

        $error = "Salary must be a valid amount greater than 0.";

    } else {

        $salary = (float) $salary;


        // CREATE OBJECT
        switch ($type) {

            case "Developer":

                $employee = new Developer(
                    $employeeId,
                    $name,
                    $email,
                    $salary
                );

                break;


            case "Network Administrator":

                $employee = new NetworkAdministrator(
                    $employeeId,
                    $name,
                    $email,
                    $salary
                );

                break;


            case "IT Support":

                $employee = new ITSupport(
                    $employeeId,
                    $name,
                    $email,
                    $salary
                );

                break;


            default:

                $employee = null;
                $error = "Invalid employee type.";

                break;
        }


        // SAVE EMPLOYEE
        if ($employee !== null) {

            // Read existing employees
            $jsonData = file_get_contents($file);

            $employeeData = json_decode(
                $jsonData,
                true
            );

            if (!is_array($employeeData)) {
                $employeeData = [];
            }


            // Add new employee to JSON data
            $employeeData[] = [
                "employeeId" => $employeeId,
                "name" => $name,
                "email" => $email,
                "type" => $type,
                "salary" => $salary
            ];


            // Save back to JSON file
            file_put_contents(
                $file,
                json_encode(
                    $employeeData,
                    JSON_PRETTY_PRINT
                )
            );


            $message = "Employee successfully added!";


            // Clear form after successful submission
            $_POST = [];
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Employee</title>

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

    <section class="form-section">

        <h1>Add Employee</h1>

        <p class="form-description">
            Enter the employee information below.
        </p>


        <?php if (!empty($message)): ?>

            <div class="success">

                <?php echo htmlspecialchars($message); ?>

            </div>

        <?php endif; ?>


        <?php if (!empty($error)): ?>

            <div class="error">

                <?php echo htmlspecialchars($error); ?>

            </div>

        <?php endif; ?>


        <form method="POST" action="">


            <div class="form-group">

                <label for="employeeId">
                    Employee ID
                </label>

                <input
                    type="text"
                    id="employeeId"
                    name="employeeId"
                    placeholder="Example: EMP001"
                    value="<?php echo htmlspecialchars($_POST["employeeId"] ?? ""); ?>"
                    required
                >

            </div>


            <div class="form-group">

                <label for="name">
                    Full Name
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Enter employee name"
                    value="<?php echo htmlspecialchars($_POST["name"] ?? ""); ?>"
                    required
                >

            </div>


            <div class="form-group">

                <label for="email">
                    Email Address
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="employee@email.com"
                    value="<?php echo htmlspecialchars($_POST["email"] ?? ""); ?>"
                    required
                >

            </div>


            <div class="form-group">

                <label for="type">
                    Employee Type
                </label>

                <select
                    id="type"
                    name="type"
                    required
                >

                    <option value="">
                        -- Select Employee Type --
                    </option>

                    <option value="Developer">
                        Developer
                    </option>

                    <option value="Network Administrator">
                        Network Administrator
                    </option>

                    <option value="IT Support">
                        IT Support
                    </option>

                </select>

            </div>


            <div class="form-group">

                <label for="salary">
                    Basic Salary
                </label>

                <input
                    type="number"
                    id="salary"
                    name="salary"
                    placeholder="Example: 25000"
                    min="1"
                    step="0.01"
                    value="<?php echo htmlspecialchars($_POST["salary"] ?? ""); ?>"
                    required
                >

            </div>


            <button
                type="submit"
                class="btn primary"
            >
                Add Employee
            </button>


            <a
                href="employees.php"
                class="btn secondary"
            >
                View Employees
            </a>


        </form>

    </section>

</main>


<footer>

    <p>
        © 2026 IT Department Employee Management System
    </p>

</footer>


</body>

</html>