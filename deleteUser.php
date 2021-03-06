<?php ob_start(); ?>
    <!DOCTYPE html>
    <html lang="en-ca">
        <head>
            <meta charset="UTF-8">
            <title>Delete A User</title>
        </head>
        <body>
        <?php
            try {
                #Require_once statement used to refer to a php file that connects to a server in order to avoid repeating lines of code
                require_once('db.php');
                $sql = "DELETE FROM users WHERE email = :email";
                $cmd = $conn->prepare($sql);
                $cmd->bindParam(':email', $_GET['email'], PDO::PARAM_STR, 120);
                $cmd->execute();
            }
            catch (exception $e) {
                mail('200358165@student.georgianc.on.ca', 'Somebody Crashed Your Web Site', $e);
                header('location:error.php');
            }
                $conn = null;
                header('location:registeredUsers.php');


        ?>
        </body>
    </html>
<?php ob_flush(); ?>