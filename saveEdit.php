<!DOCTYPE html>
<html lang="en-ca">
    <head>
        <meta charset="UTF-8">
        <title>Registering User</title>
    </head>
    <body>
    <?php
        $email = $_POST['email']; #Association of php variables with information posted in the "editUser" php file
        $oldEmail = $_POST['oldEmail'];
        $username = $_POST['username'];
        $birthday = strtotime($_POST["birthday"]);
        $birthday = date('Y-m-d H:i:s', $birthday);
        $ok = true;
        if ($ok) {
            require_once('db.php');
            #sql statement used to update information edited in the DB
            $sql = "UPDATE users SET email = :email, username = :username, birthday = :birthday WHERE email = :oldEmail";
            $cmd = $conn->prepare($sql);
            #Parameter binding to avoid sql injections
            $cmd->bindParam(':email', $email, PDO::PARAM_STR, 120);
            $cmd->bindParam(':oldEmail', $oldEmail, PDO::PARAM_STR, 120);
            $cmd->bindParam(':username', $username, PDO::PARAM_STR, 100);
            $cmd->bindParam(':birthday', $birthday, PDO::PARAM_STR);

            try { #Try/catch block to deal with possible duplicate entries
                $cmd->execute();
            }
                catch (Exception $e) {
                echo $e . '<br />';
                if (strpos($e->getMessage(), 'Integrity constraint violation: 1062') == true) {
                    header('location:registration.php?errorMessage=email-already-exists');
                }
            }
            $conn = null;
            header('location:login.php');
        }
    ?>
    </body>
</html>