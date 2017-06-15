<?php ob_start(); ?>
    <!DOCTYPE html>
        <html lang="en-ca">
        <head>
            <meta charset="UTF-8">
            <title>Delete A User</title>
        </head>
        <body>
        <?php
            require_once('db.php');
            $sql = "DELETE FROM users WHERE email = :email";
            $cmd = $conn->prepare($sql);
            $cmd->bindParam(':email', $_GET['email'], PDO::PARAM_STR);
            $cmd->execute();
            $conn = null;
            header('location:registeredUsers.php');
        ?>
        </body>
    </html>
<?php ob_flush(); ?>