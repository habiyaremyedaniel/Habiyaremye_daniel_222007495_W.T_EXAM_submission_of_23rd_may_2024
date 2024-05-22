<?php
session_start();
//--Habiyaremye daniel 2220007495--->

// Connect to database (replace dbuserid, useruserid, password with actual credentials)
require_once "databaseconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    
    $settingname = $_POST['settingname'];
    $value = $_POST['value'];
   

    $sql = "INSERT INTO settings ( settingname,  value) VALUES (?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ss",$settingname, $value);

    if ($stmt->execute()) {
        echo "Record added successfully.";
    } else {
        echo "Error adding record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['settingid'];
   
    $newsettingname = $_POST['newsettingname'];
   
    $newvalue = $_POST['newvalue'];
   
    $sql = "UPDATE settings SET  settingname=?, value=?  WHERE settingid=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssi", $newsettingname, $newvalue,$id);

    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['settingid'];

    $sql = "DELETE FROM settings WHERE settingid=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['read'])) {
    // Assuming the session contains settingid
    $id = $_POST['settingid'];

    // Select user_settings's information from the database
    $sql = "SELECT * FROM settings WHERE settingid=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch and display user_settings information
        $row = $result->fetch_assoc();
        echo "settingid: " . $row["settingid"] . "<br>";
        echo "settingname: " . $row["settingname"] . "<br>";
        echo "value: " . $row["value"] . "<br>";
        
    } else {
        echo "No user found with the provided ID.";
    }
}


?>