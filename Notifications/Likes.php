<?php
session_start();
if (isset($_SESSION['user_id']) && isset($_POST['post_id'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ECEin";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user_id = $_SESSION['user_id'];
    $post_id = $_POST['post_id'];
    $action = $_POST['action']; // 'like' or 'unlike'

    if ($action == 'like') { //! Action à réaliser si on like le post
        $sql_check = "SELECT * FROM likes WHERE User_ID = ? AND Post_ID = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("ii", $user_id, $post_id);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows == 0) {
            $sql_insert = "INSERT INTO likes (Post_ID, User_ID) VALUES (?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param("ii", $post_id, $user_id);

            if ($stmt_insert->execute()) {
                $sql_update = "UPDATE posts SET Nb_likes = Nb_likes + 1 WHERE Post_ID = ?";
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->bind_param("i", $post_id);
                $stmt_update->execute();
            }
        }
    } elseif ($action == 'unlike') { //! Action à réaliser si on enlève le like 
        $sql_check = "SELECT * FROM likes WHERE User_ID = ? AND Post_ID = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("ii", $user_id, $post_id);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            $sql_delete = "DELETE FROM likes WHERE User_ID = ? AND Post_ID = ?";
            $stmt_delete = $conn->prepare($sql_delete);
            $stmt_delete->bind_param("ii", $user_id, $post_id);

            if ($stmt_delete->execute()) {
                // Update the Nb_likes in the posts table
                $sql_update = "UPDATE posts SET Nb_likes = Nb_likes - 1 WHERE Post_ID = ?";
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->bind_param("i", $post_id);
                $stmt_update->execute();
            }
        }
    }

    $conn->close();
} else {
    echo "You must be logged in to like a post.";
}
?>
