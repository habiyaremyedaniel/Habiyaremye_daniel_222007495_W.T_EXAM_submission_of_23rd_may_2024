<?php
session_start();
//-- Habiyaremye Daniel 2220007495 WT EXAM --->

// Connect to the database (replace dbusername, userusername, password with actual credentials)
require_once "databaseconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['create'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        // Assuming 'userid' is auto-incremented primary key
        $sql = "INSERT INTO users (username, password, firstname, lastname, role, email) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssssss", $username, $password, $firstname, $lastname, $role, $email);

        if ($stmt->execute()) {
            echo "Record added successfully.";
            header("Location: index.html");
            exit(); // Terminate script after redirection
        } else {
            echo "Error adding record: " . $stmt->error;
        }
    } elseif (isset($_POST['update'])) {
        $id = $_POST['userid'];
        $newusername = $_POST['newusername'];
        $newpassword = $_POST['newpassword'];
        $newfirstname = $_POST['newfirstname'];
        $newlastname = $_POST['newlastname'];
        $newrole = $_POST['newrole'];
        $newemail = $_POST['newemail'];

        $sql = "UPDATE users SET username=?, password=?, firstname=?, lastname=?, role=?, email=? WHERE userid=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssssssi", $newusername, $newpassword, $newfirstname, $newlastname, $newrole, $newemail, $id);

        if ($stmt->execute()) {
            echo "Record updated successfully.";
        } else {
            echo "Error updating record: " . $stmt->error;
        }
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['userid'];

        $sql = "DELETE FROM users WHERE userid=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting record: " . $stmt->error;
        }
    } elseif (isset($_POST['read'])) {
        // Assuming the session contains userid
        $id = $_POST['userid'];

        // Select user's information from the database
        $sql = "SELECT * FROM users WHERE userid=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch and display user information
            $row = $result->fetch_assoc();
            echo "User ID: " . $row["userid"] . "<br>";
            echo "Username: " . $row["username"] . "<br>";
            echo "Password: " . $row["password"] . "<br>";
            echo "First Name: " . $row["firstname"] . "<br>";
            echo "Last Name: " . $row["lastname"] . "<br>";
            echo "Role: " . $row["role"] . "<br>";
            echo "Email: " . $row["email"] . "<br>";
        } else {
            echo "No user found with the provided ID.";
        }
    }
}
?>
