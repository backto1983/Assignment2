<?php ob_start(); ?>
    <!DOCTYPE html>
    <html lang="en-ca">
        <head>
            <meta charset="UTF-8">
            <title>Delete A Page</title>
        </head>
            <body>
            <?php
            try {
                #Require_once statement used to refer to a php file that connects to a server in order to avoid repeating lines of code
                require_once('db.php');
                $sql = "DELETE FROM pages WHERE pageID = :pageID";
                $cmd = $conn->prepare($sql);
                $cmd->bindParam(':pageID', $_GET['pageID'], PDO::PARAM_INT);
                $cmd->execute();
                $conn = null;
                header('location:pagesList.php'); #"Header" is a network function which redirects the user to another address directly
            }
            catch (exception $e) { #In case there is a problem with the SQL command, catch the exception and send an email to inform about the problem
                mail('200358165@student.georgianc.on.ca', 'Somebody Crashed Your Web Site', $e);
                header('location:error.php');
            }
            ?>
            </body>
    </html>
<?php ob_flush(); ?>