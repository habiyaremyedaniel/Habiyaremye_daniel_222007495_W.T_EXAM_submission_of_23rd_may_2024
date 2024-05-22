<?php
session_start();
//--Habiyaremye daniel 2220007495--->

// Connect to database (replace dbuserid, useruserid, password with actual credentials)
require_once "databaseconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $userid = $_POST['userid'];
    $message = $_POST['message'];
    
   

    $sql = "INSERT INTO notifications ( message, userid) VALUES (?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ss",$message, $userid);

    if ($stmt->execute()) {
        echo "Record added successfully.";
    } else {
        echo "Error adding record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['notificationid'];
   $newuserid = $_POST['newuserid'];
    $newmessage = $_POST['newmessage'];
   
    
   
    $sql = "UPDATE notifications SET  message=?, userid=?  WHERE notificationid=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssi", $newmessage, $newuserid,$id);

    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['notificationid'];

    $sql = "DELETE FROM notifications WHERE notificationid=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['read'])) {
    // Assuming the session contains notificationid
    $id = $_POST['notificationid'];

    // Select user_notifications's information from the database
    $sql = "SELECT * FROM notifications WHERE notificationid=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch and display user_notifications information
        $row = $result->fetch_assoc();
        echo "notificationid: " . $row["notificationid"] . "<br>";
        echo "userid: " . $row["userid"] . "<br>";
        echo "message: " . $row["message"] . "<br>";
        
        
    } else {
        echo "No user found with the provided ID.";
    }
}


?>