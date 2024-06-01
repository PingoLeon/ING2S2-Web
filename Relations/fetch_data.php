<?php
include '../Auth/functions.php';
$db_handle = connect_to_db();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch user details
    if (isset($_GET['sql'])) {
        $sql = $_GET['sql'];
        // Replace placeholder with actual ID
        $sql = str_replace(':id', $id, $sql);
        $result_user = mysqli_query($db_handle, $sql);
        $data_user = mysqli_fetch_assoc($result_user);
    }

    // Fetch education details
    $sql_education = "SELECT Education.*, Enterprise.Nom_Entreprise, Enterprise.Logo 
                    FROM Education 
                    JOIN Enterprise ON Education.Enterprise_ID = Enterprise.Enterprise_ID 
                    WHERE Education.User_ID = $id 
                    ORDER BY Education.Debut DESC";
    $result_education = mysqli_query($db_handle, $sql_education);
    $data_education = mysqli_fetch_all($result_education, MYSQLI_ASSOC);

    // Fetch experience details
    $sql_experience = "SELECT Experience.*, Enterprise.Nom_Entreprise, Enterprise.Logo 
                    FROM Experience 
                    JOIN Enterprise ON Experience.Enterprise_ID = Enterprise.Enterprise_ID 
                    WHERE Experience.User_ID = $id 
                    ORDER BY Experience.Debut DESC";
    $result_experience = mysqli_query($db_handle, $sql_experience);
    $data_experience = mysqli_fetch_all($result_experience, MYSQLI_ASSOC);

    // Fetch projects details
    $sql_projects = "   SELECT Projets.*, Education.Nom as Edu_Name 
                        FROM Projets 
                        JOIN Education ON Projets.Edu_ID = Education.Edu_ID 
                        WHERE Projets.User_ID = $id 
                        ORDER BY Projets.Debut DESC";
    $result_projects = mysqli_query($db_handle, $sql_projects);
    $data_projects = mysqli_fetch_all($result_projects, MYSQLI_ASSOC);

    // Combine all data into one array
    $data = [
        'user' => $data_user,
        'education' => $data_education,
        'experience' => $data_experience,
        'projects' => $data_projects
    ];

    echo json_encode($data);
} else {
    echo json_encode(['error' => 'No ID provided']);
}
?>