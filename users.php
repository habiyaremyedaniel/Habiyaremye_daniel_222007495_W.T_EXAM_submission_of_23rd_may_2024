<?php

//habiyaremye daniel 222007495 april 2024
                // Database connection parameters
$servername = "localhost";
$username = "Daniel";
$password = "DanielH@2024";
$dbname = "home_automation_control_systems";

                // Create database connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check database connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

$sql = "SELECT * FROM users";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<title>The Information about users</title>";
    echo "<h1>The Information about users</h1>";
    echo "<table border='1'>
            <tr>
                <th>userid</th>
                <th>username</th>
                <th>password</th>
               <th>firstname</th>
                <th>lastname</th>
                <th>email</th>
                <th>role</th>
            </tr>";

     //habiyaremye daniel 222007495 april 2024

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["userid"] . "</td>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["password"] . "</td>";
        echo "<td>" . $row["firstname"] . "</td>";
        echo "<td>" . $row["lastname"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["role"] . "</td>";
       
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "no information found";
}

//habiyaremye daniel 222007495 april 2024

$conn->close();
?>
