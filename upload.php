#!/usr/local/bin/php

<?php
    // The following block of code is just making sure we can have a connection ahaha 
    try
    { // attempt to establish connection 
        $mydb = new SQLite3('uploads.db'); // opens or creates the database
    }
    catch(Exception $ex)
    { // may throw
        echo $ex->getMessage();
    }

    // if we get to this point it works and we need to create or open our table 
    $statement = 'CREATE TABLE IF NOT EXISTS allImages(imageName TEXT, uploaderName TEXT, datey TEXT, locationName TEXT, views REAL);';
    $run = $mydb->query($statement); // run the command

    $allIsWell = 1;
    $name= $_FILES['filename']['name'];
    $dirTemp = "uploads/";
    $files = scandir($dirTemp);
    $fileTemp = $dirTemp . baseName($_FILES['filename']['name']);
    $thisType = strtolower(pathinfo($fileTemp, PATHINFO_EXTENSION));

    if(isset($_POST['upload']))
    // if visitor tries to upload something 
    { 
        // check if user is uploading an image 
        if($thisType !== "jpg" && $thisType !== "jpeg" && $thisType !== "png")
        {
            echo "Please submit a valid image.";
            $allIsWell = 0;
        }

        $nameCheck = $_POST['imageName'];
        // check if it is an original title 
        if (array_search($nameCheck, $files)) // check if it is an original title 
        {
            echo "A photo named ";
            echo $nameCheck;
            echo " already exists.";
            $allIsWell = 0; 
        }

        // the file is in fact an image and the name is original
        // we can upload now yay
        if ($allIsWell === 1)
        {

            // feed the query, for he is hungry 
            move_uploaded_file($_FILES['fileName']['$dirTemp'], 'uploads/'.'$pngName');
            // record the date and time 
            date_default_timezone_set('America/Los_Angeles');
            $setDate = date('d/m/Y') . ' ' .date('H:i:s');
            $uploader = $_POST['userName'];
            $whereItAt = 'uploads/'. $_POST['filename'];
            // Put 0 for views because this file is new
            $statement = "INSERT INTO allImages(imageName, uploaderName, datey, locationName, views) VALUES ('$pngName', '$uploader', '$setDate', '$whereItAt', 0);";
            $run = mydb->query($statement);
        }
        // it should be uploaded now, but if not I am sorry 
        // shawty I got that neurodivergent brain
    }
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>
            <?php 
                $nameForTitle = $_POST['userName'];
                echo "Thank you, ";
                echo $nameForTitle;
                echo "!"; 
            ?>
        </title>
    </head>
    <body>
       
    </body>
</html>