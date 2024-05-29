<?php

function Creation_XML() {
  
  $database = "ecein";
  $db_handle = mysqli_connect('localhost', 'root', '');
  $db_found = mysqli_select_db($db_handle, $database);

  $user_id = 1;

  

  // Create connection
  $conn = new mysqli('localhost', 'root', '', 'ecein');

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // Fetch user details
  $sql_user = "SELECT * FROM Utilisateur WHERE User_ID = $user_id";
  $result_user = $conn->query($sql_user);
  $user = $result_user->fetch_assoc();

  // Fetch education details
  $sql_education = "SELECT Education.*, Enterprise.Nom_Entreprise, Enterprise.Logo 
                    FROM Education 
                    JOIN Enterprise ON Education.Enterprise_ID = Enterprise.Enterprise_ID 
                    WHERE Education.User_ID = $user_id 
                    ORDER BY Education.Debut DESC";
  $result_education = $conn->query($sql_education);

  // Fetch experience details
  $sql_experience = "SELECT Experience.*, Enterprise.Nom_Entreprise, Enterprise.Logo 
                    FROM Experience 
                    JOIN Enterprise ON Experience.Enterprise_ID = Enterprise.Enterprise_ID 
                    WHERE Experience.User_ID = $user_id 
                    ORDER BY Experience.Debut DESC";
  $result_experience = $conn->query($sql_experience);

  // Fetch projects details
  $sql_projects = "SELECT Projets.*, Education.Nom as Edu_Name 
                  FROM Projets 
                  JOIN Education ON Projets.Edu_ID = Education.Edu_ID 
                  WHERE Projets.User_ID = $user_id 
                  ORDER BY Projets.Debut DESC";
  $result_projects = $conn->query($sql_projects);

  // Fetch posts details
  $sql_posts = "SELECT * FROM Posts WHERE User_ID = $user_id ORDER BY DatePublication DESC";
  $result_posts = $conn->query($sql_posts);

  // Create XML document
  $xml = new DOMDocument('1.0', 'UTF-8');
  $xml->formatOutput = true;

  $root = $xml->createElement("CV");
  $xml->appendChild($root);

  $userElement = $xml->createElement("User");

  $userElement->appendChild($xml->createElement("UserID", $user['User_ID']));
  $userElement->appendChild($xml->createElement("Mail", $user['Mail']));
  $userElement->appendChild($xml->createElement("Nom", $user['Nom']));
  $userElement->appendChild($xml->createElement("Prenom", $user['Prenom']));
  $userElement->appendChild($xml->createElement("Username", $user['Username']));
  $userElement->appendChild($xml->createElement("Photo", $user['Photo']));
  $userElement->appendChild($xml->createElement("Pays", $user['Pays']));

  $root->appendChild($userElement);

  // Add education details
  $educationElement = $xml->createElement("Education");
  while($education = $result_education->fetch_assoc()) {
      $eduElement = $xml->createElement("Edu");

      $eduElement->appendChild($xml->createElement("Edu_ID", $education['Edu_ID']));
      $eduElement->appendChild($xml->createElement("Debut", $education['Debut']));
      $eduElement->appendChild($xml->createElement("Fin", $education['Fin']));
      $eduElement->appendChild($xml->createElement("Nom", $education['Nom']));
      $eduElement->appendChild($xml->createElement("Type_formation", $education['Type_formation']));
      $eduElement->appendChild($xml->createElement("Enterprise", $education['Nom_Entreprise']));
      $eduElement->appendChild($xml->createElement("Logo", $education['Logo']));

      $educationElement->appendChild($eduElement);
  }
  $root->appendChild($educationElement);

  // Add experience details
  $experienceElement = $xml->createElement("Experience");
  while($experience = $result_experience->fetch_assoc()) {
      $expElement = $xml->createElement("Exp");

      $expElement->appendChild($xml->createElement("Exp_ID", $experience['Exp_ID']));
      $expElement->appendChild($xml->createElement("Debut", $experience['Debut']));
      $expElement->appendChild($xml->createElement("Fin", $experience['Fin']));
      $expElement->appendChild($xml->createElement("Position", $experience['Position']));
      $expElement->appendChild($xml->createElement("Type_Contrat", $experience['Type_Contrat']));
      $expElement->appendChild($xml->createElement("Enterprise", $experience['Nom_Entreprise']));
      $expElement->appendChild($xml->createElement("Logo", $experience['Logo']));

      $experienceElement->appendChild($expElement);
  }
  $root->appendChild($experienceElement);

  // Add projects details
  $projectsElement = $xml->createElement("Projects");
  while($project = $result_projects->fetch_assoc()) {
      $projElement = $xml->createElement("Project");

      $projElement->appendChild($xml->createElement("Proj_ID", $project['Proj_ID']));
      $projElement->appendChild($xml->createElement("Debut", $project['Debut']));
      $projElement->appendChild($xml->createElement("Fin", $project['Fin']));
      $projElement->appendChild($xml->createElement("Nom", $project['Nom']));
      $projElement->appendChild($xml->createElement("Edu_Name", $project['Edu_Name']));

      $projectsElement->appendChild($projElement);
  }
  $root->appendChild($projectsElement);

  // Add posts details
  $postsElement = $xml->createElement("Posts");
  while($post = $result_posts->fetch_assoc()) {
      $postElement = $xml->createElement("Post");

      $postElement->appendChild($xml->createElement("Post_ID", $post['Post_ID']));
      $postElement->appendChild($xml->createElement("Date", $post['DatePublication']));
      $postElement->appendChild($xml->createElement("Photo", $post['Photo']));
      $postElement->appendChild($xml->createElement("Texte", $post['Texte']));

      $postsElement->appendChild($postElement);
  }
  $root->appendChild($postsElement);

  

  // Save XML file
  $xml->save("../Profile/CV.xml");

  $conn->close();

  //Creation of the CV in HTML based on the XML file
  $xml = simplexml_load_file("../Profile/CV.xml") or die("Error: Cannot create object");

  $user_id = $xml->User->UserID;
  $prenom = $xml->User->Prenom;
  $nom = $xml->User->Nom;
  $email = $xml->User->Mail;
  $pays = $xml->User->Pays;
  $photo = $xml->User->Photo;


  return $xml;

}


$xml = Creation_XML();

?>