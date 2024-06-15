<?php
session_start();

$statusObject = new stdClass();
unset($_SESSION['signup']);
session_abort();

$statusObject->status = false;
$statusObject->errorMessage = "";

$conn = mysqli_connect('localhost', 'root', '', 'projectdb');

if (!$conn) {
    $statusObject->errorMessage = "Connection failure: " . mysqli_connect_error();
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email=? AND password=?";

    try {
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "ss", $email, $password);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) > 0) {
                    $statusObject->status = true;
                } else {
                    $statusObject->errorMessage = "Invalid email or password.";
                }
            } else {
                throw new Exception("Error executing SQL statement: " . mysqli_stmt_error($stmt));
            }
        } else {
            throw new Exception("Error preparing SQL statement: " . mysqli_stmt_error($stmt));
        }
        mysqli_stmt_close($stmt);
    } catch (Exception $e) {
        $statusObject->errorMessage = "Error: " . $e->getMessage();
    }
}

?>

<html>

<title>Fixit</title>

<body>
    
</body>

</html>