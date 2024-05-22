<?php
session_start();
//--Habiyaremye daniel 2220007495--->

// Connect to database (replace dbuserid, useruserid, password with actual credentials)
require_once "databaseconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    
    $eventtype = $_POST['eventtype'];
    $description = $_POST['description'];
   

    $sql = "INSERT INTO events ( eventtype, description) values (?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ss",$eventtype, $description);

    if ($stmt->execute()) {
        echo "Record added successfully.";
    } else {
        echo "Error adding record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['eventid'];
   
    $neweventtype = $_POST['neweventtype'];
   
    $newdescription = $_POST['newdescription'];
   
    $sql = "UPDATE events SET  eventtype=?, description=?  WHERE eventid=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssi", $neweventtype, $newdescription,$id);

    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['eventid'];

    $sql = "DELETE FROM events WHERE eventid=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['read'])) {
    // Assuming the session contains eventid
    $id = $_POST['eventid'];

    // Select user_events's information from the database
    $sql = "SELECT * FROM events WHERE eventid=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch and display user_events information
        $row = $result->fetch_assoc();
        echo "eventid: " . $row["eventid"] . "<br>";
        echo "eventtype: " . $row["eventtype"] . "<br>";
        echo "description: " . $row["description"] . "<br>";
        
    } else {
        echo "No user found with the provided ID.";
    }
}


?>