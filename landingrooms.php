<?php
session_start();
//--Habiyaremye daniel 2220007495--->

// Connect to database (replace dbroomname, userroomname, password with actual credentials)
require_once "databaseconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $roomname = $_POST['roomname'];
    $description = $_POST['description'];
   

    $sql = "INSERT INTO rooms (roomname, description) VALUES (?,?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ss", $roomname, $description);

    if ($stmt->execute()) {
        echo "Record added successfully.";
    } else {
        echo "Error adding record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['roomid'];
    $newroomname = $_POST['newroomname'];
    $newdescription = $_POST['newdescription'];
   
    $sql = "UPDATE rooms SET roomname=?, description=? WHERE roomid=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssi", $newroomname, $newdescription,$id);

    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['roomid'];

    $sql = "DELETE FROM rooms WHERE roomid=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['read'])) {
    // Assuming the session contains roomid
    $id = $_POST['roomid'];

    // Select user_rooms's information from the database
    $sql = "SELECT * FROM rooms WHERE roomid=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch and display user_rooms information
        $row = $result->fetch_assoc();
        echo "roomid: " . $row["roomid"] . "<br>";
        echo "roomname: " . $row["roomname"] . "<br>";
        echo "description: " . $row["description"] . "<br>";
       
        
    } else {
        echo "No user found with the provided ID.";
    }
}


?>