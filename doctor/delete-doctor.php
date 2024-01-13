<?php
session_start();

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'd') {
        header("location: ../login.php");
    }
} else {
    header("location: ../login.php");
}

if ($_GET) {
    // Import database
    include("../connection.php");
    $id = $_GET["id"];
    
    // Use prepared statement to avoid SQL injection
    $stmt = $database->prepare("SELECT * FROM doctor WHERE docid = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result001 = $stmt->get_result();

    if ($result001->num_rows > 0) {
        $email = $result001->fetch_assoc()["docemail"];

        // Use prepared statement to avoid SQL injection
        $stmtDeleteWebUser = $database->prepare("DELETE FROM webuser WHERE email = ?");
        $stmtDeleteWebUser->bind_param("s", $email);
        $stmtDeleteWebUser->execute();

        $stmtDeleteDoctor = $database->prepare("DELETE FROM doctor WHERE docemail = ?");
        $stmtDeleteDoctor->bind_param("s", $email);
        $stmtDeleteDoctor->execute();

        header("location: ../logout.php");
    } else {
        echo "Doctor not found!";
    }
}
?>
