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
        $password = $_POST['password'];
        $confirm = $_POST['confirm'];
        $ok = true;
        #Check if the passwords match
        if ($password != $confirm) {
            echo 'The passwords do not match <br />';
            $ok = false;
        }
        if (strlen($password) < 8) {
            echo 'The password is too short, must be 8 or more characters
                                                            <br />';
            $ok = false;
        }
        if (empty($email)) {
            echo 'You must enter an email address <br />';
            $ok = false;
        }
        #If the email and password are ok, insert information inserted in the form from "registration" in the "users" DB
        if ($ok) {
            require_once ('db.php');
            $sql = "INSERT INTO users (email, username, birthday, password) VALUES (:email, :username, :birthday, :password)";
            #Hash the password
            $password = password_hash($password, PASSWORD_DEFAULT);
            $cmd = $conn->prepare($sql);
            $cmd->bindParam(':email', $email, PDO::PARAM_STR, 120);
            $cmd->bindParam(':username', $username, PDO::PARAM_STR, 100);
            $cmd->bindParam(':birthday', $birthday, PDO::PARAM_STR);
            $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
            try {
                $cmd->execute();
            }
            catch (Exception $e) {
                if (strpos($e->getMessage(),'Integrity constraint violation: 1062') == true) {
                    header('location:registration.php?errorMessage=email-already-exists');
                }
            }
            $conn = null;
            header('location:login.php');
        }
    ?>
    </body>
</html>