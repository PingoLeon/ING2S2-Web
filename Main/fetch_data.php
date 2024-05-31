<?php

//Document to fetch data from the database
$database = "ecein";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

if (isset($_GET['sql']) && isset($_GET['id'])) {
    $sql = $_GET['sql'];
    $id = $_GET['id'];

    // Replace placeholder with actual ID
    $sql = str_replace(':id', $id, $sql);

    $result = mysqli_query($db_handle, $sql);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
        echo json_encode($data);
    } else {
        echo json_encode(['error' => 'Query failed']);
    }
}
?>
