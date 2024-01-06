<?php

    $database= new mysqli("localhost","root","","happyteeth");
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>