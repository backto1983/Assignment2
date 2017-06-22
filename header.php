<!DOCTYPE html>
<html lang="en-ca">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-inverse">
    <ul class="nav navbar-nav">
        <?php
            try {
                require_once('db.php');

                $headerLogo = null;

                $sql = "SELECT headerLogo FROM logo WHERE headerLogoID = :headerLogoID";
                $cmd = $conn->prepare($sql);
                $cmd->bindParam(':headerLogoID', $headerLogoID, PDO::PARAM_INT);
                $cmd->execute();
                $headerLogo = $cmd->fetch();
            }
            catch (exception $e) {
                mail('200358165@student.georgianc.on.ca', 'Somebody Crashed Your Web Site', $e);
                header('location:error.php');
            }
        ?>
        <li><img height="50" width="50" src="<?php echo $headerLogo['headerLogo'] ?>" id="headerLogo" title="Header Logo"></li>
        <li><a href="default.php" class="navbar-brand">Web Site Builder</a></li>

        <?php
        #Public links; they appear even when not logged in
        session_start();
        if (empty($_SESSION['email'])) { #Function used to initiate a session using a parameter
            echo '<li><a href="registration.php">Registration</a></li>
                  <li><a href="login.php">Login</a></li>';
        }
        #Private links; only appear if you're logged
        else {
            echo '<li><a href="registeredUsers.php">Registered Users</a></li>';
            echo '<li><a href="controlPanel.php">Control Panel</a></li>';
            echo '<li><a href="logout.php">Logout</a></li>';

            #Add the user name to the navigation bar
            echo '<li><div class="navbar-text pull-right">' . $_SESSION['email'] . '</div></li>';
        }
        ?>
    </ul>
</nav>