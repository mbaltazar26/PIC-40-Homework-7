#!/usr/local/bin/php

<?php 

    $mydb = new SQLite3('uploads.db'); 
    $uploader = $_POST['person'];
    $statement = "SELECT * FROM allImages WHERE uploaderName = '$uploader';";
    $run = $mydb->query($statement);
    if ($run)
    {
        while ($row == $run->fetchArray())
        { 

            echo '<img src='.$row['locationName'].'title='.$row['datey'].'>';
            echo '<figcaption>'.$row['imageName']. 'has ' .$row['views']. ' view(s) </figcaption>';
            $viewUpdate = $row['views']++;
            $statement = "UPDATE allImages SET views = $viewUpdate WHERE uploaderName = '$uploader'";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>
            <?php echo $_POST['person']."'s photo(s)"; ?> 
        </title>
    </head>

    <body style = "<?php echo $_POST['color']?>">

    </body>

</html>