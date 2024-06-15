<?php
header("Access-Control-Allow-Origin: *"); // Allow requests from any origin
header("Access-Control-Allow-Methods: POST"); // Allow POST requests only
header("Access-Control-Allow-Headers: Content-Type"); // Allow Content-Type header

// Set the response content type to JSON
header('Content-Type: application/json');

// Function to handle sign-up requests
function signUpUser() {
    $statusObject = new stdClass();
    $statusObject->status = false;
    $statusObject->errorMessage = "";

    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'projectdb');
    if (!$conn) {
        $statusObject->errorMessage = "Connection failure: " . mysqli_connect_error();
        return json_encode($statusObject);
    }

    // Check if the request method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $pincode = $_POST['pincode'];
        $userType = $_POST['userType'];
        $imgUrl = $_FILES['imgUrl']['name'];
        $phNo = $_POST['phNo'];

        // Check if all required fields are provided
        if (empty($name) || empty($email) || empty($password) || empty($address) || empty($city) || empty($pincode) || empty($userType) || empty($phNo) || empty($imgUrl)) {
            $statusObject->errorMessage = "All fields are required";
            return json_encode($statusObject);
        }

        // SQL query to insert data into the database
        $sql = "INSERT INTO users (name, email, password, address, city, pincode, phNo, userStatus, userImgUrl)
                VALUES ('$name', '$email', '$password', '$address', '$city', '$pincode', '$phNo', '$userType', '$imgUrl')";

        // Attempt to execute the SQL query
        try {
            if (mysqli_query($conn, $sql)) {
                $statusObject->status = true;
            } else {
                throw new Exception("Error: " . $sql . " " . mysqli_error($conn));
            }
        } catch (Exception $e) {
            $statusObject->errorMessage = "Error: " . $e->getMessage();
        }
    }

    // Close the database connection
    mysqli_close($conn);

    // Return the status object as JSON
    return json_encode($statusObject);
}

// Call the signUpUser function and output the result
echo signUpUser();
?>
