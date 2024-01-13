<?php

session_start();

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'p') {
        header("location: ../login.php");
    }
} else {
    header("location: ../login.php");
}

if ($_GET) {
    //import database
    include("../connection.php");
    $id = $_GET["id"];

    // Use a prepared statement for deletion
    $stmt = $database->prepare("DELETE FROM appointment WHERE appoid = ?");
    $stmt->bind_param("i", $id);
    
    // Execute the prepared statement
    $stmt->execute();

    // Close the statement
    $stmt->close();

    header("location: appointment.php");
}
?>
