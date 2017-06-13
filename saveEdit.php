<!DOCTYPE html>
<html lang="en-ca">
    <head>
        <meta charset="UTF-8">
        <title>Registering User</title>
    </head>
    <body>
    <?php
    $email = $_POST['email'];
    $username = $_POST['username'];
    $birthday = strtotime($_POST["birthday"]);
    $birthday = date('Y-m-d H:i:s', $birthday);
    $ok = true;

    if ($ok) {
        require_once('db.php');
        require('db.php');
        include_once('db.php');
        include('db.php');

        $sql = "UPDATE users SET email = :email, username = :username, birthday = :birthday WHERE email = :email";

        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':email', $email, PDO::PARAM_STR, 120);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 100);
        $cmd->bindParam(':birthday', $birthday, PDO::PARAM_STR);

        try {
            $cmd->execute();
        } catch (Exception $e) {
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
