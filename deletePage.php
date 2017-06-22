<?php ob_start(); ?>
    <!DOCTYPE html>
    <html lang="en-ca">
        <head>
            <meta charset="UTF-8">
            <title>Delete A Page</title>
        </head>
            <body>
            <?php
                #Require_once statement used to refer to a php file that connects to a server in order to avoid repeating lines of code
                require_once('db.php');
                $sql = "DELETE FROM pages WHERE pageID = :pageID";
                $cmd = $conn->prepare($sql);
                $cmd->bindParam(':pageID', $_GET['pageID'], PDO::PARAM_INT);
                $cmd->execute();
                $conn = null;
                header('location:pagesList.php');
            ?>
            </body>
    </html>
<?php ob_flush(); ?>