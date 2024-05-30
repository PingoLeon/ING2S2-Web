<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $job_id = $_POST['job_id'];

    $servername = "localhost";
    $username = "root"  ;
    $password = "";
    $dbname = "ECEIn";
    $conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    $sql = "INSERT INTO Applications (Job_ID, User_ID) VALUES ('$job_id', '1')"; // Assuming User_ID is 1 for demo purposes

    if ($conn->query($sql) === TRUE) {
        echo "Application submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
