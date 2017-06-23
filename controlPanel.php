<?php
    $pageTitle = 'Control Panel';
    require_once('header.php');
echo '<main class="container">
    <h1><a href="registeredUsers.php">Administrators</a></h1>
    <p>Add, Edit or Delete Site Administrators</p>
    <h1><a href="pagesList.php">Pages</a></h1>
    <p>Manage Public Site Content</p>
    <h1><a href="uploadLogo.php">Logos</a></h1>
    <p>Upload A New Logo To The Header</p>
    <h1><a href="logout.php?">Public Site</a></h1>
    <p>View the Public Site</p>
</main>';
require_once ('footer.php'); #Using a control structure statement (require_once) to include something (in this case, the footer) to this page
?>
