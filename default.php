<?php
    $pageTitle = 'Home';
    require_once ('header.php');

    $pageID = $_GET['pageID']; #$_GET to get passed variables contained in an array
    require('db.php');

    $sql = "SELECT * FROM pages WHERE pageID = :pageID"; #SQL command to select all information contained in the "pages" DB
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':pageID', $pageID, PDO::PARAM_INT); #Binding parameters to avoid SQL injections
    $cmd->execute();
    $pages = $cmd->fetch(); #Fetch information from a table (a row)...

    echo '<h1 class="text-center">'.$pages['title'].'</h1><br />'; #to print to the screen
    echo '<p class="text-justify">'.$pages['content'].'</p>';

require_once ('footer.php');
?>
