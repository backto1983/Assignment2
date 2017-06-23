<!--Login validation; check if password match and, in case it does, initiate a session-->
<?php
    $email = $_POST['email'];
    $password = $_POST['password'];
    require_once ('db.php');

    try {
        $sql = "SELECT * FROM users WHERE email = :email";
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':email',$email,PDO::PARAM_STR, 120);
        $cmd->execute();
    }
    catch (exception $e) {
        mail('200358165@student.georgianc.on.ca', 'Somebody Crashed Your Web Site', $e);
        header('location:error.php');
    }
        $user = $cmd->fetch();

    #Validate the user
    if (password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['email']  = $user['email'];
        $_SESSION['username'] = $user['username'];
        header('location:controlPanel.php');
    }
    else { #User was not found or did not have a valid password
        header('location:login.php?invalid=true');
        exit();
    }
    $conn=null;
?>