<?php
    $pageTitle = 'Home';
    #Require_once statement used to refer to a php file containing all the header information in order to avoid repeating lines of code
    require_once ('header.php');

    $pageID = $_GET['pageID'];
    require('db.php');

    $sql = "SELECT * FROM pages WHERE pageID = :pageID";
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':pageID', $pageID, PDO::PARAM_INT);
    $cmd->execute();
    $pages = $cmd->fetch();

    echo '<h1 class="text-center">'.$pages['title'].'</h1><br />';
    echo '<p>'.$pages['content'].'</p>';

require_once ('footer.php');
?>
