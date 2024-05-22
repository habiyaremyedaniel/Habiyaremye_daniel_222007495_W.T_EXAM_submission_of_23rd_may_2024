<?php
session_start();
//--Habiyaremye daniel 2220007495--->

// Connect to database (replace dbscenename   , userscenename, password with actual credentials)
require_once "databaseconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $scenename = $_POST['scenename'];
    $description = $_POST['description'];
    $active = $_POST['active'];
   

    $sql = "INSERT INTO scenes (scenename, description,  active) values (?,?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sss", $scenename   , $description, $active);

    if ($stmt->execute()) {
        echo "Record added successfully.";
    } else {
        echo "Error adding record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['sceneid'];
    $newscenename  = $_POST['newscenename  '];
    $newdescription = $_POST['newdescription'];
   
    $newactive = $_POST['newactive'];
   
    $sql = "UPDATE scenes SET scenename  =?, description=?, active=?  WHERE sceneid=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssi", $newscenename   , $newdescription, $newactive,$id);

    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['sceneid'];

    $sql = "DELETE FROM scenes WHERE sceneid=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['read'])) {
    // Assuming the session contains sceneid
    $id = $_POST['sceneid'];

    // Select user_scenes's information from the database
    $sql = "SELECT * FROM scenes WHERE sceneid=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch and display user_scenes information
        $row = $result->fetch_assoc();
        echo "sceneid: " . $row["sceneid"] . "<br>";
        echo "scenename   : " . $row["scenename  "] . "<br>";
        echo "description: " . $row["description"] . "<br>";
        echo "active: " . $row["active"] . "<br>";
        
    } else {
        echo "No user found with the provided ID.";
    }
}


?>