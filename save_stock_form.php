<?php
// Database connection details
$host = "localhost";
$dbname = "hi5";
$username = "root";
$password = "";

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Start the session
    session_start();

    // Check if the form_data is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['form_data'])) {
        // Decode the JSON data
        $formData = json_decode($_POST['form_data'], true);

        // Output the received JSON data for debugging
        echo "Received JSON data: ";
        print_r($formData);

        // Insert logic here to save the data to the database

        // Respond with a success message
        echo "Form data saved successfully.";
    } else {
        echo "No form data received.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
    // Close the database connection
    $pdo = null;
}
?>
